<?php
/**
 * Global configuration — homemoverandpaker.com
 * Single source of truth for business NAP, tracking IDs and environment settings.
 */

declare(strict_types=1);

/* ------------------------------------------------------------------
 | Server-specific settings
 |
 | includes/env.php holds the handful of values that differ between a
 | developer's machine and the live server — the environment name, database
 | credentials, the notification address. It is NOT in version control: copy
 | includes/env.example.php to includes/env.php on the server and fill it in.
 |
 | A file rather than SetEnv in .htaccess, because whether getenv() sees an
 | Apache environment variable depends on how PHP is running (module, FPM or
 | LiteSpeed SAPI) and shared hosting can change that underneath you. A file
 | that returns an array behaves the same everywhere.
 | ------------------------------------------------------------------ */
$appEnvFile     = __DIR__ . '/env.php';
$appEnvSettings = is_file($appEnvFile) ? (array) require $appEnvFile : [];

/**
 * One setting: includes/env.php first, then the environment, then the default.
 *
 * An EMPTY value at any level means "not set here, keep looking" — the example
 * env.php ships with blank entries as documentation, and treating those as a
 * deliberate empty string is how LEAD_NOTIFY_EMAIL silently became '' and every
 * lead notification failed to send.
 */
function cfg(string $key, string $default = ''): string
{
    global $appEnvSettings;

    $fromFile = (string) ($appEnvSettings[$key] ?? '');
    if ($fromFile !== '') {
        return $fromFile;
    }

    $fromEnv = getenv($key);

    return ($fromEnv !== false && $fromEnv !== '') ? (string) $fromEnv : $default;
}

/* ------------------------------------------------------------------
 | Environment
 | ------------------------------------------------------------------ */
define('APP_ENV', cfg('APP_ENV', 'local'));                // local | production
define('APP_DEBUG', APP_ENV !== 'production');
define('APP_ROOT', dirname(__DIR__));

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    ini_set('error_log', APP_ROOT . '/storage/logs/php-error.log');
}

date_default_timezone_set('Asia/Dubai');

/* ------------------------------------------------------------------
 | Site
 | ------------------------------------------------------------------ */
define('SITE_DOMAIN', 'homemoverandpaker.com');
define('SITE_URL', APP_ENV === 'production'
    ? 'https://homemoverandpaker.com'
    : (isset($_SERVER['HTTP_HOST']) ? 'http://' . $_SERVER['HTTP_HOST'] : 'http://localhost:8000'));

/** Canonical URLs always use the production domain so staging never leaks into search. */
define('CANONICAL_BASE', 'https://homemoverandpaker.com');

define('SITE_NAME', 'Home Movers & Packers');
define('SITE_TAGLINE', 'Movers & Packers in Dubai, Sharjah & Ajman');

/* ------------------------------------------------------------------
 | Business NAP  (Name / Address / Phone) — keep identical everywhere
 | ------------------------------------------------------------------ */
define('BUSINESS_NAME', 'Home Movers & Packers');
define('BUSINESS_CITY', 'Sharjah');
define('BUSINESS_REGION', 'Sharjah');
define('BUSINESS_COUNTRY', 'AE');
define('BUSINESS_COUNTRY_NAME', 'United Arab Emirates');
define('BUSINESS_ADDRESS', 'Sharjah, UAE');

define('PHONE_DISPLAY', '055 658 1781');
define('PHONE_INTL', '+971 55 658 1781');
define('PHONE_LINK', 'tel:+971556581781');
define('PHONE_E164', '+971556581781');

define('WHATSAPP_NUMBER', '971556581781');
define('WHATSAPP_BASE', 'https://wa.me/971556581781');

/*
 * The public contact address, and where lead notifications go by default.
 *
 * A Gmail address rather than one on the domain, at the client's request. Note
 * that the From header on outgoing notifications stays on the domain
 * (no-reply@homemoverandpaker.com, set in lead-handler.php) — sending "from" a
 * gmail.com address the server has no authority over fails DMARC outright and
 * is how a notification ends up in spam or is refused entirely.
 */
define('EMAIL_ADDRESS', 'homemoversandpackers09@gmail.com');

/** Areas served — used in schema, footer and location listings. */
define('AREAS_SERVED', ['Dubai', 'Sharjah', 'Ajman']);

/**
 * Opening hours. EMPTY until the business confirms them — the topbar simply
 * omits the row while this is blank, and no openingHours schema is emitted.
 * Publishing invented hours is how customers turn up to a closed business.
 *
 * Display example: 'Mon - Sat: 8:00 AM - 7:00 PM'
 * Schema example:  ['Mo-Sa 08:00-19:00']
 */
define('BUSINESS_HOURS_TEXT', '');
define('BUSINESS_HOURS_SCHEMA', []);

/**
 * Heading above the reviews section.
 *
 * Deliberately not "Trusted by Hundreds of Happy Customers" — that is a
 * customer-count claim, and it should only be made once the business can
 * actually stand behind the number. Change it when you can.
 */
define('REVIEWS_HEADING', 'What Our Customers Say');

/**
 * Social profiles. Add the real URLs and the icons appear in the footer and
 * as sameAs in the organisation schema. Leave blank to hide.
 */
define('SOCIAL_LINKS', [
    'facebook'  => '',
    'instagram' => '',
    'whatsapp'  => WHATSAPP_BASE,
    'youtube'   => '',
    'tiktok'    => '',
]);

/* ------------------------------------------------------------------
 | Tracking
 |
 | These are public identifiers — they appear in the page source of every
 | page — so they live here in version control rather than in env.php, and
 | deploy with the code. An empty value injects nothing at all.
 |
 | Analytics only loads when APP_ENV is 'production' (see $analyticsEnabled
 | below), so a developer browsing localhost does not pollute the property
 | with test traffic.
 | ------------------------------------------------------------------ */
$googleTagManagerId  = '';                              // e.g. GTM-XXXXXXX — unused; GA4 is wired directly
$googleAnalyticsId   = 'G-VWHD0G5WYH';                  // GA4 measurement ID
$googleAdsId         = '';                              // e.g. AW-XXXXXXXXX
$googleAdsQuoteLabel = '';                              // conversion label for quote form submissions
$googleAdsCallLabel  = '';                              // conversion label for phone CTA clicks
$googleAdsWhatsLabel = '';                              // conversion label for WhatsApp CTA clicks

/* Search Console ownership. Google keeps checking this, so it stays put
   permanently — removing it after verification un-verifies the property. */
$googleSiteVerify    = 'NJFcqQaeVRG5X-_R-pipnaiGvf30jnpA53PNmo5CUXA';

/**
 * Whether to load any analytics at all.
 *
 * Production only. Without this, every local page view, every QA crawl and
 * every screenshot run lands in the live property, and the first month of
 * data is unusable because nobody can tell real visitors from us.
 */
$analyticsEnabled = APP_ENV === 'production';

/* ------------------------------------------------------------------
 | Database (MySQL) — optional. The site degrades gracefully to file
 | storage when the database is unreachable, so a lead is never lost.
 | ------------------------------------------------------------------ */
define('DB_ENABLED', filter_var(cfg('DB_ENABLED', 'false'), FILTER_VALIDATE_BOOL));
define('DB_HOST', cfg('DB_HOST', '127.0.0.1'));
define('DB_PORT', cfg('DB_PORT', '3306'));
define('DB_NAME', cfg('DB_NAME', 'homemoverandpaker'));
define('DB_USER', cfg('DB_USER', 'root'));
define('DB_PASS', cfg('DB_PASS', ''));
define('DB_CHARSET', 'utf8mb4');

/* ------------------------------------------------------------------
 | Leads
 | ------------------------------------------------------------------ */
define('LEAD_NOTIFY_EMAIL', cfg('LEAD_NOTIFY_EMAIL', EMAIL_ADDRESS));
define('LEAD_FALLBACK_FILE', APP_ROOT . '/storage/leads.jsonl');
define('FORM_MIN_SECONDS', 3);      // submissions faster than this are treated as bots
define('RATE_LIMIT_MAX', 5);        // max submissions
define('RATE_LIMIT_WINDOW', 900);   // per 15 minutes, per IP

/* ------------------------------------------------------------------
 | Asset cache-busting version
 |
 | Assets are served with `Cache-Control: immutable, max-age=1 year` and a
 | ?v= query string. BUMP THIS whenever a file in /assets changes, or nobody
 | who has already visited — and no CDN edge — will ever fetch the new one.
 | ------------------------------------------------------------------ */
define('ASSET_VERSION', '1.5.0');
