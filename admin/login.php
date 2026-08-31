<?php
/**
 * Admin login, and the one-time setup that creates the account.
 *
 * There is no default password anywhere in this codebase. The first person to
 * reach /admin/ on a new install chooses one, which means nothing ships with a
 * known credential and the password never passes through anyone else's hands.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';
require_once dirname(__DIR__) . '/includes/content.php';

if (admin_is_logged_in()) {
    admin_redirect('/admin/');
}

$setupMode = !admin_exists();
$errors    = [];
$username  = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired. Please try again.';
    } elseif ($setupMode) {
        /* ------------------------------------------------ first-run setup */
        $username = lead_clean($_POST['username'] ?? '', 40);
        $pass     = (string) ($_POST['password'] ?? '');
        $confirm  = (string) ($_POST['password_confirm'] ?? '');

        if (!preg_match('/^[a-zA-Z0-9._-]{3,40}$/', $username)) {
            $errors[] = 'Choose a username of 3-40 letters, numbers, dots, dashes or underscores.';
        }
        if (mb_strlen($pass) < 12) {
            $errors[] = 'Use a password of at least 12 characters. Length is what makes it hard to guess.';
        }
        if ($pass !== $confirm) {
            $errors[] = 'The two passwords do not match.';
        }

        if ($errors === [] && admin_create($username, $pass)) {
            admin_login($username, $pass);
            admin_flash('success', 'Your admin account is ready.');
            admin_redirect('/admin/');
        } elseif ($errors === []) {
            $errors[] = 'The account could not be saved. Check that storage/ is writable.';
        }
    } else {
        /* ------------------------------------------------------- login */
        $wait = admin_locked_out();
        if ($wait > 0) {
            $errors[] = 'Too many failed attempts. Try again in ' . ceil($wait / 60) . ' minutes.';
        } else {
            $username = lead_clean($_POST['username'] ?? '', 40);
            if (admin_login($username, (string) ($_POST['password'] ?? ''))) {
                admin_redirect('/admin/');
            }
            /* One message for both wrong username and wrong password: saying
               which was wrong tells an attacker half the answer. */
            $errors[] = 'That username and password did not match.';
        }
    }
}

$pageTitle = $setupMode ? 'Set up the admin account' : 'Admin sign in';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($pageTitle) ?> · <?= e(SITE_NAME) ?></title>
  <link rel="icon" href="<?= e(asset('images/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="icon" href="/favicon.ico" sizes="32x32">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>">
</head>
<body class="admin admin-auth">

<main class="admin-auth-card" id="main">
  <a class="admin-auth-brand" href="/">
    <?php if (image_exists('logo.png')): ?>
      <img src="<?= e(image_url('logo.png')) ?>" alt="<?= e(BUSINESS_NAME) ?>" width="200" height="60">
    <?php else: ?>
      <strong><?= e(SITE_NAME) ?></strong>
    <?php endif; ?>
  </a>

  <h1><?= e($pageTitle) ?></h1>

  <?php if ($setupMode): ?>
    <p class="admin-auth-intro">
      No admin account exists yet, so this first visit creates one. Choose a password
      you do not use anywhere else — this account can publish to the live site.
    </p>
  <?php endif; ?>

  <?php foreach ($errors as $error): ?>
    <div class="alert alert-error" role="alert"><?= e($error) ?></div>
  <?php endforeach; ?>

  <form method="post" class="admin-form">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

    <div class="field">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required autocomplete="username"
             autocapitalize="none" spellcheck="false" value="<?= e($username) ?>"
             <?= $setupMode ? 'pattern="[a-zA-Z0-9._\-]{3,40}"' : '' ?>>
    </div>

    <div class="field">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required
             autocomplete="<?= $setupMode ? 'new-password' : 'current-password' ?>"
             <?= $setupMode ? 'minlength="12"' : '' ?>>
      <?php if ($setupMode): ?>
        <span class="field-hint">At least 12 characters.</span>
      <?php endif; ?>
    </div>

    <?php if ($setupMode): ?>
      <div class="field">
        <label for="password_confirm">Confirm password</label>
        <input type="password" id="password_confirm" name="password_confirm" required
               autocomplete="new-password" minlength="12">
      </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary btn-block btn-lg">
      <?= $setupMode ? 'Create the account' : 'Sign in' ?>
    </button>
  </form>

  <p class="admin-auth-back"><a href="/">Back to the website</a></p>
</main>

</body>
</html>
