<?php
/**
 * Admin chrome. Include after $adminTitle is set; close with admin-foot.php.
 *
 * Deliberately plain and self-contained: it loads the site stylesheet for the
 * design tokens and adds its own layer, so the dashboard cannot be broken by
 * a change to the public pages and vice versa.
 */

declare(strict_types=1);

/** @var string $adminTitle */
$adminTitle = $adminTitle ?? 'Dashboard';
$adminFlash = admin_flash();
$adminNav   = [
    ['/admin/',          'Dashboard', 'home'],
    ['/admin/projects.php', 'Projects',  'building'],
    ['/admin/reviews.php',  'Reviews',   'star'],
    ['/admin/account.php',  'Account',   'users'],
];
$adminHere  = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
$adminPend  = pending_review_count();
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($adminTitle) ?> · <?= e(SITE_NAME) ?></title>
  <link rel="icon" href="<?= e(asset('images/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
  <link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>">
</head>
<body class="admin">

<header class="admin-bar">
  <div class="admin-bar-inner">
    <a class="admin-brand" href="/admin/">
      <?= icon('truck', 'icon') ?>
      <span><?= e(SITE_NAME) ?> <small>admin</small></span>
    </a>

    <nav class="admin-nav" aria-label="Dashboard">
      <?php foreach ($adminNav as [$adminHref, $adminLabel, $adminIcon]): ?>
        <a href="<?= e($adminHref) ?>"
           class="admin-nav-link<?= rtrim($adminHere, '/') === rtrim($adminHref, '/') ? ' is-current' : '' ?>">
          <?= icon($adminIcon, 'icon icon-sm') ?><span><?= e($adminLabel) ?></span>
          <?php if ($adminLabel === 'Reviews' && $adminPend > 0): ?>
            <span class="admin-badge" title="<?= (int) $adminPend ?> waiting for review"><?= (int) $adminPend ?></span>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </nav>

    <div class="admin-bar-end">
      <a class="admin-view-site" href="/" target="_blank" rel="noopener">View site</a>
      <form method="post" action="/admin/logout.php" class="admin-logout">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <button type="submit" class="btn btn-outline btn-sm">Log out</button>
      </form>
    </div>
  </div>
</header>

<main class="admin-main" id="main">
  <div class="admin-shell">
    <?php if ($adminFlash !== null): ?>
      <div class="alert alert-<?= e($adminFlash['type'] === 'success' ? 'success' : 'error') ?>" role="status">
        <?= e($adminFlash['message']) ?>
      </div>
    <?php endif; ?>
