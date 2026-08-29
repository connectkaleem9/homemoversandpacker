<?php
/**
 * Shared helpers: escaping, data access, URL building and reusable UI partials.
 * Every page loads this (via bootstrap.php) before rendering anything.
 */

declare(strict_types=1);

/* ------------------------------------------------------------------
 | Output escaping
 | ------------------------------------------------------------------ */

/** Escape for HTML text and attribute contexts. */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Escape for a JSON-LD script block (prevents </script> breakouts). */
function json_ld(array $data): string
{
    $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return str_replace(['<', '>', '&'], ['<', '>', '&'], (string) $json);
}

/* ------------------------------------------------------------------
 | Data access
 | ------------------------------------------------------------------ */

function all_services(): array
{
    static $services = null;
    if ($services === null) {
        $services = require __DIR__ . '/data/services.php';
    }
    return $services;
}

function all_locations(): array
{
    static $locations = null;
    if ($locations === null) {
        $locations = require __DIR__ . '/data/locations.php';
    }
    return $locations;
}

function all_posts(): array
{
    static $posts = null;
    if ($posts === null) {
        $posts = require __DIR__ . '/data/blog.php';
    }
    return $posts;
}

function get_service(string $slug): ?array
{
    $services = all_services();
    if (!isset($services[$slug])) {
        return null;
    }
    return $services[$slug] + ['slug' => $slug];
}

function get_location(string $slug): ?array
{
    $locations = all_locations();
    if (!isset($locations[$slug])) {
        return null;
    }
    return $locations[$slug] + ['slug' => $slug];
}

function get_post(string $slug): ?array
{
    $posts = all_posts();
    if (!isset($posts[$slug])) {
        return null;
    }
    return $posts[$slug] + ['slug' => $slug];
}

/* ------------------------------------------------------------------
 | URLs — always trailing-slash, never exposing .php
 | ------------------------------------------------------------------ */

function url(string $path = ''): string
{
    $path = '/' . ltrim($path, '/');
    if ($path !== '/' && !str_ends_with($path, '/') && !str_contains(basename($path), '.')) {
        $path .= '/';
    }
    return $path;
}

function service_url(string $slug): string
{
    return '/services/' . $slug . '/';
}

function location_url(string $slug): string
{
    return '/locations/' . $slug . '/';
}

function post_url(string $slug): string
{
    return '/blog/' . $slug . '/';
}

function canonical(string $path): string
{
    return rtrim(CANONICAL_BASE, '/') . url($path);
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/') . '?v=' . ASSET_VERSION;
}

/** True when $path matches the current request path (for nav highlighting). */
function is_current(string $path): bool
{
    $current = rtrim(strtok($_SERVER['REQUEST_URI'] ?? '/', '?'), '/') ?: '/';
    $target  = rtrim($path, '/') ?: '/';
    return $current === $target;
}

/** True when the current request sits underneath $path. */
function is_section(string $path): bool
{
    $current = rtrim(strtok($_SERVER['REQUEST_URI'] ?? '/', '?'), '/') ?: '/';
    $target  = rtrim($path, '/');
    return $target !== '' && str_starts_with($current, $target);
}

/* ------------------------------------------------------------------
 | Conversion links
 | ------------------------------------------------------------------ */

/** Build a WhatsApp deep link with a short, contextual pre-filled message. */
function whatsapp_url(string $message = ''): string
{
    $message = $message !== '' ? $message : 'Hello, I need a moving quote.';
    return WHATSAPP_BASE . '?text=' . rawurlencode($message);
}

/* ------------------------------------------------------------------
 | CSRF
 | ------------------------------------------------------------------ */

function start_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
        'path'     => '/',
    ]);
    session_start();
}

function csrf_token(): string
{
    start_session();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_verify(?string $token): bool
{
    start_session();
    return !empty($_SESSION['csrf_token'])
        && is_string($token)
        && hash_equals($_SESSION['csrf_token'], $token);
}

/* ------------------------------------------------------------------
 | Misc
 | ------------------------------------------------------------------ */

function excerpt(string $text, int $length = 160): string
{
    $text = trim(preg_replace('/\s+/', ' ', strip_tags($text)) ?? '');
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    $cut = mb_substr($text, 0, $length);
    $pos = mb_strrpos($cut, ' ');
    return rtrim($pos !== false ? mb_substr($cut, 0, $pos) : $cut, ' ,.;:') . '…';
}

/** Human sentence listing the service areas: "Dubai, Sharjah and Ajman". */
function areas_sentence(): string
{
    $areas = AREAS_SERVED;
    $last  = array_pop($areas);
    return implode(', ', $areas) . ' and ' . $last;
}

/* ------------------------------------------------------------------
 | Reusable UI partials
 | ------------------------------------------------------------------ */

/**
 * Inline SVG icon set — no icon font, no external requests, no layout shift.
 */
function icon(string $name, string $class = 'icon'): string
{
    $paths = [
        'home'      => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M9.5 21v-6h5v6"/>',
        'sofa'      => '<path d="M4 11V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3"/><path d="M2 12.5a2 2 0 0 1 4 0V16h12v-3.5a2 2 0 0 1 4 0V19H2z"/><path d="M6 16h12"/>',
        'building'  => '<path d="M4 21V4a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v17"/><path d="M15 21V9h4a1 1 0 0 1 1 1v11"/><path d="M2 21h20"/><path d="M8 7h3M8 11h3M8 15h3"/>',
        'apartment' => '<path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/><path d="M3 21h18"/><path d="M9 7h2M13 7h2M9 11h2M13 11h2M9 15h2M13 15h2"/><path d="M10.5 21v-3h3v3"/>',
        'villa'     => '<path d="M2 11 12 3l10 8"/><path d="M5 10v11h14V10"/><path d="M9 21v-5h6v5"/><path d="M9 12.5h2M13 12.5h2"/>',
        'storage'   => '<path d="M3 8 12 4l9 4v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z"/><path d="M8 20v-6h8v6"/><path d="M8 11h8"/>',
        'box'       => '<path d="M12 3 3 7.5V17l9 4.5 9-4.5V7.5z"/><path d="m3 7.5 9 4.5 9-4.5"/><path d="M12 12v9.5"/>',
        'shop'      => '<path d="M3 9.5 4.5 4h15L21 9.5"/><path d="M3 9.5a2.5 2.5 0 0 0 5 0 2.5 2.5 0 0 0 4 0 2.5 2.5 0 0 0 4 0 2.5 2.5 0 0 0 5 0"/><path d="M5 12v9h14v-9"/><path d="M10 21v-5h4v5"/>',
        'tools'     => '<path d="M14.5 5.5a3.5 3.5 0 0 0 4.6 4.6L21 12l-9 9-3-3 9-9z"/><path d="m6.5 6.5 3 3"/><path d="M3 8.5 8.5 3l2.5 2.5L5.5 11z"/>',
        'truck'     => '<path d="M2 6h11v11H2z"/><path d="M13 9h4.5l3.5 3.5V17h-8z"/><circle cx="7" cy="18.5" r="1.8"/><circle cx="17" cy="18.5" r="1.8"/>',
        'route'     => '<circle cx="6" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><path d="M8.5 6H14a3.5 3.5 0 0 1 0 7h-4a3.5 3.5 0 0 0 0 7h5.5"/>',
        'car'       => '<path d="M4 16v2.5M20 16v2.5"/><path d="M3 16v-3.5L5 8h14l2 4.5V16z"/><path d="M5.5 8 6.5 5h11l1 3"/><circle cx="7.5" cy="13" r="1"/><circle cx="16.5" cy="13" r="1"/>',
        'phone'     => '<path d="M6.5 3h3l1.5 4-2 1.5a12 12 0 0 0 6.5 6.5L17 13l4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 4 7.2 2 2 0 0 1 6 5z"/>',
        'whatsapp'  => '<path d="M3.5 20.5 5 16.2A8.2 8.2 0 1 1 8 19.2z"/><path d="M9 9.2c.3 2.2 2.4 4.4 4.7 4.9l1-1.3 2 .9v1.4c-2.6.4-6.5-2.4-7.6-5.4z" fill="currentColor" stroke="none"/>',
        'check'     => '<path d="m4.5 12.5 5 5 10-11"/>',
        'star'      => '<path d="M12 3.5 14.6 9l6 .9-4.3 4.2 1 6-5.3-2.8L6.7 20l1-6L3.4 9.9l6-.9z"/>',
        'clock'     => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5.5l3.5 2"/>',
        'shield'    => '<path d="M12 3 5 6v5.5c0 4.3 2.9 8.1 7 9.5 4.1-1.4 7-5.2 7-9.5V6z"/><path d="m9 12 2 2 4-4"/>',
        'pin'       => '<path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/>',
        'arrow'     => '<path d="M5 12h13"/><path d="m12.5 6 6 6-6 6"/>',
        'quote'     => '<path d="M5 4h14v13H8l-3 3z"/><path d="M9 9h6M9 12.5h4"/>',
        'mail'      => '<path d="M3 6h18v12H3z"/><path d="m3 7 9 6 9-6"/>',
        'users'     => '<circle cx="9" cy="8" r="3"/><path d="M3 20a6 6 0 0 1 12 0"/><path d="M16 5.5a3 3 0 0 1 0 5.5"/><path d="M17.5 14.5A6 6 0 0 1 21 20"/>',
    ];

    $body = $paths[$name] ?? $paths['check'];

    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
        . 'stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . $body . '</svg>';
}

/** Phone call-to-action button. */
function cta_phone(string $style = 'btn btn-phone', string $label = ''): string
{
    $label = $label !== '' ? $label : 'Call ' . PHONE_DISPLAY;
    return '<a href="' . PHONE_LINK . '" class="' . e($style) . ' js-track" data-cta="phone" id="phone-cta" '
        . 'aria-label="Call ' . e(PHONE_INTL) . '">' . icon('phone', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** WhatsApp call-to-action button with a contextual message. */
function cta_whatsapp(string $message = '', string $style = 'btn btn-whatsapp', string $label = 'WhatsApp Us'): string
{
    return '<a href="' . e(whatsapp_url($message)) . '" class="' . e($style) . ' js-track" data-cta="whatsapp" '
        . 'id="whatsapp-cta" target="_blank" rel="noopener" aria-label="Message us on WhatsApp">'
        . icon('whatsapp', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** Quote call-to-action button pointing at the quote form. */
function cta_quote(string $style = 'btn btn-primary', string $label = 'Get a Free Moving Quote', string $href = '#quote'): string
{
    return '<a href="' . e($href) . '" class="' . e($style) . ' js-track" data-cta="quote" id="quote-cta">'
        . icon('quote', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** Service card used on the homepage grid, service index and related lists. */
function service_card(string $slug, array $service): string
{
    $html  = '<a class="card card-service" href="' . e(service_url($slug)) . '">';
    $html .= '<span class="card-icon">' . icon($service['icon'] ?? 'check', 'icon') . '</span>';
    $html .= '<h3 class="card-title">' . e($service['name']) . '</h3>';
    $html .= '<p class="card-text">' . e($service['short']) . '</p>';
    $html .= '<span class="card-link">Learn more ' . icon('arrow', 'icon icon-sm') . '</span>';
    $html .= '</a>';
    return $html;
}

/** Location card used on the homepage and locations index. */
function location_card(string $slug, array $location): string
{
    $html  = '<a class="card card-location" href="' . e(location_url($slug)) . '">';
    $html .= '<span class="card-icon">' . icon('pin', 'icon') . '</span>';
    $html .= '<h3 class="card-title">Movers in ' . e($location['name']) . '</h3>';
    $html .= '<p class="card-text">' . e($location['short']) . '</p>';
    $html .= '<span class="card-link">View ' . e($location['name']) . ' page ' . icon('arrow', 'icon icon-sm') . '</span>';
    $html .= '</a>';
    return $html;
}

/**
 * Accessible FAQ list. Uses native <details> so it works without JavaScript
 * and stays crawlable — the visible text always matches the FAQPage schema.
 */
function faq_list(array $faqs, string $heading = 'Frequently asked questions'): string
{
    if ($faqs === []) {
        return '';
    }
    $html  = '<section class="section section-faq" aria-labelledby="faq-heading">';
    $html .= '<div class="container container-narrow">';
    $html .= '<h2 class="section-title" id="faq-heading">' . e($heading) . '</h2>';
    $html .= '<div class="faq-list">';
    foreach ($faqs as $i => $faq) {
        $html .= '<details class="faq-item"' . ($i === 0 ? ' open' : '') . '>';
        $html .= '<summary class="faq-question">' . e($faq['q']) . '</summary>';
        $html .= '<div class="faq-answer"><p>' . e($faq['a']) . '</p></div>';
        $html .= '</details>';
    }
    $html .= '</div></div></section>';
    return $html;
}

/** Related services strip. */
function related_services(array $slugs, string $heading = 'Related services'): string
{
    $services = all_services();
    $cards    = '';
    foreach ($slugs as $slug) {
        if (isset($services[$slug])) {
            $cards .= service_card($slug, $services[$slug]);
        }
    }
    if ($cards === '') {
        return '';
    }
    return '<section class="section section-related"><div class="container">'
        . '<h2 class="section-title">' . e($heading) . '</h2>'
        . '<div class="grid grid-4">' . $cards . '</div>'
        . '</div></section>';
}

/** Related locations strip. */
function related_locations(string $heading = 'Areas we cover'): string
{
    $cards = '';
    foreach (all_locations() as $slug => $location) {
        $cards .= location_card($slug, $location);
    }
    return '<section class="section section-related"><div class="container">'
        . '<h2 class="section-title">' . e($heading) . '</h2>'
        . '<div class="grid grid-3">' . $cards . '</div>'
        . '</div></section>';
}
