<?php
/**
 * Contact Us — same design language as the homepage: photo hero, rule-flanked
 * section headings, duotone contact cards, the quote form as the main event,
 * city cards and the gold CTA band.
 *
 * No invented business hours and no embedded map: neither has been supplied.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

$locations = all_locations();

$contactHero = image_exists('contact-hero.jpg') ? 'contact-hero.jpg' : 'hero-movers-dubai.jpg';

$faqs = [];
foreach ([1, 2, 3, 4] as $n) {
    $faqs[] = ['q' => t('page.contact.faq' . $n . '_q'), 'a' => t('page.contact.faq' . $n . '_a')];
}

seo_set([
    'title'       => t('page.contact.title'),
    'description' => t('page.contact.desc'),
    'path'        => '/contact-us/',
    'breadcrumbs' => [
        ['label' => t('crumb.home'), 'url' => '/'],
        ['label' => t('nav.contact'), 'url' => '/contact-us/'],
    ],
    'schema'      => [schema_faq($faqs)],
    'quote_anchor'=> '#quote',
]);

require __DIR__ . '/includes/header.php';
?>

<!-- ===================================================== Hero ============ -->
<section class="hero-home hero-compact">
  <div class="container hero-home-inner">
    <div class="hero-home-copy">
      <span class="eyebrow"><?= e(t('page.contact.eyebrow')) ?></span>
      <h1><?= e(t('page.contact.h1')) ?></h1>
      <p class="hero-home-sub"><?= e(t('page.contact.sub')) ?></p>

      <div class="hero-trust">
        <div class="hero-trust-item"><?= icon('quote', 'icon') ?><span><?= e(t('misc.free_quotation')) ?></span></div>
        <div class="hero-trust-item"><?= icon('clock', 'icon') ?><span><?= e(t('page.contact.trust2')) ?></span></div>
        <div class="hero-trust-item"><?= icon('pin', 'icon') ?><span><?= e(areas_sentence()) ?></span></div>
      </div>

      <div class="btn-row">
        <a href="<?= PHONE_LINK ?>" class="btn btn-phone btn-lg js-track" data-cta="phone"
           <?= cta_id('phone') ?> aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
          <?= icon('phone', 'icon') ?>
          <span class="btn-stack"><small><?= e(t('cta.call_now')) ?></small><strong><?= e(PHONE_DISPLAY) ?></strong></span>
        </a>
        <?= cta_whatsapp('', 'btn btn-whatsapp btn-lg') ?>
      </div>
    </div>

    <?= hero_media($contactHero, 'Our moving crew loading a truck in Dubai',
              ['width' => 1600, 'height' => 977, 'loading' => 'eager', 'fetchpriority' => 'high', 'icon' => 'truck']) ?>
  </div>
</section>

<?= breadcrumbs_render() ?>

<!-- ============================================== How to reach us ======== -->
<section class="section">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.contact.reach_h2')) ?></h2>
    </div>

    <div class="grid grid-4 contact-methods">
      <a class="card contact-card js-track" href="<?= PHONE_LINK ?>" data-cta="phone">
        <span class="card-icon-plain"><?= service_icon('route') ?></span>
        <h3 class="card-title"><?= e(t('page.contact.m1_t')) ?></h3>
        <p class="contact-value"><?= e(PHONE_DISPLAY) ?></p>
        <p class="card-text"><?= e(t('page.contact.m1_p')) ?></p>
      </a>

      <a class="card contact-card js-track" href="<?= e(whatsapp_url()) ?>"
         data-cta="whatsapp" target="_blank" rel="noopener">
        <span class="card-icon-plain"><?= service_icon('box') ?></span>
        <h3 class="card-title"><?= e(t('page.contact.m2_t')) ?></h3>
        <p class="contact-value"><?= e(PHONE_DISPLAY) ?></p>
        <p class="card-text"><?= e(t('page.contact.m2_p')) ?></p>
      </a>

      <a class="card contact-card js-track" href="mailto:<?= e(EMAIL_ADDRESS) ?>" data-cta="email">
        <span class="card-icon-plain"><?= service_icon('tools') ?></span>
        <h3 class="card-title"><?= e(t('page.contact.m3_t')) ?></h3>
        <p class="contact-value contact-value-sm"><?= e(EMAIL_ADDRESS) ?></p>
        <p class="card-text"><?= e(t('page.contact.m3_p')) ?></p>
      </a>

      <div class="card contact-card">
        <span class="card-icon-plain"><?= service_icon('home') ?></span>
        <h3 class="card-title"><?= e(t('page.contact.m4_t')) ?></h3>
        <p class="contact-value"><?= e(business_address()) ?></p>
        <p class="card-text"><?= e(t('page.contact.m4_p', ['areas' => areas_sentence()])) ?></p>
      </div>
    </div>
  </div>
</section>

<!-- ================================================== Quote form ========= -->
<section class="section section-alt">
  <div class="container">
    <div class="heading-rule">
      <h2><?= e(t('page.contact.req_h2')) ?></h2>
    </div>

    <div class="contact-grid">
      <div>
        <?php
        $quoteHeading = t('page.contact.q_head');
        $quoteIntro   = t('page.contact.q_intro');
        $quoteSource  = 'contact-page';
        require __DIR__ . '/includes/quote-form.php';
        ?>
      </div>

      <aside>
        <div class="panel panel-accent">
          <h3><?= e(t('page.contact.speed_h3')) ?></h3>
          <p style="font-size: var(--fs-sm); color: var(--ink-500);"><?= e(t('page.contact.speed_p')) ?></p>
          <ul class="checklist">
            <?php foreach (range(1, 5) as $contactTip): ?>
              <li><?= icon('check', 'icon icon-sm') ?><span><?= e(t('page.contact.sp' . $contactTip)) ?></span></li>
            <?php endforeach; ?>
          </ul>
          <div class="grid" style="gap: var(--sp-3); margin-top: var(--sp-5);">
            <?= cta_whatsapp('', 'btn btn-whatsapp btn-block') ?>
            <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
          </div>
        </div>

        <div class="panel" style="margin-top: var(--sp-5);">
          <h3><?= e(t('misc.areas_served')) ?></h3>
          <ul class="checklist">
            <?php foreach ($locations as $locSlug => $location): ?>
              <li>
                <?= icon('pin', 'icon icon-sm') ?>
                <a href="<?= e(location_url($locSlug)) ?>"><?= e(t('nav.movers_in', ['city' => $location['name']])) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
          <p style="font-size: var(--fs-sm); color: var(--ink-500); margin-top: var(--sp-4);">
            <?= e(t('page.contact.areas_note')) ?>
          </p>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============================================== Message + locations ==== -->
<section class="section">
  <div class="container">
    <div class="contact-grid contact-grid-reverse">
      <div>
        <?php
        $contactSource = 'contact-page';
        require __DIR__ . '/includes/contact-form.php';
        ?>
      </div>

      <div>
        <span class="eyebrow"><?= e(t('page.contact.ask_eyebrow')) ?></span>
        <h2><?= e(t('page.contact.ask_h2')) ?></h2>
        <p><?= e(t('page.contact.ask_p1')) ?></p>
        <p><?= e(t('page.contact.ask_p2')) ?></p>

        <div class="btn-row" style="margin-top: var(--sp-5);">
          <?= cta_phone('btn btn-phone', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
          <?= cta_whatsapp(t('wa.question'), 'btn btn-whatsapp') ?>
        </div>
      </div>
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

<?= faq_list($faqs, t('page.contact.faq_h')) ?>

<?php
$bandTitle    = t('band.contact_title');
$bandSub      = t('band.contact_sub');
require __DIR__ . '/includes/cta-band.php';
?>

<?php require __DIR__ . '/includes/footer.php'; ?>
