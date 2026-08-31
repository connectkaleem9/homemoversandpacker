<?php
/**
 * Reusable quote form.
 *
 * Include anywhere and optionally set these before including:
 *   $quoteHeading   — card heading
 *   $quoteIntro     — short line under the heading
 *   $quoteSource    — where the lead came from (page slug), stored with the lead
 *   $quoteService   — pre-selected service slug
 *
 * Stable IDs for Google Ads conversion tracking: #quote-form, #quote-cta,
 * #phone-cta, #whatsapp-cta.
 */

declare(strict_types=1);

start_session();

$quoteHeading = $quoteHeading ?? t('form.quote_title');
$quoteIntro   = $quoteIntro   ?? t('form.quote_intro');
$quoteSource  = $quoteSource  ?? ($_SERVER['REQUEST_URI'] ?? '/');
$quoteService = $quoteService ?? '';

/* Flash state from the POST-redirect-GET cycle. Only consume it when the flash
   belongs to this form, so a page carrying two forms shows it in the right place. */
$pending = $_SESSION['form_flash'] ?? null;
$isMine  = is_array($pending) && ($pending['form'] ?? 'quote') === 'quote';

$flash  = $isMine ? $pending : null;
$old    = $isMine ? ($_SESSION['form_old'] ?? []) : [];
$errors = $isMine ? ($_SESSION['form_errors'] ?? []) : [];

if ($isMine) {
    unset($_SESSION['form_flash'], $_SESSION['form_old'], $_SESSION['form_errors']);
}

$val = static fn (string $key, string $fallback = ''): string => e((string) ($old[$key] ?? $fallback));
$err = static fn (string $key): string => isset($errors[$key]) ? e((string) $errors[$key]) : '';
$inv = static fn (string $key): string => isset($errors[$key]) ? ' aria-invalid="true"' : '';
?>
<div class="quote-card" id="quote">
  <div class="quote-card-head">
    <h2><?= e($quoteHeading) ?></h2>
    <p><?= e($quoteIntro) ?></p>
  </div>
  <div class="quote-card-body">

    <?php if ($flash && ($flash['type'] ?? '') === 'success'): ?>
      <div class="alert alert-success" role="status" data-focus>
        <strong><?= e(t('flash.success_title')) ?></strong>
        <?= e($flash['message']) ?>
      </div>
    <?php elseif ($flash && ($flash['type'] ?? '') === 'error'): ?>
      <div class="alert alert-error" role="alert" data-focus>
        <strong><?= e(t('flash.error_title')) ?></strong>
        <?= e($flash['message']) ?>
      </div>
    <?php endif; ?>

    <form id="quote-form" class="quote-form" method="post" action="/forms/quote-submit.php"
          data-validate novalidate>
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="source" value="<?= e($quoteSource) ?>">
      <input type="hidden" name="form_started" value="<?= e((string) time()) ?>">
      <input type="hidden" name="form_elapsed" value="">
      <input type="hidden" name="form_lang" value="<?= e(lang()) ?>">

      <!-- Honeypot: hidden from people, tempting to naive bots -->
      <div class="hp-field" aria-hidden="true">
        <label for="company_website">Company website</label>
        <input type="text" id="company_website" name="company_website" class="hp-input" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-grid">
        <div class="field">
          <label for="q-name"><?= e(t('form.name')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-name" name="name" required autocomplete="name"
                 value="<?= $val('name') ?>"<?= $inv('name') ?>>
          <span class="field-error"><?= $err('name') ?></span>
        </div>

        <div class="field">
          <label for="q-phone"><?= e(t('form.phone')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="tel" id="q-phone" name="phone" required autocomplete="tel"
                 inputmode="tel" placeholder="055 658 1781"
                 value="<?= $val('phone') ?>"<?= $inv('phone') ?>>
          <span class="field-error"><?= $err('phone') ?></span>
        </div>

        <div class="field field-full">
          <label for="q-email"><?= e(t('form.email')) ?> <span class="field-hint"><?= e(t('form.email_opt')) ?></span></label>
          <input type="email" id="q-email" name="email" autocomplete="email"
                 value="<?= $val('email') ?>"<?= $inv('email') ?>>
          <span class="field-error"><?= $err('email') ?></span>
        </div>

        <div class="field">
          <label for="q-from"><?= e(t('form.from')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-from" name="moving_from" required placeholder="<?= e(t('form.area_ph')) ?>"
                 value="<?= $val('moving_from') ?>"<?= $inv('moving_from') ?>>
          <span class="field-error"><?= $err('moving_from') ?></span>
        </div>

        <div class="field">
          <label for="q-to"><?= e(t('form.to')) ?> <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-to" name="moving_to" required placeholder="<?= e(t('form.area_ph')) ?>"
                 value="<?= $val('moving_to') ?>"<?= $inv('moving_to') ?>>
          <span class="field-error"><?= $err('moving_to') ?></span>
        </div>

        <div class="field">
          <label for="q-property"><?= e(t('form.property')) ?></label>
          <select id="q-property" name="property_type">
            <option value=""><?= e(t('form.property_ph')) ?></option>
            <?php
            /* The submitted VALUE stays English so every lead in the database
               reads the same way whichever language the form was filled in. */
            $qfProperties = [
                'Studio'               => 'prop.studio',
                '1 Bedroom Apartment'  => 'prop.1br',
                '2 Bedroom Apartment'  => 'prop.2br',
                '3+ Bedroom Apartment' => 'prop.3br',
                'Townhouse'            => 'prop.townhouse',
                'Villa'                => 'prop.villa',
                'Office'               => 'prop.office',
                'Shop / Retail'        => 'prop.retail',
                'Storage only'         => 'prop.storage',
                'Other'                => 'prop.other',
            ];
            foreach ($qfProperties as $qfValue => $qfKey):
                $selected = ($old['property_type'] ?? '') === $qfValue ? ' selected' : '';
            ?>
              <option value="<?= e($qfValue) ?>"<?= $selected ?>><?= e(t($qfKey)) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label for="q-date"><?= e(t('form.date')) ?></label>
          <input type="date" id="q-date" name="moving_date" value="<?= $val('moving_date') ?>">
        </div>

        <div class="field field-full">
          <label for="q-service"><?= e(t('form.service')) ?></label>
          <select id="q-service" name="service">
            <option value=""><?= e(t('form.service_ph')) ?></option>
            <?php foreach (all_services() as $qfSlug => $qfService):
                $selected = (($old['service'] ?? $quoteService) === $qfSlug) ? ' selected' : ''; ?>
              <option value="<?= e($qfSlug) ?>"<?= $selected ?>><?= e($qfService['name']) ?></option>
            <?php endforeach; ?>
            <option value="not-sure"<?= ($old['service'] ?? '') === 'not-sure' ? ' selected' : '' ?>><?= e(t('form.not_sure')) ?></option>
          </select>
        </div>

        <div class="field field-full">
          <label for="q-details"><?= e(t('form.details')) ?> <span class="field-hint"><?= e(t('form.details_hint')) ?></span></label>
          <textarea id="q-details" name="details" rows="4"
                    placeholder="<?= e(t('form.details_ph')) ?>"><?= $val('details') ?></textarea>
        </div>
      </div>

      <div class="form-foot">
        <button type="submit" class="btn btn-primary btn-lg btn-block"><?= e(t('form.submit')) ?></button>
        <p class="form-legal">
          <?= e(t('form.legal')) ?>
          <a href="<?= e(lang_url('/privacy-policy/')) ?>"><?= e(t('form.privacy')) ?></a>.
        </p>
      </div>

      <div class="form-alt">
        <span><?= e(t('form.prefer_talk')) ?></span>
        <?= cta_phone('btn btn-outline', PHONE_DISPLAY) ?>
        <?= cta_whatsapp('', 'btn btn-whatsapp') ?>
      </div>
    </form>
  </div>
</div>
