<?php
/**
 * 404 page. Reached via ErrorDocument in .htaccess, and included directly by
 * the service/location templates when an unknown slug is requested.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

if (!headers_sent()) {
    http_response_code(404);
}

seo_set([
    'title'       => 'Page Not Found | ' . SITE_NAME,
    'description' => 'The page you were looking for could not be found. Browse our moving services or contact us on 055 658 1781.',
    'path'        => '/404/',
    'robots'      => 'noindex, follow',
    'breadcrumbs' => [],
]);

require __DIR__ . '/includes/header.php';
?>

<section class="section">
  <div class="container container-narrow error-page">
    <p class="error-code">404</p>
    <h1>We could not find that page</h1>
    <p class="section-lead" style="margin-bottom: var(--sp-6);">
      The page may have moved or the link may be incomplete. Everything below is still where
      it should be — or call us and we will point you in the right direction.
    </p>

    <div class="btn-row" style="justify-content: center; margin-bottom: var(--sp-8);">
      <a href="/" class="btn btn-primary btn-lg">Go to the homepage</a>
      <?= cta_phone('btn btn-outline btn-lg', 'Call ' . PHONE_DISPLAY) ?>
      <?= cta_whatsapp('Hello, I need a moving quote.', 'btn btn-whatsapp btn-lg') ?>
    </div>
  </div>

  <div class="container">
    <h2 class="section-title">Our moving services</h2>
    <div class="grid grid-4">
      <?php foreach (all_services() as $slug => $service): ?>
        <?= service_card($slug, $service) ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= related_locations('Areas we cover') ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
