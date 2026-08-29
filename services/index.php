<?php
/**
 * Services index — hub page linking every service landing page.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$services = all_services();

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
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Our services</span>
      <h1>Moving Services in Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-sub">
        Twelve services covering residential and commercial moves end to end. Book the full move,
        or only the part you want help with — each is priced for what it actually involves.
      </p>
      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '/contact-us/#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I would like to ask about your moving services.', 'btn btn-whatsapp btn-lg') ?>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Residential moving</h2>
      <p class="section-lead">Homes, villas and apartments — from a single room to a full five-bedroom relocation.</p>
    </div>
    <div class="grid grid-4">
      <?php foreach (['home-movers', 'villa-movers', 'studio-apartment-movers', 'local-moving'] as $slug): ?>
        <?= service_card($slug, $services[$slug]) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Business moving</h2>
      <p class="section-lead">Offices, shops and showrooms, scheduled around your working and trading hours.</p>
    </div>
    <div class="grid grid-4">
      <?php foreach (['office-commercial-movers', 'commercial-retail-movers', 'warehousing-storage', 'loading-unloading'] as $slug): ?>
        <?= service_card($slug, $services[$slug]) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Furniture, packing and specialist services</h2>
      <p class="section-lead">The individual services that make up a move, available on their own if that is all you need.</p>
    </div>
    <div class="grid grid-4">
      <?php foreach (['furniture-movers', 'packing-unpacking', 'furniture-assembly', 'car-transportation'] as $slug): ?>
        <?= service_card($slug, $services[$slug]) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= related_locations('Choose your emirate') ?>

<?= faq_list($faqs, 'Questions about our services') ?>

<section class="section section-alt">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Not sure which service you need?';
    $quoteIntro   = 'Describe your move and we will tell you which service fits — and quote for it.';
    $quoteSource  = 'services-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
