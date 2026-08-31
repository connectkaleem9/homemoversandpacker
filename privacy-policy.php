<?php
/**
 * Privacy Policy.
 *
 * Written to describe what this website actually does with data. Placeholders
 * are used where the business must supply specifics (legal entity, retention
 * period); no regulatory claims or certifications are invented.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

seo_set([
    'title'       => t('page.privacy.title') . ' | ' . SITE_NAME,
    'description' => t('page.privacy.desc'),
    'path'        => '/privacy-policy/',
    'robots'      => 'index, follow',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('foot.privacy'), 'url' => '/privacy-policy/'],
    ],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('legal.eyebrow')) ?></span>
      <p class="hero-home-sub"><?= e(t('page.privacy.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span><?= e(t('page.privacy.trust1')) ?></span></div>
        <div class="hero-trust-item"><?= icon('mail', 'icon') ?><span><?= e(t('page.privacy.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('page.privacy.trust3')) ?></span></div>
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
$legalDoc = 'privacy';
require __DIR__ . '/includes/legal-body.php';
?>

<?php
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
