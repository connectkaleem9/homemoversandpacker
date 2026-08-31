<?php
/**
 * Customer reviews — the approved ones, and the form to leave a new one.
 *
 * Review and AggregateRating schema is emitted only when there are genuinely
 * approved reviews to back it. With none, the page is still useful (the form
 * is the point) and no structured data is claimed.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/content.php';

$reviews = approved_reviews();
$average = reviews_average();

$faqs = [];
foreach ([1, 2, 3] as $n) {
    $faqs[] = ['q' => t('page.reviews.faq' . $n . '_q'), 'a' => t('page.reviews.faq' . $n . '_a')];
}

$schema = [schema_faq($faqs)];
if ($reviews !== [] && $average !== null) {
    $schema[] = schema_reviews($reviews, $average);
}

seo_set([
    'title'       => t('page.reviews.title'),
    'description' => t('page.reviews.desc'),
    'path'        => '/reviews/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('nav.reviews'), 'url' => '/reviews/'],
    ],
    'schema'      => $schema,
    'quote_anchor'=> '/contact-us/#quote',
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.reviews.eyebrow')) ?></span>
      <h1><?= e(t('page.reviews.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.reviews.sub')) ?></p>

      <?php if ($average !== null): ?>
        <div class="hero-rating">
          <div class="stars" role="img"
               aria-label="<?= e(t('page.home.rating_aria', ['score' => $average, 'count' => count($reviews)])) ?>">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <?= icon('star', 'icon' . ($i <= round($average) ? '' : ' is-empty')) ?>
            <?php endfor; ?>
          </div>
          <p class="hero-rating-text">
            <strong><?= e(number_format($average, 1)) ?></strong> <?= e(t('page.home.out_of')) ?>
            &middot; <?= count($reviews) ?>
            <?= e(t(count($reviews) === 1 ? 'page.home.review_one' : 'page.home.review_many')) ?>
          </p>
        </div>
      <?php endif; ?>

      <div class="btn-row">
        <a href="#write-review" class="btn btn-primary btn-lg">
          <?= icon('star', 'icon icon-sm') ?><span><?= e(t('cta.write_review')) ?></span>
        </a>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <?= hero_media('why-choose-us.jpg', t('page.reviews.h1'),
              ['width' => 1400, 'height' => 933, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'star']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ================================================== The reviews ========= -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.reviews')) ?></h2>
    </div>

    <?php if ($reviews === []): ?>
      <p class="section-lead" style="text-align:center; max-width:60ch; margin-inline:auto;">
        <?= e(t('page.reviews.empty')) ?>
      </p>
    <?php else: ?>
      <div class="review-wall">
        <?php foreach ($reviews as $review): ?>
          <figure class="review-card">
            <span class="review-mark" aria-hidden="true">&ldquo;</span>

            <?php if (!empty($review['rating'])): ?>
              <div class="stars stars-sm" role="img"
                   aria-label="<?= e(t('page.home.stars_aria', ['n' => (int) $review['rating']])) ?>">
                <?php for ($n = 1; $n <= 5; $n++): ?>
                  <?= icon('star', 'icon' . ($n <= (int) $review['rating'] ? '' : ' is-empty')) ?>
                <?php endfor; ?>
              </div>
            <?php endif; ?>

            <blockquote><?= e($review['quote']) ?></blockquote>

            <figcaption class="review-author">
              <span class="review-avatar-initials" aria-hidden="true"><?= e(initials($review['name'])) ?></span>
              <span>
                <strong>&mdash; <?= e($review['name']) ?></strong>
                <span>
                  <?= e($review['city'] ?? '') ?><?php
                  if (!empty($review['service'])) {
                      echo $review['city'] ? ' &middot; ' : '';
                      echo e($review['service']);
                  } ?>
                </span>
              </span>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ================================================= Leave a review ======= -->
<section class="section section-alt">
  <div class="container container-narrow">
    <?php require __DIR__ . '/includes/review-form.php'; ?>
  </div>
</section>

<?= faq_list($faqs, t('page.reviews.faq_h')) ?>

<?php
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
