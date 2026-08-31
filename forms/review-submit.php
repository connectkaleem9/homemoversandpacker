<?php
/**
 * Customer review submission.
 *
 * POST only, redirects back. Everything submitted here is stored as `pending`
 * and is invisible on the site until an admin approves it in the dashboard.
 * That is the whole point: an unmoderated review form is a spam target, and
 * Review structured data built from unchecked submissions is precisely what
 * Google's guidelines call misleading.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/lead-handler.php';
require_once dirname(__DIR__) . '/includes/content.php';

lead_guard('/reviews/', 'review');

define('REVIEW_FALLBACK', lang_url('/reviews/'));

$input = [
    'name'    => lead_clean($_POST['name'] ?? '', 80),
    'city'    => lead_clean($_POST['city'] ?? '', 60),
    'email'   => lead_clean($_POST['email'] ?? '', 160),
    'phone'   => lead_clean($_POST['phone'] ?? '', 32),
    'service' => lead_clean($_POST['service'] ?? '', 60),
    'rating'  => (int) ($_POST['rating'] ?? 0),
    'quote'   => lead_clean($_POST['quote'] ?? '', 1500),
];

$errors = [];

if (mb_strlen($input['name']) < 2) {
    $errors['name'] = t('err.name');
}
if ($input['rating'] < 1 || $input['rating'] > 5) {
    $errors['rating'] = t('err.rating');
}
if (mb_strlen($input['quote']) < 20) {
    $errors['quote'] = t('err.review_short');
}
if ($input['email'] !== '' && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = t('err.email');
}
/* One contact detail, so a review can be verified before it is published. */
if ($input['email'] === '' && $input['phone'] === '') {
    $errors['email'] = t('err.review_contact');
}

/* Only accept a service slug the site actually publishes. */
$serviceName = '';
if ($input['service'] !== '') {
    $catalogue = require dirname(__DIR__) . '/includes/data/services.php';
    if (!isset($catalogue[$input['service']])) {
        $input['service'] = '';
    } else {
        /* Stored in English so the moderation queue reads consistently
           whichever language the review was left in. */
        $serviceName = $catalogue[$input['service']]['name'];
    }
}

if ($errors !== []) {
    lead_redirect(REVIEW_FALLBACK, 'error', t('err.check_review'), $input, $errors, 'review');
}

$stored = store_insert('reviews', [
    'name'       => $input['name'],
    'city'       => $input['city'],
    'email'      => $input['email'],
    'phone'      => $input['phone'] !== '' ? lead_normalise_phone($input['phone']) : '',
    'service'    => $serviceName,
    'rating'     => $input['rating'],
    'quote'      => $input['quote'],
    'status'     => REVIEW_PENDING,
    'lang'       => lang(),
    'ip_address' => lead_client_ip(),
    'user_agent' => mb_substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
]);

if ($stored === null) {
    lead_redirect(
        REVIEW_FALLBACK,
        'error',
        t('lead.store_failed', ['phone' => PHONE_DISPLAY]),
        $input,
        [],
        'review'
    );
}

lead_notify('New review awaiting approval — ' . $input['rating'] . '/5 from ' . $input['name'], [
    'name'    => $input['name'],
    'city'    => $input['city'],
    'rating'  => $input['rating'] . ' out of 5',
    'service' => $serviceName,
    'review'  => $input['quote'],
    'email'   => $input['email'],
    'phone'   => $input['phone'],
    'approve' => CANONICAL_BASE . '/admin/reviews.php',
]);

lead_redirect(REVIEW_FALLBACK, 'success', t('lead.review_ok'), [], [], 'review');
