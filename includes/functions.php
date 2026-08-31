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

/**
 * Escape for a JSON-LD script block (prevents </script> breakouts).
 * Pretty-printed locally so the graph is readable while developing, minified
 * in production where it is markup weight on every single page.
 */
function json_ld(array $data): string
{
    $flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
    if (APP_DEBUG) {
        $flags |= JSON_PRETTY_PRINT;
    }
    $json = json_encode($data, $flags);
    return str_replace(['<', '>', '&'], ['<', '>', '&'], (string) $json);
}

/* ------------------------------------------------------------------
 | Data access
 | ------------------------------------------------------------------ */

function all_services(): array
{
    static $services = [];
    return $services[lang()] ??= lang_data('services');
}

function all_locations(): array
{
    static $locations = [];
    return $locations[lang()] ??= lang_data('locations');
}

function all_posts(): array
{
    static $posts = [];
    return $posts[lang()] ??= lang_data('blog');
}

/**
 * Real customer reviews only. Ships empty; the homepage section and the
 * Review/AggregateRating schema both stay hidden until genuine reviews are
 * added. See includes/data/testimonials.php.
 */
function all_testimonials(): array
{
    static $testimonials = null;

    if ($testimonials !== null) {
        return $testimonials;
    }

    /*
     * Reviews approved in the admin dashboard are the real source now. The
     * hand-written file stays as a fallback so anything added there before the
     * dashboard existed is not silently dropped; approved submissions come
     * first because they are the newer, verifiable ones.
     */
    require_once __DIR__ . '/content.php';

    $fromFile = array_values(array_filter(
        require __DIR__ . '/data/testimonials.php',
        static fn ($t): bool => is_array($t) && !empty($t['quote']) && !empty($t['name'])
    ));

    return $testimonials = array_merge(approved_reviews(), $fromFile);
}

/**
 * Placeholder reviews, shown ONLY on a local development server so the design
 * of the section can be seen while it is being built.
 *
 * These are never served in production: reviews_for_display() refuses to return
 * them once APP_ENV is 'production', and no Review or AggregateRating schema is
 * ever emitted from them. Replace them with real customer reviews in
 * includes/data/testimonials.php and they stop being used entirely.
 */
function example_testimonials(): array
{
    $cities = array_values(areas_list());
    $cards  = [];

    foreach ([1, 2, 3] as $n) {
        $cards[] = [
            'quote'  => t('example.quote' . $n),
            'name'   => t('example.name'),
            'city'   => $cities[$n - 1] ?? '',
            'rating' => 5,
            'date'   => '2026-01-' . str_pad((string) (10 + $n * 2), 2, '0', STR_PAD_LEFT),
            'photo'  => '',
            'source' => t('example.source'),
        ];
    }

    return $cards;
}

/**
 * What the reviews section should render.
 *
 * Returns ['reviews' => [...], 'is_example' => bool]. Real reviews always win.
 * With none, a local server shows the examples so the design is visible, and
 * production shows nothing at all.
 */
function reviews_for_display(): array
{
    $real = all_testimonials();
    if ($real !== []) {
        return ['reviews' => $real, 'is_example' => false];
    }
    if (APP_ENV !== 'production') {
        return ['reviews' => example_testimonials(), 'is_example' => true];
    }
    return ['reviews' => [], 'is_example' => false];
}

/** Initials fallback for a reviewer with no photo. */
function initials(string $name): string
{
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $out = '';
    foreach (array_slice($parts, 0, 2) as $part) {
        $out .= mb_strtoupper(mb_substr($part, 0, 1));
    }
    return $out !== '' ? $out : '?';
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
    return lang_url('/services/' . $slug . '/');
}

function location_url(string $slug): string
{
    return lang_url('/locations/' . $slug . '/');
}

function post_url(string $slug): string
{
    return lang_url('/blog/' . $slug . '/');
}

/**
 * Absolute canonical URL. $path is language-neutral; the current language's
 * prefix is applied here so each language canonicalises to its own URL.
 */
function canonical(string $path, ?string $forLang = null): string
{
    return rtrim(CANONICAL_BASE, '/') . lang_url(url($path), $forLang);
}

function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/') . '?v=' . ASSET_VERSION;
}

/* ------------------------------------------------------------------
 | Images
 |
 | Photography is dropped into /assets/images/ by the business (see the
 | README in that folder). Until a file is there, we render a styled
 | placeholder rather than a broken image, so the layout is correct from
 | day one and fills in as real photos arrive.
 | ------------------------------------------------------------------ */

/**
 * Resolve an image path to a file that actually exists.
 *
 * The requested name wins, so dropping in a real photo immediately replaces
 * the artwork. Falls back through the other web formats and finally to the
 * bundled .svg illustration, which is what ships until real photography
 * arrives. Returns null when nothing is available.
 */
function image_resolve(string $path): ?string
{
    $path = ltrim($path, '/');
    $base = preg_replace('/\.[a-zA-Z0-9]+$/', '', $path) ?? $path;

    foreach ([$path, $base . '.webp', $base . '.avif', $base . '.jpg', $base . '.png', $base . '.svg'] as $candidate) {
        $file = APP_ROOT . '/assets/images/' . $candidate;
        if (is_file($file) && filesize($file) > 0) {
            return $candidate;
        }
    }
    return null;
}

/** True when an image is available for this slot (in any supported format). */
function image_exists(string $path): bool
{
    return image_resolve($path) !== null;
}

/** URL for an image in /assets/images/, cache-busted. */
function image_url(string $path): string
{
    return asset('images/' . ltrim(image_resolve($path) ?? $path, '/'));
}

/**
 * Render an image, or a placeholder if it has not been supplied yet.
 *
 * $opts: width, height, class, loading ('lazy'|'eager'), fetchpriority, sizes, icon
 * Width and height are always emitted so the browser reserves the space —
 * that is what keeps Cumulative Layout Shift at zero.
 */
function img(string $path, string $alt, array $opts = []): string
{
    $width  = (int) ($opts['width'] ?? 800);
    $height = (int) ($opts['height'] ?? 600);
    $class  = (string) ($opts['class'] ?? '');
    $load   = (string) ($opts['loading'] ?? 'lazy');
    $icon   = (string) ($opts['icon'] ?? 'truck');

    if (image_exists($path)) {
        $attrs = 'src="' . e(image_url($path)) . '" alt="' . e($alt) . '"'
            . ' width="' . $width . '" height="' . $height . '"'
            . ' loading="' . e($load) . '" decoding="async"';
        if (!empty($opts['fetchpriority'])) {
            $attrs .= ' fetchpriority="' . e((string) $opts['fetchpriority']) . '"';
        }
        if ($class !== '') {
            $attrs .= ' class="' . e($class) . '"';
        }
        return '<img ' . $attrs . '>';
    }

    /* Placeholder — proportional, never a broken-image icon. */
    $ratio = $width > 0 ? ($height / $width) * 100 : 75;
    $hint  = APP_DEBUG
        ? '<span class="img-placeholder-hint">assets/images/' . e($path) . '</span>'
        : '';

    return '<div class="img-placeholder ' . e($class) . '" role="img" aria-label="' . e($alt) . '"'
        . ' style="padding-bottom:' . round($ratio, 3) . '%">'
        . '<span class="img-placeholder-inner">' . icon($icon, 'icon icon-lg') . $hint . '</span>'
        . '</div>';
}

/**
 * True when $path matches the current request path (for nav highlighting).
 * Both sides are compared with the language prefix removed, so /ar/services/
 * highlights the same nav item as /services/.
 */
function is_current(string $path): bool
{
    $current = rtrim(current_path(), '/') ?: '/';
    $target  = rtrim(preg_replace('#^/ar(?=/|$)#', '', $path) ?? $path, '/') ?: '/';
    return $current === $target;
}

/** True when the current request sits underneath $path. */
function is_section(string $path): bool
{
    $current = rtrim(current_path(), '/') ?: '/';
    $target  = rtrim(preg_replace('#^/ar(?=/|$)#', '', $path) ?? $path, '/');
    return $target !== '' && str_starts_with($current, $target);
}

/* ------------------------------------------------------------------
 | Conversion links
 | ------------------------------------------------------------------ */

/** Build a WhatsApp deep link with a short, contextual pre-filled message. */
function whatsapp_url(string $message = ''): string
{
    $message = $message !== '' ? $message : t('wa.default');
    return WHATSAPP_BASE . '?text=' . rawurlencode($message);
}

/* ------------------------------------------------------------------
 | Input
 | ------------------------------------------------------------------ */

/**
 * Trim, collapse runs of spaces and strip control characters from user input.
 *
 * Not lead-specific, despite where it used to live: the admin dashboard
 * sanitises its own fields with it too, and making it reach for the whole lead
 * pipeline to get one string helper is what made the dashboard fatal on an
 * undefined function.
 */
function lead_clean(?string $value, int $max = 255): string
{
    $value = (string) ($value ?? '');
    $value = preg_replace('/[ --]/u', '', $value) ?? '';
    $value = trim(preg_replace('/[ 	]+/', ' ', $value) ?? '');

    return mb_substr($value, 0, $max);
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

/**
 * The service-area city names, in the current language.
 *
 * Taken from the locations data rather than the AREAS_SERVED constant, so the
 * Arabic pages read Arabic city names. The constant stays the fallback and is
 * still what the structured data uses, where English is correct.
 */
function areas_list(): array
{
    $names = array_column(all_locations(), 'name');
    return $names !== [] ? $names : AREAS_SERVED;
}

/** Human sentence listing the service areas: "Dubai, Sharjah and Ajman". */
function areas_sentence(): string
{
    $areas = areas_list();
    $last  = array_pop($areas);

    return $areas === []
        ? (string) $last
        : implode(t('misc.list_sep'), $areas) . t('misc.list_and') . $last;
}

/** The business address as it should read on the page, in the current language. */
function business_address(): string
{
    return t('misc.address');
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
        'headset'   => '<path d="M4 13v-1a8 8 0 0 1 16 0v1"/><path d="M4 13h2.5a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1z"/><path d="M20 13h-2.5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1H19a1 1 0 0 0 1-1z"/><path d="M20 19v.5a2.5 2.5 0 0 1-2.5 2.5H13"/>',
        'clipboard' => '<path d="M9 4h6v3H9z"/><path d="M15 5.5h2.5A1.5 1.5 0 0 1 19 7v12.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 5 19.5V7a1.5 1.5 0 0 1 1.5-1.5H9"/><path d="M8.5 11h7M8.5 14.5h7M8.5 18h4"/>',
        'sparkle'   => '<path d="M12 3.5 13.7 9l5.5 1.7-5.5 1.8L12 18l-1.7-5.5L4.8 10.7 10.3 9z"/><path d="M18.5 3.5 19 5l1.5.5L19 6l-.5 1.5L18 6l-1.5-.5L18 5z"/>',
        'globe'     => '<circle cx="12" cy="12" r="9"/><path d="M3.2 9.5h17.6M3.2 14.5h17.6"/><path d="M12 3a14 14 0 0 1 0 18 14 14 0 0 1 0-18z"/>',
        'facebook'  => '<path d="M14.5 8.5V6.8c0-.7.5-1.3 1.2-1.3h1.6V2.6h-2.4c-2.2 0-3.6 1.5-3.6 3.8v2.1H8.7v3.1h2.6V21h3.2v-9.4h2.5l.4-3.1z" fill="currentColor" stroke="none"/>',
        'instagram' => '<rect x="3.5" y="3.5" width="17" height="17" rx="4.6"/><circle cx="12" cy="12" r="3.9"/><circle cx="17.1" cy="6.9" r="1.1" fill="currentColor" stroke="none"/>',
        'youtube'   => '<rect x="2.5" y="5.5" width="19" height="13" rx="3.6"/><path d="m10.3 9.4 5 2.6-5 2.6z" fill="currentColor" stroke="none"/>',
        'tiktok'    => '<path d="M15 3.5c.4 2.2 1.8 3.5 3.9 3.7v2.7c-1.4.1-2.7-.3-3.9-1.1v5.6a5.4 5.4 0 1 1-4.6-5.3v2.9a2.5 2.5 0 1 0 1.8 2.4V3.5z" fill="currentColor" stroke="none"/>',
    ];

    $body = $paths[$name] ?? $paths['check'];

    /* The arrow is the one icon whose meaning is directional — rtl.css
       mirrors it in Arabic, and needs a hook to select it by. */
    if ($name === 'arrow') {
        $class .= ' icon-arrow';
    }

    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
        . 'stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
        . $body . '</svg>';
}

/**
 * Google Ads conversion tracking wants a stable ID per CTA type, but a page
 * carries several of each — and repeating an id is invalid HTML that breaks
 * getElementById. So the first CTA of each type on the page gets the id, and
 * every one of them carries the .js-track class and data-cta attribute that
 * the click handler and GTM actually listen on.
 */
function cta_id(string $type): string
{
    static $used = [];
    if (isset($used[$type])) {
        return '';
    }
    $used[$type] = true;
    return ' id="' . e($type) . '-cta"';
}

/**
 * Hero media block.
 *
 * Two copies of the same photograph: a blurred, cover-fitted backdrop filling
 * the section, and the sharp `contain` copy on top which is never cropped.
 * Without the backdrop there is a hard vertical seam wherever the contained
 * image begins, and that edge moves with the viewport width, so no single
 * gradient stop can hide it.
 */
function hero_media(string $path, string $alt, array $opts = []): string
{
    $out = '<div class="hero-home-media">';

    if (image_exists($path)) {
        $out .= '<img class="hero-home-backdrop" src="' . e(image_url($path)) . '" alt=""'
             . ' aria-hidden="true" loading="' . e((string) ($opts['loading'] ?? 'eager')) . '" decoding="async">';
    }

    $out .= img($path, $alt, $opts);
    $out .= '</div>';

    return $out;
}

/**
 * Duotone service icons — solid navy shapes with gold accents, matching the
 * reference design. Separate from icon(): those are line icons used inline in
 * body copy, these are filled illustrations sized for the service cards.
 */
function service_icon(string $name, string $class = 'svc-icon'): string
{
    $N = '#0d2440';   // navy
    $G = '#f5b21d';   // gold
    $W = '#ffffff';

    $art = [
        'home' => '<path d="M24 6 6 20v22h36V20z" fill="' . $N . '"/>'
                . '<path d="M24 6 4 21h40z" fill="' . $G . '"/>'
                . '<rect x="18" y="26" width="12" height="16" rx="1.5" fill="' . $G . '"/>'
                . '<rect x="10" y="24" width="6" height="6" fill="' . $W . '"/>'
                . '<rect x="32" y="24" width="6" height="6" fill="' . $W . '"/>',

        'sofa' => '<path d="M8 20a4 4 0 0 1 4-4h24a4 4 0 0 1 4 4v6H8z" fill="' . $N . '"/>'
                . '<path d="M4 28a4 4 0 0 1 8 0v10H4z" fill="' . $N . '"/>'
                . '<path d="M36 28a4 4 0 0 1 8 0v10h-8z" fill="' . $N . '"/>'
                . '<rect x="10" y="24" width="28" height="14" rx="3" fill="' . $G . '"/>'
                . '<rect x="9" y="38" width="4" height="5" fill="' . $N . '"/>'
                . '<rect x="35" y="38" width="4" height="5" fill="' . $N . '"/>',

        'building' => '<rect x="8" y="8" width="20" height="34" fill="' . $N . '"/>'
                . '<rect x="28" y="18" width="13" height="24" fill="' . $G . '"/>'
                . '<g fill="' . $W . '"><rect x="12" y="13" width="5" height="5"/><rect x="20" y="13" width="5" height="5"/>'
                . '<rect x="12" y="22" width="5" height="5"/><rect x="20" y="22" width="5" height="5"/>'
                . '<rect x="12" y="31" width="5" height="5"/><rect x="20" y="31" width="5" height="5"/>'
                . '<rect x="32" y="23" width="5" height="5"/><rect x="32" y="32" width="5" height="5"/></g>',

        'apartment' => '<rect x="10" y="6" width="17" height="36" fill="' . $N . '"/>'
                . '<rect x="27" y="16" width="11" height="26" fill="' . $G . '"/>'
                . '<g fill="' . $W . '"><rect x="14" y="11" width="4" height="4"/><rect x="20" y="11" width="4" height="4"/>'
                . '<rect x="14" y="19" width="4" height="4"/><rect x="20" y="19" width="4" height="4"/>'
                . '<rect x="14" y="27" width="4" height="4"/><rect x="20" y="27" width="4" height="4"/>'
                . '<rect x="30" y="21" width="5" height="4"/><rect x="30" y="29" width="5" height="4"/></g>',

        'villa' => '<path d="M24 8 8 19v23h32V19z" fill="' . $N . '"/>'
                . '<path d="M24 8 5 20h38z" fill="' . $G . '"/>'
                . '<rect x="19" y="28" width="10" height="14" fill="' . $G . '"/>'
                . '<rect x="12" y="25" width="5" height="5" fill="' . $W . '"/>'
                . '<rect x="31" y="25" width="5" height="5" fill="' . $W . '"/>',

        'storage' => '<path d="M6 20 24 8l18 12v22H6z" fill="' . $N . '"/>'
                . '<rect x="14" y="26" width="20" height="16" fill="' . $G . '"/>'
                . '<g fill="' . $N . '" opacity=".35"><rect x="14" y="30" width="20" height="2"/>'
                . '<rect x="14" y="35" width="20" height="2"/></g>'
                . '<rect x="14" y="22" width="20" height="3" fill="' . $W . '"/>',

        'box' => '<path d="M24 12 6 19v18l18 7 18-7V19z" fill="' . $N . '"/>'
                . '<path d="M6 19 24 26l18-7-18-7z" fill="' . $G . '"/>'
                . '<path d="M24 26v18l18-7V19z" fill="' . $N . '" opacity=".72"/>'
                . '<path d="M15 8h6v8l-3-2-3 2z" fill="' . $G . '"/>',

        'shop' => '<path d="M8 12h32l3 9H5z" fill="' . $G . '"/>'
                . '<rect x="9" y="21" width="30" height="21" fill="' . $N . '"/>'
                . '<rect x="19" y="28" width="10" height="14" fill="' . $G . '"/>'
                . '<rect x="12" y="25" width="5" height="5" fill="' . $W . '"/>'
                . '<rect x="31" y="25" width="5" height="5" fill="' . $W . '"/>',

        'tools' => '<path d="M30 8a9 9 0 0 0 11 11l-3 4-12-12z" fill="' . $G . '"/>'
                . '<path d="m26 15 7 7L15 40a5 5 0 0 1-7-7z" fill="' . $N . '"/>'
                . '<circle cx="12" cy="36" r="2.4" fill="' . $W . '"/>',

        'truck' => '<rect x="4" y="14" width="24" height="18" rx="2" fill="' . $N . '"/>'
                . '<path d="M28 19h8l6 7v6H28z" fill="' . $G . '"/>'
                . '<rect x="4" y="27" width="38" height="4" fill="' . $G . '"/>'
                . '<circle cx="14" cy="36" r="5" fill="' . $N . '"/><circle cx="14" cy="36" r="2" fill="' . $W . '"/>'
                . '<circle cx="34" cy="36" r="5" fill="' . $N . '"/><circle cx="34" cy="36" r="2" fill="' . $W . '"/>',

        'route' => '<circle cx="12" cy="12" r="6" fill="' . $G . '"/><circle cx="12" cy="12" r="2.4" fill="' . $W . '"/>'
                . '<circle cx="36" cy="36" r="6" fill="' . $N . '"/><circle cx="36" cy="36" r="2.4" fill="' . $W . '"/>'
                . '<path d="M17 14h11a7 7 0 0 1 0 14h-8a7 7 0 0 0 0 14h11" stroke="' . $N . '" stroke-width="3.4" fill="none" stroke-linecap="round"/>',

        'car' => '<path d="M8 24 12 14h24l4 10z" fill="' . $G . '"/>'
                . '<rect x="5" y="24" width="38" height="11" rx="3" fill="' . $N . '"/>'
                . '<circle cx="14" cy="37" r="4.6" fill="' . $N . '"/><circle cx="14" cy="37" r="1.9" fill="' . $W . '"/>'
                . '<circle cx="34" cy="37" r="4.6" fill="' . $N . '"/><circle cx="34" cy="37" r="1.9" fill="' . $W . '"/>'
                . '<rect x="9" y="27" width="6" height="3" rx="1.5" fill="' . $W . '"/>'
                . '<rect x="33" y="27" width="6" height="3" rx="1.5" fill="' . $W . '"/>',
    ];

    $body = $art[$name] ?? $art['box'];

    return '<svg class="' . e($class) . '" viewBox="0 0 48 48" aria-hidden="true" focusable="false">'
        . $body . '</svg>';
}

/** Phone call-to-action button. */
function cta_phone(string $style = 'btn btn-phone', string $label = ''): string
{
    $label = $label !== '' ? $label : t('cta.call', ['phone' => PHONE_DISPLAY]);
    return '<a href="' . PHONE_LINK . '" class="' . e($style) . ' js-track" data-cta="phone"' . cta_id('phone')
        . ' aria-label="' . e(t('cta.call', ['phone' => PHONE_INTL])) . '">'
        . icon('phone', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** WhatsApp call-to-action button with a contextual message. */
function cta_whatsapp(string $message = '', string $style = 'btn btn-whatsapp', string $label = ''): string
{
    $label = $label !== '' ? $label : t('cta.whatsapp');
    return '<a href="' . e(whatsapp_url($message)) . '" class="' . e($style) . ' js-track" data-cta="whatsapp"'
        . cta_id('whatsapp') . ' target="_blank" rel="noopener" aria-label="' . e(t('foot.whatsapp_us')) . '">'
        . icon('whatsapp', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** Quote call-to-action button pointing at the quote form. */
function cta_quote(string $style = 'btn btn-primary', string $label = '', string $href = '#quote'): string
{
    $label = $label !== '' ? $label : t('cta.quote_long');
    return '<a href="' . e($href) . '" class="' . e($style) . ' js-track" data-cta="quote"' . cta_id('quote') . '>'
        . icon('quote', 'icon icon-sm') . '<span>' . e($label) . '</span></a>';
}

/** Service card used on the homepage grid, service index and related lists. */
function service_card(string $slug, array $service): string
{
    $html  = '<a class="card card-service" href="' . e(service_url($slug)) . '">';
    $html .= '<span class="card-icon">' . icon($service['icon'] ?? 'check', 'icon') . '</span>';
    $html .= '<h3 class="card-title">' . e($service['name']) . '</h3>';
    $html .= '<p class="card-text">' . e($service['short']) . '</p>';
    $html .= '<span class="card-link">' . e(t('cta.learn_more')) . ' ' . icon('arrow', 'icon icon-sm') . '</span>';
    $html .= '</a>';
    return $html;
}

/** Location card used on the homepage and locations index. */
function location_card(string $slug, array $location): string
{
    $html  = '<a class="card card-location" href="' . e(location_url($slug)) . '">';
    $html .= '<span class="card-icon">' . icon('pin', 'icon') . '</span>';
    $html .= '<h3 class="card-title">' . e(t('nav.movers_in', ['city' => $location['name']])) . '</h3>';
    $html .= '<p class="card-text">' . e($location['short']) . '</p>';
    $html .= '<span class="card-link">' . e(t('cta.learn_more')) . ' ' . icon('arrow', 'icon icon-sm') . '</span>';
    $html .= '</a>';
    return $html;
}

/**
 * Accessible FAQ list. Uses native <details> so it works without JavaScript
 * and stays crawlable — the visible text always matches the FAQPage schema.
 */
function faq_list(array $faqs, string $heading = ''): string
{
    if ($faqs === []) {
        return '';
    }
    $heading = $heading !== '' ? $heading : t('sec.faq');
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
function related_services(array $slugs, string $heading = ''): string
{
    $heading  = $heading !== '' ? $heading : t('sec.related');
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
function related_locations(string $heading = ''): string
{
    $heading = $heading !== '' ? $heading : t('misc.areas_served');
    $cards   = '';
    foreach (all_locations() as $slug => $location) {
        $cards .= location_card($slug, $location);
    }
    return '<section class="section section-related"><div class="container">'
        . '<h2 class="section-title">' . e($heading) . '</h2>'
        . '<div class="grid grid-3">' . $cards . '</div>'
        . '</div></section>';
}
