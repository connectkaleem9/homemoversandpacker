<?php
/**
 * "Leave a review" form.
 *
 * Posts to /forms/review-submit.php. Nothing submitted here reaches the site
 * until an admin approves it, and the form says so — a customer who writes a
 * review and cannot find it an hour later assumes it was lost.
 */

declare(strict_types=1);

start_session();

$rvServices = all_services();

$pending = $_SESSION['form_flash'] ?? null;
$isMine  = is_array($pending) && ($pending['form'] ?? '') === 'review';

$flash  = $isMine ? $pending : null;
$old    = $isMine ? ($_SESSION['form_old'] ?? []) : [];
$errors = $isMine ? ($_SESSION['form_errors'] ?? []) : [];

if ($isMine) {
    unset($_SESSION['form_flash'], $_SESSION['form_old'], $_SESSION['form_errors']);
}

$val = static fn (string $k): string => e((string) ($old[$k] ?? ''));
$err = static fn (string $k): string => isset($errors[$k]) ? e((string) $errors[$k]) : '';
$inv = static fn (string $k): string => isset($errors[$k]) ? ' aria-invalid="true"' : '';
?>
<div class="quote-card" id="write-review">
  <div class="quote-card-head">
    <h2><?= e(t('page.reviews.form_title')) ?></h2>
    <p><?= e(t('page.reviews.form_intro')) ?></p>
  </div>
  <div class="quote-card-body">

    <?php if ($flash && ($flash['type'] ?? '') === 'success'): ?>
      <div class="alert alert-success" role="status" data-focus>
        <strong><?= e(t('flash.review_thanks')) ?></strong> <?= e($flash['message']) ?>
      </div>
    <?php elseif ($flash && ($flash['type'] ?? '') === 'error'): ?>
      <div class="alert alert-error" role="alert" data-focus>
        <strong><?= e(t('flash.error_title')) ?></strong> <?= e($flash['message']) ?>
      </div>
    <?php endif; ?>

    <form id="review-form" method="post" action="/forms/review-submit.php" data-validate novalidate>
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="form_started" value="<?= e((string) time()) ?>">
      <input type="hidden" name="form_elapsed" value="">
      <input type="hidden" name="form_lang" value="<?= e(lang()) ?>">

      <div class="hp-field" aria-hidden="true">
        <label for="r-company-website">Company website</label>
        <input type="text" id="r-company-website" name="company_website" class="hp-input" tabindex="-1" autocomplete="off">
      </div>

      <?php
      /*
       * Radio buttons rather than a star widget: they work without JavaScript,
       * they are announced correctly by a screen reader, and the visual stars
       * are drawn from them with CSS. The fieldset carries the question.
       */
      ?>
      <fieldset class="rating-field">
        <legend><?= e(t('form.rating')) ?> <span class="req" aria-hidden="true">*</span></legend>
        <div class="rating-stars">
          <?php foreach ([5, 4, 3, 2, 1] as $star): ?>
            <input type="radio" id="r-star-<?= $star ?>" name="rating" value="<?= $star ?>"
                   <?= (int) ($old['rating'] ?? 0) === $star ? 'checked' : '' ?> required>
            <label for="r-star-<?= $star ?>"
                   title="<?= e(t('form.rating_of', ['n' => $star])) ?>">
              <span class="sr-only"><?= e(t('form.rating_of', ['n' => $star])) ?></span>
              <?= icon('star', 'icon') ?>
            </label>
          <?php endforeach; ?>
        </div>
        <span class="field-error"><?= $err('rating') ?></span>
      </fieldset>

      <div class="form-grid">
        <div class="field">
          <label for="r-name"><?= e(t('form.name')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="r-name" name="name" required autocomplete="name"
                 value="<?= $val('name') ?>"<?= $inv('name') ?>>
          <span class="field-error"><?= $err('name') ?></span>
        </div>

        <div class="field">
          <label for="r-city"><?= e(t('form.city')) ?></label>
          <input type="text" id="r-city" name="city" placeholder="<?= e(t('form.area_ph')) ?>"
                 value="<?= $val('city') ?>">
        </div>

        <div class="field">
          <label for="r-email"><?= e(t('form.email')) ?></label>
          <input type="email" id="r-email" name="email" autocomplete="email"
                 value="<?= $val('email') ?>"<?= $inv('email') ?>>
          <span class="field-error"><?= $err('email') ?></span>
        </div>

        <div class="field">
          <label for="r-phone"><?= e(t('form.phone')) ?></label>
          <input type="tel" id="r-phone" name="phone" autocomplete="tel" inputmode="tel"
                 placeholder="055 658 1781" value="<?= $val('phone') ?>">
        </div>

        <div class="field field-full">
          <span class="field-hint"><?= e(t('form.review_contact_hint')) ?></span>
        </div>

        <div class="field field-full">
          <label for="r-service"><?= e(t('form.service_used')) ?></label>
          <select id="r-service" name="service">
            <option value=""><?= e(t('form.service_ph')) ?></option>
            <?php foreach ($rvServices as $rvSlug => $rvService): ?>
              <option value="<?= e($rvSlug) ?>"<?= ($old['service'] ?? '') === $rvSlug ? ' selected' : '' ?>>
                <?= e($rvService['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field field-full">
          <label for="r-quote"><?= e(t('form.review')) ?> <span class="req" aria-hidden="true">*</span></label>
          <textarea id="r-quote" name="quote" rows="5" required minlength="20" maxlength="1500"
                    placeholder="<?= e(t('form.review_ph')) ?>"<?= $inv('quote') ?>><?= $val('quote') ?></textarea>
          <span class="field-error"><?= $err('quote') ?></span>
        </div>
      </div>

      <div class="form-foot">
        <button type="submit" class="btn btn-primary btn-lg btn-block"><?= e(t('form.review_submit')) ?></button>
        <p class="form-legal">
          <?= e(t('form.review_legal')) ?>
          <a href="<?= e(lang_url('/privacy-policy/')) ?>"><?= e(t('form.privacy')) ?></a>.
        </p>
      </div>
    </form>
  </div>
</div>
