<?php
/**
 * Locations index — hub linking the three emirate landing pages.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$locations = all_locations();

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
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Service areas</span>
      <h1>Movers &amp; Packers Serving Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-sub">
        We are based in <?= e(BUSINESS_ADDRESS) ?> and work across all three emirates daily —
        which is why cross-emirate moves are ordinary work for us rather than a logistical event.
      </p>
      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '/contact-us/#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">Choose your emirate</h2>
      <p class="section-lead">
        Each page covers the moving scenarios, property types and practical considerations
        specific to that emirate.
      </p>
    </div>
    <div class="grid grid-3">
      <?php foreach ($locations as $slug => $location): ?>
        <?= location_card($slug, $location) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="split">
      <div class="prose">
        <h2>One service area, three emirates</h2>
        <p>
          Dubai, Sharjah and Ajman sit close enough together that people move between them
          constantly — for a shorter commute, more space, or a change of tenancy. Treating the
          three as a single service area is what makes those moves straightforward: one crew,
          one vehicle, one day, rather than a handover between companies at an emirate border.
        </p>
        <p>
          Being based in Sharjah puts us in the middle of that area. Sharjah jobs get the shortest
          response times, Ajman is a short run north, and Dubai is close enough that we work there
          every day. The routes between them are ones our crews drive constantly, which matters more
          for scheduling accuracy than any distance figure.
        </p>
        <p>
          What changes between the three is not our method but the local conditions — building
          access rules, lift availability, community entry requirements and the mix of property
          types. Those differences are covered on each emirate's own page.
        </p>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3>Common cross-emirate routes</h3>
          <ul class="checklist">
            <li><?= icon('route', 'icon icon-sm') ?><span>Sharjah to Dubai — our most frequent route</span></li>
            <li><?= icon('route', 'icon icon-sm') ?><span>Dubai to Sharjah — same-day for most households</span></li>
            <li><?= icon('route', 'icon icon-sm') ?><span>Ajman to Sharjah — a short run, usually straightforward</span></li>
            <li><?= icon('route', 'icon icon-sm') ?><span>Ajman to Dubai — comfortably a single-day move</span></li>
            <li><?= icon('route', 'icon icon-sm') ?><span>Dubai to Ajman — planned around building access at both ends</span></li>
          </ul>
        </div>
      </aside>
    </div>
  </div>
</section>

<?= faq_list($faqs, 'Questions about our service areas') ?>

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

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
