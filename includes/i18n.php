<?php
/**
 * Bilingual support — English (default) and Arabic.
 *
 * URL structure:
 *   /                        English homepage
 *   /ar/                     Arabic homepage
 *   /services/villa-movers/  English service page
 *   /ar/services/villa-movers/
 *
 * A path prefix rather than a query string or a cookie: it gives each language
 * its own canonical URL, which is what Google needs to index and rank them
 * separately, and it survives sharing and linking.
 *
 * The prefix is read from REQUEST_URI, which internal rewrites do not alter,
 * so the same detection works on Apache, LiteSpeed and the dev router.
 */

declare(strict_types=1);

const LANGUAGES = [
    'en' => ['name' => 'English',  'native' => 'English', 'dir' => 'ltr', 'locale' => 'en-AE', 'prefix' => ''],
    'ar' => ['name' => 'Arabic',   'native' => 'العربية', 'dir' => 'rtl', 'locale' => 'ar-AE', 'prefix' => '/ar'],
];

const DEFAULT_LANG = 'en';

/** Current language code, decided once from the URL. */
function lang(): string
{
    static $lang = null;
    if (func_num_args() === 1) {
        /* lang_set() reaches the same static through here. */
        $lang = (string) func_get_arg(0);
        return $lang;
    }
    if ($lang !== null) {
        return $lang;
    }

    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $lang = (preg_match('#^/ar(/|$)#', $path) === 1) ? 'ar' : DEFAULT_LANG;

    return $lang;
}

/**
 * Force the language for the rest of the request.
 *
 * The form endpoints live at /forms/*.php, a path with no language prefix, so
 * they cannot infer the visitor's language from the URL. Each form posts the
 * language it was rendered in and the endpoint sets it here, so validation
 * errors come back in the language the visitor was reading.
 */
function lang_set(?string $l): string
{
    return lang(isset(LANGUAGES[(string) $l]) ? (string) $l : DEFAULT_LANG);
}

function is_rtl(): bool
{
    return LANGUAGES[lang()]['dir'] === 'rtl';
}

function lang_dir(): string
{
    return LANGUAGES[lang()]['dir'];
}

function lang_locale(): string
{
    return LANGUAGES[lang()]['locale'];
}

/** The other language — this site has exactly two. */
function other_lang(): string
{
    return lang() === 'ar' ? 'en' : 'ar';
}

/**
 * Prefix a site-relative path with a language.
 * English keeps clean URLs; Arabic gets /ar.
 *
 * Idempotent: any prefix already on the path is stripped first. Helpers like
 * service_url() return an already-prefixed path, and passing one of those
 * through here again would otherwise produce /ar/ar/services/villa-movers/.
 */
function lang_url(string $path, ?string $forLang = null): string
{
    $forLang = $forLang ?? lang();
    $prefix  = LANGUAGES[$forLang]['prefix'] ?? '';
    $path    = '/' . ltrim($path, '/');
    $path    = preg_replace('#^/ar(?=/|$)#', '', $path) ?? $path;

    return $prefix . ($path === '' ? '/' : $path);
}

/** The current page's path with the language prefix stripped. */
function current_path(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $path = preg_replace('#^/ar(?=/|$)#', '', $path) ?? $path;

    return $path === '' ? '/' : $path;
}

/** This same page in the other language — for the switcher and hreflang. */
function alternate_url(string $forLang): string
{
    return lang_url(current_path(), $forLang);
}

/* ------------------------------------------------------------------
 | UI strings
 | ------------------------------------------------------------------ */

/**
 * Load and merge a language's string tables.
 *
 * Two files per language, kept apart so they stay readable:
 *   lang/en.php        chrome — navigation, buttons, form labels
 *   lang/en.pages.php  page copy — headings and paragraphs, keyed page.*
 */
function lang_strings(string $l): array
{
    static $cache = [];
    if (isset($cache[$l])) {
        return $cache[$l];
    }

    $strings = [];
    foreach ([$l . '.php', $l . '.pages.php'] as $name) {
        $file = __DIR__ . '/lang/' . $name;
        if (is_file($file)) {
            $strings += require $file;
        }
    }

    return $cache[$l] = $strings;
}

/** Translate a UI string. Falls back to English, then to the key itself. */
function t(string $key, array $replace = []): string
{
    $l    = lang();
    $text = lang_strings($l)[$key] ?? lang_strings(DEFAULT_LANG)[$key] ?? $key;

    foreach ($replace as $search => $value) {
        $text = str_replace('{' . $search . '}', (string) $value, $text);
    }

    return $text;
}

/* ------------------------------------------------------------------
 | Dates
 | ------------------------------------------------------------------ */

/**
 * A date in the current language.
 *
 * PHP's date() has no locale, and IntlDateFormatter is not guaranteed to be
 * installed on shared hosting — so the month names are a plain table. The
 * Gregorian calendar and Western digits are deliberate: that is what UAE
 * businesses use in Arabic-language material.
 *
 * $style 'long' => 31 أغسطس 2026, 'short' => 31 أغسطس 2026 (abbreviated in English).
 */
function format_date(DateTimeInterface $date, string $style = 'long'): string
{
    if (lang() !== 'ar') {
        return $date->format($style === 'short' ? 'j M Y' : 'j F Y');
    }

    static $months = [
        1 => 'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
        'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر',
    ];

    return $date->format('j') . ' ' . $months[(int) $date->format('n')] . ' ' . $date->format('Y');
}

/**
 * Load a data file for the current language, falling back to English.
 * includes/data/services.php  ->  includes/data/services.ar.php
 */
function lang_data(string $name): array
{
    $l = lang();
    if ($l !== DEFAULT_LANG) {
        $translated = __DIR__ . '/data/' . $name . '.' . $l . '.php';
        if (is_file($translated)) {
            return require $translated;
        }
    }
    return require __DIR__ . '/data/' . $name . '.php';
}
