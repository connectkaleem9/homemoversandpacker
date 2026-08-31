<?php
/**
 * Locations index — hub linking the three emirate landing pages.
 * Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$locations = all_locations();
$services  = all_services();

$faqs = [];
foreach ([1, 2, 3, 4] as $n) {
    $faqs[] = ['q' => t('page.locations.faq' . $n . '_q'), 'a' => t('page.locations.faq' . $n . '_a')];
}

seo_set([
    'title'       => t('page.locations.title'),
    'description' => t('page.locations.desc'),
    'path'        => '/locations/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.locations'), 'url' => '/locations/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '#quote',
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.locations.eyebrow')) ?></span>
      <h1><?= e(t('page.locations.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.locations.sub', ['address' => business_address()])) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('misc.three_emirates')) ?></span></div>
        <div class="hero-trust-item"><?= icon('route', 'icon') ?><span><?= e(t('page.locations.trust2')) ?></span></div>
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

    <?= hero_media('hero-movers-dubai.jpg', 'Our moving crew working across Dubai, Sharjah and Ajman',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ================================================ Choose an emirate ==== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.choose_emirate')) ?></h2>
    </div>
    <p class="section-lead" style="text-align:center; margin-bottom: var(--sp-5);">
      <?= e(t('page.locations.choose_lead')) ?>
    </p>

    <?php
    require dirname(__DIR__) . '/includes/city-cards.php';
    ?>
  </div>
</section>

<!-- ============================================ One area, three emirates = -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img('hero-movers-dubai.jpg', 'Our crew loading a truck for a cross-emirate move',
                ['width' => 1600, 'height' => 977, 'icon' => 'truck']) ?>
      </div>

      <div>
        <span class="eyebrow"><?= e(t('page.locations.why_eyebrow')) ?></span>
        <h2><?= e(t('page.locations.why_h2')) ?></h2>
        <p><?= e(t('page.locations.why_p1')) ?></p>
        <p><?= e(t('page.locations.why_p2')) ?></p>

        <ul class="why-list">
          <?php foreach (range(1, 6) as $locWhy): ?>
            <li><?= icon('check', 'icon') ?><span><?= e(t('page.locations.why' . $locWhy)) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================================================= Services strip ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.locations.avail_h2')) ?></h2>
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

<?= faq_list($faqs, t('page.locations.faq_h')) ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = t('page.locations.q_head');
    $quoteIntro   = t('page.locations.q_intro');
    $quoteSource  = 'locations-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
  </div>
</section>

<?php
$bandTitle    = t('band.between_title');
$bandSub      = t('band.between_sub');
require dirname(__DIR__) . '/includes/cta-band.php';
?>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
