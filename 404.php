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
    'title'       => 'Page Not Found | ' . SITE_NAME,
    'description' => 'The page you were looking for could not be found. Browse our moving services or contact us on 055 658 1781.',
    'path'        => '/404/',
    'robots'      => 'noindex, follow',
    'breadcrumbs' => [],
]);

require __DIR__ . '/includes/header.php';
?>

<section class="section">
  <div class="container container-narrow error-page">
    <p class="error-code">404</p>
    <h1>We Could Not Find That Page</h1>
    <p class="section-lead" style="margin-bottom: var(--sp-6);">
      The page may have moved or the link may be incomplete. Everything below is still where
      it should be — or call us and we will point you in the right direction.
    </p>

    <div class="btn-row" style="justify-content: center;">
      <a href="/" class="btn btn-primary btn-lg">Go to the homepage</a>
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
         <?= cta_id('phone') ?> aria-label="Call <?= e(PHONE_INTL) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="heading-rule"><h2>Our Moving Services</h2></div>
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
    <div class="heading-rule"><h2>Areas We Cover</h2></div>
    <div class="city-cards">
      <?php foreach (all_locations() as $citySlug => $city): ?>
        <a class="city-card" href="<?= e(location_url($citySlug)) ?>">
          <span class="city-card-media">
            <?= img('locations/' . $citySlug . '.webp',
                    'Movers and packers serving ' . $city['name'] . ', UAE',
                    ['width' => 900, 'height' => 600, 'icon' => 'building']) ?>
          </span>
          <span class="city-card-body">
            <h3>Movers in <?= e($city['name']) ?></h3>
            <p><?= e($city['short']) ?></p>
            <span class="card-link">Learn more <?= icon('arrow', 'icon icon-sm') ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="cta-gold">
  <div class="container cta-gold-inner">
    <div class="cta-gold-media">
      <?= img('cta-boxes.webp', '', ['width' => 600, 'height' => 450, 'icon' => 'box']) ?>
    </div>
    <div>
      <h2>Looking for a Moving Quote?</h2>
      <p>Call or WhatsApp us and we will help you directly.</p>
    </div>
    <div class="cta-gold-actions">
      <?= cta_phone('btn btn-phone btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
