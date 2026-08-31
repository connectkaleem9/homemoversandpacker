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
require_once __DIR__ . '/includes/content.php';

header('Content-Type: application/xml; charset=UTF-8');

$today = date('Y-m-d');

/**
 * Every page exists in both languages at the same path, one with the /ar
 * prefix. Each entry is listed once per language with xhtml:link alternates
 * pointing at the other, which is what Google asks for on a bilingual site.
 *
 * @var array<int, array{loc: string, lastmod: string, changefreq: string, priority: string, alternates: array<string, string>}> $urls
 */
$urls = [];

$add = static function (string $path, string $lastmod, string $changefreq, string $priority) use (&$urls): void {
    $alternates = [];
    foreach (array_keys(LANGUAGES) as $altLang) {
        $alternates[LANGUAGES[$altLang]['locale']] = canonical($path, $altLang);
    }

    foreach (array_keys(LANGUAGES) as $urlLang) {
        $urls[] = [
            'loc'        => canonical($path, $urlLang),
            'lastmod'    => $lastmod,
            'changefreq' => $changefreq,
            'priority'   => $priority,
            'alternates' => $alternates,
        ];
    }
};

/* Core pages */
$add('/', $today, 'weekly', '1.0');
$add('/services/', $today, 'monthly', '0.9');
$add('/locations/', $today, 'monthly', '0.9');
$add('/about-us/', $today, 'yearly', '0.6');
$add('/contact-us/', $today, 'monthly', '0.8');
$add('/blog/', $today, 'weekly', '0.7');
$add('/projects/', $today, 'weekly', '0.8');
$add('/reviews/', $today, 'weekly', '0.7');

/* Service landing pages — the primary commercial targets.
   The slugs are identical in both languages, so one loop covers both. */
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

/* Project pages — created in the admin dashboard, so this list is whatever
   is published right now rather than a fixed set. */
foreach (all_projects() as $project) {
    $add(
        '/projects/' . $project['slug'] . '/',
        substr((string) ($project['updated_at'] ?? $project['created_at'] ?? $today), 0, 10),
        'yearly',
        '0.6'
    );
}

/* Legal pages */
$add('/privacy-policy/', $today, 'yearly', '0.3');
$add('/terms-and-conditions/', $today, 'yearly', '0.3');

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($urls as $url): ?>
  <url>
    <loc><?= e($url['loc']) ?></loc>
    <lastmod><?= e($url['lastmod']) ?></lastmod>
    <changefreq><?= e($url['changefreq']) ?></changefreq>
    <priority><?= e($url['priority']) ?></priority>
<?php foreach ($url['alternates'] as $altLocale => $altUrl): ?>
    <xhtml:link rel="alternate" hreflang="<?= e($altLocale) ?>" href="<?= e($altUrl) ?>"/>
<?php endforeach; ?>
    <xhtml:link rel="alternate" hreflang="x-default" href="<?= e($url['alternates'][LANGUAGES[DEFAULT_LANG]['locale']]) ?>"/>
  </url>
<?php endforeach; ?>
</urlset>
