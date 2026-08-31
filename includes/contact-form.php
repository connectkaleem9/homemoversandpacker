<?php
/**
 * Short "send us a message" form — the secondary contact route for questions
 * that are not a quote request. Posts to /forms/contact-submit.php.
 */

declare(strict_types=1);

start_session();

$contactSource = $contactSource ?? ($_SERVER['REQUEST_URI'] ?? '/');

$pending = $_SESSION['form_flash'] ?? null;
$isMine  = is_array($pending) && ($pending['form'] ?? '') === 'contact';

$flash  = $isMine ? $pending : null;
$old    = $isMine ? ($_SESSION['form_old'] ?? []) : [];
$errors = $isMine ? ($_SESSION['form_errors'] ?? []) : [];

if ($isMine) {
    unset($_SESSION['form_flash'], $_SESSION['form_old'], $_SESSION['form_errors']);
}

$val = static fn (string $key): string => e((string) ($old[$key] ?? ''));
$err = static fn (string $key): string => isset($errors[$key]) ? e((string) $errors[$key]) : '';
$inv = static fn (string $key): string => isset($errors[$key]) ? ' aria-invalid="true"' : '';
?>
<div class="quote-card" id="message">
  <div class="quote-card-head">
    <h2><?= e(t('msg.title')) ?></h2>
    <p><?= e(t('msg.intro')) ?></p>
  </div>
  <div class="quote-card-body">

    <?php if ($flash && ($flash['type'] ?? '') === 'success'): ?>
      <div class="alert alert-success" role="status" data-focus>
        <strong><?= e(t('flash.msg_received')) ?></strong> <?= e($flash['message']) ?>
      </div>
    <?php elseif ($flash && ($flash['type'] ?? '') === 'error'): ?>
      <div class="alert alert-error" role="alert" data-focus>
        <strong><?= e(t('flash.msg_error')) ?></strong> <?= e($flash['message']) ?>
      </div>
    <?php endif; ?>

    <form id="contact-form" method="post" action="/forms/contact-submit.php" data-validate novalidate>
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="source" value="<?= e($contactSource) ?>">
      <input type="hidden" name="form_started" value="<?= e((string) time()) ?>">
      <input type="hidden" name="form_elapsed" value="">
      <input type="hidden" name="form_lang" value="<?= e(lang()) ?>">

      <div class="hp-field" aria-hidden="true">
        <label for="c-company-website">Company website</label>
        <input type="text" id="c-company-website" name="company_website" class="hp-input" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-grid">
        <div class="field">
          <label for="c-name"><?= e(t('form.name')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="c-name" name="name" required autocomplete="name"
                 value="<?= $val('name') ?>"<?= $inv('name') ?>>
          <span class="field-error"><?= $err('name') ?></span>
        </div>

        <div class="field">
          <label for="c-phone"><?= e(t('form.phone')) ?></label>
          <input type="tel" id="c-phone" name="phone" autocomplete="tel" inputmode="tel"
                 placeholder="055 658 1781" value="<?= $val('phone') ?>"<?= $inv('phone') ?>>
          <span class="field-error"><?= $err('phone') ?></span>
        </div>

        <div class="field field-full">
          <label for="c-email"><?= e(t('form.email')) ?></label>
          <input type="email" id="c-email" name="email" autocomplete="email"
                 value="<?= $val('email') ?>"<?= $inv('email') ?>>
          <span class="field-error"><?= $err('email') ?></span>
          <span class="field-hint"><?= e(t('msg.contact_hint')) ?></span>
        </div>

        <div class="field field-full">
          <label for="c-subject"><?= e(t('msg.subject')) ?></label>
          <input type="text" id="c-subject" name="subject" value="<?= $val('subject') ?>">
        </div>

        <div class="field field-full">
          <label for="c-message"><?= e(t('msg.message')) ?> <span class="req" aria-hidden="true">*</span></label>
          <textarea id="c-message" name="message" rows="4" required<?= $inv('message') ?>><?= $val('message') ?></textarea>
          <span class="field-error"><?= $err('message') ?></span>
        </div>
      </div>

      <div class="form-foot">
        <button type="submit" class="btn btn-outline btn-block"><?= e(t('msg.submit')) ?></button>
        <p class="form-legal">
          <?= e(t('msg.legal')) ?>
          <a href="<?= e(lang_url('/privacy-policy/')) ?>"><?= e(t('form.privacy')) ?></a>.
        </p>
      </div>
    </form>
  </div>
</div>
