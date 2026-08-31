<?php
/**
 * 404 page. Reached via ErrorDocument in .htaccess, and included directly by
 * the service/location templates when an unknown slug is requested.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

if (!headers_sent()) {
    http_response_code(404);
}

seo_set([
    'title'       => t('page.404.title') . ' | ' . SITE_NAME,
    'description' => t('page.404.desc'),
    'path'        => '/404/',
    'robots'      => 'noindex, follow',
    'breadcrumbs' => [],
]);

require __DIR__ . '/includes/header.php';
?>

<section class="section">
  <div class="container container-narrow error-page">
    <p class="error-code">404</p>
    <h1><?= e(t('404.title')) ?></h1>
    <p class="section-lead" style="margin-bottom: var(--sp-6);"><?= e(t('404.text')) ?></p>

    <div class="btn-row" style="justify-content: center;">
      <a href="<?= e(lang_url('/')) ?>" class="btn btn-primary btn-lg"><?= e(t('cta.home')) ?></a>
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
         <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="heading-rule"><h2><?= e(t('sec.services')) ?></h2></div>
    <div class="service-strip service-strip-wrap">
      <?php foreach (all_services() as $svcSlug => $svc): ?>
        <a class="service-tile" href="<?= e(service_url($svcSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($svc['icon']) ?></span>
          <h3><?= e($svc['name']) ?></h3>
          <p><?= e($svc['tile']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="heading-rule"><h2><?= e(t('page.404.areas_h2')) ?></h2></div>
    <?php
    require __DIR__ . '/includes/city-cards.php';
    ?>
  </div>
</section>

<?php
$bandTitle    = t('band.404_title');
$bandSub      = t('band.404_sub');
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
