<?php
/**
 * XML sitemap, generated from the same data that builds the site.
 * Served at /sitemap.xml via the .htaccess rewrite.
 *
 * Only canonical, indexable URLs are listed — no .php paths, no form
 * endpoints, no noindex pages, no redirect targets.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

header('Content-Type: application/xml; charset=UTF-8');

$today = date('Y-m-d');

/** @var array<int, array{loc: string, lastmod: string, changefreq: string, priority: string}> $urls */
$urls = [];

$add = static function (string $path, string $lastmod, string $changefreq, string $priority) use (&$urls): void {
    $urls[] = [
        'loc'        => canonical($path),
        'lastmod'    => $lastmod,
        'changefreq' => $changefreq,
        'priority'   => $priority,
    ];
};

/* Core pages */
$add('/', $today, 'weekly', '1.0');
$add('/services/', $today, 'monthly', '0.9');
$add('/locations/', $today, 'monthly', '0.9');
$add('/about-us/', $today, 'yearly', '0.6');
$add('/contact-us/', $today, 'monthly', '0.8');
$add('/blog/', $today, 'weekly', '0.7');

/* Service landing pages — the primary commercial targets */
foreach (all_services() as $slug => $service) {
    $add(service_url($slug), $today, 'monthly', '0.9');
}

/* Location landing pages — the primary local SEO targets */
foreach (all_locations() as $slug => $location) {
    $add(location_url($slug), $today, 'monthly', '0.9');
}

/* Blog articles */
foreach (all_posts() as $slug => $post) {
    $add(post_url($slug), $post['modified'] ?? $post['published'], 'yearly', '0.6');
}

/* Legal pages */
$add('/privacy-policy/', $today, 'yearly', '0.3');
$add('/terms-and-conditions/', $today, 'yearly', '0.3');

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
  <url>
    <loc><?= e($url['loc']) ?></loc>
    <lastmod><?= e($url['lastmod']) ?></lastmod>
    <changefreq><?= e($url['changefreq']) ?></changefreq>
    <priority><?= e($url['priority']) ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
