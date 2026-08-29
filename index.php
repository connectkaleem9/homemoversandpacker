<?php
/**
 * Homepage — primary intent: "Movers & Packers in Dubai, Sharjah & Ajman".
 * Built as a Google Ads landing page: H1, location, service, quote form,
 * phone and WhatsApp are all above or immediately at the fold.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$services  = all_services();
$locations = all_locations();

/* FAQs rendered on this page — the same array feeds FAQPage schema. */
$homeFaqs = [
    ['q' => 'Which areas do you cover?', 'a' => 'We are based in Sharjah, UAE and provide moving services across Dubai, Sharjah and Ajman, including moves between all three emirates. Most cross-emirate household moves along these routes are completed in a single day.'],
    ['q' => 'How much do movers and packers cost?', 'a' => 'There is no single fixed price, and any quote given without asking about your property is a guess. The cost depends on the size of the property, the number of items, the distance between addresses, whether you want packing included, the access at both ends — floor, lift and parking — and any extra services such as storage or furniture assembly. Send us your details and we will give you a specific quotation.'],
    ['q' => 'Do you provide packing and unpacking?', 'a' => 'Yes. Full or partial packing is available with all materials supplied — cartons, bubble wrap, stretch film, tape and hanging wardrobe boxes — and we can unpack and place items at the new property if you want the home usable straight away.'],
    ['q' => 'Do you dismantle and reassemble furniture?', 'a' => 'Yes. Beds, wardrobes, dining tables, desks and modular units are dismantled where the access requires it and reassembled at your new property. Fixings are bagged and kept with the piece they belong to.'],
    ['q' => 'Can you move offices and shops as well as homes?', 'a' => 'Yes. We handle office relocations, retail and showroom moves, and commercial premises, usually scheduled outside working hours so the business keeps trading.'],
    ['q' => 'Do you offer storage between moving dates?', 'a' => 'Yes. Where your move-out and move-in dates do not line up, we collect and inventory your belongings, store them for the period you need, and deliver and reassemble them when your new property is ready.'],
    ['q' => 'How do I request a moving quote?', 'a' => 'Call or WhatsApp us on 055 658 1781, or complete the quote form on this page. A short video walkthrough of the property over WhatsApp is the fastest way for us to quote accurately.'],
    ['q' => 'How far in advance should I book a move?', 'a' => 'Earlier is better, especially at month end and around tenancy start and end dates when demand peaks. If your move is urgent, call us and we will tell you honestly what is available.'],
];

seo_set([
    'title'       => 'Movers and Packers in Dubai, Sharjah & Ajman',
    'description' => 'Movers and packers based in Sharjah, serving Dubai, Sharjah and Ajman. Home, villa, apartment and office moving with packing and storage. Call 055 658 1781.',
    'path'        => '/',
    'breadcrumbs' => [['label' => 'Home', 'url' => '/']],
    'schema'      => [schema_faq($homeFaqs)],
    'quote_anchor'=> '#quote',
]);

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Based in Sharjah · Serving <?= e(areas_sentence()) ?></span>
      <h1>Professional Movers &amp; Packers in Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-sub">
        Home, villa, apartment and office moves handled end to end — packed properly, dismantled
        where needed, transported safely and reassembled at your new address.
      </p>

      <ul class="hero-points">
        <li><?= icon('check', 'icon icon-sm') ?><span>Free, specific quotation before any work begins — no vague extras</span></li>
        <li><?= icon('check', 'icon icon-sm') ?><span>Packing materials, furniture dismantling and reassembly included</span></li>
        <li><?= icon('check', 'icon icon-sm') ?><span>Most moves within and between the three emirates completed in one day</span></li>
      </ul>

      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
      </div>

      <div class="hero-assurance">
        <span><?= icon('shield', 'icon icon-sm') ?> Careful furniture handling</span>
        <span><?= icon('clock', 'icon icon-sm') ?> Planned around building access</span>
        <span><?= icon('users', 'icon icon-sm') ?> Trained moving crews</span>
      </div>
    </div>

    <div class="hero-form">
      <?php
      $quoteSource = 'homepage';
      require __DIR__ . '/includes/quote-form.php';
      ?>
    </div>
  </div>
</section>

<section class="trust-strip">
  <div class="container">
    <div class="trust-grid">
      <div class="trust-item">
        <?= icon('box', 'icon') ?>
        <div>
          <h3>Packing &amp; unpacking</h3>
          <p>Proper materials, individually wrapped fragile items and cartons labelled by room.</p>
        </div>
      </div>
      <div class="trust-item">
        <?= icon('tools', 'icon') ?>
        <div>
          <h3>Furniture handling</h3>
          <p>Dismantling, protection and reassembly are part of the job, not an added extra.</p>
        </div>
      </div>
      <div class="trust-item">
        <?= icon('home', 'icon') ?>
        <div>
          <h3>Residential &amp; commercial</h3>
          <p>Apartments, villas, offices and retail units — each planned for what it actually needs.</p>
        </div>
      </div>
      <div class="trust-item">
        <?= icon('storage', 'icon') ?>
        <div>
          <h3>Storage when dates slip</h3>
          <p>Collected, inventoried and stored until your new property is ready.</p>
        </div>
      </div>
      <div class="trust-item">
        <?= icon('pin', 'icon') ?>
        <div>
          <h3><?= e(areas_sentence()) ?> coverage</h3>
          <p>All three emirates as one service area, with cross-emirate moves as standard work.</p>
        </div>
      </div>
      <div class="trust-item">
        <?= icon('quote', 'icon') ?>
        <div>
          <h3>Quoted before we start</h3>
          <p>Scope, crew, vehicle and price agreed in advance, based on your actual property.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="services">
  <div class="container">
    <div class="section-head section-head-center">
      <span class="eyebrow">Our services</span>
      <h2 class="section-title">Complete moving services across <?= e(areas_sentence()) ?></h2>
      <p class="section-lead">
        Twelve services covering everything a residential or commercial move needs — book the
        full move, or only the part you want help with.
      </p>
    </div>

    <div class="grid grid-4">
      <?php foreach ($services as $slug => $service): ?>
        <?= service_card($slug, $service) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head section-head-center">
      <span class="eyebrow">How it works</span>
      <h2 class="section-title">A move that is planned before it starts</h2>
      <p class="section-lead">
        Most moving days go wrong because nobody looked at the property first. Ours begins with
        an honest assessment and a quotation you can hold us to.
      </p>
    </div>

    <ol class="steps steps-5">
      <li class="step">
        <h3>Tell us about the move</h3>
        <p>Call, WhatsApp or use the quote form. A short video of the rooms is the fastest way for us to see what is involved.</p>
      </li>
      <li class="step">
        <h3>Survey and quotation</h3>
        <p>We confirm crew size, vehicles, materials and timing, then quote against that — for villas, after an on-site survey.</p>
      </li>
      <li class="step">
        <h3>Packing and protection</h3>
        <p>Room-by-room packing with labelled cartons, fragile items wrapped individually and furniture properly protected.</p>
      </li>
      <li class="step">
        <h3>Loading and transport</h3>
        <p>Loaded in a planned order with the weight balanced and the load strapped, then driven directly to the new address.</p>
      </li>
      <li class="step">
        <h3>Setup at your new home</h3>
        <p>Furniture reassembled and placed, cartons delivered to their labelled rooms, and a final check with you before we leave.</p>
      </li>
    </ol>
  </div>
</section>

<section class="section" id="locations">
  <div class="container">
    <div class="section-head section-head-center">
      <span class="eyebrow">Where we work</span>
      <h2 class="section-title">Movers in Dubai, Sharjah and Ajman</h2>
      <p class="section-lead">
        We are based in Sharjah and work across all three emirates daily, so cross-emirate moves
        are routine rather than a special arrangement.
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
        <span class="eyebrow">Why choose us</span>
        <h2>A moving company that tells you what the day will actually involve</h2>
        <p>
          Moving is stressful mostly because of uncertainty — how long it will take, what it will
          cost, and whether your furniture will arrive in the condition it left. We remove that
          uncertainty by doing the assessment properly before quoting, and by being specific about
          what is included.
        </p>
        <p>
          That means telling you when a wardrobe will have to be dismantled, when a building's
          single service lift is going to slow the day down, and when a villa needs two days of
          packing rather than one. It is less comfortable than promising everything will be fine,
          and considerably more useful.
        </p>
        <p>
          Our crews are trained in handling, protection and lifting technique, and the same team
          that packs your home is the team that unpacks it. Nothing gets lost in a handover between
          contractors.
        </p>
      </div>

      <div class="grid" style="gap: var(--sp-5);">
        <div class="benefit">
          <?= icon('shield', 'icon') ?>
          <div>
            <h3>Protection before lifting</h3>
            <p>Wrapping, padding and corner protection go on before anything is carried — the only point at which they prevent damage.</p>
          </div>
        </div>
        <div class="benefit">
          <?= icon('clock', 'icon') ?>
          <div>
            <h3>Realistic timelines</h3>
            <p>We plan around lift bookings, service entrances and permitted moving hours rather than assuming an empty building.</p>
          </div>
        </div>
        <div class="benefit">
          <?= icon('users', 'icon') ?>
          <div>
            <h3>Crew sized to the job</h3>
            <p>A fourth-floor flat with no lift needs more people, not more hours. We price it that way from the start.</p>
          </div>
        </div>
        <div class="benefit">
          <?= icon('quote', 'icon') ?>
          <div>
            <h3>No surprise charges</h3>
            <p>The quotation covers the scope we agreed. If something changes, we tell you before doing the work, not after.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= faq_list($homeFaqs, 'Movers and packers — common questions') ?>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Ready to plan your move?</h2>
      <p>Send us your property details and we will come back with a clear quotation. Free, and no obligation.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '#quote') ?>
      <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
