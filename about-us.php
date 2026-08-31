<?php
/**
 * About Us — built with the same design language as the homepage: photo hero,
 * rule-flanked section headings, a left-bleeding photo split, duotone value
 * cards, numbered process steps, city cards and the gold CTA band.
 *
 * Deliberately free of invented history, headcounts, fleet sizes and awards.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$locations = all_locations();

/* Dedicated About photography if it has been supplied, otherwise the site's
   existing crew photos — same company, same crew, so nothing is misleading. */
$aboutHero = image_exists('about-hero.jpg') ? 'about-hero.jpg' : 'hero-movers-dubai.jpg';
$aboutTeam = image_exists('about-team.jpg') ? 'about-team.jpg' : 'why-choose-us.jpg';

$faqs = [];
foreach ([1, 2, 3, 4] as $n) {
    $faqs[] = ['q' => t('page.about.faq' . $n . '_q'), 'a' => t('page.about.faq' . $n . '_a')];
}

seo_set([
    'title'       => t('page.about.title'),
    'description' => t('page.about.desc'),
    'path'        => '/about-us/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('nav.about'), 'url' => '/about-us/'],
    ],
    'schema'      => [schema_faq($faqs)],
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.about.eyebrow')) ?></span>
      <h1><?= e(t('page.about.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.about.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('misc.based_sharjah')) ?></span></div>
        <div class="hero-trust-item"><?= icon('users', 'icon') ?><span><?= e(t('page.about.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('page.about.trust3')) ?></span></div>
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

    <?= hero_media($aboutHero, 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ================================================== Who we are ========= -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img($aboutTeam, 'Our crew wrapping an armchair in protective film before a move',
                ['width' => 1400, 'height' => 933, 'icon' => 'sofa']) ?>
      </div>

      <div>
        <?php $aboutTokens = ['address' => business_address(), 'areas' => areas_sentence(), 'brand' => BUSINESS_NAME]; ?>
        <span class="eyebrow"><?= e(t('page.about.who_eyebrow')) ?></span>
        <h2><?= e(t('page.about.who_h2', $aboutTokens)) ?></h2>
        <p><?= e(t('page.about.who_p1', $aboutTokens)) ?></p>
        <p><?= e(t('page.about.who_p2', $aboutTokens)) ?></p>

        <ul class="why-list">
          <?php foreach (range(1, 6) as $aboutWho): ?>
            <li><?= icon('check', 'icon') ?><span><?= e(t('page.about.who' . $aboutWho, $aboutTokens)) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- =============================================== What we stand behind == -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.about.stand_h2')) ?></h2>
    </div>

    <div class="grid grid-4">
      <?php foreach (['box', 'tools', 'route', 'home'] as $aboutValue => $aboutIcon): ?>
        <div class="card">
          <span class="card-icon-plain"><?= service_icon($aboutIcon) ?></span>
          <h3 class="card-title"><?= e(t('page.about.v' . ($aboutValue + 1) . '_t')) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e(t('page.about.v' . ($aboutValue + 1) . '_p')) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================== How we work ======== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.about.how_h2')) ?></h2>
    </div>

    <ol class="process-row">
      <?php foreach (['phone', 'clipboard', 'shield', 'truck', 'home'] as $aboutStep => $aboutIcon): ?>
        <li class="process-item">
          <span class="process-icon"><?= icon($aboutIcon, 'icon') ?></span>
          <span class="process-num"><?= str_pad((string) ($aboutStep + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h3><?= e(t('page.about.s' . ($aboutStep + 1) . '_t')) ?></h3>
          <p><?= e(t('page.about.s' . ($aboutStep + 1) . '_p')) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ============================================= What we will not do ===== -->
<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <span class="eyebrow"><?= e(t('page.about.not_eyebrow')) ?></span>
        <h2><?= e(t('page.about.not_h2')) ?></h2>
        <p><?= e(t('page.about.not_p1')) ?></p>
        <p><?= e(t('page.about.not_p2')) ?></p>
        <p><?= e(t('page.about.not_p3')) ?></p>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3><?= e(t('page.about.panel_h3')) ?></h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);"><?= e(t('page.about.panel_p')) ?></p>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-4);">
            <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
            <?= cta_whatsapp(t('wa.about'), 'btn btn-whatsapp btn-block') ?>
            <?= cta_quote('btn btn-primary btn-block', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================================================== Where we work ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.where')) ?></h2>
    </div>

    <?php
    require __DIR__ . '/includes/city-cards.php';
    ?>
  </div>
</section>

<?= faq_list($faqs, t('page.about.faq_h')) ?>

<?php
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
