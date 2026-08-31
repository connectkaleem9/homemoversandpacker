<?php
/**
 * Site header and main navigation.
 *
 * The dropdowns work with pure CSS on hover for pointer devices and with a
 * small amount of JavaScript for keyboard and touch, so the menu is usable
 * before main.js loads and remains usable if it never does.
 *
 * NOTE: every variable declared in this partial is prefixed `nav*`.
 * This file is included in the middle of a page's own scope, so an
 * unprefixed $service or $location here would silently overwrite the
 * page's data and the page would render the wrong content.
 */

declare(strict_types=1);

$navServices  = all_services();
$navLocations = all_locations();
$navHasLogo   = image_exists('logo.png');
$navHome      = lang_url('/');
$navOther     = other_lang();
?>
<div class="topbar">
  <div class="container topbar-inner">
    <span class="topbar-item topbar-left">
      <?= icon('shield', 'icon icon-sm') ?>
      <?= e(t('top.trusted', ['areas' => areas_sentence()])) ?>
    </span>
    <span class="topbar-item topbar-right">
      <span class="topbar-item"><?= icon('pin', 'icon icon-sm') ?> <?= e(business_address()) ?></span>
      <?php if (BUSINESS_HOURS_TEXT !== ''): ?>
        <span class="topbar-item"><?= icon('clock', 'icon icon-sm') ?> <?= e(BUSINESS_HOURS_TEXT) ?></span>
      <?php endif; ?>
      <span class="topbar-item topbar-phone">
        <?= icon('phone', 'icon icon-sm') ?>
        <a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a>
      </span>
    </span>
  </div>
</div>

<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a class="brand" href="<?= e($navHome) ?>" aria-label="<?= e(BUSINESS_NAME) ?>">
      <?php if ($navHasLogo): ?>
        <img class="brand-logo" src="<?= e(image_url('logo.png')) ?>"
             alt="<?= e(BUSINESS_NAME) ?>" width="200" height="60">
      <?php else: ?>
        <span class="brand-mark" aria-hidden="true"><?= icon('truck', 'icon') ?></span>
        <span class="brand-text">
          <strong>Home Movers</strong>
          <span>&amp; Packers</span>
        </span>
      <?php endif; ?>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav"
            aria-label="<?= e(t('nav.open_menu')) ?>">
      <span class="nav-toggle-bar" aria-hidden="true"></span>
      <span class="nav-toggle-bar" aria-hidden="true"></span>
      <span class="nav-toggle-bar" aria-hidden="true"></span>
    </button>

    <nav class="primary-nav" id="primary-nav" aria-label="Main">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="<?= e($navHome) ?>" class="nav-link<?= is_current('/') ? ' is-current' : '' ?>"><?= e(t('nav.home')) ?></a>
        </li>

        <li class="nav-item has-dropdown">
          <a href="<?= e(lang_url('/services/')) ?>" class="nav-link<?= is_section('/services') ? ' is-current' : '' ?>"
             aria-haspopup="true" aria-expanded="false">
            <?= e(t('nav.services')) ?> <span class="nav-caret" aria-hidden="true"></span>
          </a>
          <div class="dropdown dropdown-wide">
            <ul class="dropdown-list">
              <?php foreach ($navServices as $navSlug => $navService): ?>
                <li>
                  <a href="<?= e(service_url($navSlug)) ?>"<?= is_current(service_url($navSlug)) ? ' class="is-current"' : '' ?>>
                    <?= icon($navService['icon'], 'icon icon-sm') ?><span><?= e($navService['name']) ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="dropdown-foot">
              <a href="<?= e(lang_url('/services/')) ?>" class="dropdown-all"><?= e(t('nav.view_all')) ?> <?= icon('arrow', 'icon icon-sm') ?></a>
            </div>
          </div>
        </li>

        <li class="nav-item has-dropdown">
          <a href="<?= e(lang_url('/locations/')) ?>" class="nav-link<?= is_section('/locations') ? ' is-current' : '' ?>"
             aria-haspopup="true" aria-expanded="false">
            <?= e(t('nav.locations')) ?> <span class="nav-caret" aria-hidden="true"></span>
          </a>
          <div class="dropdown">
            <ul class="dropdown-list">
              <?php foreach ($navLocations as $navLocSlug => $navLocation): ?>
                <li>
                  <a href="<?= e(location_url($navLocSlug)) ?>"<?= is_current(location_url($navLocSlug)) ? ' class="is-current"' : '' ?>>
                    <?= icon('pin', 'icon icon-sm') ?><span><?= e(t('nav.movers_in', ['city' => $navLocation['name']])) ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a href="<?= e(lang_url('/projects/')) ?>" class="nav-link<?= is_section('/projects') ? ' is-current' : '' ?>"><?= e(t('nav.projects')) ?></a>
        </li>
        <li class="nav-item">
          <a href="<?= e(lang_url('/reviews/')) ?>" class="nav-link<?= is_current('/reviews/') ? ' is-current' : '' ?>"><?= e(t('nav.reviews')) ?></a>
        </li>
        <li class="nav-item">
          <a href="<?= e(lang_url('/about-us/')) ?>" class="nav-link<?= is_current('/about-us/') ? ' is-current' : '' ?>"><?= e(t('nav.about')) ?></a>
        </li>
        <li class="nav-item">
          <a href="<?= e(lang_url('/contact-us/')) ?>" class="nav-link<?= is_current('/contact-us/') ? ' is-current' : '' ?>"><?= e(t('nav.contact')) ?></a>
        </li>

        <?php /* Same page, other language — a real link, so it is crawlable. */ ?>
        <li class="nav-item nav-item-lang">
          <a href="<?= e(alternate_url($navOther)) ?>" class="nav-link nav-lang"
             lang="<?= e($navOther) ?>" hreflang="<?= e(LANGUAGES[$navOther]['locale']) ?>"
             aria-label="<?= e(t('nav.switch_aria')) ?>" rel="alternate">
            <?= icon('globe', 'icon icon-sm') ?><span><?= e(t('nav.switch_language')) ?></span>
          </a>
        </li>
      </ul>

      <div class="nav-cta-mobile">
        <?= cta_phone('btn btn-phone btn-block', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
        <?= cta_whatsapp('', 'btn btn-whatsapp btn-block', t('cta.whatsapp')) ?>
        <?= cta_quote('btn btn-primary btn-block', t('cta.quote'), lang_url('/contact-us/') . '#quote') ?>
      </div>
    </nav>

    <?php /* Both carry an aria-label: between 1025px and 1140px the labels are
             hidden to keep the header on one line, and without these the
             buttons would have no accessible name at all. */ ?>
    <div class="header-cta">
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone js-track" data-cta="phone"
         aria-label="<?= e(t('cta.call', ['phone' => PHONE_INTL])) ?>">
        <?= icon('phone', 'icon icon-sm') ?><span><?= e(PHONE_DISPLAY) ?></span>
      </a>
      <a href="<?= e(whatsapp_url()) ?>" class="btn btn-gold js-track"
         data-cta="whatsapp" target="_blank" rel="noopener"
         aria-label="<?= e(t('foot.whatsapp_us')) ?>">
        <?= icon('whatsapp', 'icon icon-sm') ?><span><?= e(t('cta.whatsapp')) ?></span>
      </a>
    </div>
  </div>
</header>
