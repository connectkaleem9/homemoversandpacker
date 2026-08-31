<?php
/**
 * Blog article template. Each file in /blog/ sets $postSlug and requires this.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

/** @var string $postSlug */
$post = get_post($postSlug ?? '');

if ($post === null) {
    http_response_code(404);
    require dirname(__DIR__, 2) . '/404.php';
    exit;
}

$slug     = $post['slug'];
$services = all_services();

seo_set([
    'title'       => $post['title'],
    'description' => $post['description'],
    'path'        => post_url($slug),
    'og_type'     => 'article',
    'published'   => $post['published'],
    'modified'    => $post['modified'] ?? $post['published'],
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.blog'), 'url' => '/blog/'],
        ['label' => $post['title'], 'url' => post_url($slug)],
    ],
    'schema'      => [schema_article($post)],
]);

require dirname(__DIR__) . '/header.php';

/* Re-resolve after the header — see the note in service-page.php. */
$post = get_post($postSlug);
$slug = $post['slug'];

$published = new DateTimeImmutable($post['published']);
$modified  = new DateTimeImmutable($post['modified'] ?? $post['published']);
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e($post['category']) ?></span>
      <h1><?= e($post['title_h1'] ?? $post['title']) ?></h1>
      <p class="post-meta" style="margin-bottom: var(--sp-4);">
        <span><?= e(t('misc.published')) ?> <time datetime="<?= e($published->format('Y-m-d')) ?>"><?= e(format_date($published)) ?></time></span>
        <?php if ($modified > $published): ?>
          <span><?= e(t('misc.updated')) ?> <time datetime="<?= e($modified->format('Y-m-d')) ?>"><?= e(format_date($modified)) ?></time></span>
        <?php endif; ?>
        <span><?= e($post['read_time']) ?></span>
      </p>
      <div class="btn-row">
        <?= cta_quote('btn btn-primary', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon icon-sm') ?><span><?= e(PHONE_DISPLAY) ?></span>
        </a>
      </div>
    </div>

    <?php
    /* The card thumbnails are drawn at 800x500 for a 16:9 card, so they crop to
       one enlarged detail in a hero. Drop blog/<slug>-hero.jpg in to override. */
    $postHero = image_exists('blog/' . $slug . '-hero.jpg')
        ? 'blog/' . $slug . '-hero.jpg'
        : 'hero-movers-dubai.jpg';
    ?>
    <?= hero_media($postHero, 'Our moving crew at work',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<article class="section">
  <div class="container">
    <div class="split">
      <div class="post-body">
        <?php foreach ($post['intro'] as $paragraph): ?>
          <p style="font-size: var(--fs-lg); color: var(--ink-500);"><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <nav class="post-toc" aria-label="<?= e(t('tpl.post.toc_aria')) ?>" style="margin: var(--sp-6) 0;">
          <h2><?= e(t('tpl.post.toc_h2')) ?></h2>
          <ol>
            <?php foreach ($post['sections'] as $i => $section): ?>
              <li><a href="#section-<?= (int) $i ?>"><?= e($section['heading']) ?></a></li>
            <?php endforeach; ?>
          </ol>
        </nav>

        <?php foreach ($post['sections'] as $i => $section): ?>
          <h2 id="section-<?= (int) $i ?>"><?= e($section['heading']) ?></h2>
          <?php foreach ($section['blocks'] as $block): ?>
            <?php switch ($block['type']):
                case 'p': ?>
                  <p><?= e($block['content']) ?></p>
                <?php break;

                case 'h3': ?>
                  <h3><?= e($block['content']) ?></h3>
                <?php break;

                case 'ul': ?>
                  <ul>
                    <?php foreach ($block['content'] as $item): ?>
                      <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php break;

                case 'ol': ?>
                  <ol>
                    <?php foreach ($block['content'] as $item): ?>
                      <li><?= e($item) ?></li>
                    <?php endforeach; ?>
                  </ol>
                <?php break;

                case 'note': ?>
                  <div class="panel panel-accent" style="margin-block: var(--sp-5);">
                    <p style="font-size: var(--fs-sm); margin:0;"><strong><?= e(t('tpl.post.note_label')) ?></strong> <?= e($block['content']) ?></p>
                  </div>
                <?php break;
            endswitch; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>

        <div class="panel panel-accent" style="margin-top: var(--sp-7);">
          <h2 style="font-size: var(--fs-xl); margin-bottom: var(--sp-3);"><?= e(t('tpl.post.cta_h2', ['areas' => areas_sentence()])) ?></h2>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);"><?= e(t('tpl.post.cta_p')) ?></p>
          <div class="btn-row" style="margin-top: var(--sp-4);">
            <?= cta_quote('btn btn-primary', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
            <?= cta_phone('btn btn-outline', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
            <?= cta_whatsapp('', 'btn btn-whatsapp') ?>
          </div>
        </div>
      </div>

      <aside>
        <div class="panel">
          <h3><?= e(t('tpl.post.services_h3')) ?></h3>
          <ul class="checklist">
            <?php foreach ($post['related_services'] as $serviceSlug): ?>
              <?php if (isset($services[$serviceSlug])): ?>
                <li>
                  <?= icon('check', 'icon icon-sm') ?>
                  <a href="<?= e(service_url($serviceSlug)) ?>"><?= e($services[$serviceSlug]['name']) ?></a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3><?= e(t('misc.areas_served')) ?></h3>
          <ul class="checklist">
            <?php foreach (all_locations() as $locSlug => $location): ?>
              <li>
                <?= icon('pin', 'icon icon-sm') ?>
                <a href="<?= e(location_url($locSlug)) ?>"><?= e(t('nav.movers_in', ['city' => $location['name']])) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="panel panel-accent" style="margin-top: var(--sp-5);">
          <h3><?= e(t('tpl.post.talk_h3')) ?></h3>
          <div class="grid" style="gap: var(--sp-3);">
            <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
            <?= cta_whatsapp('', 'btn btn-whatsapp btn-block') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</article>

<section class="section section-alt">
  <div class="container">
    <div class="heading-rule"><h2><?= e(t('sec.more_guides')) ?></h2></div>
    <div class="grid grid-3">
      <?php
      $others = 0;
      foreach (all_posts() as $otherSlug => $other):
          if ($otherSlug === $slug || $others >= 3) { continue; }
          $others++;
      ?>
        <a class="card post-card" href="<?= e(post_url($otherSlug)) ?>">
          <span class="card-icon"><?= icon('quote', 'icon') ?></span>
          <h3 class="card-title"><?= e($other['title']) ?></h3>
          <p class="card-text"><?= e($other['excerpt']) ?></p>
          <span class="card-link"><?= e(t('cta.read_guide')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/../cta-band.php';
?>

<?php require dirname(__DIR__) . '/footer.php'; ?>
