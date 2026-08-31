<?php
/**
 * A single project.
 *
 * Reached through a rewrite: /projects/<slug>/ and /ar/projects/<slug>/ both
 * land here, and the slug comes from the path rather than a query string so
 * the URL stays clean.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/content.php';

/* current_path() has already had the language prefix removed. */
$projectSlug = '';
if (preg_match('#^/projects/([a-z0-9-]+)/?$#', current_path(), $m) === 1) {
    $projectSlug = $m[1];
}

$project = $projectSlug !== '' ? get_project($projectSlug) : null;

if ($project === null) {
    http_response_code(404);
    require dirname(__DIR__) . '/404.php';
    exit;
}

$projectTitle = project_text($project, 'title');
$projectSum   = project_text($project, 'summary');
$projectBody  = project_text($project, 'body');
$services     = all_services();
$service      = $services[$project['service'] ?? ''] ?? null;

seo_set([
    'title'       => $projectTitle,
    'description' => excerpt($projectSum, 155),
    'path'        => '/projects/' . $project['slug'] . '/',
    'og_type'     => 'article',
    'og_image'    => ($project['images'] ?? []) !== []
        ? upload_url($project['images'][0])
        : '/assets/images/og-default.svg',
    'breadcrumbs' => [
        ['label' => t('crumb.home'),     'url' => '/'],
        ['label' => t('nav.projects'),   'url' => '/projects/'],
        ['label' => $projectTitle,       'url' => '/projects/' . $project['slug'] . '/'],
    ],
    'quote_anchor'=> '/contact-us/#quote',
]);

require dirname(__DIR__) . '/includes/header.php';

/* Re-resolve after the header — see the note in service-page.php. */
$project      = get_project($projectSlug);
$projectTitle = project_text($project, 'title');
$projectSum   = project_text($project, 'summary');
$projectBody  = project_text($project, 'body');
$images       = $project['images'] ?? [];
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('nav.projects')) ?></span>
      <h1><?= e($projectTitle) ?></h1>
      <p class="hero-home-sub"><?= e($projectSum) ?></p>

      <div class="hero-trust">
        <?php if (!empty($project['location'])): ?>
          <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e($project['location']) ?></span></div>
        <?php endif; ?>
        <?php if (!empty($project['completed_at'])): ?>
          <div class="hero-trust-item">
            <?= icon('clock', 'icon') ?>
            <span><?= e(format_date(new DateTimeImmutable($project['completed_at']), 'short')) ?></span>
          </div>
        <?php endif; ?>
        <?php if ($service !== null): ?>
          <div class="hero-trust-item"><?= icon($service['icon'], 'icon') ?><span><?= e($service['name']) ?></span></div>
        <?php endif; ?>
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

    <?php
    $projectHero = $images !== [] ? '' : 'hero-movers-dubai.jpg';
    ?>
    <?php if ($images !== []): ?>
      <div class="hero-home-media">
        <img class="hero-home-backdrop" src="<?= e(upload_url($images[0])) ?>" alt="" aria-hidden="true">
        <img src="<?= e(upload_url($images[0])) ?>" alt="<?= e($projectTitle) ?>"
             width="1600" height="1200" fetchpriority="high">
      </div>
    <?php else: ?>
      <?= hero_media('hero-movers-dubai.jpg', $projectTitle,
                ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
    <?php endif; ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<?php if ($projectBody !== '' || count($images) > 1): ?>
<section class="section">
  <div class="container container-narrow">
    <?php if ($projectBody !== ''): ?>
      <div class="prose">
        <?php foreach (preg_split('/\R{2,}/u', $projectBody) ?: [] as $paragraph): ?>
          <?php if (trim($paragraph) !== ''): ?>
            <p><?= nl2br(e(trim($paragraph))) ?></p>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (count($images) > 1): ?>
      <div class="project-gallery">
        <?php foreach (array_slice($images, 1) as $image): ?>
          <img src="<?= e(upload_url($image)) ?>" alt="<?= e($projectTitle) ?>"
               width="800" height="600" loading="lazy">
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php if ($service !== null): ?>
  <?= related_services([$project['service']], t('sec.related')) ?>
<?php endif; ?>

<!-- ================================================== More projects ====== -->
<?php
$others = array_values(array_filter(
    all_projects(),
    static fn (array $p): bool => ($p['slug'] ?? '') !== $projectSlug
));
?>
<?php if ($others !== []): ?>
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.projects.more_h2')) ?></h2>
    </div>
    <div class="project-grid">
      <?php foreach (array_slice($others, 0, 3) as $other): ?>
        <a class="project-card" href="<?= e(project_url($other['slug'])) ?>">
          <span class="project-card-media">
            <?php if (($other['images'] ?? []) !== []): ?>
              <img src="<?= e(upload_url($other['images'][0])) ?>" alt="" width="800" height="600" loading="lazy">
            <?php else: ?>
              <span class="project-card-placeholder"><?= service_icon('box') ?></span>
            <?php endif; ?>
          </span>
          <span class="project-card-body">
            <h3><?= e(project_text($other, 'title')) ?></h3>
            <p><?= e(project_text($other, 'summary')) ?></p>
            <span class="card-link"><?= e(t('cta.view_project')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
require dirname(__DIR__) . '/includes/cta-band.php';
?>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
