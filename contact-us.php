<?php
/**
 * Contact Us — phone, WhatsApp, email, service areas and the quote form.
 * No invented business hours and no embedded map: neither has been supplied.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

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

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Contact us</span>
      <h1>Get a Free Moving Quote</h1>
      <p class="hero-sub">
        Call, WhatsApp or send us your move details. We will confirm what is involved and come back
        with a clear, specific quotation — no obligation.
      </p>
      <div class="hero-actions">
        <?= cta_phone('btn btn-primary btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="split split-reverse">
      <aside>
        <div class="panel panel-accent">
          <h3>Talk to us directly</h3>
          <ul class="checklist" style="margin-bottom: var(--sp-5);">
            <li>
              <?= icon('phone', 'icon icon-sm') ?>
              <span><strong>Phone</strong><br>
                <a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a>
                <span style="color: var(--ink-400);">(<?= e(PHONE_INTL) ?>)</span>
              </span>
            </li>
            <li>
              <?= icon('whatsapp', 'icon icon-sm') ?>
              <span><strong>WhatsApp</strong><br>
                <a href="<?= e(whatsapp_url('Hello, I need a moving quote.')) ?>" class="js-track"
                   data-cta="whatsapp" target="_blank" rel="noopener"><?= e(PHONE_DISPLAY) ?></a>
              </span>
            </li>
            <li>
              <?= icon('mail', 'icon icon-sm') ?>
              <span><strong>Email</strong><br>
                <a href="mailto:<?= e(EMAIL_ADDRESS) ?>" class="js-track" data-cta="email"><?= e(EMAIL_ADDRESS) ?></a>
              </span>
            </li>
            <li>
              <?= icon('pin', 'icon icon-sm') ?>
              <span><strong>Location</strong><br><?= e(BUSINESS_ADDRESS) ?></span>
            </li>
          </ul>

          <div class="grid" style="gap: var(--sp-3);">
            <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
            <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-block') ?>
          </div>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3>Areas we serve</h3>
          <ul class="checklist">
            <?php foreach (all_locations() as $slug => $location): ?>
              <li>
                <?= icon('pin', 'icon icon-sm') ?>
                <a href="<?= e(location_url($slug)) ?>">Movers in <?= e($location['name']) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
          <p style="font-size: var(--fs-sm); color: var(--ink-500); margin-top: var(--sp-4);">
            Including moves between all three emirates, usually completed in a single day.
          </p>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3>Speed up your quote</h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);">
            The fastest way to get an accurate figure is a short video walkthrough of the property
            sent over WhatsApp, along with:
          </p>
          <ul class="checklist">
            <li><?= icon('check', 'icon icon-sm') ?><span>Both addresses</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Floor number and lift availability at each</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Your preferred moving date</span></li>
            <li><?= icon('check', 'icon icon-sm') ?><span>Whether you want packing included</span></li>
          </ul>
        </div>
      </aside>

      <div>
        <?php
        $quoteHeading = 'Request Your Free Quote';
        $quoteIntro   = 'Fill in what you know — we will follow up for anything else. Required fields are marked.';
        $quoteSource  = 'contact-page';
        require __DIR__ . '/includes/quote-form.php';
        ?>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container container-narrow">
    <?php
    $contactSource = 'contact-page';
    require __DIR__ . '/includes/contact-form.php';
    ?>
  </div>
</section>

<?= faq_list($faqs, 'Contacting us — common questions') ?>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Prefer to just call?</h2>
      <p>We would rather talk through your move than exchange messages about it. <?= e(PHONE_DISPLAY) ?>.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_phone('btn btn-primary btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
