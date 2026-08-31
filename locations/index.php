<?php
/**
 * Locations index — hub linking the three emirate landing pages.
 * Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$locations = all_locations();
$services  = all_services();

$faqs = [
    ['q' => 'Which emirates do you serve?', 'a' => 'Dubai, Sharjah and Ajman. We are based in Sharjah, UAE, and moves between all three emirates are part of our normal service rather than a special arrangement.'],
    ['q' => 'Do you move between emirates in one day?', 'a' => 'For most households, yes. Dubai, Sharjah and Ajman are close enough that a full household move along any of those routes is usually completed in a single day, subject to the volume of contents and the building access at both ends.'],
    ['q' => 'Do you charge more for a cross-emirate move?', 'a' => 'The distance is only one factor and, over these routes, a small one. The bigger cost drivers are the volume of belongings, the packing required and the access at each address. Tell us both addresses and we will quote the actual job.'],
    ['q' => 'Do you cover areas outside these three emirates?', 'a' => 'Dubai, Sharjah and Ajman are our service area, which is what lets us keep response times short and schedules reliable. If your move involves an address just outside it, call us and we will tell you honestly whether we can help.'],
];

seo_set([
    'title'       => 'Movers in Dubai, Sharjah & Ajman | Service Areas',
    'description' => 'Movers and packers serving Dubai, Sharjah and Ajman from our Sharjah base. Local and cross-emirate household and commercial moves. Call 055 658 1781.',
    'path'        => '/locations/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Locations', 'url' => '/locations/'],
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
      <span class="eyebrow">Service areas</span>
      <h1>Movers &amp; Packers Serving Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-home-sub">
        We are based in <?= e(BUSINESS_ADDRESS) ?> and work across all three emirates daily —
        which is why cross-emirate moves are ordinary work for us.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span>Three emirates</span></div>
        <div class="hero-trust-item"><?= icon('route', 'icon') ?><span>Single-day moves</span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span>Free quotation</span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="Call <?= e(PHONE_INTL) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <div class="hero-home-media">
      <?= img('hero-movers-dubai.jpg', 'Our moving crew working across Dubai, Sharjah and Ajman',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ================================================ Choose an emirate ==== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>Choose Your Emirate</h2>
    </div>
    <p class="section-lead" style="text-align:center; margin-bottom: var(--sp-5);">
      Each page covers the moving scenarios, property types and practical considerations
      specific to that emirate.
    </p>

    <div class="city-cards">
      <?php foreach ($locations as $citySlug => $city): ?>
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

<!-- ============================================ One area, three emirates = -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img('hero-movers-dubai.jpg', 'Our crew loading a truck for a cross-emirate move',
                ['width' => 1600, 'height' => 977, 'icon' => 'truck']) ?>
      </div>

      <div>
        <span class="eyebrow">Why it matters</span>
        <h2>One Service Area, Three Emirates</h2>
        <p>
          Dubai, Sharjah and Ajman sit close enough together that people move between them
          constantly. Treating the three as a single service area is what makes those moves
          straightforward: one crew, one vehicle, one day, rather than a handover between
          companies at an emirate border.
        </p>
        <p>
          Being based in Sharjah puts us in the middle of that area. Sharjah jobs get the
          shortest response times, Ajman is a short run north, and Dubai is close enough that
          we work there every day.
        </p>

        <ul class="why-list">
          <li><?= icon('check', 'icon') ?><span>Sharjah to Dubai — our most frequent route</span></li>
          <li><?= icon('check', 'icon') ?><span>Dubai to Sharjah — same-day for most homes</span></li>
          <li><?= icon('check', 'icon') ?><span>Ajman to Sharjah — a short run</span></li>
          <li><?= icon('check', 'icon') ?><span>Ajman to Dubai — a single-day move</span></li>
          <li><?= icon('check', 'icon') ?><span>Dubai to Ajman — planned around access</span></li>
          <li><?= icon('check', 'icon') ?><span>Within any one emirate</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================================================= Services strip ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>Available Across All Three</h2>
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

<?= faq_list($faqs, 'Questions about our service areas') ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Get a Free Moving Quote';
    $quoteIntro   = 'Tell us both addresses and we will confirm access, timing and price for that specific route.';
    $quoteSource  = 'locations-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
  </div>
</section>

<!-- ======================================================= CTA band ====== -->
<section class="cta-gold">
  <div class="container cta-gold-inner">
    <div class="cta-gold-media">
      <?= img('cta-boxes.webp', '', ['width' => 600, 'height' => 450, 'icon' => 'box']) ?>
    </div>
    <div>
      <h2>Moving Between Emirates?</h2>
      <p>Most household moves between Dubai, Sharjah and Ajman are done in a single day.</p>
    </div>
    <div class="cta-gold-actions">
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
         aria-label="Call <?= e(PHONE_INTL) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
