<?php
/**
 * Projects and customer reviews — the two things the admin manages at runtime.
 *
 * Both are stored through includes/store.php. Projects are written only by a
 * logged-in admin. Reviews are written by the public and start their life
 * pending: nothing a visitor submits appears on the site until someone has
 * read it and approved it.
 */

declare(strict_types=1);

require_once __DIR__ . '/store.php';

const REVIEW_PENDING  = 'pending';
const REVIEW_APPROVED = 'approved';
const REVIEW_REJECTED = 'rejected';

/* ==================================================================
 | Projects
 | ================================================================== */

/** Every project, newest completion first. */
function all_projects(): array
{
    $rows = store_all('projects');

    usort($rows, static fn (array $a, array $b): int
        => strcmp((string) ($b['completed_at'] ?? ''), (string) ($a['completed_at'] ?? '')));

    return $rows;
}

function get_project(string $slug): ?array
{
    foreach (all_projects() as $project) {
        if (($project['slug'] ?? '') === $slug) {
            return $project;
        }
    }
    return null;
}

/**
 * The fields to render, in the current language, falling back to English.
 *
 * The admin form takes Arabic as optional: a business that has just finished a
 * job should be able to publish it in a minute without translating first. An
 * untranslated field shows its English rather than an empty card.
 */
function project_text(array $project, string $field): string
{
    if (lang() !== DEFAULT_LANG) {
        $translated = trim((string) ($project[$field . '_' . lang()] ?? ''));
        if ($translated !== '') {
            return $translated;
        }
    }
    return trim((string) ($project[$field] ?? ''));
}

/** URL-safe slug, kept unique against the projects already stored. */
function project_slug(string $title, string $ignoreId = ''): string
{
    $base = strtolower(trim($title));
    $base = preg_replace('/[^a-z0-9]+/u', '-', $base) ?? '';
    $base = trim((string) $base, '-');

    if ($base === '' || !preg_match('/[a-z0-9]/', $base)) {
        /* An all-Arabic title leaves nothing usable, so fall back to a date
           rather than producing an empty or punctuation-only URL. */
        $base = 'project-' . date('Y-m-d');
    }
    $base = substr($base, 0, 60);

    $taken = [];
    foreach (store_all('projects') as $row) {
        if (($row['id'] ?? '') !== $ignoreId) {
            $taken[] = $row['slug'] ?? '';
        }
    }

    $slug = $base;
    $n    = 2;
    while (in_array($slug, $taken, true)) {
        $slug = $base . '-' . $n++;
    }

    return $slug;
}

function project_url(string $slug): string
{
    return lang_url('/projects/' . $slug . '/');
}

/* ==================================================================
 | Reviews
 | ================================================================== */

/** Approved reviews only — the set the public site is allowed to show. */
function approved_reviews(): array
{
    $rows = array_values(array_filter(
        store_all('reviews'),
        static fn (array $r): bool => ($r['status'] ?? '') === REVIEW_APPROVED
    ));

    usort($rows, static fn (array $a, array $b): int
        => strcmp((string) ($b['created_at'] ?? ''), (string) ($a['created_at'] ?? '')));

    return $rows;
}

function reviews_by_status(string $status): array
{
    return array_values(array_filter(
        store_all('reviews'),
        static fn (array $r): bool => ($r['status'] ?? '') === $status
    ));
}

function pending_review_count(): int
{
    return count(reviews_by_status(REVIEW_PENDING));
}

/** Average star rating across approved reviews, or null when there are none. */
function reviews_average(): ?float
{
    $ratings = array_filter(array_map(
        static fn (array $r): int => (int) ($r['rating'] ?? 0),
        approved_reviews()
    ));

    return $ratings === [] ? null : round(array_sum($ratings) / count($ratings), 1);
}
