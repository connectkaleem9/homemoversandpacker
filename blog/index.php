<?php
/**
 * Blog index — moving guides. Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$posts     = all_posts();
$services  = all_services();

seo_set([
    'title'       => t('page.blog.title'),
    'description' => t('page.blog.desc'),
    'path'        => '/blog/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.blog'), 'url' => '/blog/'],
    ],
    'quote_anchor'=> '#quote',
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.blog.eyebrow')) ?></span>
      <h1><?= e(t('page.blog.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.blog.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('clipboard', 'icon') ?><span><?= e(t('page.blog.trust1')) ?></span></div>
        <div class="hero-trust-item"><?= icon('box', 'icon') ?><span><?= e(t('page.blog.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('page.blog.trust3')) ?></span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <?= hero_media('why-choose-us.jpg', 'Our crew wrapping furniture before a move',
              ['width' => 1400, 'height' => 933, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'sofa']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ===================================================== Articles ======== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.blog')) ?></h2>
    </div>

    <div class="grid grid-2">
      <?php foreach ($posts as $postSlug => $post):
          $published = new DateTimeImmutable($post['published']); ?>
        <a class="blog-card" href="<?= e(post_url($postSlug)) ?>">
          <span class="blog-card-media">
            <?= img('blog/' . $postSlug . '.webp', '',
                    ['width' => 800, 'height' => 500, 'icon' => 'quote']) ?>
          </span>
          <span class="blog-card-body">
            <span class="post-meta">
              <span><?= e($post['category']) ?></span>
              <span><time datetime="<?= e($published->format('Y-m-d')) ?>"><?= e(format_date($published, 'short')) ?></time></span>
              <span><?= e($post['read_time']) ?></span>
            </span>
            <h3><?= e($post['title']) ?></h3>
            <p class="card-text"><?= e($post['excerpt']) ?></p>
            <span class="card-link"><?= e(t('cta.read_guide')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================== Services in guides ===== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.blog.covered_h2')) ?></h2>
    </div>
    <div class="service-strip" style="--cols:7">
      <?php foreach (['home-movers', 'packing-unpacking', 'villa-movers', 'local-moving', 'furniture-movers', 'warehousing-storage'] as $svcSlug): ?>
        <a class="service-tile" href="<?= e(service_url($svcSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($services[$svcSlug]['icon']) ?></span>
          <h3><?= e($services[$svcSlug]['name']) ?></h3>
          <p><?= e($services[$svcSlug]['tile']) ?></p>
        </a>
      <?php endforeach; ?>
      <a class="service-tile" href="<?= e(lang_url('/services/')) ?>">
        <span class="service-tile-icon"><?= service_icon('truck') ?></span>
        <h3><?= e(t('sec.and_more')) ?></h3>
        <p><?= e(t('sec.and_more_text')) ?></p>
      </a>
    </div>
  </div>
</section>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = t('page.blog.q_head');
    $quoteIntro   = t('page.blog.q_intro');
    $quoteSource  = 'blog-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
  </div>
</section>

<?php
require dirname(__DIR__) . '/includes/cta-band.php';
?>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
