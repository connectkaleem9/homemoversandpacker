<?php
/** Change the admin password. */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';
require_once dirname(__DIR__) . '/includes/content.php';

admin_require_login();

$errors = [];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired. Please try again.';
    } else {
        $current = (string) ($_POST['current_password'] ?? '');
        $next    = (string) ($_POST['new_password'] ?? '');
        $confirm = (string) ($_POST['confirm_password'] ?? '');
        $account = admin_account();

        if ($account === null || !password_verify($current, $account['password_hash'])) {
            $errors[] = 'Your current password is not right.';
        }
        if (mb_strlen($next) < 12) {
            $errors[] = 'The new password needs at least 12 characters.';
        }
        if ($next !== $confirm) {
            $errors[] = 'The two new passwords do not match.';
        }
        if ($next === $current && $errors === []) {
            $errors[] = 'That is the password you already have.';
        }

        if ($errors === [] && admin_set_password($next)) {
            /* A password change should invalidate anything else holding this
               session, so the id is replaced. */
            session_regenerate_id(true);
            admin_flash('success', 'Password changed.');
            admin_redirect('/admin/account.php');
        } elseif ($errors === []) {
            $errors[] = 'The new password could not be saved.';
        }
    }
}

$adminTitle = 'Account';
require dirname(__DIR__) . '/includes/admin-layout.php';
?>

<h1 class="admin-h1">Account</h1>

<section class="admin-panel">
  <h2>Change your password</h2>

  <?php foreach ($errors as $error): ?>
    <div class="alert alert-error" role="alert"><?= e($error) ?></div>
  <?php endforeach; ?>

  <form method="post" class="admin-form admin-form-narrow">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="text" name="username" value="<?= e(admin_username()) ?>" autocomplete="username" hidden>

    <div class="field">
      <label for="current_password">Current password</label>
      <input type="password" id="current_password" name="current_password" required autocomplete="current-password">
    </div>
    <div class="field">
      <label for="new_password">New password</label>
      <input type="password" id="new_password" name="new_password" required minlength="12" autocomplete="new-password">
      <span class="field-hint">At least 12 characters.</span>
    </div>
    <div class="field">
      <label for="confirm_password">Confirm new password</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="12" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Change password</button>
  </form>
</section>

<section class="admin-panel">
  <h2>How this account works</h2>
  <ul class="admin-notes">
    <li>There is one admin account. It was created the first time anyone opened <code>/admin/</code>.</li>
    <li>The password is stored as a bcrypt hash in <code>storage/admin.json</code>, which is denied over HTTP and readable only by the account that runs the site.</li>
    <li>Five wrong passwords from one address locks that address out for fifteen minutes.</li>
    <li>A session ends after an hour of inactivity.</li>
    <li>If the password is ever lost, delete <code>storage/admin.json</code> over SSH and the next visit to <code>/admin/</code> will set the account up again.</li>
  </ul>
</section>

<?php require dirname(__DIR__) . '/includes/admin-foot.php';
