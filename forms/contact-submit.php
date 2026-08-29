<?php
/**
 * Contact message endpoint — the short "send us a message" form.
 *
 * POST only, redirects back to the contact page. Blocked in robots.txt.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/lead-handler.php';

const CONTACT_FALLBACK = '/contact-us/';

lead_guard(CONTACT_FALLBACK, 'contact');

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
    $errors['name'] = 'Please enter your name.';
}
if ($input['phone'] === '' && $input['email'] === '') {
    $errors['phone'] = 'Give us either a phone number or an email address so we can reply.';
} elseif ($input['phone'] !== '' && !lead_valid_uae_phone($input['phone'])) {
    $errors['phone'] = 'Enter a valid UAE mobile number, e.g. 055 658 1781.';
}
if ($input['email'] !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Enter a valid email address, or leave the field empty.';
}
if (mb_strlen($input['message']) < 10) {
    $errors['message'] = 'Please tell us a little more so we can help.';
}

if ($errors !== []) {
    lead_redirect(
        CONTACT_FALLBACK,
        'error',
        'Please check the highlighted fields and send the message again.',
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
        'Something went wrong on our side. Please call or WhatsApp us on ' . PHONE_DISPLAY . '.',
        $input,
        [],
        'contact'
    );
}

lead_notify('Website message — ' . $lead['subject'], $lead);

lead_redirect(
    CONTACT_FALLBACK,
    'success',
    'Thanks for your message — we will reply shortly. For anything urgent, call or WhatsApp ' . PHONE_DISPLAY . '.',
    [],
    [],
    'contact'
);
