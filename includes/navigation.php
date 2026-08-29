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
?>
<div class="topbar">
  <div class="container topbar-inner">
    <span class="topbar-item topbar-left">
      <?= icon('shield', 'icon icon-sm') ?>
      Your trusted movers &amp; packers in <?= e(areas_sentence()) ?>
    </span>
    <span class="topbar-item topbar-right">
      <span class="topbar-item"><?= icon('pin', 'icon icon-sm') ?> <?= e(BUSINESS_ADDRESS) ?></span>
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
    <a class="brand" href="/" aria-label="<?= e(BUSINESS_NAME) ?> — home">
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

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Open menu">
      <span class="nav-toggle-bar" aria-hidden="true"></span>
      <span class="nav-toggle-bar" aria-hidden="true"></span>
      <span class="nav-toggle-bar" aria-hidden="true"></span>
    </button>

    <nav class="primary-nav" id="primary-nav" aria-label="Main">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="/" class="nav-link<?= is_current('/') ? ' is-current' : '' ?>">Home</a>
        </li>

        <li class="nav-item has-dropdown">
          <a href="/services/" class="nav-link<?= is_section('/services') ? ' is-current' : '' ?>" aria-haspopup="true" aria-expanded="false">
            Services <span class="nav-caret" aria-hidden="true"></span>
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
              <a href="/services/" class="dropdown-all">View all services <?= icon('arrow', 'icon icon-sm') ?></a>
            </div>
          </div>
        </li>

        <li class="nav-item has-dropdown">
          <a href="/locations/" class="nav-link<?= is_section('/locations') ? ' is-current' : '' ?>" aria-haspopup="true" aria-expanded="false">
            Locations <span class="nav-caret" aria-hidden="true"></span>
          </a>
          <div class="dropdown">
            <ul class="dropdown-list">
              <?php foreach ($navLocations as $navLocSlug => $navLocation): ?>
                <li>
                  <a href="<?= e(location_url($navLocSlug)) ?>"<?= is_current(location_url($navLocSlug)) ? ' class="is-current"' : '' ?>>
                    <?= icon('pin', 'icon icon-sm') ?><span>Movers in <?= e($navLocation['name']) ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </li>

        <li class="nav-item"><a href="/about-us/" class="nav-link<?= is_current('/about-us/') ? ' is-current' : '' ?>">About Us</a></li>
        <li class="nav-item"><a href="/blog/" class="nav-link<?= is_section('/blog') ? ' is-current' : '' ?>">Blog</a></li>
        <li class="nav-item"><a href="/contact-us/" class="nav-link<?= is_current('/contact-us/') ? ' is-current' : '' ?>">Contact Us</a></li>
      </ul>

      <div class="nav-cta-mobile">
        <?= cta_phone('btn btn-phone btn-block', 'Call ' . PHONE_DISPLAY) ?>
        <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-block') ?>
        <?= cta_quote('btn btn-primary btn-block', 'Get a Free Quote', '/contact-us/#quote') ?>
      </div>
    </nav>

    <div class="header-cta">
      <a href="<?= PHONE_LINK ?>" class="btn btn-phone js-track" data-cta="phone">
        <?= icon('phone', 'icon icon-sm') ?><span><?= e(PHONE_DISPLAY) ?></span>
      </a>
      <a href="<?= e(whatsapp_url('Hello, I need a moving quote.')) ?>" class="btn btn-gold js-track"
         data-cta="whatsapp" target="_blank" rel="noopener">
        <?= icon('whatsapp', 'icon icon-sm') ?><span>WhatsApp Us</span>
      </a>
    </div>
  </div>
</header>
