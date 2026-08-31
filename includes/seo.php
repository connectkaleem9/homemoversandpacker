<?php
/**
 * SEO metadata system.
 *
 * A page sets its metadata with seo_set([...]) before including header.php.
 * The header then renders title, description, canonical, robots, Open Graph
 * and Twitter tags from that single definition — every indexable page ends up
 * with unique metadata and nothing is hardcoded twice.
 */

declare(strict_types=1);

/** Internal store for the current page's SEO definition. */
function &seo_store(): array
{
    static $seo = [
        'title'       => '',
        'description' => '',
        'h1'          => '',
        'path'        => '',     // site-relative path used for the canonical URL
        'canonical'   => '',     // explicit override, if ever needed
        'robots'      => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
        'og_type'     => 'website',
        'og_title'    => '',
        'og_desc'     => '',
        'og_image'    => '/assets/images/og-default.svg',
        'breadcrumbs' => [],
        'schema'      => [],     // extra JSON-LD graph nodes for this page
        'published'   => '',
        'modified'    => '',
    ];
    return $seo;
}

function seo_set(array $values): void
{
    $seo = &seo_store();
    foreach ($values as $key => $value) {
        $seo[$key] = $value;
    }
}

function seo_get(string $key, $default = null)
{
    $seo = &seo_store();
    return $seo[$key] ?? $default;
}

/** Full canonical URL for the current page. */
function seo_canonical(): string
{
    $explicit = seo_get('canonical', '');
    if ($explicit !== '') {
        return $explicit;
    }
    return canonical(seo_get('path', '/'));
}

/**
 * Page <title>.
 *
 * The brand is appended only when the result still fits inside the ~60
 * characters Google renders. Past that the suffix is not branding, it is
 * an ellipsis — so a keyword-rich title keeps the space instead.
 */
const SEO_TITLE_MAX = 60;

function seo_title(): string
{
    $title = trim((string) seo_get('title', ''));
    if ($title === '') {
        return SITE_NAME . ' | ' . SITE_TAGLINE;
    }
    if (stripos($title, SITE_NAME) !== false) {
        return $title;
    }

    $branded = $title . ' | ' . SITE_NAME;
    return mb_strlen($branded) <= SEO_TITLE_MAX ? $branded : $title;
}

function seo_description(): string
{
    return trim((string) seo_get('description', ''));
}

/** Render every metadata tag for the current page. */
function seo_render_meta(): string
{
    $out  = '';
    $desc = seo_description();
    $url  = seo_canonical();

    $out .= '  <title>' . e(seo_title()) . '</title>' . PHP_EOL;
    if ($desc !== '') {
        $out .= '  <meta name="description" content="' . e($desc) . '">' . PHP_EOL;
    }
    $out .= '  <meta name="robots" content="' . e((string) seo_get('robots')) . '">' . PHP_EOL;
    $out .= '  <link rel="canonical" href="' . e($url) . '">' . PHP_EOL;

    /*
     * hreflang. Every indexable page exists in both languages at the same
     * path, one with the /ar prefix, so the alternates are derived rather
     * than maintained by hand. x-default points at English.
     */
    if (seo_get('robots') && !str_contains((string) seo_get('robots'), 'noindex')) {
        $base = rtrim(CANONICAL_BASE, '/');
        $path = url((string) seo_get('path', '/'));
        foreach (array_keys(LANGUAGES) as $altLang) {
            $out .= '  <link rel="alternate" hreflang="' . e(LANGUAGES[$altLang]['locale'])
                  . '" href="' . e($base . lang_url($path, $altLang)) . '">' . PHP_EOL;
        }
        $out .= '  <link rel="alternate" hreflang="x-default" href="'
              . e($base . lang_url($path, DEFAULT_LANG)) . '">' . PHP_EOL;
    }

    /* Open Graph */
    $ogTitle = seo_get('og_title') ?: seo_title();
    $ogDesc  = seo_get('og_desc') ?: $desc;
    $ogImage = rtrim(CANONICAL_BASE, '/') . (string) seo_get('og_image');

    $out .= '  <meta property="og:type" content="' . e((string) seo_get('og_type')) . '">' . PHP_EOL;
    $out .= '  <meta property="og:site_name" content="' . e(SITE_NAME) . '">' . PHP_EOL;
    $out .= '  <meta property="og:locale" content="' . e(str_replace('-', '_', lang_locale())) . '">' . PHP_EOL;
    $out .= '  <meta property="og:locale:alternate" content="'
          . e(str_replace('-', '_', LANGUAGES[other_lang()]['locale'])) . '">' . PHP_EOL;
    $out .= '  <meta property="og:title" content="' . e($ogTitle) . '">' . PHP_EOL;
    if ($ogDesc !== '') {
        $out .= '  <meta property="og:description" content="' . e($ogDesc) . '">' . PHP_EOL;
    }
    $out .= '  <meta property="og:url" content="' . e($url) . '">' . PHP_EOL;
    $out .= '  <meta property="og:image" content="' . e($ogImage) . '">' . PHP_EOL;

    /* Twitter / X */
    $out .= '  <meta name="twitter:card" content="summary_large_image">' . PHP_EOL;
    $out .= '  <meta name="twitter:title" content="' . e($ogTitle) . '">' . PHP_EOL;
    if ($ogDesc !== '') {
        $out .= '  <meta name="twitter:description" content="' . e($ogDesc) . '">' . PHP_EOL;
    }
    $out .= '  <meta name="twitter:image" content="' . e($ogImage) . '">' . PHP_EOL;

    /* Article timestamps, when the page is a blog post */
    if (seo_get('published')) {
        $out .= '  <meta property="article:published_time" content="' . e((string) seo_get('published')) . '">' . PHP_EOL;
    }
    if (seo_get('modified')) {
        $out .= '  <meta property="article:modified_time" content="' . e((string) seo_get('modified')) . '">' . PHP_EOL;
    }

    return $out;
}
