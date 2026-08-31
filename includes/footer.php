<?php
/**
 * Global footer, mobile sticky CTA bar and deferred scripts.
 * Closes <main> opened by header.php.
 */

declare(strict_types=1);

/* Prefixed `foot*` for the same reason as includes/navigation.php. */
$footServices  = all_services();
$footLocations = all_locations();
$footYear = date('Y');
$footHome = lang_url('/');
?>
</main>

<footer class="site-footer">
  <div class="container footer-top">
    <div class="footer-col footer-brand-col">
      <a class="brand brand-footer" href="<?= e($footHome) ?>" aria-label="<?= e(BUSINESS_NAME) ?>">
        <?php if (image_exists('logo-white.png')): ?>
          <img class="brand-logo" src="<?= e(image_url('logo-white.png')) ?>"
               alt="<?= e(BUSINESS_NAME) ?>" width="220" height="66" loading="lazy">
        <?php else: ?>
          <span class="brand-mark" aria-hidden="true"><?= icon('truck', 'icon') ?></span>
          <span class="brand-text"><strong>Home Movers</strong><span>&amp; Packers</span></span>
        <?php endif; ?>
      </a>
      <p class="footer-about">
        <?= e(t('foot.about', ['address' => BUSINESS_ADDRESS, 'areas' => areas_sentence()])) ?>
      </p>

      <?php
      /* Social icons appear only for profiles that have a real URL in config. */
      $footSocial = array_filter(SOCIAL_LINKS, static fn ($url): bool => is_string($url) && $url !== '');
      ?>
      <?php if ($footSocial !== []): ?>
        <div class="footer-social">
          <?php foreach ($footSocial as $footNetwork => $footUrl): ?>
            <a href="<?= e($footUrl) ?>" target="_blank" rel="noopener"
               aria-label="<?= e(ucfirst($footNetwork)) ?>">
              <?= icon($footNetwork, 'icon') ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="footer-cta" style="margin-top: var(--sp-5);">
        <?= cta_phone('btn btn-primary', t('cta.call', ['phone' => PHONE_DISPLAY])) ?>
      </div>
    </div>

    <div class="footer-col">
      <h2 class="footer-title"><?= e(t('foot.services')) ?></h2>
      <ul class="footer-list">
        <?php
        /* The reference footer lists a handful of services and an "And more"
           link, not all twelve — twelve stacked links doubled the footer height. */
        $footShown = 0;
        foreach ($footServices as $footSlug => $footService):
            if ($footShown++ >= 6) { break; } ?>
          <li><a href="<?= e(service_url($footSlug)) ?>"><?= e($footService['name']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="<?= e(lang_url('/services/')) ?>"><strong style="color:inherit;"><?= e(t('foot.and_more')) ?></strong></a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h2 class="footer-title"><?= e(t('foot.locations')) ?></h2>
      <ul class="footer-list">
        <?php foreach ($footLocations as $footLocSlug => $footLocation): ?>
          <li><a href="<?= e(location_url($footLocSlug)) ?>"><?= e(t('nav.movers_in', ['city' => $footLocation['name']])) ?></a></li>
        <?php endforeach; ?>
      </ul>

      <h2 class="footer-title footer-title-spaced"><?= e(t('foot.company')) ?></h2>
      <ul class="footer-list">
        <li><a href="<?= e($footHome) ?>"><?= e(t('nav.home')) ?></a></li>
        <li><a href="<?= e(lang_url('/about-us/')) ?>"><?= e(t('nav.about')) ?></a></li>
        <li><a href="<?= e(lang_url('/contact-us/')) ?>"><?= e(t('nav.contact')) ?></a></li>
        <?php /* Blog left the header at the client's request; it keeps this
                 footer link so the articles stay reachable and crawlable. */ ?>
        <li><a href="<?= e(lang_url('/blog/')) ?>"><?= e(t('nav.blog')) ?></a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h2 class="footer-title"><?= e(t('foot.contact')) ?></h2>
      <ul class="footer-contact">
        <li>
          <?= icon('phone', 'icon icon-sm') ?>
          <a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a>
        </li>
        <li>
          <?= icon('whatsapp', 'icon icon-sm') ?>
          <a href="<?= e(whatsapp_url()) ?>" class="js-track"
             data-cta="whatsapp" target="_blank" rel="noopener"><?= e(t('foot.whatsapp_us')) ?></a>
        </li>
        <li>
          <?= icon('mail', 'icon icon-sm') ?>
          <a href="mailto:<?= e(EMAIL_ADDRESS) ?>" class="js-track" data-cta="email"><?= e(EMAIL_ADDRESS) ?></a>
        </li>
        <li>
          <?= icon('pin', 'icon icon-sm') ?>
          <span><?= e(business_address()) ?></span>
        </li>
      </ul>
      <p class="footer-note">
        <?= e(t('foot.note', ['areas' => areas_sentence()])) ?>
      </p>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <p>&copy; <?= e((string) $footYear) ?> <?= e(BUSINESS_NAME) ?>. <?= e(t('foot.rights')) ?></p>
      <ul class="footer-legal">
        <li><a href="<?= e(lang_url('/privacy-policy/')) ?>"><?= e(t('foot.privacy')) ?></a></li>
        <li><a href="<?= e(lang_url('/terms-and-conditions/')) ?>"><?= e(t('foot.terms')) ?></a></li>
        <li><a href="/sitemap.xml"><?= e(t('foot.sitemap')) ?></a></li>
      </ul>
    </div>
  </div>
</footer>

<!-- Mobile sticky conversion bar -->
<div class="mobile-bar" role="group" aria-label="<?= e(t('bar.aria')) ?>">
  <a href="<?= PHONE_LINK ?>" class="mobile-bar-item js-track" data-cta="phone">
    <?= icon('phone', 'icon') ?><span><?= e(t('bar.call')) ?></span>
  </a>
  <a href="<?= e(whatsapp_url()) ?>" class="mobile-bar-item mobile-bar-whatsapp js-track"
     data-cta="whatsapp" target="_blank" rel="noopener">
    <?= icon('whatsapp', 'icon') ?><span><?= e(t('bar.whatsapp')) ?></span>
  </a>
  <?php
  /* An in-page anchor stays as it is; a path gets the language prefix. */
  $footQuote = (string) seo_get('quote_anchor', '/contact-us/#quote');
  $footQuote = str_starts_with($footQuote, '#') ? $footQuote : lang_url($footQuote);
  ?>
  <a href="<?= e($footQuote) ?>" class="mobile-bar-item mobile-bar-quote js-track" data-cta="quote">
    <?= icon('quote', 'icon') ?><span><?= e(t('bar.quote')) ?></span>
  </a>
</div>

<script src="<?= e(asset('js/main.js')) ?>" defer></script>
</body>
</html>
