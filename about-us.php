<?php
/**
 * About Us — built with the same design language as the homepage: photo hero,
 * rule-flanked section headings, a left-bleeding photo split, duotone value
 * cards, numbered process steps, city cards and the gold CTA band.
 *
 * Deliberately free of invented history, headcounts, fleet sizes and awards.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$locations = all_locations();

/* Dedicated About photography if it has been supplied, otherwise the site's
   existing crew photos — same company, same crew, so nothing is misleading. */
$aboutHero = image_exists('about-hero.jpg') ? 'about-hero.jpg' : 'hero-movers-dubai.jpg';
$aboutTeam = image_exists('about-team.jpg') ? 'about-team.jpg' : 'why-choose-us.jpg';

$faqs = [
    ['q' => 'Where is your business based?', 'a' => 'Sharjah, UAE. We serve Dubai, Sharjah and Ajman from there, and we do not claim offices in emirates where we do not have them.'],
    ['q' => 'What kind of moves do you handle?', 'a' => 'Residential moves of every size — studios through to five-bedroom villas — and commercial moves including offices, shops and showrooms. We also provide the individual services separately: packing, furniture moving, assembly, loading, storage and car transport.'],
    ['q' => 'Do you use your own crews?', 'a' => 'Yes. The team that packs your home is the team that loads, transports and unpacks it. Nothing is handed over mid-move to a separate contractor, which is where responsibility usually gets lost.'],
    ['q' => 'How do I get a quotation?', 'a' => 'Call or WhatsApp 055 658 1781, or use the quote form on this site. For apartments, a short video walkthrough is usually enough. For villas, we recommend an on-site survey so the quotation reflects the actual property.'],
];

seo_set([
    'title'       => 'About Us | Movers & Packers in Sharjah, UAE',
    'description' => 'About Home Movers & Packers — a moving company in Sharjah, UAE serving Dubai, Sharjah and Ajman with moving, packing and storage services.',
    'path'        => '/about-us/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'About Us', 'url' => '/about-us/'],
    ],
    'schema'      => [schema_faq($faqs)],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">About us</span>
      <h1>A Moving Company Based in Sharjah, Serving All Three Emirates</h1>
      <p class="hero-home-sub">
        We move homes, villas, apartments, offices and shops — and we tell you what the
        day will actually involve before you book it.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span>Based in Sharjah</span></div>
        <div class="hero-trust-item"><?= icon('users', 'icon') ?><span>Our own crews</span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span>Quoted in advance</span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '/contact-us/#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="Call <?= e(PHONE_INTL) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <div class="hero-home-media">
      <?= img($aboutHero, 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ================================================== Who we are ========= -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img($aboutTeam, 'Our crew wrapping an armchair in protective film before a move',
                ['width' => 1400, 'height' => 933, 'icon' => 'sofa']) ?>
      </div>

      <div>
        <span class="eyebrow">Who we are</span>
        <h2>Movers &amp; Packers in <?= e(BUSINESS_ADDRESS) ?></h2>
        <p>
          Home Movers &amp; Packers provides residential and commercial relocation across
          <?= e(areas_sentence()) ?>. We handle full household moves, single-item furniture
          jobs, office and retail relocations, packing, furniture assembly, loading and
          unloading, storage and vehicle transport.
        </p>
        <p>
          We are not a broker. When you book a move with us, our own crew arrives, packs,
          protects, loads, transports, unloads and reassembles. That single line of
          responsibility is the most practical guarantee we can offer — there is nobody to
          point at when something goes wrong, because the same people are there from start
          to finish.
        </p>

        <ul class="why-list">
          <li><?= icon('check', 'icon') ?><span>Based in <?= e(BUSINESS_ADDRESS) ?></span></li>
          <li><?= icon('check', 'icon') ?><span>Serving <?= e(areas_sentence()) ?></span></li>
          <li><?= icon('check', 'icon') ?><span>12 residential and commercial services</span></li>
          <li><?= icon('check', 'icon') ?><span>Own crews — no subcontracted handovers</span></li>
          <li><?= icon('check', 'icon') ?><span>Free quotation before any booking</span></li>
          <li><?= icon('check', 'icon') ?><span>Cross-emirate moves as standard work</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- =============================================== What we stand behind == -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>What We Stand Behind</h2>
    </div>

    <div class="grid grid-4">
      <div class="card">
        <span class="card-icon-plain"><?= service_icon('box') ?></span>
        <h3 class="card-title">Protect first</h3>
        <p class="card-text" style="margin-bottom:0;">
          Wrapping and padding go on before the lift. Protection applied afterwards is just
          cleanup.
        </p>
      </div>
      <div class="card">
        <span class="card-icon-plain"><?= service_icon('tools') ?></span>
        <h3 class="card-title">Quote honestly</h3>
        <p class="card-text" style="margin-bottom:0;">
          A quotation based on your actual property, with the scope stated so nothing is
          ambiguous later.
        </p>
      </div>
      <div class="card">
        <span class="card-icon-plain"><?= service_icon('route') ?></span>
        <h3 class="card-title">Plan the constraints</h3>
        <p class="card-text" style="margin-bottom:0;">
          Lifts, service entrances, permitted hours and access routes are settled before the
          crew arrives.
        </p>
      </div>
      <div class="card">
        <span class="card-icon-plain"><?= service_icon('home') ?></span>
        <h3 class="card-title">Finish the job</h3>
        <p class="card-text" style="margin-bottom:0;">
          Furniture reassembled, cartons in the right rooms, material cleared, and a final
          walkthrough with you.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================== How we work ======== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2>How We Work</h2>
    </div>

    <ol class="process-row">
      <li class="process-item">
        <span class="process-icon"><?= icon('phone', 'icon') ?></span>
        <span class="process-num">01</span>
        <h3>We assess first</h3>
        <p>A short video walkthrough for apartments, an on-site survey for villas and commercial premises.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('clipboard', 'icon') ?></span>
        <span class="process-num">02</span>
        <h3>We quote to that</h3>
        <p>Crew size, vehicle, materials and a realistic window — not a number that changes on the day.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('shield', 'icon') ?></span>
        <span class="process-num">03</span>
        <h3>We protect before lifting</h3>
        <p>Upholstery filmed, hard furniture blanketed, glass and mirrors given rigid protection.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('truck', 'icon') ?></span>
        <span class="process-num">04</span>
        <h3>We move it ourselves</h3>
        <p>The crew that packed your home is the crew that loads, drives and unloads it.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('home', 'icon') ?></span>
        <span class="process-num">05</span>
        <h3>We put it back together</h3>
        <p>Whatever we dismantled is reassembled and placed before we leave.</p>
      </li>
    </ol>
  </div>
</section>

<!-- ============================================= What we will not do ===== -->
<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <span class="eyebrow">Being straight with you</span>
        <h2>What we will not do</h2>
        <p>
          We do not quote without asking about your property, because a number produced that
          way is a guess that gets corrected on the day — usually upward, at the point where
          you have no alternative.
        </p>
        <p>
          We do not claim capabilities we do not have, and where a job needs something we
          cannot provide, we say so rather than improvising on site.
        </p>
        <p>
          We also do not publish invented credentials. You will not find fabricated review
          counts, star ratings, years-in-business figures or fleet numbers anywhere on this
          site. If you want to know something specific about how we work, call and ask — a
          direct answer is more useful than a badge.
        </p>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3>Talk to us directly</h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);">
            Tell us about the property and we will come back with a clear quotation. Free,
            and with no obligation.
          </p>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-4);">
            <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
            <?= cta_whatsapp('Hello, I would like to know more about your moving services.', 'btn btn-whatsapp btn-block') ?>
            <?= cta_quote('btn btn-primary btn-block', 'Get a Free Quote', '/contact-us/#quote') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================================================== Where we work ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2>Where We Work</h2>
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

<?= faq_list($faqs, 'About our company — common questions') ?>

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
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
