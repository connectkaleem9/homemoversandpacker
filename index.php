<?php
/**
 * Homepage — primary intent: "Movers & Packers in Dubai, Sharjah & Ajman".
 *
 * Section order follows the Google Ads landing-page pattern:
 *   Hero (service + location + CTA + phone + WhatsApp above the fold)
 *   → Services → Why us → Process → Service areas → Reviews → FAQs
 *   → CTA band → Blog + quote form
 *
 * Photography is dropped into /assets/images/ (see the README there). Every
 * image renders a correctly-proportioned placeholder until the file exists, so
 * adding a photo later causes no layout shift.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$services     = all_services();
$locations    = all_locations();
$posts        = all_posts();
$testimonials = all_testimonials();

/* The seven services shown in the strip; the eighth tile links to them all. */
$featured = ['home-movers', 'furniture-movers', 'office-commercial-movers', 'studio-apartment-movers',
             'villa-movers', 'warehousing-storage', 'packing-unpacking'];

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

<!-- ===================================================== Hero ============ -->
<section class="hero-home">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Safe, reliable, affordable</span>
      <h1>Professional Movers &amp; Packers in Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-home-sub">
        We make your move simple, safe and stress-free — with expert packing, careful
        furniture handling and on-time delivery.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item">
          <?= icon('users', 'icon') ?><span>Trained professionals</span>
        </div>
        <div class="hero-trust-item">
          <?= icon('shield', 'icon') ?><span>Safe &amp; secure handling</span>
        </div>
        <div class="hero-trust-item">
          <?= icon('clock', 'icon') ?><span>On-time delivery</span>
        </div>
      </div>

      <div class="btn-row">
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           id="phone-cta" aria-label="Call <?= e(PHONE_INTL) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack">
            <small>Call Now</small>
            <strong><?= e(PHONE_DISPLAY) ?></strong>
          </span>
        </a>
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '#quote') ?>
      </div>
    </div>

    <div class="hero-home-media">
      <?= img('hero-movers-dubai.webp',
              'Movers loading wrapped furniture and cartons into a moving truck in Dubai',
              ['width' => 1200, 'height' => 900, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    </div>
  </div>
</section>

<!-- ============================================= Our moving services ===== -->
<section class="section" id="services">
  <div class="container">
    <div class="heading-rule">
      <h2>Our Moving Services</h2>
    </div>

    <div class="service-strip">
      <?php foreach ($featured as $featSlug): $feat = $services[$featSlug]; ?>
        <a class="service-tile" href="<?= e(service_url($featSlug)) ?>">
          <span class="service-tile-icon"><?= icon($feat['icon'], 'icon') ?></span>
          <h3><?= e($feat['name']) ?></h3>
          <p><?= e($feat['tile']) ?></p>
        </a>
      <?php endforeach; ?>

      <a class="service-tile" href="/services/">
        <span class="service-tile-icon"><?= icon('truck', 'icon') ?></span>
        <h3>And More Services</h3>
        <p>Loading, assembly, local moving and car transport.</p>
      </a>
    </div>

    <div class="service-strip-foot">
      <a href="/services/" class="btn btn-phone">
        <span>View All Services</span><?= icon('arrow', 'icon icon-sm') ?>
      </a>
    </div>
  </div>
</section>

<!-- ================================================== Why choose us ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img('why-choose-us.webp',
                'Moving crew wrapping an armchair in protective film before loading',
                ['width' => 900, 'height' => 700, 'icon' => 'sofa']) ?>
      </div>

      <div>
        <span class="eyebrow">Why choose us</span>
        <h2>We Make Moving Easy For You</h2>
        <p>
          With trained crews, proper packing materials and a plan made before the day starts,
          your belongings are in safe hands — and you know what the move will cost before
          anyone lifts anything.
        </p>

        <ul class="why-list">
          <li><?= icon('check', 'icon') ?><span>Trained, experienced moving crews</span></li>
          <li><?= icon('check', 'icon') ?><span>On-time arrival and delivery</span></li>
          <li><?= icon('check', 'icon') ?><span>Careful, fully protected handling</span></li>
          <li><?= icon('check', 'icon') ?><span>Furniture dismantling and reassembly</span></li>
          <li><?= icon('check', 'icon') ?><span>Transparent pricing, quoted in advance</span></li>
          <li><?= icon('check', 'icon') ?><span><?= e(areas_sentence()) ?> coverage</span></li>
        </ul>

        <div class="btn-row" style="margin-top: var(--sp-6);">
          <?= cta_quote('btn btn-primary', 'Get a Free Quote', '#quote') ?>
          <a href="/about-us/" class="btn btn-outline">More about us</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =================================================== Moving process ==== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>Our Moving Process</h2>
    </div>

    <ol class="process-row">
      <li class="process-item">
        <span class="process-icon"><?= icon('phone', 'icon') ?></span>
        <span class="process-num">01</span>
        <h3>Contact Us</h3>
        <p>Reach out by call, WhatsApp or the form on this page.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('clipboard', 'icon') ?></span>
        <span class="process-num">02</span>
        <h3>Get a Free Quote</h3>
        <p>Share your move details and we quote against what is actually there.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('box', 'icon') ?></span>
        <span class="process-num">03</span>
        <h3>Plan Your Move</h3>
        <p>We confirm crew, vehicle, access and timing, then pack and protect.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('truck', 'icon') ?></span>
        <span class="process-num">04</span>
        <h3>We Move Safely</h3>
        <p>Loaded in a planned order, strapped, and driven straight to the new address.</p>
      </li>
      <li class="process-item">
        <span class="process-icon"><?= icon('home', 'icon') ?></span>
        <span class="process-num">05</span>
        <h3>Settle In</h3>
        <p>Furniture reassembled, cartons in their rooms, and a final check with you.</p>
      </li>
    </ol>
  </div>
</section>

<!-- ==================================================== Service areas ==== -->
<section class="section section-alt" id="locations">
  <div class="container">
    <div class="serve-grid">
      <div>
        <span class="eyebrow">We serve</span>
        <h2 class="serve-cities">
          Dubai <span class="dot">&bull;</span> Sharjah <span class="dot">&bull;</span> Ajman
        </h2>
        <p>
          Wherever you are moving within Dubai, Sharjah or Ajman — or between them — we
          treat all three emirates as one service area, so a cross-emirate move is a
          single-day job rather than a handover between companies.
        </p>

        <div class="help-box">
          <?= icon('headset', 'icon') ?>
          <div>
            <small>Need help? Call us anytime</small>
            <strong><a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a></strong>
          </div>
        </div>
      </div>

      <div class="city-cards">
        <?php foreach ($locations as $citySlug => $city): ?>
          <a class="city-card" href="<?= e(location_url($citySlug)) ?>">
            <span class="city-card-media">
              <?= img('locations/' . $citySlug . '.webp',
                      'Movers and packers serving ' . $city['name'] . ', UAE',
                      ['width' => 800, 'height' => 600, 'icon' => 'building']) ?>
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
  </div>
</section>

<?php if ($testimonials !== []): ?>
<!-- ======================================================== Reviews ====== -->
<?php
$ratings = array_filter(array_column($testimonials, 'rating'));
$average = $ratings !== [] ? round(array_sum($ratings) / count($ratings), 1) : null;
?>
<section class="section reviews">
  <div class="container reviews-grid">
    <div class="reviews-intro">
      <h2>What Our Customers Say</h2>
      <?php if ($average !== null): ?>
        <div class="stars" role="img" aria-label="<?= e((string) $average) ?> out of 5 stars">
          <?php for ($i = 0; $i < 5; $i++): ?><?= icon('star', 'icon') ?><?php endfor; ?>
        </div>
        <p><?= e((string) $average) ?> out of 5 from <?= count($testimonials) ?> customer
          <?= count($testimonials) === 1 ? 'review' : 'reviews' ?>.</p>
      <?php endif; ?>
    </div>

    <div class="review-cards">
      <?php foreach (array_slice($testimonials, 0, 3) as $review): ?>
        <figure class="review-card">
          <span class="review-mark" aria-hidden="true">&ldquo;</span>
          <blockquote><?= e($review['quote']) ?></blockquote>
          <figcaption class="review-author">
            <?php if (!empty($review['photo']) && image_exists('testimonials/' . $review['photo'])): ?>
              <img class="review-avatar" src="<?= e(image_url('testimonials/' . $review['photo'])) ?>"
                   alt="" width="42" height="42" loading="lazy">
            <?php else: ?>
              <span class="review-avatar-initials" aria-hidden="true"><?= e(initials($review['name'])) ?></span>
            <?php endif; ?>
            <span>
              <strong><?= e($review['name']) ?></strong>
              <span><?= e($review['city'] ?? '') ?><?= !empty($review['source']) ? ' · ' . e($review['source']) : '' ?></span>
            </span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?= faq_list($homeFaqs, 'Movers and packers — common questions') ?>

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
        <span class="btn-stack">
          <small>Call Now</small>
          <strong><?= e(PHONE_DISPLAY) ?></strong>
        </span>
      </a>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<!-- ==================================================== Blog + quote ===== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>Latest From Our Blog</h2>
    </div>

    <div class="blog-grid">
      <div class="blog-cards">
        <?php
        $shown = 0;
        foreach ($posts as $postSlug => $post):
            if ($shown >= 3) { break; }
            $shown++;
            $published = new DateTimeImmutable($post['published']);
        ?>
          <a class="blog-card" href="<?= e(post_url($postSlug)) ?>">
            <span class="blog-card-media">
              <?= img('blog/' . $postSlug . '.webp', '',
                      ['width' => 800, 'height' => 500, 'icon' => 'quote']) ?>
            </span>
            <span class="blog-card-body">
              <span class="post-meta">
                <span><time datetime="<?= e($published->format('Y-m-d')) ?>"><?= e($published->format('j M Y')) ?></time></span>
                <span><?= e($post['category']) ?></span>
              </span>
              <h3><?= e($post['title']) ?></h3>
              <span class="card-link">Read More <?= icon('arrow', 'icon icon-sm') ?></span>
            </span>
          </a>
        <?php endforeach; ?>
      </div>

      <?php
      $miniSource = 'homepage';
      require __DIR__ . '/includes/quote-form-mini.php';
      ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
