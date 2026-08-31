<?php
/**
 * Projects — the work the business has actually completed.
 *
 * Everything here is added from the admin dashboard. An empty list is a normal
 * state on a new install, not an error, and the page says so rather than
 * showing an empty grid.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/content.php';

$projects  = all_projects();
$locations = all_locations();

$faqs = [];
foreach ([1, 2, 3] as $n) {
    $faqs[] = ['q' => t('page.projects.faq' . $n . '_q'), 'a' => t('page.projects.faq' . $n . '_a')];
}

seo_set([
    'title'       => t('page.projects.title'),
    'description' => t('page.projects.desc'),
    'path'        => '/projects/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('nav.projects'), 'url' => '/projects/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '/contact-us/#quote',
]);

require dirname(__DIR__) . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.projects.eyebrow')) ?></span>
      <h1><?= e(t('page.projects.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.projects.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('misc.based_sharjah')) ?></span></div>
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span><?= e(t('misc.careful_handling')) ?></span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('misc.free_quotation')) ?></span></div>
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

    <?= hero_media('hero-movers-dubai.jpg', t('page.projects.h1'),
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ==================================================== The projects ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.projects.grid_h2')) ?></h2>
    </div>

    <?php if ($projects === []): ?>
      <p class="section-lead" style="text-align:center; max-width:60ch; margin-inline:auto;">
        <?= e(t('page.projects.empty')) ?>
      </p>
    <?php else: ?>
      <div class="project-grid">
        <?php foreach ($projects as $project): ?>
          <a class="project-card" href="<?= e(project_url($project['slug'])) ?>">
            <span class="project-card-media">
              <?php if (($project['images'] ?? []) !== []): ?>
                <img src="<?= e(upload_url($project['images'][0])) ?>" alt=""
                     width="800" height="600" loading="lazy">
              <?php else: ?>
                <span class="project-card-placeholder"><?= service_icon('box') ?></span>
              <?php endif; ?>
            </span>
            <span class="project-card-body">
              <?php if (!empty($project['completed_at'])): ?>
                <span class="project-card-meta">
                  <?= e(format_date(new DateTimeImmutable($project['completed_at']), 'short')) ?>
                  <?php if (!empty($project['location'])): ?>
                    &middot; <?= e($project['location']) ?>
                  <?php endif; ?>
                </span>
              <?php endif; ?>
              <h3><?= e(project_text($project, 'title')) ?></h3>
              <p><?= e(project_text($project, 'summary')) ?></p>
              <span class="card-link"><?= e(t('cta.view_project')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
            </span>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ================================================== Where we work ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.where')) ?></h2>
    </div>
    <?php require dirname(__DIR__) . '/includes/city-cards.php'; ?>
  </div>
</section>

<?= faq_list($faqs, t('page.projects.faq_h')) ?>

<?php
require dirname(__DIR__) . '/includes/cta-band.php';
?>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
