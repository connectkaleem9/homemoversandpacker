<?php
/**
 * Local development router for PHP's built-in server.
 *
 *   php -S localhost:8000 router.php
 *
 * The built-in server ignores .htaccess, so this reproduces the same clean-URL
 * mapping locally. It is NOT used on Apache or LiteSpeed — there, .htaccess
 * does this job — and it is harmless if uploaded.
 */

declare(strict_types=1);

$root = __DIR__;
$uri  = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$uri  = rawurldecode($uri);
$path = '/' . trim($uri, '/');

/*
 * Arabic lives at /ar/... but is served by the same files. Strip the prefix
 * before resolving; includes/i18n.php reads the language back out of
 * REQUEST_URI, which is untouched by this. Mirrors rule 5 in .htaccess.
 */
if (preg_match('#^/ar(/|$)#', $path) === 1) {
    $path = substr($path, 3);
    $path = $path === '' ? '/' : $path;
}

/* Project pages have no file on disk — the slugs come from the dashboard.
   Mirrors rule 6 in .htaccess. */
if (preg_match('#^/projects/[a-z0-9][a-z0-9-]*/?$#', $path) === 1) {
    require $root . '/projects/project.php';
    return true;
}

/* Block the paths .htaccess denies, so local behaviour matches production. */
if (preg_match('#^/(storage|database|includes)(/|$)#', $path)) {
    http_response_code(404);
    require $root . '/404.php';
    return true;
}

/* Serve real files (assets, robots.txt, ...) straight from disk. */
$file = $root . $path;
if ($path !== '/' && is_file($file)) {
    return false;
}

/* /sitemap.xml -> sitemap.php */
if ($path === '/sitemap.xml') {
    require $root . '/sitemap.php';
    return true;
}

/* Root */
if ($path === '/') {
    require $root . '/index.php';
    return true;
}

/* Directory index: /services/ -> services/index.php */
if (is_file($root . $path . '/index.php')) {
    require $root . $path . '/index.php';
    return true;
}

/* Clean URL: /services/villa-movers/ -> services/villa-movers.php */
if (is_file($root . $path . '.php')) {
    require $root . $path . '.php';
    return true;
}

/* Form endpoints and any other direct .php request */
if (str_ends_with($path, '.php') && is_file($root . $path)) {
    require $root . $path;
    return true;
}

http_response_code(404);
require $root . '/404.php';
return true;
