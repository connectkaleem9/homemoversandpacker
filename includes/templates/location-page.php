<?php
/**
 * Shared location page template.
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
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Locations', 'url' => '/locations/'],
        ['label' => 'Movers in ' . $city, 'url' => location_url($slug)],
    ],
    'schema'      => [schema_faq($location['faqs'])],
    'quote_anchor'=> '#quote',
]);

$waMessage = 'Hello, I need a moving quote in ' . $city . '.';

require dirname(__DIR__) . '/header.php';

/* Re-resolve after the header — see the note in service-page.php. */
$location = get_location($locationSlug);
$slug     = $location['slug'];
$city     = $location['name'];
?>

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Movers &amp; Packers · <?= e($city) ?>, UAE</span>
      <h1><?= e($location['h1']) ?></h1>
      <p class="hero-sub"><?= e($location['hero_sub']) ?></p>

      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-lg') ?>
      </div>

      <div class="hero-assurance">
        <span><?= icon('pin', 'icon icon-sm') ?> Based in <?= e(BUSINESS_ADDRESS) ?></span>
        <span><?= icon('route', 'icon icon-sm') ?> <?= e($city) ?> moves and cross-emirate routes</span>
        <span><?= icon('quote', 'icon icon-sm') ?> Free quotation before booking</span>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <?php foreach ($location['intro'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <h2><?= e($location['local_context']['heading']) ?></h2>
        <?php foreach ($location['local_context']['body'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3>Book a move in <?= e($city) ?></h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);">
            Send us the two addresses, the property type and your preferred date. We confirm access,
            crew and vehicle, then quote.
          </p>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-4);">
            <?= cta_quote('btn btn-primary btn-block', 'Get a Free Quote', '#quote') ?>
            <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
            <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-block') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow"><?= e($city) ?> moving scenarios</span>
      <h2 class="section-title"><?= e($location['scenarios']['heading']) ?></h2>
    </div>
    <div class="grid grid-3">
      <?php foreach ($location['scenarios']['items'] as $item): ?>
        <div class="card">
          <span class="card-icon"><?= icon('route', 'icon') ?></span>
          <h3 class="card-title"><?= e($item['title']) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e($item['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Services in <?= e($city) ?></span>
      <h2 class="section-title">Moving services available in <?= e($city) ?></h2>
      <p class="section-lead"><?= e($location['services_intro']) ?></p>
    </div>
    <div class="grid grid-3">
      <?php foreach ($location['featured_services'] as $serviceSlug): ?>
        <?php if (isset($services[$serviceSlug])): ?>
          <?= service_card($serviceSlug, $services[$serviceSlug]) ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <div class="panel" style="margin-top: var(--sp-6);">
      <h3>Every service we offer covers <?= e($city) ?></h3>
      <ul class="checklist checklist-2">
        <?php foreach ($services as $serviceSlug => $service): ?>
          <li>
            <?= icon('check', 'icon icon-sm') ?>
            <a href="<?= e(service_url($serviceSlug)) ?>"><?= e($service['name']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?= faq_list($location['faqs'], 'Movers in ' . e($city) . ' — frequently asked questions') ?>

<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Get a Free Moving Quote in ' . $city;
    $quoteIntro   = 'Tell us about your move in ' . $city . ' and we will come back with a specific quotation. No obligation.';
    $quoteSource  = 'location:' . $slug;
    require dirname(__DIR__) . '/quote-form.php';
    ?>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <h2 class="section-title">Also moving to or from another emirate?</h2>
    <div class="grid grid-3">
      <?php foreach (all_locations() as $otherSlug => $other): ?>
        <?php if ($otherSlug !== $slug): ?>
          <?= location_card($otherSlug, $other) ?>
        <?php endif; ?>
      <?php endforeach; ?>
      <a class="card card-location" href="/services/">
        <span class="card-icon"><?= icon('box', 'icon') ?></span>
        <h3 class="card-title">All moving services</h3>
        <p class="card-text">Browse the full range of residential, commercial and specialist services.</p>
        <span class="card-link">View services <?= icon('arrow', 'icon icon-sm') ?></span>
      </a>
    </div>
  </div>
</section>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Moving in <?= e($city) ?>?</h2>
      <p>Call or WhatsApp us with your dates and addresses — we will confirm what is available and what it will involve.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_phone('btn btn-primary btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/footer.php'; ?>
