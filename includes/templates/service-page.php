<?php
/**
 * Shared service page template — same design language as the homepage:
 * photo hero, rule-flanked section headings, duotone cards, a left-bleeding
 * photo split, numbered process steps, city cards and the gold CTA band.
 *
 * Every service file in /services/ sets $serviceSlug and requires this file.
 * The layout is reusable; all the copy comes from includes/data/services.php,
 * so no two service pages carry the same text.
 *
 * Page order follows the Google Ads landing page structure:
 *   Hero (H1 + location + CTA + phone + WhatsApp)
 *   → Explanation → Who it is for → What is included → Process
 *   → Benefits → Local coverage → FAQs → Quote form → Related links
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/bootstrap.php';

/** @var string $serviceSlug */
$service = get_service($serviceSlug ?? '');

if ($service === null) {
    http_response_code(404);
    require dirname(__DIR__, 2) . '/404.php';
    exit;
}

$slug      = $service['slug'];
$locations = all_locations();

seo_set([
    'title'       => $service['title'],
    'description' => $service['description'],
    'path'        => service_url($slug),
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('crumb.services'), 'url' => '/services/'],
        ['label' => $service['name'], 'url' => service_url($slug)],
    ],
    'schema'      => [schema_service($service), schema_faq($service['faqs'])],
    'quote_anchor'=> '#quote',
]);

$waMessage = t('wa.service', ['service' => $service['name']]);

require dirname(__DIR__) . '/header.php';

/* Re-resolve after the header: included partials run in this scope, and a
   stray $service or $slug in one of them would otherwise render another
   service's content under this page's URL and title. */
$service = get_service($serviceSlug);
$slug    = $service['slug'];

/* Per-service photography if supplied, otherwise the site's crew photos. */
$heroImg  = image_exists('services/' . $slug . '.jpg') ? 'services/' . $slug . '.jpg' : 'hero-movers-dubai.jpg';
$splitImg = image_exists('services/' . $slug . '-2.jpg') ? 'services/' . $slug . '-2.jpg' : 'why-choose-us.jpg';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e($service['name']) ?></span>
      <h1><?= e($service['h1']) ?></h1>
      <p class="hero-home-sub"><?= e($service['hero_sub']) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(t('misc.based_sharjah')) ?></span></div>
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('misc.free_quotation')) ?></span></div>
        <div class="hero-trust-item"><?= icon('shield', 'icon') ?><span><?= e(t('misc.careful_handling')) ?></span></div>
      </div>

      <div class="btn-row">
        <?= cta_quote('btn btn-primary btn-lg', t('cta.quote'), '#quote') ?>
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
      </div>
    </div>

    <?= hero_media($heroImg, $service['name'] . ' in Dubai, Sharjah and Ajman',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => $service['icon']]) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ============================================= What the service is ===== -->
<section class="section section-alt why-section">
  <div class="container">
    <div class="why-grid">
      <div class="why-media">
        <?= img($splitImg, $service['name'] . ' — our crew at work',
                ['width' => 1400, 'height' => 933, 'icon' => $service['icon']]) ?>
      </div>

      <div>
        <span class="eyebrow"><?= e(t('tpl.service.covers')) ?></span>
        <h2><?= e($service['what_it_is']['heading']) ?></h2>
        <?php foreach ($service['intro'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <div class="btn-row" style="margin-top: var(--sp-5);">
          <?= cta_quote('btn btn-primary', t('cta.quote'), '#quote') ?>
          <?= cta_whatsapp($waMessage, 'btn btn-whatsapp') ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================================================ Detail + included === -->
<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <?php foreach ($service['what_it_is']['body'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <h2><?= e($service['suits']['heading']) ?></h2>
        <ul class="tag-list">
          <?php foreach ($service['suits']['items'] as $item): ?>
            <li><span class="tag"><?= e($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3><?= e($service['includes']['heading']) ?></h3>
          <ul class="checklist">
            <?php foreach ($service['includes']['items'] as $item): ?>
              <li><?= icon('check', 'icon icon-sm') ?><span><?= e($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-5);">
            <?= cta_quote('btn btn-primary btn-block', t('cta.quote'), '#quote') ?>
            <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ================================================== Who it is for ====== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e($service['who_for']['heading']) ?></h2>
    </div>
    <div class="grid grid-4">
      <?php foreach ($service['who_for']['items'] as $item): ?>
        <div class="card">
          <span class="card-icon-plain"><?= service_icon($service['icon']) ?></span>
          <h3 class="card-title"><?= e($item['title']) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e($item['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===================================================== Process ========= -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('tpl.service.how_h2')) ?></h2>
    </div>
    <ol class="process-row">
      <?php foreach ($service['process'] as $i => $step): ?>
        <li class="process-item">
          <span class="process-icon"><?= icon(['phone', 'clipboard', 'box', 'truck', 'home'][$i] ?? 'check', 'icon') ?></span>
          <span class="process-num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h3><?= e($step['title']) ?></h3>
          <p><?= e($step['text']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ===================================================== Benefits ======== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('tpl.service.why_h2')) ?></h2>
    </div>
    <div class="grid grid-4">
      <?php foreach ($service['benefits'] as $benefit): ?>
        <div class="card">
          <span class="card-icon-plain"><?= service_icon('tools') ?></span>
          <h3 class="card-title"><?= e($benefit['title']) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e($benefit['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================================================= Where we do it ====== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('tpl.service.across', ['service' => $service['name']])) ?></h2>
    </div>
    <?php
    $cityAlt = $service['name'];
    require __DIR__ . '/../city-cards.php';
    ?>
  </div>
</section>

<?= faq_list($service['faqs'], t('tpl.service.faq_h', ['service' => $service['name']])) ?>

<!-- ==================================================== Quote form ====== -->
<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = t('tpl.service.q_head', ['service' => $service['name']]);
    $quoteIntro   = t('tpl.service.q_intro', ['service' => $service['name']]);
    $quoteSource  = 'service:' . $slug;
    $quoteService = $slug;
    require dirname(__DIR__) . '/quote-form.php';
    ?>
  </div>
</section>

<!-- ================================================ Related services ===== -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('sec.related')) ?></h2>
    </div>
    <div class="service-strip" style="--cols:<?= count($service['related']) ?>">
      <?php
      $allServices = all_services();
      foreach ($service['related'] as $relSlug):
          if (!isset($allServices[$relSlug])) { continue; }
          $rel = $allServices[$relSlug]; ?>
        <a class="service-tile" href="<?= e(service_url($relSlug)) ?>">
          <span class="service-tile-icon"><?= service_icon($rel['icon']) ?></span>
          <h3><?= e($rel['name']) ?></h3>
          <p><?= e($rel['tile']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
    <div class="service-strip-foot">
      <a href="<?= e(lang_url('/services/')) ?>" class="btn btn-phone">
        <span><?= e(t('cta.view_services')) ?></span><?= icon('arrow', 'icon icon-sm') ?>
      </a>
    </div>
  </div>
</section>

<?php
$bandTitle    = t('band.service_title', ['service' => $service['name']]);
$bandSub      = t('band.service_sub');
$bandWhatsApp = $waMessage;
require __DIR__ . '/../cta-band.php';
?>

<?php require dirname(__DIR__) . '/footer.php'; ?>
