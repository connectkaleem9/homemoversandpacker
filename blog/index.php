<?php
/**
 * Blog index — moving guides for Dubai, Sharjah and Ajman.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

$posts = all_posts();

seo_set([
    'title'       => 'Moving Guides & Tips for Dubai, Sharjah & Ajman',
    'description' => 'Practical moving guides for UAE residents — checklists, packing advice, what moves actually cost and what to expect when moving between Dubai, Sharjah and Ajman.',
    'path'        => '/blog/',
    'breadcrumbs' => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Blog', 'url' => '/blog/'],
    ],
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light">Moving guides</span>
      <h1>Practical Moving Advice for Dubai, Sharjah &amp; Ajman</h1>
      <p class="hero-sub">
        Guides written from actual moving days — what goes wrong, why it goes wrong, and the
        order to do things in so it does not.
      </p>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="grid grid-2">
      <?php foreach ($posts as $slug => $post):
          $published = new DateTimeImmutable($post['published']); ?>
        <a class="card post-card" href="<?= e(post_url($slug)) ?>">
          <span class="card-icon"><?= icon('quote', 'icon') ?></span>
          <p class="post-meta" style="margin-bottom: var(--sp-3);">
            <span><?= e($post['category']) ?></span>
            <span><time datetime="<?= e($published->format('Y-m-d')) ?>"><?= e($published->format('j F Y')) ?></time></span>
            <span><?= e($post['read_time']) ?></span>
          </p>
          <h2 class="card-title"><?= e($post['title']) ?></h2>
          <p class="card-text"><?= e($post['excerpt']) ?></p>
          <span class="card-link">Read the guide <?= icon('arrow', 'icon icon-sm') ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= related_services(['home-movers', 'packing-unpacking', 'villa-movers', 'local-moving'], 'Services covered in these guides') ?>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Rather have us handle it?</h2>
      <p>Send us your move details and we will come back with a clear quotation — free, no obligation.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Quote', '/contact-us/#quote') ?>
      <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
