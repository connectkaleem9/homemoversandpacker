<?php
/**
 * Terms & Conditions.
 *
 * Describes how quotations, bookings and the website itself work. Anything that
 * requires a business or legal decision (cancellation windows, liability limits,
 * insurance, payment terms) is left as a clearly marked placeholder rather than
 * invented — those must be confirmed by the business and, ideally, a lawyer.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

seo_set([
    'title'       => t('page.terms.title') . ' | ' . SITE_NAME,
    'description' => t('page.terms.desc'),
    'path'        => '/terms-and-conditions/',
    'robots'      => 'index, follow',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('foot.terms'), 'url' => '/terms-and-conditions/'],
    ],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('legal.eyebrow')) ?></span>
      <p class="hero-home-sub"><?= e(t('page.terms.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('clipboard', 'icon') ?><span><?= e(t('page.terms.trust1')) ?></span></div>
        <div class="hero-trust-item"><?= icon('truck', 'icon') ?><span><?= e(t('page.terms.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span><?= e(t('page.terms.trust3')) ?></span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <?= hero_media('hero-movers-dubai.jpg', 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<?php
$legalDoc = 'terms';
require __DIR__ . '/includes/legal-body.php';
?>

<?php
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
