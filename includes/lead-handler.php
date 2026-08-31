<?php
/**
 * Shared lead pipeline for the quote, contact and review forms.
 *
 * Order of defence:
 *   1. POST only, CSRF token, honeypot, submission timing, per-IP rate limit
 *   2. Validation and sanitisation of every field
 *   3. Storage — MySQL when enabled, append-only file otherwise (never both fail
 *      silently: a failure to store is logged and the lead still goes by email)
 *   4. Email notification to the business
 *   5. POST-redirect-GET back to the originating page with a flash message
 *
 * lead_clean() used to live here. It is a general-purpose input sanitiser, so
 * it moved to functions.php once the admin dashboard needed it too.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/database.php';

/** Header-injection guard for anything that reaches a mail header. */
function lead_header_safe(string $value): string
{
    return trim(str_replace(["\r", "\n", "%0a", "%0d"], '', $value));
}

function lead_valid_uae_phone(string $phone): bool
{
    $digits = preg_replace('/[^\d+]/', '', $phone) ?? '';
    return (bool) preg_match('/^(?:\+?971|0)?5\d{8}$/', $digits);
}

/** Normalise any accepted UAE mobile format to +9715XXXXXXXX. */
function lead_normalise_phone(string $phone): string
{
    $digits = preg_replace('/\D/', '', $phone) ?? '';
    if (str_starts_with($digits, '971')) {
        return '+' . $digits;
    }
    return '+971' . ltrim($digits, '0');
}

function lead_client_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
}

/**
 * Per-IP rate limit backed by a small JSON file. Returns false when the caller
 * has exceeded RATE_LIMIT_MAX submissions inside RATE_LIMIT_WINDOW seconds.
 */
function lead_rate_ok(): bool
{
    $file = APP_ROOT . '/storage/rate-limit.json';
    $now  = time();
    $ip   = lead_client_ip();

    $data = [];
    if (is_readable($file)) {
        $decoded = json_decode((string) file_get_contents($file), true);
        if (is_array($decoded)) {
            $data = $decoded;
        }
    }

    /* Drop entries outside the window, for every IP, so the file stays small. */
    foreach ($data as $key => $stamps) {
        $data[$key] = array_values(array_filter(
            (array) $stamps,
            static fn ($t): bool => is_int($t) && ($now - $t) < RATE_LIMIT_WINDOW
        ));
        if ($data[$key] === []) {
            unset($data[$key]);
        }
    }

    $count = count($data[$ip] ?? []);
    if ($count >= RATE_LIMIT_MAX) {
        return false;
    }

    $data[$ip][] = $now;

    if (!is_dir(dirname($file))) {
        @mkdir(dirname($file), 0775, true);
    }
    @file_put_contents($file, json_encode($data), LOCK_EX);

    return true;
}

/** Append the lead to the fallback file. Used when MySQL is off or unreachable. */
function lead_store_file(array $lead): bool
{
    $file = LEAD_FALLBACK_FILE;
    if (!is_dir(dirname($file))) {
        @mkdir(dirname($file), 0775, true);
    }
    $line = json_encode($lead, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return (bool) @file_put_contents($file, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
}

/** Store a quote submission. Returns true if it landed anywhere durable. */
function lead_store_quote(array $lead): bool
{
    $id = db_insert(
        'INSERT INTO quote_submissions
            (name, phone, email, moving_from, moving_to, property_type, moving_date,
             service, details, source, ip_address, user_agent, created_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())',
        [
            $lead['name'], $lead['phone'], $lead['email'], $lead['moving_from'],
            $lead['moving_to'], $lead['property_type'], $lead['moving_date'] ?: null,
            $lead['service'], $lead['details'], $lead['source'],
            $lead['ip_address'], $lead['user_agent'],
        ]
    );

    $fileOk = lead_store_file($lead);

    if ($id === null && !$fileOk) {
        error_log('[lead] FAILED to store quote from ' . $lead['phone']);
        return false;
    }
    return true;
}

/** Store a contact-message submission. */
function lead_store_contact(array $lead): bool
{
    $id = db_insert(
        'INSERT INTO contact_submissions
            (name, phone, email, subject, message, source, ip_address, user_agent, created_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())',
        [
            $lead['name'], $lead['phone'], $lead['email'], $lead['subject'],
            $lead['message'], $lead['source'], $lead['ip_address'], $lead['user_agent'],
        ]
    );

    $fileOk = lead_store_file($lead);

    if ($id === null && !$fileOk) {
        error_log('[lead] FAILED to store contact message from ' . $lead['phone']);
        return false;
    }
    return true;
}

/**
 * Notify the business. Failure here is logged but never shown to the customer —
 * the lead is already stored, and telling a visitor "email failed" helps nobody.
 */
function lead_notify(string $subject, array $lead): void
{
    $lines = [];
    foreach ($lead as $key => $value) {
        if ($value === '' || $value === null) {
            continue;
        }
        $label = ucwords(str_replace('_', ' ', (string) $key));
        $lines[] = $label . ': ' . $value;
    }

    $body = "New enquiry from " . SITE_DOMAIN . "\n\n" . implode("\n", $lines) . "\n";

    $replyTo = '';
    if (!empty($lead['email']) && filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
        $replyTo = lead_header_safe((string) $lead['email']);
    }

    $headers = [
        'From: ' . mb_encode_mimeheader(SITE_NAME, 'UTF-8', 'B') . ' <no-reply@' . SITE_DOMAIN . '>',
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . PHP_VERSION,
    ];
    if ($replyTo !== '') {
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    /*
     * Say WHY it failed. A generic "could not be sent" sent us looking at the
     * mail server when the recipient address was simply empty. The lead is
     * stored either way, but nobody goes and reads a .jsonl file, so a
     * notification that quietly stops arriving is the worst failure here.
     */
    if (LEAD_NOTIFY_EMAIL === '') {
        error_log('[lead] LEAD_NOTIFY_EMAIL is empty, no notification sent for: ' . $subject
                . ' (the lead itself was stored)');
        return;
    }

    /* Mail headers must be ASCII, and a subject carries an em dash — or, from
       the contact form, whatever the visitor typed, in either language. */
    $sent = @mail(
        LEAD_NOTIFY_EMAIL,
        mb_encode_mimeheader(lead_header_safe($subject), 'UTF-8', 'B'),
        $body,
        implode("\r\n", $headers)
    );

    if (!$sent) {
        error_log('[lead] mail() refused the notification to ' . LEAD_NOTIFY_EMAIL
                . ' for: ' . $subject . ' (the lead itself was stored)');
    }

    /*
     * A true return only means the local mail system accepted the message. It
     * says nothing about whether the recipient's provider did — and this domain
     * publishes no SPF record, so mail claiming to be from it is unauthenticated
     * and Gmail may file it as spam with nothing logged anywhere.
     *
     * That is why every lead is written to storage BEFORE this function is
     * called, and why a missing notification is an inconvenience rather than a
     * lost enquiry. See "Lead notifications" in README.md for the SPF record.
     */
}

/**
 * Store flash state and redirect back to the form the visitor came from.
 * $form tags the flash so a page carrying two forms shows the message on the
 * right one instead of the first one that renders.
 */
function lead_redirect(
    string $fallback,
    string $type,
    string $message,
    array $old = [],
    array $errors = [],
    string $form = 'quote'
): never {
    start_session();
    $_SESSION['form_flash']  = ['type' => $type, 'message' => $message, 'form' => $form];
    $_SESSION['form_old']    = $old;
    $_SESSION['form_errors'] = $errors;

    $target = $fallback;
    $ref    = $_SERVER['HTTP_REFERER'] ?? '';

    /*
     * Only ever redirect to our own host — an open redirect here would let a
     * third-party page bounce a visitor off our domain through a form post.
     *
     * The port is part of the comparison: HTTP_HOST carries it, parse_url()
     * returns it separately, and without reassembling it the check fails on
     * any non-standard port and every submission falls back to the contact
     * page instead of returning to the form the visitor used.
     */
    if ($ref !== '') {
        $parts = parse_url($ref);
        $host  = $parts['host'] ?? '';
        if (isset($parts['port'])) {
            $host .= ':' . $parts['port'];
        }
        if ($host === '' || $host === ($_SERVER['HTTP_HOST'] ?? '')) {
            $target = ($parts['path'] ?? $fallback);
        }
    }

    /* Land on the form the visitor actually used, not just any form. */
    $anchor = match ($form) {
        'contact' => '#message',
        'review'  => '#write-review',
        default   => '#quote',
    };

    header('Location: ' . $target . $anchor, true, 303);
    exit;
}

/** Guard rails shared by both endpoints. Terminates the request on failure. */
function lead_guard(string $fallback, string $form = 'quote'): void
{
    /* Reply in the language the form was rendered in, not the endpoint's. */
    lang_set($_POST['form_lang'] ?? null);

    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        header('Location: ' . $fallback, true, 303);
        exit;
    }

    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        lead_redirect($fallback, 'error', t('lead.expired', ['phone' => PHONE_DISPLAY]), [], [], $form);
    }

    /* Honeypot — a real person never fills a field they cannot see. */
    if (lead_clean($_POST['company_website'] ?? '') !== '') {
        /* Pretend it worked; do not tell a bot it was detected. */
        lead_redirect($fallback, 'success', t('lead.soon'), [], [], $form);
    }

    /* Timing — a form completed faster than a human could type it. */
    $started = (int) ($_POST['form_started'] ?? 0);
    if ($started > 0 && (time() - $started) < FORM_MIN_SECONDS) {
        lead_redirect($fallback, 'success', t('lead.soon'), [], [], $form);
    }

    if (!lead_rate_ok()) {
        lead_redirect($fallback, 'error', t('lead.rate', ['phone' => PHONE_DISPLAY]), [], [], $form);
    }
}
