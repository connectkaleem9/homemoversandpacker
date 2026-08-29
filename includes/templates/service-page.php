<?php
/**
 * Shared service page template.
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
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Services', 'url' => '/services/'],
        ['label' => $service['name'], 'url' => service_url($slug)],
    ],
    'schema'      => [schema_service($service), schema_faq($service['faqs'])],
    'quote_anchor'=> '#quote',
]);

$waMessage = 'Hello, I need ' . lcfirst($service['name']) . ' in Dubai, Sharjah or Ajman.';

require dirname(__DIR__) . '/header.php';

/* Re-resolve after the header: included partials run in this scope, and a
   stray $service or $slug in one of them would otherwise render another
   service's content under this page's URL and title. */
$service = get_service($serviceSlug);
$slug    = $service['slug'];
?>

<section class="hero hero-inner-page">
  <div class="container hero-inner">
    <div class="hero-copy">
      <span class="eyebrow eyebrow-light"><?= e($service['name']) ?> · <?= e(areas_sentence()) ?></span>
      <h1><?= e($service['h1']) ?></h1>
      <p class="hero-sub"><?= e($service['hero_sub']) ?></p>

      <div class="hero-actions">
        <?= cta_quote('btn btn-primary btn-lg', 'Get a Free Moving Quote', '#quote') ?>
        <?= cta_phone('btn btn-ghost-light btn-lg', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-lg') ?>
      </div>

      <div class="hero-assurance">
        <span><?= icon('pin', 'icon icon-sm') ?> Based in <?= e(BUSINESS_ADDRESS) ?></span>
        <span><?= icon('quote', 'icon icon-sm') ?> Free quotation, no obligation</span>
        <span><?= icon('shield', 'icon icon-sm') ?> Careful handling throughout</span>
      </div>
    </div>
  </div>
</section>

<?= breadcrumbs_render() ?>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="prose">
        <?php foreach ($service['intro'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <h2><?= e($service['what_it_is']['heading']) ?></h2>
        <?php foreach ($service['what_it_is']['body'] as $paragraph): ?>
          <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3><?= e($service['includes']['heading']) ?></h3>
          <ul class="checklist">
            <?php foreach ($service['includes']['items'] as $item): ?>
              <li><?= icon('check', 'icon icon-sm') ?><span><?= e($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <div class="btn-row" style="margin-top: var(--sp-5);">
            <?= cta_quote('btn btn-primary btn-block', 'Get a Free Quote', '#quote') ?>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title"><?= e($service['who_for']['heading']) ?></h2>
    </div>
    <div class="grid grid-4">
      <?php foreach ($service['who_for']['items'] as $item): ?>
        <div class="card">
          <h3 class="card-title"><?= e($item['title']) ?></h3>
          <p class="card-text" style="margin-bottom:0;"><?= e($item['text']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Our process</span>
      <h2 class="section-title">How your <?= e(strtolower($service['name'])) ?> booking works</h2>
    </div>
    <ol class="steps steps-5">
      <?php foreach ($service['process'] as $step): ?>
        <li class="step">
          <h3><?= e($step['title']) ?></h3>
          <p><?= e($step['text']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="split">
      <div>
        <div class="section-head">
          <span class="eyebrow">Why it matters</span>
          <h2 class="section-title">What you get from doing this properly</h2>
        </div>
        <div class="grid" style="gap: var(--sp-5);">
          <?php foreach ($service['benefits'] as $benefit): ?>
            <div class="benefit">
              <?= icon('check', 'icon') ?>
              <div>
                <h3><?= e($benefit['title']) ?></h3>
                <p><?= e($benefit['text']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <aside>
        <div class="panel">
          <h3><?= e($service['suits']['heading']) ?></h3>
          <ul class="tag-list">
            <?php foreach ($service['suits']['items'] as $item): ?>
              <li><span class="tag"><?= e($item) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3>Available across all three emirates</h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);">
            <?= e($service['name']) ?> is available throughout our service area. Choose your emirate
            for local details and moving scenarios:
          </p>
          <ul class="checklist">
            <?php foreach ($locations as $locSlug => $location): ?>
              <li>
                <?= icon('pin', 'icon icon-sm') ?>
                <a href="<?= e(location_url($locSlug)) ?>">Movers in <?= e($location['name']) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </aside>
    </div>
  </div>
</section>

<?= faq_list($service['faqs'], e($service['name']) . ' — frequently asked questions') ?>

<section class="section">
  <div class="container container-narrow">
    <?php
    $quoteHeading = 'Get a Free Quote for ' . $service['name'];
    $quoteIntro   = 'Tell us about your move and we will come back with a clear, specific quotation for '
                  . lcfirst($service['name']) . '. No obligation.';
    $quoteSource  = 'service:' . $slug;
    $quoteService = $slug;
    require dirname(__DIR__) . '/quote-form.php';
    ?>
  </div>
</section>

<?= related_services($service['related']) ?>

<section class="cta-band">
  <div class="container cta-band-inner">
    <div>
      <h2>Need <?= e($service['name']) ?> today?</h2>
      <p>Call or WhatsApp us and we will tell you honestly what is available and what it will involve.</p>
    </div>
    <div class="cta-band-actions">
      <?= cta_phone('btn btn-primary btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp($waMessage, 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>
</section>

<?php require dirname(__DIR__) . '/footer.php'; ?>
