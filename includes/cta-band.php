<?php
/**
 * Gold call-to-action band.
 *
 * It appears on every page, and before this partial existed it was copy-pasted
 * twelve times — which meant twelve places to translate and twelve places for
 * the markup to drift. Optionally set before including:
 *
 *   $bandTitle    — heading (defaults to the shared "Planning a Move?" line)
 *   $bandSub      — supporting line
 *   $bandWhatsApp — pre-filled WhatsApp message
 */

declare(strict_types=1);

$bandTitle    = $bandTitle    ?? t('band.title');
$bandSub      = $bandSub      ?? t('band.sub');
$bandWhatsApp = $bandWhatsApp ?? '';
?>
<section class="cta-gold">
  <div class="container cta-gold-inner">
    <div class="cta-gold-media">
      <?= img('cta-boxes.webp', '', ['width' => 600, 'height' => 450, 'icon' => 'box']) ?>
    </div>
    <div>
      <h2><?= e($bandTitle) ?></h2>
      <p><?= e($bandSub) ?></p>
    </div>
    <div class="cta-gold-actions">
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
         <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack">
          <small><?= e(t('cta.call_now')) ?></small>
          <strong><?= e(PHONE_DISPLAY) ?></strong>
        </span>
      </a>
      <?= cta_whatsapp($bandWhatsApp, 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>
<?php
/* The partial is included into the page's own scope, so clear the overrides —
   otherwise a second band on the same page would inherit the first one's copy. */
unset($bandTitle, $bandSub, $bandWhatsApp);
