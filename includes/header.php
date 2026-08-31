<?php
/**
 * Global document head and site header.
 * Include after the page has called seo_set([...]).
 */

declare(strict_types=1);

if (!defined('APP_ROOT')) {
    require_once __DIR__ . '/bootstrap.php';
}
require_once __DIR__ . '/config.php';

/** @var string $googleTagManagerId */
/** @var string $googleAnalyticsId */
/** @var string $googleAdsId */
/** @var string $googleSiteVerify */
?><!DOCTYPE html>
<html lang="<?= e(lang_locale()) ?>" dir="<?= e(lang_dir()) ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0d2440">
<?php echo seo_render_meta(); ?>
<?php if (!empty($googleSiteVerify)): ?>
  <meta name="google-site-verification" content="<?= e($googleSiteVerify) ?>">
<?php endif; ?>
<?php /* SVG first for browsers that take it; .ico is the fallback that older
         browsers and most crawlers still request by name from the site root,
         whatever the markup says. */ ?>
  <link rel="icon" href="<?= e(asset('images/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="icon" href="/favicon.ico" sizes="32x32">
  <link rel="apple-touch-icon" href="<?= e(asset('images/apple-touch-icon.png')) ?>">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/responsive.css')) ?>" media="screen">
<?php if (is_rtl()): ?>
  <link rel="stylesheet" href="<?= e(asset('css/rtl.css')) ?>">
<?php endif; ?>
<?php echo schema_render(); ?>
<?php
/*
 * Analytics. One gtag.js load covers GA4 and Google Ads — loading it twice,
 * once per product, is a common mistake that double-counts every page view.
 *
 * $analyticsEnabled is false outside production, so nothing below is emitted
 * on a developer machine.
 */
$trackingIds = $analyticsEnabled
    ? array_values(array_filter([$googleAnalyticsId, $googleAdsId]))
    : [];
?>
<?php if ($analyticsEnabled && !empty($googleTagManagerId)): ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
  var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;
  j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})
  (window,document,'script','dataLayer','<?= e($googleTagManagerId) ?>');</script>
<?php elseif ($trackingIds !== []): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($trackingIds[0]) ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    <?php foreach ($trackingIds as $trackingId): ?>
    gtag('config', '<?= e($trackingId) ?>');
    <?php endforeach; ?>
    /* Which language the visitor is reading, as a dimension on every event —
       the whole point of running a bilingual site is being able to see
       whether the Arabic side is working. */
    gtag('set', {'content_language': '<?= e(lang()) ?>'});
  </script>
<?php endif; ?>
</head>
<body class="<?= e(seo_get('body_class', '')) ?>">
<?php if (!empty($googleTagManagerId)): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($googleTagManagerId) ?>"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<a class="skip-link" href="#main"><?= e(t('nav.skip')) ?></a>

<?php require __DIR__ . '/navigation.php'; ?>

<main id="main">
