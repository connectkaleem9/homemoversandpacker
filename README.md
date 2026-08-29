# homemoverandpaker.com

Server-rendered PHP website for **Home Movers & Packers** — a moving company based in
Sharjah, UAE serving Dubai, Sharjah and Ajman.

Built as a lead-generation site: local SEO, Google Ads landing-page structure and
conversion (call / WhatsApp / quote form) drive the architecture rather than being
bolted on afterwards.

---

## Stack

| Layer      | Technology |
|------------|------------|
| Frontend   | HTML5, CSS3, vanilla JavaScript, inline SVG icons |
| Backend    | PHP 8.2+ (server-rendered, no framework) |
| Database   | MySQL 8 (optional — see below) |
| Server     | Apache or LiteSpeed with `.htaccess` |

No React, no Next.js, no Laravel, no WordPress, no build step. No external fonts or
icon libraries — the page renders completely on first paint.

---

## Running it locally

The site needs PHP 8.2 or newer. It runs on the PHP built-in server via `router.php`,
which reproduces the `.htaccess` clean-URL rules that the built-in server ignores.

```bash
cd D:/homemovers
php -S localhost:8000 router.php
```

Then open <http://localhost:8000>.

`router.php` is a development-only file. On Apache/LiteSpeed the `.htaccess` handles
routing and `router.php` is never invoked.

### Database (optional)

The site runs fine without MySQL. Leads fall back to append-only file storage at
`storage/leads.jsonl`, so a submission is never lost because the database is down.

To enable MySQL:

```bash
mysql -u root -p < database/schema.sql
```

Then set the environment variables before starting PHP:

```bash
DB_ENABLED=true DB_HOST=127.0.0.1 DB_NAME=homemoverandpaker DB_USER=root DB_PASS=secret \
  php -S localhost:8000 router.php
```

---

## Project structure

```
├── index.php                  Homepage
├── about-us.php               About
├── contact-us.php             Contact + quote form + message form
├── privacy-policy.php
├── terms-and-conditions.php
├── 404.php
├── sitemap.php                Rendered at /sitemap.xml via .htaccess
├── router.php                 LOCAL DEV ONLY — mirrors .htaccess routing
├── .htaccess                  HTTPS, canonical host, clean URLs, security, caching
├── robots.txt
│
├── services/                  12 service pages, each a 4-line file
│   ├── index.php
│   └── <slug>.php             sets $serviceSlug, requires the shared template
│
├── locations/                 3 emirate pages
│   ├── index.php
│   └── dubai.php | sharjah.php | ajman.php
│
├── blog/                      4 long-form guides
│   ├── index.php
│   └── <slug>.php
│
├── includes/
│   ├── bootstrap.php          Loads everything, starts the session
│   ├── config.php             NAP, tracking IDs, DB, limits  ← EDIT THIS FIRST
│   ├── functions.php          Helpers, escaping, CSRF, UI partials, icon set
│   ├── seo.php                Per-page metadata system
│   ├── schema.php             JSON-LD graph
│   ├── breadcrumbs.php
│   ├── database.php           PDO, prepared statements only
│   ├── lead-handler.php       Validation, spam defence, storage, notification
│   ├── header.php / navigation.php / footer.php
│   ├── quote-form.php         Primary conversion form
│   ├── contact-form.php       Secondary message form
│   ├── data/
│   │   ├── services.php       All 12 services — content lives here
│   │   ├── locations.php      All 3 emirates — content lives here
│   │   └── blog.php           All articles — content lives here
│   └── templates/
│       ├── service-page.php
│       ├── location-page.php
│       └── blog-post.php
│
├── forms/
│   ├── quote-submit.php       POST only, noindex, redirects back (PRG)
│   └── contact-submit.php
│
├── assets/css | js | images | fonts
├── database/schema.sql
├── storage/                   Leads + logs. Never web-accessible.
└── uploads/
```

### Adding content

Everything data-driven. To add a service, add one entry to
`includes/data/services.php` and create a 4-line file in `services/`:

```php
<?php
declare(strict_types=1);

$serviceSlug = 'my-new-service';
require __DIR__ . '/../includes/templates/service-page.php';
```

It then appears automatically in the navigation dropdown, the homepage grid, the
footer, the services index, the quote form's service list and the XML sitemap.
Locations and blog posts work the same way.

**One rule when editing partials:** `navigation.php`, `footer.php` and the form
partials are included into the *page's* variable scope. Every variable they declare
is prefixed (`$nav*`, `$foot*`, `$qf*`) for that reason. An unprefixed `$service` or
`$location` in a partial silently overwrites the page's own data and the page renders
the wrong content. The page templates also re-resolve their data after the header as
a second line of defence.

---

## Before going live

### 1. Business details — `includes/config.php`

NAP, phone, WhatsApp and email are defined once and used everywhere. Change them
there and the whole site, including schema and footer, follows.

Currently set:

- **Name:** Home Movers & Packers
- **Address:** Sharjah, UAE
- **Phone:** 055 658 1781 → `tel:+971556581781`
- **WhatsApp:** <https://wa.me/971556581781>
- **Email:** info@homemoverandpaker.com — *confirm this mailbox exists*

### 2. Tracking IDs — `includes/config.php`

Empty by default, and nothing is injected into the page while they are empty:

```php
$googleTagManagerId  = '';   // GTM-XXXXXXX
$googleAnalyticsId   = '';   // G-XXXXXXXXXX
$googleAdsId         = '';   // AW-XXXXXXXXX
$googleAdsQuoteLabel = '';
$googleAdsCallLabel  = '';
$googleAdsWhatsLabel = '';
$googleSiteVerify    = '';   // Search Console verification
```

Stable IDs are already in the markup for conversion tracking:
`#quote-form`, `#quote-cta`, `#phone-cta`, `#whatsapp-cta`. Every CTA also pushes a
`cta_click` event to `dataLayer` with a `cta_type` of `phone`, `whatsapp`, `quote`
or `email`, and forms push `form_submit`.

**Conversion priority:** quote form submission → phone click → WhatsApp click are
primary. Email clicks and other CTA interactions are secondary — do not count every
button click as a primary conversion.

### 3. Legal pages

`terms-and-conditions.php` contains clearly marked placeholders for payment terms,
cancellation terms and liability/insurance. These are commercial and legal decisions
— they must be completed by the business and reviewed by a lawyer.
`privacy-policy.php` has one placeholder for the data retention period.

### 4. Imagery

The site currently uses SVG for the favicon and Open Graph card and has no photography.
Drop real WebP/AVIF photos into `assets/images/` with descriptive filenames
(`villa-movers-dubai.webp`) and meaningful alt text. Do not use stock imagery that
misrepresents the service.

### 5. Server

- Enable HTTPS, then uncomment the HSTS header in `.htaccess`
- Confirm `mod_rewrite`, `mod_headers`, `mod_deflate` and `mod_expires` are enabled
- Ensure `storage/` is writable by PHP but not web-accessible
- Set `APP_ENV=production` so errors are logged rather than displayed
- Submit `https://homemoverandpaker.com/sitemap.xml` to Search Console

---

## What is deliberately absent

Nothing on this site is invented. There are no fabricated reviews, star ratings,
aggregate ratings, awards, certifications, insurance claims, years-in-business
figures, customer counts, fleet numbers, warehouse specifications, branch addresses,
opening hours, price lists or map embeds — because none of that has been supplied by
the business, and `Review`/`AggregateRating` schema without real review data breaches
Google's structured data guidelines.

The schema emits only verifiable facts: business name, phone, city, URL, area served
and services offered. When the business supplies real data (opening hours, a street
address, genuine reviews), add it to `includes/config.php` and `includes/schema.php`.

---

## Security

- CSRF tokens on every form, verified with `hash_equals`
- All output escaped through `e()`; JSON-LD escaped separately
- PDO prepared statements only — no string-interpolated SQL
- Honeypot field, minimum-completion-time check and per-IP rate limiting
  (5 submissions per 15 minutes)
- Mail headers sanitised against header injection
- Redirects restricted to this host
- `storage/`, `database/` and `includes/` blocked at the web server
- Security headers set in `.htaccess`
- No credentials in client-side JavaScript; DB config read from environment variables

---

## SEO notes

Keyword-to-page mapping, kept deliberately non-overlapping to avoid cannibalisation:

| Page | Primary intent |
|------|----------------|
| `/` | Movers & Packers Dubai, Sharjah & Ajman |
| `/locations/dubai/` | Movers in Dubai |
| `/locations/sharjah/` | Movers in Sharjah |
| `/locations/ajman/` | Movers in Ajman |
| `/services/<slug>/` | The service intent only (e.g. Villa Movers) |

Every indexable page has a unique title (≤60 characters), a unique meta description,
a self-referencing canonical on the production domain, exactly one H1, breadcrumbs
with matching `BreadcrumbList` schema, and `FAQPage` schema that matches the FAQs
visible on the page.

The architecture supports future `/dubai/villa-movers/`-style service+location pages,
but these should only be created where there is genuinely unique content for them.
Do not mass-generate city × service pages — they are thin doorway pages and will hurt
the site.
