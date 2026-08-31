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
├── admin/                     Dashboard — projects, reviews, account
│   ├── index.php              Counts and what needs attention
│   ├── login.php              Sign in, and first-run account setup
│   ├── projects.php           Add / edit / delete, with photo upload
│   ├── reviews.php            Approve / reject / unpublish / delete
│   └── account.php            Change password
│
├── projects/                  Public project pages
│   ├── index.php              The grid
│   └── project.php            One project (reached by rewrite)
├── reviews.php                Approved reviews + the submission form
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
│   ├── store.php              JSON record store — atomic, locked writes
│   ├── content.php            Projects and reviews domain logic
│   ├── admin.php              Auth, throttling, sessions, flash
│   ├── upload.php             Photo validation and re-encoding
│   ├── admin-layout.php / admin-foot.php
│   ├── review-form.php        Public "leave a review" form
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

## Admin dashboard

At **`/admin/`**. It manages the two things that change after launch: the
projects on `/projects/` and the customer reviews on `/reviews/`.

### First run

There is no default password in this repository. The first visit to `/admin/`
shows a setup screen that creates the single account — whoever sets the site up
chooses the password, and it never passes through anyone else's hands.

If the password is ever lost, delete `storage/admin.json` over SSH and the next
visit sets the account up again.

### What it does

| Screen | What it is for |
|---|---|
| Dashboard | Counts, and anything waiting for attention |
| Projects | Add, edit and delete projects, with up to six photos each |
| Reviews | Approve, reject, unpublish or delete customer reviews |
| Account | Change the password |

### Reviews are moderated on purpose

Everything submitted through the public form arrives as `pending` and is
invisible on the site until it is approved. An unmoderated review form is a
spam target, and `Review` structured data built from unchecked submissions is
what Google's guidelines mean by misleading. Approving is one click.

`Review` and `AggregateRating` schema is emitted only when there are approved
reviews behind it. With none, the page claims nothing — which is why the site
shipped with no rating markup at all until this existed.

Approved reviews also feed the homepage reviews section, which had been waiting
for real data since it was built.

### Projects are bilingual, with English as the fallback

The project form takes Arabic title, summary and description as **optional**
fields: a business that has just finished a job should be able to publish it in
a minute. A blank Arabic field shows the English on the Arabic page rather than
an empty card.

The slug is set once, when the project is created. It is part of a published
URL, and changing it silently would break every link to that project.

### Security notes

- bcrypt hash in `storage/admin.json`, denied over HTTP three ways and `0600`
- Five wrong passwords locks that address out for fifteen minutes
- A wrong username and a wrong password take the same time and give the same
  message, so neither can be used to enumerate the other
- The session id is regenerated on login and on a password change, and expires
  after an hour of inactivity
- Every write is a POST with a CSRF token, followed by a redirect

**Photo uploads** are the only place a file arrives from outside and is written
to disk, so:

- the type is read from the file, never from its name or the browser's claim
- the image is **re-encoded** through GD rather than moved — a polyglot file
  that is both a valid JPEG and a valid PHP script does not survive being
  decoded to a pixel buffer and written out again, and nor does any EXIF payload
- the stored filename is generated here; nothing from the upload reaches the
  filesystem
- `uploads/.htaccess` disables execution several ways, because which one takes
  effect depends on how the host runs PHP

### Where the records live

`storage/data/projects.json` and `storage/data/reviews.json`, through
`includes/store.php` — exclusive-locked writes that land through a temporary
file, so a request that dies mid-write cannot leave a half-written file.

A file rather than MySQL because the database has to be created in hPanel
before it can be used, and the feature should work the moment it deploys. At
this scale — tens of projects, hundreds of reviews — a JSON file read once per
request is not the bottleneck. `includes/database.php` is still there for the
day the volume justifies moving.

**Neither file is in version control.** They are live data. Back them up with
the uploads directory if you back anything up.

---

## Deployment

The site is live at **<https://homemoverandpaker.com>** on Hostinger shared
hosting (LiteSpeed, PHP 8.3).

### Layout on the server

```
~/homemovers/                                 git clone, OUTSIDE the web root
~/domains/homemoverandpaker.com/public_html/  document root
~/deploy.sh                                   pull + copy + permissions
```

The repository is deliberately **not** cloned into the document root: a
readable `.git` directory lets anyone reconstruct the source. Only the files
git tracks are copied across, so nothing untracked in the working copy can
reach the public directory either.

### Updating the live site

Push to `main`, then over SSH:

```sh
sh ~/deploy.sh
```

It fetches, resets to `origin/main`, copies the tracked files into the
document root, fixes permissions and runs a syntax and config check.
`includes/env.php` is not in the repository, so it survives every deploy.

### Server settings

`includes/env.php` on the server holds `APP_ENV=production`. That one value
switches off displayed errors, turns on logging to
`storage/logs/php-error.log`, and hides the placeholder review cards.

The database is off (`DB_ENABLED=false`). Leads are written to
`storage/leads.jsonl` and emailed to `LEAD_NOTIFY_EMAIL`. To switch MySQL on:
create the database in hPanel, import `database/schema.sql`, then fill in
`DB_NAME`, `DB_USER`, `DB_PASS` and set `DB_ENABLED` to `true`. Nothing else
changes — the file fallback stays as the safety net.

### What is protected

`.htaccess` denies `/includes/`, `/storage/`, `/database/` and `/.git/`, the
project brief, `env.php`, and the `.sql .log .jsonl .md .sh .bat` extensions.
`storage/` and `database/` carry their own `Require all denied` as well, so
one lost file is not enough to expose enquiry records. `env.php` is `0600`.

### Two things that only show up in production

Both were found by testing against the live server, and neither could happen
locally, because `router.php` has no rewrite rules:

- **`POST` to a form endpoint was answered with a 301.** `THE_REQUEST`
  matches the whole request line regardless of method, so the rule that
  strips `.php` from public URLs caught the form POSTs too — and a 301 on a
  POST makes the browser re-issue it as a GET with no body. Both redirect
  rules are now `REQUEST_METHOD =GET` only.
- **Lead notification emails were failing silently.** A blank entry in
  `env.php` was being returned as a deliberate empty string, so `mail()` got
  an empty recipient. Blank now means "unset, use the default".

If you change `.htaccess` or anything about forms, test a real submission
against the live site rather than only locally.

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

### 2. Analytics and Search Console — done

Both are wired up in `includes/config.php`:

```php
$googleAnalyticsId = 'G-VWHD0G5WYH';                              // GA4
$googleSiteVerify  = 'NJFcqQaeVRG5X-_R-pipnaiGvf30jnpA53PNmo5CUXA'; // Search Console
```

These are public identifiers — they appear in the page source — so they live in
version control and deploy with the code, rather than in `env.php`.

**The verification tag stays put permanently.** Google re-checks it, and removing
it after verification un-verifies the property.

Google Ads is still empty (`$googleAdsId`). When there is an account, put the
`AW-` ID there and it joins the same gtag load — do not add a second gtag script,
that double-counts every page view.

#### Analytics only runs in production

`$analyticsEnabled = APP_ENV === 'production'`, so nothing is sent from a
developer machine. Without this, every local page view, QA crawl and screenshot
run lands in the live property and the first month of data is unusable because
real visitors cannot be told apart from us.

To check the tag on a local machine, set `APP_ENV` to `production` in
`includes/env.php` temporarily — and remember that hits from that session are
real and will show up in the reports.

#### What is measured

| Event | When |
|---|---|
| `page_view` | automatic, with `content_language` set to `en` or `ar` |
| `cta_click` | any call, WhatsApp, quote or email CTA; `cta_type` says which |
| `generate_lead` | a quote, contact or review form passing validation |

`generate_lead` is one of GA4's recommended events, so it can be marked as a key
event in the property without any custom configuration. **Mark it, and mark
`cta_click` where `cta_type` is `phone` or `whatsapp`** — on this site a phone
call is the conversion, not a page view.

Every event carries `page_path` and `page_language`, so the Arabic side can be
compared with the English one. That comparison is the main reason the site is
bilingual, and it is invisible without the language dimension.

Each event goes out twice, deliberately, in two different shapes:
`dataLayer.push({event: ...})` for Google Tag Manager and `gtag('event', ...)`
for GA4. They are not interchangeable — `gtag()` pushes an *arguments* object, so
a hand-rolled `dataLayer.push` of a plain object is invisible to GA4, and a GTM
container never sees a gtag event as a trigger. Sending both means one CTA reaches
whichever is installed.

The conversion fires from the form's own submit handler, **after** the site's
validation — a listener on the raw submit event counts attempts, not leads.

Stable IDs for anything that needs to target an element directly:
`#quote-form`, `#contact-form`, `#review-form`, `#quote-cta`, `#phone-cta`,
`#whatsapp-cta`.

#### Still to do in the Google properties

- Submit `https://homemoverandpaker.com/sitemap.xml` in Search Console
- In GA4, mark `generate_lead` (and the phone/WhatsApp `cta_click`s) as key events
- Link the GA4 property to Search Console, so query data and behaviour sit together
- Consider excluding your own IP in GA4 → Admin → Data Streams → Configure tag
  settings → Define internal traffic, or the team's own visits inflate everything


### 3. Customer reviews

Customers leave reviews themselves at `/reviews/`, and you approve them in the
dashboard — see [Admin dashboard](#admin-dashboard). Approved reviews appear on
that page and on the homepage.

`includes/data/testimonials.php` is still read as a fallback for anything added
by hand before the dashboard existed. It ships empty.

Do not invent reviews. Fabricated ones breach Google's structured data
guidelines, are treated as misleading advertising under UAE consumer protection
law, and are the easiest thing in the world for a competitor to report. The
moderation queue exists so the reviews on this site are worth reading, not so
the awkward ones can be removed.

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

Done during deployment — see [Deployment](#deployment):

- HTTPS is live (Let's Encrypt, covers the apex and `www`), HTTP and `www`
  both 301 to `https://homemoverandpaker.com`
- `mod_rewrite`, `mod_headers`, `mod_deflate` and `mod_expires` all confirmed
  working on the live server
- `storage/` is writable by PHP and returns 404 over HTTP
- `APP_ENV=production` is set in `includes/env.php`

Still to do:

- Uncomment the HSTS header in `.htaccess` once you are confident nothing
  needs to be served over plain HTTP. It is commented out deliberately:
  `max-age=31536000; preload` is very hard to undo if something is wrong.
- Confirm the `info@homemoverandpaker.com` mailbox exists and that lead
  notifications are actually arriving in it
- Finish the Google property setup — see
  [Analytics and Search Console](#2-analytics-and-search-console--done)

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
