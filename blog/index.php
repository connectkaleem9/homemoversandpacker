<?php
/**
 * Blog index — moving guides. Same design language as the homepage.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$posts     = all_posts();
$services  = all_services();

seo_set([
    'title'       => 'Moving Guides & Tips for Dubai, Sharjah & Ajman',
    'description' => 'Practical moving guides for UAE residents — checklists, packing advice, what moves actually cost and what to expect when moving between Dubai, Sharjah and Ajman.',
    'path'        => '/blog/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Blog', 'url' => '/blog/'],
    ],
    'quote_anchor'=> '#quote',
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow">Moving guides</span>
      <h1>Practical Moving Advice for Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-home-sub">
        Guides written from actual moving days — what goes wrong, why it goes wrong, and the
        order to do things in so it does not.
      </p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('clipboard', 'icon') ?><span>Checklists</span></div>
        <div class="hero-trust-item"><?= icon('box', 'icon') ?><span>Packing advice</span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span>Real costs</span></div>
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

    <?= hero_media('why-choose-us.jpg', 'Our crew wrapping furniture before a move',
              ['width' => 1400, 'height' => 933, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'sofa']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ===================================================== Articles ======== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2>Latest From Our Blog</h2>
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
              <span><time datetime="<?= e($published->format('Y-m-d')) ?>"><?= e($published->format('j M Y')) ?></time></span>
              <span><?= e($post['read_time']) ?></span>
            </span>
            <h3><?= e($post['title']) ?></h3>
            <p class="card-text"><?= e($post['excerpt']) ?></p>
            <span class="card-link">Read the guide <?= icon('arrow', 'icon icon-sm') ?></span>
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
      <h2>Services Covered in These Guides</h2>
    </div>
    <div class="service-strip" style="--cols:7">
      <?php foreach (['home-movers', 'packing-unpacking', 'villa-movers', 'local-moving', 'furniture-movers', 'warehousing-storage'] as $svcSlug): ?>
        <a class="service-tile" href="<?= e(service_url($svcSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($services[$svcSlug]['icon']) ?></span>
          <h3><?= e($services[$svcSlug]['name']) ?></h3>
          <p><?= e($services[$svcSlug]['tile']) ?></p>
        </a>
      <?php endforeach; ?>
      <a class="service-tile" href="/services/">
        <span class="service-tile-icon"><?= service_icon('truck') ?></span>
        <h3>And More Services</h3>
        <p>Loading, assembly, local moving and car transport.</p>
      </a>
    </div>
  </div>
</section>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Rather Have Us Handle It?';
    $quoteIntro   = 'Send us your move details and we will come back with a clear quotation — free, no obligation.';
    $quoteSource  = 'blog-index';
    require dirname(__DIR__) . '/includes/quote-form.php';
    ?>
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
         aria-label="Call <?= e(PHONE_INTL) ?>">
        <?= icon('phone', 'icon') ?>
        <span class="btn-stack"><small>Call Now</small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
      </a>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-white btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
