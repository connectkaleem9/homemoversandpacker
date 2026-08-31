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
    'title'       => t('page.home.title'),
    'description' => t('page.home.desc'),
    'path'        => '/',
    'breadcrumbs' => [['label' => t('crumb.home'), 'url' => '/']],
    'quote_anchor'=> '#quote',
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.home.eyebrow')) ?></span>
      <h1><?= e(t('page.home.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.home.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item">
          <?= icon('users', 'icon') ?><span><?= e(t('page.home.trust1')) ?></span>
        </div>
        <div class="hero-trust-item">
          <?= icon('shield', 'icon') ?><span><?= e(t('page.home.trust2')) ?></span>
        </div>
        <div class="hero-trust-item">
          <?= icon('clock', 'icon') ?><span><?= e(t('page.home.trust3')) ?></span>
        </div>
      </div>

      <div class="btn-row">
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack">
            <small><?= e(t('cta.call_now')) ?></small>
            <strong><?= e(PHONE_DISPLAY) ?></strong>
          </span>
        </a>
        <?= cta_quote('btn btn-primary btn-lg', t('cta.quote'), '#quote') ?>
      </div>
    </div>

    <?= hero_media('hero-movers-dubai.webp',
              'Movers loading wrapped furniture and cartons into a moving truck in Dubai',
              ['width' => 1200, 'height' => 900, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<!-- ============================================= Our moving services ===== -->
<section class="section" id="services">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.services')) ?></h2>
    </div>

    <div class="service-strip" style="--cols:8">
      <?php foreach ($featured as $featSlug): $feat = $services[$featSlug]; ?>
        <a class="service-tile" href="<?= e(service_url($featSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($feat['icon']) ?></span>
          <h3><?= e($feat['name']) ?></h3>
          <p><?= e($feat['tile']) ?></p>
        </a>
      <?php endforeach; ?>

      <a class="service-tile" href="<?= e(lang_url('/services/')) ?>">
        <span class="service-tile-icon"><?= service_icon('truck') ?></span>
        <h3><?= e(t('sec.and_more')) ?></h3>
        <p><?= e(t('sec.and_more_text')) ?></p>
      </a>
    </div>

    <div class="service-strip-foot">
      <a href="<?= e(lang_url('/services/')) ?>" class="btn btn-phone">
        <span><?= e(t('cta.view_services')) ?></span><?= icon('arrow', 'icon icon-sm') ?>
      </a>
    </div>
  </div>
</section>

<!-- ================================================== Why choose us ====== -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img('why-choose-us.webp',
                'Moving crew wrapping an armchair in protective film before loading',
                ['width' => 900, 'height' => 700, 'icon' => 'sofa']) ?>
      </div>

      <div>
        <span class="eyebrow"><?= e(t('page.home.why_eyebrow')) ?></span>
        <h2><?= e(t('page.home.why_h2')) ?></h2>
        <p><?= e(t('page.home.why_p')) ?></p>

        <ul class="why-list">
          <?php foreach (['why1', 'why2', 'why3', 'why4', 'why5'] as $homeWhy): ?>
            <li><?= icon('check', 'icon') ?><span><?= e(t('page.home.' . $homeWhy)) ?></span></li>
          <?php endforeach; ?>
          <li><?= icon('check', 'icon') ?><span><?= e(t('page.home.why6', ['areas' => areas_sentence()])) ?></span></li>
        </ul>

        <div class="btn-row" style="margin-top: var(--sp-6);">
          <?= cta_quote('btn btn-primary', t('cta.quote'), '#quote') ?>
          <a href="<?= e(lang_url('/about-us/')) ?>" class="btn btn-outline"><?= e(t('cta.more_about')) ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =================================================== Moving process ==== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.process')) ?></h2>
    </div>

    <ol class="process-row">
      <?php foreach (['phone', 'clipboard', 'box', 'truck', 'home'] as $homeStep => $homeIcon): ?>
        <li class="process-item">
          <span class="process-icon"><?= icon($homeIcon, 'icon') ?></span>
          <span class="process-num"><?= str_pad((string) ($homeStep + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h3><?= e(t('page.home.step' . ($homeStep + 1) . '_t')) ?></h3>
          <p><?= e(t('page.home.step' . ($homeStep + 1) . '_p')) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ==================================================== Service areas ==== -->
<section class="section section-alt" id="locations">
  <div class="container">
    <div class="serve-grid">
      <div>
        <span class="eyebrow"><?= e(t('sec.serve')) ?></span>
        <h2 class="serve-cities">
          <?php foreach (areas_list() as $homeArea => $homeCity): ?>
            <?php /* The separator is its own word: without the spaces the bullet
                     sits flush against the next city name. */ ?>
            <?= $homeArea > 0 ? '<span class="dot">&bull;</span> ' : '' ?><?= e($homeCity) ?>
          <?php endforeach; ?>
        </h2>
        <p><?= e(t('page.home.serve_p')) ?></p>

        <div class="help-box">
          <?= icon('headset', 'icon') ?>
          <div>
            <small><?= e(t('page.home.help_label')) ?></small>
            <strong><a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a></strong>
          </div>
        </div>
      </div>

      <?php
      require __DIR__ . '/includes/city-cards.php';
      ?>
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
      <h2 id="reviews-heading"><?= e(t('sec.reviews')) ?></h2>

      <?php if ($average !== null): ?>
        <div class="stars" role="img"
             aria-label="<?= e(t('page.home.rating_aria', ['score' => $average, 'count' => count($reviews)])) ?>">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <?= icon('star', 'icon' . ($i <= round($average) ? '' : ' is-empty')) ?>
          <?php endfor; ?>
        </div>
        <p class="reviews-score">
          <strong><?= e(number_format($average, 1)) ?></strong> <?= e(t('page.home.out_of')) ?>
          &middot; <?= count($reviews) ?>
          <?= e(t(count($reviews) === 1 ? 'page.home.review_one' : 'page.home.review_many')) ?>
        </p>
      <?php endif; ?>

      <p><?= e(t('page.home.reviews_lead')) ?></p>
    </div>

    <div class="reviews-main">
      <?php if ($isExample): ?>
        <p class="reviews-dev-note">
          <strong><?= e(t('page.home.dev_note_t')) ?></strong> <?= e(t('page.home.dev_note')) ?>
        </p>
      <?php endif; ?>

      <div class="review-cards" id="review-cards">
        <?php foreach ($reviews as $i => $review): ?>
          <figure class="review-card<?= $i >= 3 ? ' is-hidden' : '' ?>" data-page="<?= (int) floor($i / 3) ?>">
            <span class="review-mark" aria-hidden="true">&ldquo;</span>

            <?php if (!empty($review['rating'])): ?>
              <div class="stars stars-sm" role="img" aria-label="<?= e(t('page.home.stars_aria', ['n' => (int) $review['rating']])) ?>">
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
        <div class="review-dots" role="tablist" aria-label="<?= e(t('page.home.pages_aria')) ?>">
          <?php for ($p = 0; $p < $pages; $p++): ?>
            <button type="button" class="review-dot<?= $p === 0 ? ' is-active' : '' ?>"
                    role="tab" aria-selected="<?= $p === 0 ? 'true' : 'false' ?>"
                    data-page="<?= $p ?>" aria-label="<?= e(t('page.home.page_aria', ['n' => $p + 1])) ?>"></button>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
require __DIR__ . '/includes/cta-band.php';
?>

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
