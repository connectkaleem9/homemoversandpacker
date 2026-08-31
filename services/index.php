<?php
/**
 * Services index — hub page linking every service landing page.
 * Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$services  = all_services();
$locations = all_locations();

$faqs = [];
foreach ([1, 2, 3, 4] as $n) {
    $faqs[] = ['q' => t('page.services.faq' . $n . '_q'), 'a' => t('page.services.faq' . $n . '_a')];
}

seo_set([
    'title'       => t('page.services.title'),
    'description' => t('page.services.desc'),
    'path'        => '/services/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.services'), 'url' => '/services/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '#quote',
]);

require dirname(__DIR__) . '/includes/header.php';

$groups = [
    [t('page.services.g1_t'), t('page.services.g1_p'),
     ['home-movers', 'villa-movers', 'studio-apartment-movers', 'local-moving']],
    [t('page.services.g2_t'), t('page.services.g2_p'),
     ['office-commercial-movers', 'commercial-retail-movers', 'warehousing-storage', 'loading-unloading']],
    [t('page.services.g3_t'), t('page.services.g3_p'),
     ['furniture-movers', 'packing-unpacking', 'furniture-assembly', 'car-transportation']],
];
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.services.eyebrow')) ?></span>
      <h1><?= e(t('page.services.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.services.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('box', 'icon') ?><span><?= e(t('page.services.trust1')) ?></span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('page.services.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('misc.free_quotation')) ?></span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', t('cta.quote'), '#quote') ?>
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

<!-- =================================================== All services ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.services.all_h2')) ?></h2>
    </div>
    <div class="service-strip service-strip-wrap">
      <?php foreach ($services as $svcSlug => $svc): ?>
        <a class="service-tile" href="<?= e(service_url($svcSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($svc['icon']) ?></span>
          <h3><?= e($svc['name']) ?></h3>
          <p><?= e($svc['tile']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================= Grouped detail ====== -->
<?php foreach ($groups as $g => [$title, $lead, $slugs]): ?>
<section class="section<?= $g % 2 === 0 ? ' section-alt' : '' ?>">
  <div class="container">
    <div class="section-head section-head-center">
      <h2 class="section-title"><?= e($title) ?></h2>
      <p class="section-lead"><?= e($lead) ?></p>
    </div>
    <div class="grid grid-4">
      <?php foreach ($slugs as $svcSlug): ?>
        <a class="card card-service" href="<?= e(service_url($svcSlug)) ?>">
          <span class="card-icon-plain"><?= service_icon($services[$svcSlug]['icon']) ?></span>
          <h3 class="card-title"><?= e($services[$svcSlug]['name']) ?></h3>
          <p class="card-text"><?= e($services[$svcSlug]['short']) ?></p>
          <span class="card-link"><?= e(t('cta.learn_more')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endforeach; ?>

<!-- ================================================== Where we work ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.choose_emirate')) ?></h2>
    </div>
    <?php
    require dirname(__DIR__) . '/includes/city-cards.php';
    ?>
  </div>
</section>

<?= faq_list($faqs, t('page.services.faq_h')) ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = t('page.services.q_head');
    $quoteIntro   = t('page.services.q_intro');
    $quoteSource  = 'services-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
  </div>
</section>

<?php
$bandWhatsApp = t('wa.services');
require dirname(__DIR__) . '/includes/cta-band.php';
?>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
