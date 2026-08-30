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
?>
</main>

<footer class="site-footer">
  <div class="container footer-top">
    <div class="footer-col footer-brand-col">
      <a class="brand brand-footer" href="/" aria-label="<?= e(BUSINESS_NAME) ?> — home">
        <?php if (image_exists('logo-white.png')): ?>
          <img class="brand-logo" src="<?= e(image_url('logo-white.png')) ?>"
               alt="<?= e(BUSINESS_NAME) ?>" width="220" height="66" loading="lazy">
        <?php else: ?>
          <span class="brand-mark" aria-hidden="true"><?= icon('truck', 'icon') ?></span>
          <span class="brand-text"><strong>Home Movers</strong><span>&amp; Packers</span></span>
        <?php endif; ?>
      </a>
      <p class="footer-about">
        Movers and packers based in <?= e(BUSINESS_ADDRESS) ?>, providing home, villa, apartment,
        office and commercial moving with packing, storage and furniture services across
        <?= e(areas_sentence()) ?>.
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
        <?= cta_phone('btn btn-primary', 'Call ' . PHONE_DISPLAY) ?>
      </div>
    </div>

    <div class="footer-col">
      <h2 class="footer-title">Services</h2>
      <ul class="footer-list">
        <?php
        /* The reference footer lists a handful of services and an "And more"
           link, not all twelve — twelve stacked links doubled the footer height. */
        $footShown = 0;
        foreach ($footServices as $footSlug => $footService):
            if ($footShown++ >= 6) { break; } ?>
          <li><a href="<?= e(service_url($footSlug)) ?>"><?= e($footService['name']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="/services/"><strong style="color:inherit;">And more services</strong></a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h2 class="footer-title">Locations</h2>
      <ul class="footer-list">
        <?php foreach ($footLocations as $footLocSlug => $footLocation): ?>
          <li><a href="<?= e(location_url($footLocSlug)) ?>">Movers in <?= e($footLocation['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>

      <h2 class="footer-title footer-title-spaced">Company</h2>
      <ul class="footer-list">
        <li><a href="/">Home</a></li>
        <li><a href="/about-us/">About Us</a></li>
        <li><a href="/contact-us/">Contact Us</a></li>
        <li><a href="/blog/">Blog</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h2 class="footer-title">Contact</h2>
      <ul class="footer-contact">
        <li>
          <?= icon('phone', 'icon icon-sm') ?>
          <a href="<?= PHONE_LINK ?>" class="js-track" data-cta="phone"><?= e(PHONE_DISPLAY) ?></a>
        </li>
        <li>
          <?= icon('whatsapp', 'icon icon-sm') ?>
          <a href="<?= e(whatsapp_url('Hello, I need a moving quote.')) ?>" class="js-track"
             data-cta="whatsapp" target="_blank" rel="noopener">WhatsApp us</a>
        </li>
        <li>
          <?= icon('mail', 'icon icon-sm') ?>
          <a href="mailto:<?= e(EMAIL_ADDRESS) ?>" class="js-track" data-cta="email"><?= e(EMAIL_ADDRESS) ?></a>
        </li>
        <li>
          <?= icon('pin', 'icon icon-sm') ?>
          <span><?= e(BUSINESS_ADDRESS) ?></span>
        </li>
      </ul>
      <p class="footer-note">
        Serving <?= e(areas_sentence()) ?>. Contact us for a free, no-obligation moving quote.
      </p>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom-inner">
      <p>&copy; <?= e((string) $footYear) ?> <?= e(BUSINESS_NAME) ?>. All rights reserved.</p>
      <ul class="footer-legal">
        <li><a href="/privacy-policy/">Privacy Policy</a></li>
        <li><a href="/terms-and-conditions/">Terms &amp; Conditions</a></li>
        <li><a href="/sitemap.xml">Sitemap</a></li>
      </ul>
    </div>
  </div>
</footer>

<!-- Mobile sticky conversion bar -->
<div class="mobile-bar" role="group" aria-label="Contact actions">
  <a href="<?= PHONE_LINK ?>" class="mobile-bar-item js-track" data-cta="phone">
    <?= icon('phone', 'icon') ?><span>Call Now</span>
  </a>
  <a href="<?= e(whatsapp_url('Hello, I need a moving quote.')) ?>" class="mobile-bar-item mobile-bar-whatsapp js-track"
     data-cta="whatsapp" target="_blank" rel="noopener">
    <?= icon('whatsapp', 'icon') ?><span>WhatsApp</span>
  </a>
  <a href="<?= e(seo_get('quote_anchor', '/contact-us/#quote')) ?>" class="mobile-bar-item mobile-bar-quote js-track" data-cta="quote">
    <?= icon('quote', 'icon') ?><span>Get Quote</span>
  </a>
</div>

<script src="<?= e(asset('js/main.js')) ?>" defer></script>
</body>
</html>
