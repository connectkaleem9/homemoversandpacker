<?php
/**
 * Homepage — primary intent: "Movers & Packers in Dubai, Sharjah & Ajman".
 *
 * Section order:
 *   Hero → Services → Why us → Process → Service areas → Reviews
 *   → CTA band → Quote form
 *
 * No FAQ block here: it is not in the approved design. FAQs and their
 * FAQPage schema live on all 12 service pages and all 3 location pages,
 * which is where the question-shaped search traffic lands anyway.
 *
 * Photography is dropped into /assets/images/ (see the README there). Every
 * image renders a correctly-proportioned placeholder until the file exists, so
 * adding a photo later causes no layout shift.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$services     = all_services();
$locations    = all_locations();

/* The seven services shown in the strip; the eighth tile links to them all. */
$featured = ['home-movers', 'furniture-movers', 'office-commercial-movers', 'studio-apartment-movers',
             'villa-movers', 'warehousing-storage', 'packing-unpacking'];

seo_set([
    'title'       => 'Movers and Packers in Dubai, Sharjah & Ajman',
    'description' => 'Movers and packers based in Sharjah, serving Dubai, Sharjah and Ajman. Home, villa, apartment and office moving with packing and storage. Call 055 658 1781.',
    'path'        => '/',
    'breadcrumbs' => [['label' => 'Home', 'url' => '/']],
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
          <span class="service-tile-icon"><?= service_icon($feat['icon']) ?></span>
          <h3><?= e($feat['name']) ?></h3>
          <p><?= e($feat['tile']) ?></p>
        </a>
      <?php endforeach; ?>

      <a class="service-tile" href="/services/">
        <span class="service-tile-icon"><?= service_icon('truck') ?></span>
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

<?php
/* Real reviews when they exist; on a local server, example cards so the
   design can be seen. Production with no real reviews renders nothing. */
$reviewState = reviews_for_display();
$reviews     = $reviewState['reviews'];
$isExample   = $reviewState['is_example'];

$ratings = array_filter(array_column($reviews, 'rating'));
$average = $ratings !== [] ? round(array_sum($ratings) / count($ratings), 1) : null;
$pages   = (int) ceil(count($reviews) / 3);
?>
<?php if ($reviews !== []): ?>
<!-- ======================================================== Reviews ====== -->
<section class="section reviews" aria-labelledby="reviews-heading">
  <div class="container reviews-grid">
    <div class="reviews-intro">
      <h2 id="reviews-heading"><?= e(REVIEWS_HEADING) ?></h2>

      <?php if ($average !== null): ?>
        <div class="stars" role="img"
             aria-label="Average rating <?= e((string) $average) ?> out of 5 from <?= count($reviews) ?> reviews">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <?= icon('star', 'icon' . ($i <= round($average) ? '' : ' is-empty')) ?>
          <?php endfor; ?>
        </div>
        <p class="reviews-score">
          <strong><?= e(number_format($average, 1)) ?></strong> out of 5
          &middot; <?= count($reviews) ?> <?= count($reviews) === 1 ? 'review' : 'reviews' ?>
        </p>
      <?php endif; ?>

      <p>Rated by our customers for careful handling, clear pricing and turning up on time.</p>
    </div>

    <div class="reviews-main">
      <?php if ($isExample): ?>
        <p class="reviews-dev-note">
          <strong>Local preview only.</strong> These cards are placeholders so you can see the
          design. Add your real reviews to <code>includes/data/testimonials.php</code> — on the
          live site this section stays hidden until you do.
        </p>
      <?php endif; ?>

      <div class="review-cards" id="review-cards">
        <?php foreach ($reviews as $i => $review): ?>
          <figure class="review-card<?= $i >= 3 ? ' is-hidden' : '' ?>" data-page="<?= (int) floor($i / 3) ?>">
            <span class="review-mark" aria-hidden="true">&ldquo;</span>

            <?php if (!empty($review['rating'])): ?>
              <div class="stars stars-sm" role="img" aria-label="<?= (int) $review['rating'] ?> out of 5 stars">
                <?php for ($n = 1; $n <= 5; $n++): ?>
                  <?= icon('star', 'icon' . ($n <= (int) $review['rating'] ? '' : ' is-empty')) ?>
                <?php endfor; ?>
              </div>
            <?php endif; ?>

            <blockquote><?= e($review['quote']) ?></blockquote>

            <figcaption class="review-author">
              <?php if (!empty($review['photo']) && image_exists('testimonials/' . $review['photo'])): ?>
                <img class="review-avatar" src="<?= e(image_url('testimonials/' . $review['photo'])) ?>"
                     alt="" width="46" height="46" loading="lazy">
              <?php else: ?>
                <span class="review-avatar-initials" aria-hidden="true"><?= e(initials($review['name'])) ?></span>
              <?php endif; ?>
              <span>
                <strong>&mdash; <?= e($review['name']) ?></strong>
                <span><?= e($review['city'] ?? '') ?><?= !empty($review['source']) ? ' &middot; ' . e($review['source']) : '' ?></span>
              </span>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>

      <?php if ($pages > 1): ?>
        <div class="review-dots" role="tablist" aria-label="Review pages">
          <?php for ($p = 0; $p < $pages; $p++): ?>
            <button type="button" class="review-dot<?= $p === 0 ? ' is-active' : '' ?>"
                    role="tab" aria-selected="<?= $p === 0 ? 'true' : 'false' ?>"
                    data-page="<?= $p ?>" aria-label="Show reviews page <?= $p + 1 ?>"></button>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

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

<!-- ==================================================== Quote form ====== -->
<section class="section section-alt">
  <div class="container container-narrow">
    <?php
    /* The blog strip that sat beside this form was removed at the client's
       request. The form stays: it is the page's primary conversion and the
       only one on the homepage, so it now gets a section of its own. */
    $miniSource = 'homepage';
    require __DIR__ . '/includes/quote-form-mini.php';
    ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
