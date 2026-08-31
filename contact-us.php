<?php
/**
 * Contact Us — same design language as the homepage: photo hero, rule-flanked
 * section headings, duotone contact cards, the quote form as the main event,
 * city cards and the gold CTA band.
 *
 * No invented business hours and no embedded map: neither has been supplied.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$locations = all_locations();

$contactHero = image_exists('contact-hero.jpg') ? 'contact-hero.jpg' : 'hero-movers-dubai.jpg';

$faqs = [
    ['q' => 'What is the fastest way to get a quote?', 'a' => 'WhatsApp. Send a short video walkthrough of the property along with your two addresses and preferred date, and we can usually respond with a specific quotation quickly. Calling works equally well if you would rather talk it through.'],
    ['q' => 'Do you charge for a survey or quotation?', 'a' => 'No. Quotations are free and carry no obligation, including on-site surveys for villas and commercial premises.'],
    ['q' => 'What information should I have ready?', 'a' => 'The current and new addresses, the property type, the floor and lift situation at both ends, your preferred date, and whether you want packing included. That is usually enough for an accurate quotation.'],
    ['q' => 'Do you serve Dubai, Sharjah and Ajman?', 'a' => 'Yes, all three, including moves between them. We are based in Sharjah, UAE.'],
];

seo_set([
    'title'       => 'Contact Us | Get a Free Moving Quote',
    'description' => 'Contact Home Movers & Packers for a free moving quote. Call 055 658 1781 or WhatsApp us. Based in Sharjah, UAE, serving Dubai, Sharjah and Ajman.',
    'path'        => '/contact-us/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Contact Us', 'url' => '/contact-us/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '#quote',
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Contact us</span>
      <h1>Get a Free Moving Quote</h1>
      <p class="hero-home-sub">
        Call, WhatsApp or send us your move details. We will confirm what is involved and
        come back with a clear, specific quotation — no obligation.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span>Free quotation</span></div>
        <div class="hero-trust-item"><?= icon('clock', 'icon') ?><span>Quick response</span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(areas_sentence()) ?></span></div>
      </div>

      <div class="btn-row">
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="Call <?= e(PHONE_INTL) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
      </div>
    </div>

    <div class="hero-home-media">
      <?= img($contactHero, 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ============================================== How to reach us ======== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>How to Reach Us</h2>
    </div>

    <div class="grid grid-4 contact-methods">
      <a class="card contact-card js-track" href="<?= PHONE_LINK ?>" data-cta="phone">
        <span class="card-icon-plain"><?= service_icon('route') ?></span>
        <h3 class="card-title">Call us</h3>
        <p class="contact-value"><?= e(PHONE_DISPLAY) ?></p>
        <p class="card-text">Fastest for anything urgent or complicated.</p>
      </a>

      <a class="card contact-card js-track" href="<?= e(whatsapp_url('Hello, I need a moving quote.')) ?>"
         data-cta="whatsapp" target="_blank" rel="noopener">
        <span class="card-icon-plain"><?= service_icon('box') ?></span>
        <h3 class="card-title">WhatsApp</h3>
        <p class="contact-value"><?= e(PHONE_DISPLAY) ?></p>
        <p class="card-text">Send a short video of the property for the quickest quote.</p>
      </a>

      <a class="card contact-card js-track" href="mailto:<?= e(EMAIL_ADDRESS) ?>" data-cta="email">
        <span class="card-icon-plain"><?= service_icon('tools') ?></span>
        <h3 class="card-title">Email</h3>
        <p class="contact-value contact-value-sm"><?= e(EMAIL_ADDRESS) ?></p>
        <p class="card-text">Good for detailed enquiries and office relocations.</p>
      </a>

      <div class="card contact-card">
        <span class="card-icon-plain"><?= service_icon('home') ?></span>
        <h3 class="card-title">Where we are</h3>
        <p class="contact-value"><?= e(BUSINESS_ADDRESS) ?></p>
        <p class="card-text">Serving <?= e(areas_sentence()) ?>.</p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================== Quote form ========= -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2>Request Your Free Quote</h2>
    </div>

    <div class="contact-grid">
      <div>
        <?php
        $quoteHeading = 'Tell us about your move';
        $quoteIntro   = 'Fill in what you know — we will follow up for anything else. Required fields are marked.';
        $quoteSource  = 'contact-page';
        require __DIR__ . '/includes/quote-form.php';
        ?>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3>Speed up your quote</h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);">
            The fastest way to an accurate figure is a short video walkthrough sent over
            WhatsApp, along with:
          </p>
          <ul class="checklist">
            <li><?= icon('check', 'icon icon-sm') ?><span>Both addresses</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Floor number and lift availability at each</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Your preferred moving date</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Whether you want packing included</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Anything unusually large, heavy or fragile</span></li>
          </ul>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-5);">
            <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-block') ?>
            <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
          </div>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3>Areas we serve</h3>
          <ul class="checklist">
            <?php foreach ($locations as $locSlug => $location): ?>
              <li>
                <?= icon('pin', 'icon icon-sm') ?>
                <a href="<?= e(location_url($locSlug)) ?>">Movers in <?= e($location['name']) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
          <p style="font-size: var(--fs-sm); color: var(--ink-500); margin-top: var(--sp-4);">
            Including moves between all three emirates, usually completed in a single day.
          </p>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============================================== Message + locations ==== -->
<section class="section">
  <div class="container">
    <div class="contact-grid contact-grid-reverse">
      <div>
        <?php
        $contactSource = 'contact-page';
        require __DIR__ . '/includes/contact-form.php';
        ?>
      </div>

      <div>
        <span class="eyebrow">Not a quote request?</span>
        <h2>Ask us anything about your move</h2>
        <p>
          Not everyone who gets in touch is ready to book. If you are still working out
          whether you need packing, how far ahead to book, or what a villa move actually
          involves, send the question over and we will answer it.
        </p>
        <p>
          We would rather tell you honestly that your move is smaller than you think than
          sell you a service you do not need.
        </p>

        <div class="btn-row" style="margin-top: var(--sp-5);">
          <?= cta_phone('btn btn-phone', 'Call ' . PHONE_DISPLAY) ?>
          <?= cta_whatsapp('Hello, I have a question about moving.', 'btn btn-whatsapp') ?>
        </div>
      </div>
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

<?= faq_list($faqs, 'Contacting us — common questions') ?>

<!-- ======================================================= CTA band ====== -->
<section class="cta-gold">
  <div class="container cta-gold-inner">
    <div class="cta-gold-media">
      <?= img('cta-boxes.webp', '', ['width' => 600, 'height' => 450, 'icon' => 'box']) ?>
    </div>
    <div>
      <h2>Prefer to Just Call?</h2>
      <p>We would rather talk through your move than exchange messages about it.</p>
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
