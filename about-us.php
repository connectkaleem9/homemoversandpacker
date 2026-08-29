<?php
/**
 * About Us — who the company is, what it does, how it works.
 * Deliberately free of invented history, headcounts, fleet sizes and awards.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

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

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">About us</span>
      <h1>A Moving Company Based in Sharjah, Serving Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-sub">
        We move homes, villas, apartments, offices and shops — and we tell you what the day will
        actually involve before you book it.
      </p>
      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '/contact-us/#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <h2>Who we are</h2>
        <p>
          Home Movers &amp; Packers is a moving company based in <?= e(BUSINESS_ADDRESS) ?>, providing
          residential and commercial relocation across <?= e(areas_sentence()) ?>. We handle full
          household moves, single-item furniture jobs, office and retail relocations, packing,
          furniture assembly, loading and unloading, storage and vehicle transport.
        </p>
        <p>
          We are not a broker. When you book a move with us, our own crew arrives, packs, protects,
          loads, transports, unloads and reassembles. That single line of responsibility is the
          most practical guarantee we can offer, because it means there is nobody to point at when
          something goes wrong — and nobody has to point at anyone, because the same people are
          there from start to finish.
        </p>

        <h2>How we work</h2>
        <p>
          Every job starts with an assessment. For apartments, that is usually a short video
          walkthrough over WhatsApp. For villas and commercial premises, it is an on-site survey.
          Either way, the point is the same: to know what is actually in the property before
          quoting, rather than producing a number that changes on moving day.
        </p>
        <p>
          From that assessment comes the crew size, the vehicle, the amount of packing material and
          the realistic time window. We would rather tell you a move needs two days of packing than
          promise one and finish at midnight.
        </p>
        <p>
          Protection is applied before anything is lifted. Upholstery is stretch-wrapped, hard
          furniture gets blankets and corner protection, glass and mirrors get rigid protection, and
          fragile items are wrapped individually. Furniture that will not clear the access route is
          dismantled properly, with fixings bagged and taped to the piece they belong to.
        </p>

        <h2>What we will not do</h2>
        <p>
          We do not quote without asking about your property, because a number produced that way is
          a guess that gets corrected on the day, usually upward. We do not claim capabilities we do
          not have, and where a job needs something we cannot provide, we say so rather than
          improvising on site.
        </p>
        <p>
          We also do not publish invented credentials. You will not find fabricated review counts,
          star ratings, years-in-business figures or fleet numbers anywhere on this site. If you
          want to know something specific about how we work, call and ask — a direct answer is more
          useful than a badge.
        </p>

        <h2>Our service area</h2>
        <p>
          Sharjah is our base and where our response times are shortest. Ajman is a short run north.
          Dubai is close enough that we work there every day, and moves between all three emirates
          are ordinary jobs for us — normally completed in a single day for a typical household.
        </p>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3>At a glance</h3>
          <ul class="checklist">
            <li><?= icon('pin', 'icon icon-sm') ?><span>Based in <?= e(BUSINESS_ADDRESS) ?></span></li>
            <li><?= icon('route', 'icon icon-sm') ?><span>Serving <?= e(areas_sentence()) ?></span></li>
            <li><?= icon('box', 'icon icon-sm') ?><span>12 residential and commercial services</span></li>
            <li><?= icon('users', 'icon icon-sm') ?><span>Own crews — no subcontracted handovers</span></li>
            <li><?= icon('quote', 'icon icon-sm') ?><span>Free quotation before any booking</span></li>
            <li><?= icon('phone', 'icon icon-sm') ?><span><?= e(PHONE_DISPLAY) ?></span></li>
          </ul>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-5);">
            <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
            <?= cta_whatsapp('Hello, I would like to know more about your moving services.', 'btn btn-whatsapp btn-block') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head section-head-center">
      <span class="eyebrow">What we stand behind</span>
      <h2 class="section-title">Four things we hold ourselves to</h2>
    </div>
    <div class="grid grid-4">
      <div class="card">
        <span class="card-icon"><?= icon('shield', 'icon') ?></span>
        <h3 class="card-title">Protect first</h3>
        <p class="card-text" style="margin-bottom:0;">Wrapping and padding go on before the lift. Protection applied afterwards is just cleanup.</p>
      </div>
      <div class="card">
        <span class="card-icon"><?= icon('quote', 'icon') ?></span>
        <h3 class="card-title">Quote honestly</h3>
        <p class="card-text" style="margin-bottom:0;">A quotation based on your actual property, with the scope stated so nothing is ambiguous later.</p>
      </div>
      <div class="card">
        <span class="card-icon"><?= icon('clock', 'icon') ?></span>
        <h3 class="card-title">Plan the constraints</h3>
        <p class="card-text" style="margin-bottom:0;">Lifts, service entrances, permitted hours and access routes are settled before the crew arrives.</p>
      </div>
      <div class="card">
        <span class="card-icon"><?= icon('users', 'icon') ?></span>
        <h3 class="card-title">Finish the job</h3>
        <p class="card-text" style="margin-bottom:0;">Furniture reassembled, cartons in the right rooms, packing material cleared, and a final walkthrough with you.</p>
      </div>
    </div>
  </div>
</section>

<?= related_locations('Where we work') ?>

<?= faq_list($faqs, 'About our company — common questions') ?>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Planning a move?</h2>
      <p>Tell us about the property and we will come back with a clear quotation — free, and with no obligation.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '/contact-us/#quote') ?>
      <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
