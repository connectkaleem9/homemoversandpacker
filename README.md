# homemoverandpaker.com

Server-rendered PHP website for **Home Movers & Packers** — a moving company based in
Sharjah, UAE serving Dubai, Sharjah and Ajman.

Built as a lead-generation site: local SEO, Google Ads landing-page structure and
conversion (call / WhatsApp / quote form) drive the architecture rather than being
bolted on afterwards.

The site is bilingual: **English at `/`, Arabic at `/ar/`**, each with its own
canonical URL, hreflang alternates and sitemap entries.

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

**Easiest way: double-click `START-WEBSITE.bat`.**

It starts PHP, opens <http://localhost:8000> in your browser and keeps running until
you close the black window. Nothing else to install or configure.

Or start it by hand from a terminal:

```bash
cd D:/homemovers
php -S localhost:8000 router.php
```

Either way, the server must stay running while you use the site — closing the window
stops it. `router.php` reproduces the `.htaccess` clean-URL rules, which PHP's
built-in server ignores.

The site needs PHP 8.2 or newer.

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
├── START-WEBSITE.bat          LOCAL DEV ONLY — double-click to run the site
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
│   ├── i18n.php               Language detection, t(), lang_url(), format_date()
│   ├── header.php / navigation.php / footer.php
│   ├── quote-form.php         Primary conversion form
│   ├── quote-form-mini.php    Compact 4-field version
│   ├── contact-form.php       Secondary message form
│   ├── cta-band.php           Shared gold call-to-action band
│   ├── city-cards.php         Shared three-emirate card row
│   ├── legal-body.php         Renders a document from data/legal.php
│   ├── lang/
│   │   ├── en.php             English UI chrome — buttons, labels, nav
│   │   ├── en.pages.php       English page copy, keyed page.* and tpl.*
│   │   ├── ar.php             Arabic chrome
│   │   └── ar.pages.php       Arabic page copy
│   ├── data/
│   │   ├── services.php       All 12 services — content lives here
│   │   ├── services.ar.php    Arabic mirror
│   │   ├── locations.php      All 3 emirates — content lives here
│   │   ├── locations.ar.php   Arabic mirror
│   │   ├── blog.php           All articles — content lives here
│   │   ├── blog.ar.php        Arabic mirror
│   │   ├── legal.php          Privacy Policy + Terms as typed blocks
│   │   └── legal.ar.php       Arabic mirror
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
│      css/rtl.css             Loaded only when the page language is Arabic
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

Add the matching entry to `includes/data/services.ar.php` under the same slug at the
same time — see [Bilingual](#bilingual-english--arabic) below.

**One rule when editing partials:** `navigation.php`, `footer.php` and the form
partials are included into the *page's* variable scope. Every variable they declare
is prefixed (`$nav*`, `$foot*`, `$qf*`) for that reason. An unprefixed `$service` or
`$location` in a partial silently overwrites the page's own data and the page renders
the wrong content. The page templates also re-resolve their data after the header as
a second line of defence.

---

## Bilingual (English + Arabic)

English lives at `/`, Arabic at `/ar/`. A path prefix rather than a cookie or a
query string, because it gives each language its own canonical URL — which is what
Google needs to index and rank them separately, and what makes a shared link keep
its language.

### How a request resolves

`.htaccess` (production) and `router.php` (local) strip the `/ar` prefix internally
and serve the same PHP file. The rewrite is internal, so `REQUEST_URI` still carries
the prefix, and `includes/i18n.php` reads the language back out of it. One set of
templates renders both languages.

### Where the words live

| Kind of text | English | Arabic |
|---|---|---|
| Buttons, labels, navigation | `includes/lang/en.php` | `includes/lang/ar.php` |
| Page headings and paragraphs | `includes/lang/en.pages.php` | `includes/lang/ar.pages.php` |
| Services, locations, articles | `includes/data/*.php` | `includes/data/*.ar.php` |
| Privacy Policy, Terms | `includes/data/legal.php` | `includes/data/legal.ar.php` |

`t('key')` returns a UI string, substituting `{placeholders}` from its second
argument. A missing Arabic key falls back to English rather than rendering the key,
so a half-finished translation degrades quietly instead of breaking a page.

`lang_data('services')` loads `services.ar.php` when the page is Arabic and
`services.php` otherwise. The `.ar.php` files mirror their English counterpart key
for key — same slugs, same array lengths, same block types — so both languages
render through the same templates.

### Editing content

To change wording, edit the language file, not the template. To add a service,
add the entry to **both** `services.php` and `services.ar.php` using the same slug;
`icon` and `related` hold slugs and stay identical in both.

### Right-to-left

`<html>` carries `dir="rtl"` and `lang="ar-AE"` on Arabic pages, which flips flex
rows, grid column order and text alignment on its own. `assets/css/rtl.css` — loaded
only for Arabic — handles the rest: the physical-side rules, the arrow and chevron
mirroring, the hero photograph anchor and scrim direction, and the Arabic font stack.
Phone numbers, dates and the brand name are marked `direction: ltr` so their digits
do not reorder.

Grid column *numbers* follow the writing direction, so a rule like
`grid-column: 2` already means the mirrored column in RTL — do not override it.

### Forms

The form endpoints live at `/forms/*.php`, a path with no language prefix, so they
cannot infer the language from the URL. Each form posts a hidden `form_lang` field
and `lead_guard()` calls `lang_set()` with it, so validation errors and confirmation
messages come back in the language the visitor was reading, on the page they
submitted from.

Stored leads keep English values — the property type and the service name — so the
leads table and the notification email read consistently whichever language the form
was filled in.

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

### 3. Customer reviews

`includes/data/testimonials.php` ships **empty**, and the reviews section on the
homepage does not render at all while it is. Add real reviews — copied from your
Google Business Profile or written by actual customers — and the section appears.

Do not invent them. Fabricated reviews breach Google's structured data guidelines,
are treated as misleading advertising under UAE consumer protection law, and are the
easiest thing in the world for a competitor to report.

### 4. Legal pages

`includes/data/legal.php` contains clearly marked `placeholder` blocks for payment
terms, cancellation terms and liability/insurance. These are commercial and legal
decisions — they must be completed by the business and reviewed by a lawyer. There
is one more placeholder for the data retention period in the privacy policy.

The same placeholders exist in `includes/data/legal.ar.php`. Complete both, and have
both reviewed: an Arabic contract page is as binding as an English one.

### 5. Imagery

**See `assets/images/README.md` for the exact filenames to use.** Drop your files in
with those names and the site picks them up — no code changes.

Until a file exists the page renders a correctly-proportioned placeholder, so the
layout is right today and adding a photo later causes zero layout shift.

The homepage needs: `logo.png`, `logo-white.png`, `hero-movers-dubai.webp`,
`why-choose-us.webp`, `cta-boxes.webp`, three `locations/*.webp` and four
`blog/*.webp`.

Use real photos of your own crew, keep each one under ~200 KB, and prefer WebP.
Do not use stock imagery that misrepresents the service.

### 6. Server

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

The Arabic pages target the Arabic terms people actually search in the UAE —
"نقل أثاث", "شركة نقل عفش" — rather than a literal translation of the English
titles, and they sit at the mirrored path (`/ar/locations/dubai/` and so on).

Every indexable page has a unique title (≤60 characters), a unique meta description,
a self-referencing canonical on the production domain, exactly one H1, breadcrumbs
with matching `BreadcrumbList` schema, and `FAQPage` schema that matches the FAQs
visible on the page — in both languages, each with `hreflang` alternates pointing at
the other plus `x-default` at English, and both listed in the sitemap with matching
`xhtml:link` alternates.

The architecture supports future `/dubai/villa-movers/`-style service+location pages,
but these should only be created where there is genuinely unique content for them.
Do not mass-generate city × service pages — they are thin doorway pages and will hurt
the site.
