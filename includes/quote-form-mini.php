<?php
/**
 * Compact quote form — four fields, sits beside the blog strip on the homepage.
 *
 * Posts to the same /forms/quote-submit.php endpoint with the same CSRF token,
 * honeypot and timing checks as the full form, and satisfies the same required
 * fields (name, phone, moving from, moving to).
 *
 * Only ever render ONE quote form per page: it carries id="quote-form", the
 * stable ID Google Ads conversion tracking is wired to.
 */

declare(strict_types=1);

start_session();

$miniSource = $miniSource ?? 'homepage-mini';

/* Same flash cycle as the full form; only one of the two renders per page. */
$pending = $_SESSION['form_flash'] ?? null;
$isMine  = is_array($pending) && ($pending['form'] ?? 'quote') === 'quote';

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
<div class="quote-mini" id="quote">
  <h2>Need a Moving Quote?</h2>
  <p>Fill out the form and our team will get back to you shortly.</p>

  <?php if ($flash && ($flash['type'] ?? '') === 'success'): ?>
    <div class="alert alert-success" role="status" data-focus>
      <strong>Thank you — request received.</strong> <?= e($flash['message']) ?>
    </div>
  <?php elseif ($flash && ($flash['type'] ?? '') === 'error'): ?>
    <div class="alert alert-error" role="alert" data-focus>
      <strong>We could not send your request.</strong> <?= e($flash['message']) ?>
    </div>
  <?php endif; ?>

  <form id="quote-form" method="post" action="/forms/quote-submit.php" data-validate novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="source" value="<?= e($miniSource) ?>">
    <input type="hidden" name="form_started" value="<?= e((string) time()) ?>">
    <input type="hidden" name="form_elapsed" value="">

    <div class="hp-field" aria-hidden="true">
      <label for="m-company-website">Company website</label>
      <input type="text" id="m-company-website" name="company_website" class="hp-input" tabindex="-1" autocomplete="off">
    </div>

    <div class="form-grid">
      <div class="field">
        <label class="sr-only" for="m-name">Your name</label>
        <input type="text" id="m-name" name="name" required autocomplete="name"
               placeholder="Your Name" value="<?= $val('name') ?>"<?= $inv('name') ?>>
        <span class="field-error"><?= $err('name') ?></span>
      </div>

      <div class="field">
        <label class="sr-only" for="m-phone">Phone number</label>
        <input type="tel" id="m-phone" name="phone" required autocomplete="tel" inputmode="tel"
               placeholder="Phone Number" value="<?= $val('phone') ?>"<?= $inv('phone') ?>>
        <span class="field-error"><?= $err('phone') ?></span>
      </div>

      <div class="field">
        <label class="sr-only" for="m-from">Moving from</label>
        <input type="text" id="m-from" name="moving_from" required
               placeholder="Moving From" value="<?= $val('moving_from') ?>"<?= $inv('moving_from') ?>>
        <span class="field-error"><?= $err('moving_from') ?></span>
      </div>

      <div class="field">
        <label class="sr-only" for="m-to">Moving to</label>
        <input type="text" id="m-to" name="moving_to" required
               placeholder="Moving To" value="<?= $val('moving_to') ?>"<?= $inv('moving_to') ?>>
        <span class="field-error"><?= $err('moving_to') ?></span>
      </div>

      <div class="field field-full">
        <label class="sr-only" for="m-service">Service required</label>
        <select id="m-service" name="service">
          <option value="">Service required (optional)</option>
          <?php foreach (all_services() as $qmSlug => $qmService): ?>
            <option value="<?= e($qmSlug) ?>"<?= ($old['service'] ?? '') === $qmSlug ? ' selected' : '' ?>>
              <?= e($qmService['name']) ?>
            </option>
          <?php endforeach; ?>
          <option value="not-sure"<?= ($old['service'] ?? '') === 'not-sure' ? ' selected' : '' ?>>Not sure — please advise</option>
        </select>
      </div>
    </div>

    <div class="form-foot">
      <button type="submit" class="btn btn-phone btn-block">
        <?= icon('quote', 'icon icon-sm') ?><span>Get a Free Quote</span>
      </button>
      <p class="form-legal">
        We use your details only to prepare your quote. See our
        <a href="/privacy-policy/">Privacy Policy</a>.
      </p>
    </div>
  </form>
</div>
