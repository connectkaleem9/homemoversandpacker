<?php
/**
 * Privacy Policy.
 *
 * Written to describe what this website actually does with data. Placeholders
 * are used where the business must supply specifics (legal entity, retention
 * period); no regulatory claims or certifications are invented.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

seo_set([
    'title'       => 'Privacy Policy | ' . SITE_NAME,
    'description' => 'How Home Movers & Packers collects, uses and protects the personal information you provide through this website.',
    'path'        => '/privacy-policy/',
    'robots'      => 'index, follow',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Privacy Policy', 'url' => '/privacy-policy/'],
    ],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Legal</span>
        <p class="hero-home-sub">How we collect, use and protect the information you give us. Short, and in plain language.</p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span>Plain language</span></div>
        <div class="hero-trust-item"><?= icon('mail', 'icon') ?><span>No data selling</span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span>Sharjah, UAE</span></div>
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
    <h1>Privacy Policy</h1>
    <p><strong>Last updated:</strong> <?= e(date('j F Y')) ?></p>

    <p>
      This policy explains what information <?= e(BUSINESS_NAME) ?> collects through
      <?= e(SITE_DOMAIN) ?>, why we collect it, and what we do with it. If anything here is
      unclear, call us on <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a> and ask.
    </p>

    <h2>Who we are</h2>
    <p>
      <?= e(BUSINESS_NAME) ?> is a moving company based in <?= e(BUSINESS_ADDRESS) ?>, providing
      moving, packing and storage services across <?= e(areas_sentence()) ?>.
    </p>
    <p>
      Contact: <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a> ·
      <a href="mailto:<?= e(EMAIL_ADDRESS) ?>"><?= e(EMAIL_ADDRESS) ?></a>
    </p>

    <h2>What we collect</h2>
    <p>We only collect what we need in order to quote for and carry out a move.</p>
    <h3>Information you give us</h3>
    <ul>
      <li>Your name</li>
      <li>Your phone number</li>
      <li>Your email address, if you provide one</li>
      <li>The addresses or areas you are moving from and to</li>
      <li>Property type, preferred moving date and the service you need</li>
      <li>Any additional details you choose to include in the form or in a message</li>
    </ul>

    <h3>Information collected automatically</h3>
    <ul>
      <li>Your IP address and browser user-agent string, recorded with form submissions to help prevent spam and abuse</li>
      <li>Standard web server logs</li>
      <li>Analytics data, if and when analytics is enabled on this site</li>
    </ul>

    <h2>Why we use it</h2>
    <ul>
      <li>To prepare and send you a moving quotation</li>
      <li>To contact you about your enquiry and arrange your move</li>
      <li>To carry out the service you booked</li>
      <li>To protect the website and our forms from spam and automated abuse</li>
      <li>To meet any legal or accounting obligations that apply to us</li>
    </ul>
    <p>
      We do not sell your personal information, and we do not share it with third parties for
      their own marketing.
    </p>

    <h2>Cookies and analytics</h2>
    <p>
      This website uses a session cookie, which is required for the security of our forms
      (specifically to protect against cross-site request forgery). It contains no personal
      information and expires when you close your browser.
    </p>
    <p>
      Where analytics or advertising measurement tools such as Google Analytics, Google Tag
      Manager or Google Ads conversion tracking are enabled, those services may set their own
      cookies and process usage data under their own privacy terms. You can control cookies
      through your browser settings.
    </p>

    <h2>How long we keep it</h2>
    <p>
      Enquiry and booking records are kept for as long as we need them to provide the service, to
      answer follow-up questions and to meet our record-keeping obligations, after which they are
      deleted. <em>[The business should confirm a specific retention period here.]</em>
    </p>

    <h2>How we protect it</h2>
    <p>
      Form submissions are transmitted over an encrypted connection, database access uses prepared
      statements, and access to enquiry records is limited to the people who need it in order to
      handle your move. No system is perfectly secure, but we do not collect information we do not
      need, which is the most effective protection available.
    </p>

    <h2>Your choices</h2>
    <ul>
      <li>You can ask us what information we hold about you</li>
      <li>You can ask us to correct anything that is wrong</li>
      <li>You can ask us to delete your enquiry record, where we are not required to keep it</li>
      <li>You can ask us to stop contacting you at any time</li>
    </ul>
    <p>
      To make any of these requests, call <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a>
      or email <a href="mailto:<?= e(EMAIL_ADDRESS) ?>"><?= e(EMAIL_ADDRESS) ?></a>.
    </p>

    <h2>Third-party links</h2>
    <p>
      This site links to WhatsApp for messaging. Once you leave our website, the destination
      service's own privacy terms apply. We are not responsible for the content or privacy
      practices of external services.
    </p>

    <h2>Changes to this policy</h2>
    <p>
      If we change how we handle personal information, we will update this page and the date at
      the top of it.
    </p>

    <h2>Contact</h2>
    <p>
      Questions about this policy: <a href="<?= PHONE_LINK ?>"><?= e(PHONE_DISPLAY) ?></a> ·
      <a href="mailto:<?= e(EMAIL_ADDRESS) ?>"><?= e(EMAIL_ADDRESS) ?></a> ·
      <?= e(BUSINESS_ADDRESS) ?>
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
