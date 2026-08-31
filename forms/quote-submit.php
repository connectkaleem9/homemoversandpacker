<?php
/**
 * Quote form endpoint.
 *
 * Never rendered directly — POST only, then redirects back to the page the
 * visitor submitted from. Blocked in robots.txt and noindexed by .htaccess.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/lead-handler.php';

lead_guard('/contact-us/');

/* lead_guard() has set the language from the posted form, so the fallback
   lands the visitor back on the contact page in the language they were in. */
define('QUOTE_FALLBACK', lang_url('/contact-us/'));

/* ---------------------------------------------------------------- input */
$input = [
    'name'          => lead_clean($_POST['name'] ?? '', 120),
    'phone'         => lead_clean($_POST['phone'] ?? '', 32),
    'email'         => lead_clean($_POST['email'] ?? '', 160),
    'moving_from'   => lead_clean($_POST['moving_from'] ?? '', 160),
    'moving_to'     => lead_clean($_POST['moving_to'] ?? '', 160),
    'property_type' => lead_clean($_POST['property_type'] ?? '', 60),
    'moving_date'   => lead_clean($_POST['moving_date'] ?? '', 10),
    'service'       => lead_clean($_POST['service'] ?? '', 60),
    'details'       => lead_clean($_POST['details'] ?? '', 2000),
    'source'        => lead_clean($_POST['source'] ?? '', 120),
];

/* ----------------------------------------------------------- validation */
$errors = [];

if (mb_strlen($input['name']) < 2) {
    $errors['name'] = t('err.name');
}
if ($input['phone'] === '') {
    $errors['phone'] = t('err.phone_missing');
} elseif (!lead_valid_uae_phone($input['phone'])) {
    $errors['phone'] = t('err.phone_invalid');
}
if ($input['email'] !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = t('err.email');
}
if ($input['moving_from'] === '') {
    $errors['moving_from'] = t('err.from');
}
if ($input['moving_to'] === '') {
    $errors['moving_to'] = t('err.to');
}
if ($input['moving_date'] !== '') {
    $date = DateTimeImmutable::createFromFormat('Y-m-d', $input['moving_date']);
    if ($date === false || $date->format('Y-m-d') !== $input['moving_date']) {
        $errors['moving_date'] = t('err.date');
    }
}

/* Only accept a service slug we actually publish. */
if ($input['service'] !== '' && $input['service'] !== 'not-sure' && get_service($input['service']) === null) {
    $input['service'] = '';
}

if ($errors !== []) {
    lead_redirect(
        QUOTE_FALLBACK,
        'error',
        t('err.check_form'),
        $input,
        $errors
    );
}

/* -------------------------------------------------------------- storage */
/*
 * The stored service name is always the English one, even when the form was
 * filled in Arabic: the leads table and the notification email are read by one
 * team in one inbox, and a column that switches language per row is unreadable.
 */
$serviceNames = require dirname(__DIR__) . '/includes/data/services.php';

$service = $input['service'] !== '' && $input['service'] !== 'not-sure'
    ? ($serviceNames[$input['service']]['name'] ?? $input['service'])
    : ($input['service'] === 'not-sure' ? 'Not sure — please advise' : '');

$lead = [
    'type'          => 'quote',
    'name'          => $input['name'],
    'phone'         => lead_normalise_phone($input['phone']),
    'email'         => $input['email'],
    'moving_from'   => $input['moving_from'],
    'moving_to'     => $input['moving_to'],
    'property_type' => $input['property_type'],
    'moving_date'   => $input['moving_date'],
    'service'       => $service,
    'details'       => $input['details'],
    'source'        => $input['source'],
    'ip_address'    => lead_client_ip(),
    'user_agent'    => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
    'received_at'   => date('c'),
];

$stored = lead_store_quote($lead);

if (!$stored) {
    lead_redirect(
        QUOTE_FALLBACK,
        'error',
        t('lead.store_failed', ['phone' => PHONE_DISPLAY]),
        $input
    );
}

lead_notify('New quote request — ' . ($service !== '' ? $service : 'Moving enquiry'), $lead);

lead_redirect(
    QUOTE_FALLBACK,
    'success',
    t('lead.quote_ok', ['phone' => PHONE_DISPLAY])
);
