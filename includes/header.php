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
<html lang="en-AE">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0d2440">
<?php echo seo_render_meta(); ?>
<?php if (!empty($googleSiteVerify)): ?>
  <meta name="google-site-verification" content="<?= e($googleSiteVerify) ?>">
<?php endif; ?>
  <link rel="icon" href="<?= e(asset('images/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?= e(asset('images/favicon.svg')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/responsive.css')) ?>" media="screen">
<?php echo schema_render(); ?>
<?php if (!empty($googleTagManagerId)): ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
  var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;
  j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})
  (window,document,'script','dataLayer','<?= e($googleTagManagerId) ?>');</script>
<?php elseif (!empty($googleAnalyticsId)): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($googleAnalyticsId) ?>"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
  gtag('js',new Date());gtag('config','<?= e($googleAnalyticsId) ?>');</script>
<?php endif; ?>
<?php if (!empty($googleAdsId)): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($googleAdsId) ?>"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}
  gtag('js',new Date());gtag('config','<?= e($googleAdsId) ?>');</script>
<?php endif; ?>
</head>
<body class="<?= e(seo_get('body_class', '')) ?>">
<?php if (!empty($googleTagManagerId)): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e($googleTagManagerId) ?>"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

<a class="skip-link" href="#main">Skip to main content</a>

<?php require __DIR__ . '/navigation.php'; ?>

<main id="main">
