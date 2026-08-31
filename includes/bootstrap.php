<?php
/**
 * Single entry point for the shared runtime. Every page starts with:
 *
 *     require_once __DIR__ . '/includes/bootstrap.php';
 *
 * Paths are resolved relative to this file, so pages in subdirectories work
 * without depending on DOCUMENT_ROOT being set the way we expect.
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/schema.php';
require_once __DIR__ . '/breadcrumbs.php';
require_once __DIR__ . '/store.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/upload.php';

/**
 * Start the session here, before a single byte of output.
 *
 * The forms are rendered mid-page, long after headers are sent, so starting
 * the session at that point would silently fail — no cookie, no CSRF token
 * that survives to the POST, and every submission rejected. Starting it up
 * front is the only place it reliably works.
 */
start_session();
