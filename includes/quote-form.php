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

$quoteHeading = $quoteHeading ?? 'Get a Free Moving Quote';
$quoteIntro   = $quoteIntro   ?? 'Tell us about your move and we will come back with a clear, specific quotation — no obligation.';
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
        <strong>Thank you — your request has been received.</strong>
        <?= e($flash['message']) ?>
      </div>
    <?php elseif ($flash && ($flash['type'] ?? '') === 'error'): ?>
      <div class="alert alert-error" role="alert" data-focus>
        <strong>We could not send your request.</strong>
        <?= e($flash['message']) ?>
      </div>
    <?php endif; ?>

    <form id="quote-form" class="quote-form" method="post" action="/forms/quote-submit.php"
          data-validate novalidate>
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="source" value="<?= e($quoteSource) ?>">
      <input type="hidden" name="form_started" value="<?= e((string) time()) ?>">
      <input type="hidden" name="form_elapsed" value="">

      <!-- Honeypot: hidden from people, tempting to naive bots -->
      <div class="hp-field" aria-hidden="true">
        <label for="company_website">Company website</label>
        <input type="text" id="company_website" name="company_website" class="hp-input" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-grid">
        <div class="field">
          <label for="q-name">Your name <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-name" name="name" required autocomplete="name"
                 value="<?= $val('name') ?>"<?= $inv('name') ?>>
          <span class="field-error"><?= $err('name') ?></span>
        </div>

        <div class="field">
          <label for="q-phone">Phone number <span class="req" aria-hidden="true">*</span></label>
          <input type="tel" id="q-phone" name="phone" required autocomplete="tel"
                 inputmode="tel" placeholder="055 658 1781"
                 value="<?= $val('phone') ?>"<?= $inv('phone') ?>>
          <span class="field-error"><?= $err('phone') ?></span>
        </div>

        <div class="field field-full">
          <label for="q-email">Email <span class="field-hint">(optional)</span></label>
          <input type="email" id="q-email" name="email" autocomplete="email"
                 value="<?= $val('email') ?>"<?= $inv('email') ?>>
          <span class="field-error"><?= $err('email') ?></span>
        </div>

        <div class="field">
          <label for="q-from">Moving from <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-from" name="moving_from" required placeholder="Area, emirate"
                 value="<?= $val('moving_from') ?>"<?= $inv('moving_from') ?>>
          <span class="field-error"><?= $err('moving_from') ?></span>
        </div>

        <div class="field">
          <label for="q-to">Moving to <span class="req" aria-hidden="true">*</span></label>
          <input type="text" id="q-to" name="moving_to" required placeholder="Area, emirate"
                 value="<?= $val('moving_to') ?>"<?= $inv('moving_to') ?>>
          <span class="field-error"><?= $err('moving_to') ?></span>
        </div>

        <div class="field">
          <label for="q-property">Property type</label>
          <select id="q-property" name="property_type">
            <?php
            $properties = ['', 'Studio', '1 Bedroom Apartment', '2 Bedroom Apartment', '3+ Bedroom Apartment',
                           'Townhouse', 'Villa', 'Office', 'Shop / Retail', 'Storage only', 'Other'];
            foreach ($properties as $property):
                $selected = ($old['property_type'] ?? '') === $property && $property !== '' ? ' selected' : '';
            ?>
              <option value="<?= e($property) ?>"<?= $selected ?>><?= $property === '' ? 'Select property type' : e($property) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label for="q-date">Preferred moving date</label>
          <input type="date" id="q-date" name="moving_date" value="<?= $val('moving_date') ?>">
        </div>

        <div class="field field-full">
          <label for="q-service">Service required</label>
          <select id="q-service" name="service">
            <option value="">Select a service</option>
            <?php foreach (all_services() as $qfSlug => $qfService):
                $selected = (($old['service'] ?? $quoteService) === $qfSlug) ? ' selected' : ''; ?>
              <option value="<?= e($qfSlug) ?>"<?= $selected ?>><?= e($qfService['name']) ?></option>
            <?php endforeach; ?>
            <option value="not-sure"<?= ($old['service'] ?? '') === 'not-sure' ? ' selected' : '' ?>>Not sure — please advise</option>
          </select>
        </div>

        <div class="field field-full">
          <label for="q-details">Additional details <span class="field-hint">(items, floors, lift access, packing needed)</span></label>
          <textarea id="q-details" name="details" rows="4"
                    placeholder="e.g. 2 bedroom apartment, 5th floor with lift, need packing for the kitchen"><?= $val('details') ?></textarea>
        </div>
      </div>

      <div class="form-foot">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Get My Free Quote</button>
        <p class="form-legal">
          We use your details only to prepare and discuss your moving quote. See our
          <a href="/privacy-policy/">Privacy Policy</a>.
        </p>
      </div>

      <div class="form-alt">
        <span>Prefer to talk?</span>
        <?= cta_phone('btn btn-outline', PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp') ?>
      </div>
    </form>
  </div>
</div>
