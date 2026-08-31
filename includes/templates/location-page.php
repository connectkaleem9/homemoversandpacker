<?php
/**
 * Shared location page template — same design language as the homepage.
 *
 * Each file in /locations/ sets $locationSlug and requires this.
 * Layout is shared; every word of content comes from includes/data/locations.php,
 * where Dubai, Sharjah and Ajman are written separately rather than city-swapped.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

/** @var string $locationSlug */
$location = get_location($locationSlug ?? '');

if ($location === null) {
    http_response_code(404);
    require dirname(__DIR__, 2) . '/404.php';
    exit;
}

$slug     = $location['slug'];
$city     = $location['name'];
$services = all_services();

seo_set([
    'title'       => $location['title'],
    'description' => $location['description'],
    'path'        => location_url($slug),
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.locations'), 'url' => '/locations/'],
        ['label' => t('nav.movers_in', ['city' => $city]), 'url' => location_url($slug)],
    ],
    'schema'      => [schema_faq($location['faqs'])],
    'quote_anchor'=> '#quote',
]);

$waMessage = t('wa.city', ['city' => $city]);

require dirname(__DIR__) . '/header.php';

/* Re-resolve after the header — see the note in service-page.php. */
$location = get_location($locationSlug);
$slug     = $location['slug'];
$city     = $location['name'];

/* The city skylines are card-sized (900px). Across a ~890x490 hero they would
   be upscaled and soft, so the hero uses the full-size crew photo unless a
   dedicated large city image has been supplied. */
$heroImg = image_exists('locations/' . $slug . '-hero.jpg')
    ? 'locations/' . $slug . '-hero.jpg'
    : 'hero-movers-dubai.jpg';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('tpl.location.eyebrow', ['city' => $city])) ?></span>
      <h1><?= e($location['h1']) ?></h1>
      <p class="hero-home-sub"><?= e($location['hero_sub']) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('misc.based_sharjah')) ?></span></div>
        <div class="hero-trust-item"><?= icon('route', 'icon') ?><span><?= e(t('misc.cross_emirate')) ?></span></div>
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

    <?= hero_media($heroImg, 'Our moving crew working in ' . $city . ', UAE',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'building']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ============================================== Local context ========== -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img('why-choose-us.jpg', 'Our crew wrapping furniture before a move in ' . $city,
                ['width' => 1400, 'height' => 933, 'icon' => 'sofa']) ?>
      </div>

      <div>
        <span class="eyebrow"><?= e(t('tpl.location.moving_in', ['city' => $city])) ?></span>
        <h2><?= e($location['local_context']['heading']) ?></h2>
        <?php foreach ($location['intro'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <div class="btn-row" style="margin-top: var(--sp-5);">
          <?= cta_quote('btn btn-primary', t('cta.quote'), '#quote') ?>
          <?= cta_whatsapp($waMessage, 'btn btn-whatsapp') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =============================================== Detail + help box ===== -->
<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <?php foreach ($location['local_context']['body'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3><?= e(t('tpl.location.book_h3', ['city' => $city])) ?></h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);"><?= e(t('tpl.location.book_p')) ?></p>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-4);">
            <?= cta_quote('btn btn-primary btn-block', t('cta.quote'), '#quote') ?>
            <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
            <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-block') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================================================== Scenarios ========== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e($location['scenarios']['heading']) ?></h2>
    </div>
    <div class="grid grid-3">
      <?php foreach ($location['scenarios']['items'] as $item): ?>
        <div class="card">
          <span class="card-icon-plain"><?= service_icon('route') ?></span>
          <h3 class="card-title"><?= e($item['title']) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e($item['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================ Services in this city ==== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('tpl.location.svc_h2', ['city' => $city])) ?></h2>
    </div>
    <p class="section-lead" style="text-align:center; margin-bottom: var(--sp-5);">
      <?= e($location['services_intro']) ?>
    </p>

    <div class="service-strip" style="--cols:<?= min(6, count($location['featured_services'])) + 1 ?>">
      <?php foreach (array_slice($location['featured_services'], 0, 6) as $featSlug): ?>
        <?php if (!isset($services[$featSlug])) { continue; } $feat = $services[$featSlug]; ?>
        <a class="service-tile" href="<?= e(service_url($featSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($feat['icon']) ?></span>
          <h3><?= e($feat['name']) ?></h3>
          <p><?= e($feat['tile']) ?></p>
        </a>
      <?php endforeach; ?>
      <a class="service-tile" href="<?= e(lang_url('/services/')) ?>">
        <span class="service-tile-icon"><?= service_icon('truck') ?></span>
        <h3><?= e(t('sec.and_more')) ?></h3>
        <p><?= e(t('sec.and_more_text')) ?></p>
      </a>
    </div>

    <div class="panel" style="margin-top: var(--sp-5);">
      <h3><?= e(t('tpl.location.every_h3', ['city' => $city])) ?></h3>
      <ul class="checklist checklist-2">
        <?php foreach ($services as $svcSlug => $svc): ?>
          <li>
            <?= icon('check', 'icon icon-sm') ?>
            <a href="<?= e(service_url($svcSlug)) ?>"><?= e($svc['name']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?= faq_list($location['faqs'], t('tpl.location.faq_h', ['city' => $city])) ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = t('tpl.location.q_head', ['city' => $city]);
    $quoteIntro   = t('tpl.location.q_intro', ['city' => $city]);
    $quoteSource  = 'location:' . $slug;
    require dirname(__DIR__) . '/quote-form.php';
    ?>
  </div>
</section>

<!-- ================================================ Other emirates ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('tpl.location.other_h2')) ?></h2>
    </div>
    <?php
    $cityExclude = $slug;
    $cityExtra = true;
    require __DIR__ . '/../city-cards.php';
    ?>
  </div>
</section>

<?php
$bandTitle    = t('band.city_title', ['city' => $city]);
$bandSub      = t('band.city_sub');
$bandWhatsApp = $waMessage;
require __DIR__ . '/../cta-band.php';
?>

<?php require dirname(__DIR__) . '/footer.php'; ?>
