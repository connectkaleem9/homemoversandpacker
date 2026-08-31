<?php
/**
 * Services index — hub page linking every service landing page.
 * Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$services  = all_services();
$locations = all_locations();

$faqs = [
    ['q' => 'Can I book more than one service together?', 'a' => 'Yes, and most customers do. A typical booking combines home moving with packing, and often furniture assembly or storage. Booking them together means one crew, one schedule and one quotation rather than several providers coordinating between themselves.'],
    ['q' => 'Can I book only part of a move?', 'a' => 'Yes. Loading and unloading is available as labour only if you have your own vehicle, packing can be booked without transport, and furniture assembly can be booked on its own. Tell us which part you want and we will price that.'],
    ['q' => 'Are all services available in Dubai, Sharjah and Ajman?', 'a' => 'Yes. Every service listed here is available across all three emirates, including moves between them.'],
    ['q' => 'How do I know which service I need?', 'a' => 'If you are not sure, call or WhatsApp us with a short description of what you are moving. It is usually obvious to us within a minute, and we would rather quote for the right service than sell you a larger one.'],
];

seo_set([
    'title'       => 'Moving Services in Dubai, Sharjah & Ajman',
    'description' => 'Home, villa, apartment, office, retail, packing, storage, furniture assembly, loading and car transport across Dubai, Sharjah and Ajman. Call 055 658 1781.',
    'path'        => '/services/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Services', 'url' => '/services/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '#quote',
]);

require dirname(__DIR__) . '/includes/header.php';

$groups = [
    ['Residential Moving', 'Homes, villas and apartments — from a single room to a full five-bedroom relocation.',
     ['home-movers', 'villa-movers', 'studio-apartment-movers', 'local-moving']],
    ['Business Moving', 'Offices, shops and showrooms, scheduled around your working and trading hours.',
     ['office-commercial-movers', 'commercial-retail-movers', 'warehousing-storage', 'loading-unloading']],
    ['Furniture, Packing &amp; Specialist', 'The individual services that make up a move, available on their own if that is all you need.',
     ['furniture-movers', 'packing-unpacking', 'furniture-assembly', 'car-transportation']],
];
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Our services</span>
      <h1>Moving Services in Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-home-sub">
        Twelve services covering residential and commercial moves end to end. Book the full
        move, or only the part you want help with.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('box', 'icon') ?><span>12 services</span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span>All three emirates</span></div>
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
      <?= img('hero-movers-dubai.jpg', 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- =================================================== All services ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>All Our Moving Services</h2>
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
      <h2 class="section-title"><?= $title ?></h2>
      <p class="section-lead"><?= $lead ?></p>
    </div>
    <div class="grid grid-4">
      <?php foreach ($slugs as $svcSlug): ?>
        <a class="card card-service" href="<?= e(service_url($svcSlug)) ?>">
          <span class="card-icon-plain"><?= service_icon($services[$svcSlug]['icon']) ?></span>
          <h3 class="card-title"><?= e($services[$svcSlug]['name']) ?></h3>
          <p class="card-text"><?= e($services[$svcSlug]['short']) ?></p>
          <span class="card-link">Learn more <?= icon('arrow', 'icon icon-sm') ?></span>
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
      <h2>Choose Your Emirate</h2>
    </div>
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

<?= faq_list($faqs, 'Questions about our services') ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Not sure which service you need?';
    $quoteIntro   = 'Describe your move and we will tell you which service fits — and quote for it.';
    $quoteSource  = 'services-index';
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
      <h2>Planning a Move? Get Your Free Quote Today!</h2>
      <p>Quick, easy and obligation-free.</p>
    </div>
    <div class="cta-gold-actions">
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
         aria-label="Call <?= e(PHONE_INTL) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('Hello, I would like to ask about your moving services.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
