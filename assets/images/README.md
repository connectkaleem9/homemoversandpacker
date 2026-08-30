# Where to put your images

Drop your files in with **exactly these names** and the site picks them up
automatically — no code changes needed.

Until a file exists, the page renders a styled placeholder in its place, so the
layout is correct right now and fills in as you add photos.

**Any of `.webp`, `.jpg` or `.png` works** — the site tries each in turn, so
drop in whatever you have. Only the filename has to match.

Keep every photo under roughly 200 KB. The hero image is the largest thing on
the homepage and it sets your Largest Contentful Paint score directly, which
Google measures. [squoosh.app](https://squoosh.app) shrinks images in the
browser, free.

---

## Required

| Put the file here | What it is | Suggested size |
|---|---|---|
| `assets/images/logo.png` | Header logo, transparent background | 400 × 120 |
| `assets/images/logo-white.png` | Footer logo — white/light version for the navy footer | 400 × 120 |
| `assets/images/hero-movers-dubai.webp` | Hero photo — crew loading the truck | 1200 × 900 |
| `assets/images/why-choose-us.webp` | "Why choose us" photo — crew wrapping furniture | 900 × 700 |
| `assets/images/cta-boxes.webp` | Boxes for the gold CTA band. **Transparent PNG works best here** | 600 × 450 |

## Location cards

| Put the file here | What it is | Suggested size |
|---|---|---|
| `assets/images/locations/dubai.webp` | Dubai skyline | 800 × 600 |
| `assets/images/locations/sharjah.webp` | Sharjah skyline | 800 × 600 |
| `assets/images/locations/ajman.webp` | Ajman skyline | 800 × 600 |

## Blog thumbnails

Named after the article slug:

| Put the file here | Article |
|---|---|
| `assets/images/blog/moving-checklist-dubai-sharjah-ajman.webp` | Moving Checklist for Dubai, Sharjah & Ajman |
| `assets/images/blog/how-much-does-moving-cost-dubai.webp` | How Much Does Moving Cost in Dubai & Sharjah? |
| `assets/images/blog/how-to-pack-furniture-safely.webp` | How to Pack Furniture Safely for a Move |
| `assets/images/blog/moving-between-dubai-sharjah-ajman.webp` | Moving Between Dubai, Sharjah and Ajman |

Suggested size: 800 × 500.

## Customer photos (optional)

Only if a customer has given permission for their photo to be used:

`assets/images/testimonials/<name>.webp` — 200 × 200, square.

Then reference the filename in `includes/data/testimonials.php`. Reviews render
fine without a photo — initials are shown instead.

---

## Rules that matter

**Filenames** — keep them descriptive. `villa-movers-dubai.webp` helps you in
image search; `IMG_4471.webp` does nothing.

**Alt text** — set in the page code, not here. Describe what is happening in the
photo (`Movers wrapping a sofa before a villa move in Sharjah`), don't stuff
keywords into it.

**File size** — keep every photo under roughly 200 KB. The hero image is the
largest thing on the homepage and it directly sets your Largest Contentful Paint
score, which Google measures. A 3 MB camera JPEG will visibly hurt your rankings
and your Google Ads quality score.

**Use real photos of real work.** Stock images of movers who are obviously not
your crew, in a city that is obviously not the UAE, are worse than a placeholder —
customers notice, and misleading imagery is the kind of thing that gets flagged
in a Google Ads review.
