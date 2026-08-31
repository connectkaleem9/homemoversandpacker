<?php
/**
 * Contact message endpoint — the short "send us a message" form.
 *
 * POST only, redirects back to the contact page. Blocked in robots.txt.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/lead-handler.php';

lead_guard('/contact-us/', 'contact');

/* lead_guard() has set the language from the posted form, so the fallback
   lands the visitor back on the contact page in the language they were in. */
define('CONTACT_FALLBACK', lang_url('/contact-us/'));

$input = [
    'name'    => lead_clean($_POST['name'] ?? '', 120),
    'phone'   => lead_clean($_POST['phone'] ?? '', 32),
    'email'   => lead_clean($_POST['email'] ?? '', 160),
    'subject' => lead_clean($_POST['subject'] ?? '', 160),
    'message' => lead_clean($_POST['message'] ?? '', 2000),
    'source'  => lead_clean($_POST['source'] ?? '', 120),
];

$errors = [];

if (mb_strlen($input['name']) < 2) {
    $errors['name'] = t('err.name');
}
if ($input['phone'] === '' && $input['email'] === '') {
    $errors['phone'] = t('err.reach');
} elseif ($input['phone'] !== '' && !lead_valid_uae_phone($input['phone'])) {
    $errors['phone'] = t('err.phone_invalid');
}
if ($input['email'] !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = t('err.email');
}
if (mb_strlen($input['message']) < 10) {
    $errors['message'] = t('err.message');
}

if ($errors !== []) {
    lead_redirect(
        CONTACT_FALLBACK,
        'error',
        t('err.check_message'),
        $input,
        $errors,
        'contact'
    );
}

$lead = [
    'type'        => 'contact',
    'name'        => $input['name'],
    'phone'       => $input['phone'] !== '' ? lead_normalise_phone($input['phone']) : '',
    'email'       => $input['email'],
    'subject'     => $input['subject'] !== '' ? $input['subject'] : 'Website message',
    'message'     => $input['message'],
    'source'      => $input['source'],
    'ip_address'  => lead_client_ip(),
    'user_agent'  => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    'received_at' => date('c'),
];

if (!lead_store_contact($lead)) {
    lead_redirect(
        CONTACT_FALLBACK,
        'error',
        t('lead.store_failed', ['phone' => PHONE_DISPLAY]),
        $input,
        [],
        'contact'
    );
}

lead_notify('Website message — ' . $lead['subject'], $lead);

lead_redirect(
    CONTACT_FALLBACK,
    'success',
    t('lead.message_ok', ['phone' => PHONE_DISPLAY]),
    [],
    [],
    'contact'
);
