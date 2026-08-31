<?php
/**
 * Terms & Conditions.
 *
 * Describes how quotations, bookings and the website itself work. Anything that
 * requires a business or legal decision (cancellation windows, liability limits,
 * insurance, payment terms) is left as a clearly marked placeholder rather than
 * invented — those must be confirmed by the business and, ideally, a lawyer.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

seo_set([
    'title'       => 'Terms & Conditions | ' . SITE_NAME,
    'description' => 'The terms that apply to quotations, bookings and use of the Home Movers & Packers website.',
    'path'        => '/terms-and-conditions/',
    'robots'      => 'index, follow',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Terms & Conditions', 'url' => '/terms-and-conditions/'],
    ],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Legal</span>
        <p class="hero-home-sub">The terms that apply to quotations, bookings and use of this website.</p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('clipboard', 'icon') ?><span>Quotations</span></div>
        <div class="hero-trust-item"><?= icon('truck', 'icon') ?><span>Bookings</span></div>
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span>Your rights</span></div>
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

    <?= hero_media('hero-movers-dubai.jpg', 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container container-narrow prose">
    <h1>Terms &amp; Conditions</h1>
    <p><strong>Last updated:</strong> <?= e(date('j F Y')) ?></p>

    <p>
      These terms apply to the use of <?= e(SITE_DOMAIN) ?> and to quotations and bookings made
      with <?= e(BUSINESS_NAME) ?>, <?= e(BUSINESS_ADDRESS) ?>. By requesting a quotation or
      booking a move, you agree to them.
    </p>

    <div class="panel panel-accent" style="margin-bottom: var(--sp-6);">
      <p style="margin:0; font-size: var(--fs-sm);">
        <strong>Note for the business:</strong> the clauses marked in square brackets below require
        commercial decisions — cancellation windows, payment terms, liability limits and insurance
        arrangements. They should be completed and reviewed by a qualified legal adviser before this
        page goes live.
      </p>
    </div>

    <h2>1. Quotations</h2>
    <p>
      Quotations are provided free of charge and without obligation. A quotation is based on the
      information you give us — property size, inventory, addresses, floor and lift access, dates
      and services required — or on what we observe during a site survey.
    </p>
    <p>
      Where the actual job differs materially from what was described or surveyed (for example
      significantly more items, restricted access we were not told about, or additional services
      requested on the day), the price may change. We will tell you before carrying out additional
      work, not afterwards.
    </p>

    <h2>2. Bookings</h2>
    <p>
      A booking is confirmed once we have agreed the date, scope and price with you. Please make
      sure the property is accessible, that any building moving permit, NOC or service lift booking
      required by your building management is arranged, and that parking or loading access is
      available for our vehicle.
    </p>

    <h2>3. Your responsibilities</h2>
    <ul>
      <li>Tell us about anything unusually heavy, fragile, valuable or hazardous before the move</li>
      <li>Obtain any building permits, NOCs or lift bookings your building requires</li>
      <li>Remove personal documents, jewellery, cash and medication and carry them yourself</li>
      <li>Ensure someone is present, or authorised, at both addresses during the move</li>
      <li>Check that nothing is left behind before we leave the collection address</li>
    </ul>

    <h2>4. Items we do not move</h2>
    <p>
      We do not transport hazardous, flammable, explosive, perishable or illegal goods, or live
      animals. If you are unsure whether something can be moved, ask before the day.
    </p>

    <h2>5. Payment</h2>
    <p>
      <em>[Payment terms — accepted methods, deposit requirements and when the balance is due —
      to be confirmed by the business.]</em>
    </p>

    <h2>6. Cancellation and rescheduling</h2>
    <p>
      <em>[Cancellation and rescheduling terms, including any notice period and charges, to be
      confirmed by the business.]</em>
    </p>
    <p>
      Where circumstances beyond either party's reasonable control prevent a move going ahead —
      severe weather, road closures, building access being withdrawn — we will work with you to
      reschedule.
    </p>

    <h2>7. Liability</h2>
    <p>
      <em>[Liability terms and any insurance arrangements to be confirmed by the business and
      reviewed legally. This section should state what cover applies, any limits, and the
      procedure and time limit for reporting a claim.]</em>
    </p>
    <p>
      We handle your belongings with care and protect them before moving them. Pre-existing damage,
      items packed by the customer, and inherent defects in an item are treated differently from
      damage caused during handling; the confirmed liability terms above will set this out.
    </p>

    <h2>8. Reporting a problem</h2>
    <p>
      If something is damaged or missing, tell us as soon as you notice it — ideally before our
      crew leaves the delivery address. Call <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a>
      or email <a href="mailto:<?= e(EMAIL_ADDRESS) ?>"><?= e(EMAIL_ADDRESS) ?></a>.
    </p>

    <h2>9. Storage</h2>
    <p>
      Where you use our storage service, items are inventoried at collection and stored for the
      agreed period. Storage charges, notice periods for redelivery and terms for extending the
      period are set out in your storage quotation.
    </p>

    <h2>10. Website use</h2>
    <p>
      The content of this website is provided for information. We aim to keep it accurate and
      current, but service descriptions are general and the specifics of your move are governed by
      your quotation. You may not copy or reproduce the content of this site for commercial use
      without permission.
    </p>

    <h2>11. Privacy</h2>
    <p>
      Personal information you provide is handled as described in our
      <a href="/privacy-policy/">Privacy Policy</a>.
    </p>

    <h2>12. Governing law</h2>
    <p>
      These terms are governed by the laws of the United Arab Emirates, and any dispute is subject
      to the jurisdiction of the UAE courts.
    </p>

    <h2>13. Contact</h2>
    <p>
      <?= e(BUSINESS_NAME) ?> · <?= e(BUSINESS_ADDRESS) ?> ·
      <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a> ·
      <a href="mailto:<?= e(EMAIL_ADDRESS) ?>"><?= e(EMAIL_ADDRESS) ?></a>
    </p>
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
         <?= cta_id('phone') ?> aria-label="Call <?= e(PHONE_INTL) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
