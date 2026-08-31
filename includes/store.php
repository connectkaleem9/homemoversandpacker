<?php
/**
 * Small JSON-backed record store for admin-managed content.
 *
 * Projects and reviews need to be created, edited and deleted at runtime, so
 * they cannot live in the PHP files under includes/data/ the way the services
 * and locations do. They go in storage/data/ instead.
 *
 * A file rather than MySQL because the database has to be created in hPanel
 * before it can be used, and the site should work the moment it is deployed.
 * At the scale this holds — tens of projects, hundreds of reviews — a JSON
 * file read once per request is not the bottleneck, and includes/database.php
 * is still there for the day the volume justifies it.
 *
 * Every write is exclusive-locked and lands through a temporary file, so a
 * request that dies mid-write cannot leave a half-written file behind.
 */

declare(strict_types=1);

/** Directory the record files live in. Created on first write. */
function store_dir(): string
{
    return APP_ROOT . '/storage/data';
}

function store_path(string $name): string
{
    return store_dir() . '/' . preg_replace('/[^a-z0-9_-]/', '', $name) . '.json';
}

/**
 * Every record in a store, newest first.
 * A missing or unreadable file is an empty store, never an error — a fresh
 * install has no projects yet, and that is not a failure state.
 */
function store_all(string $name): array
{
    $cache = &store_cache_ref();

    if (isset($cache[$name])) {
        return $cache[$name];
    }

    $file = store_path($name);
    if (!is_file($file)) {
        return $cache[$name] = [];
    }

    $rows = json_decode((string) @file_get_contents($file), true);

    if (!is_array($rows)) {
        error_log('[store] ' . $file . ' is not valid JSON; treating as empty');
        return $cache[$name] = [];
    }

    return $cache[$name] = $rows;
}

/** One record by id, or null. */
function store_find(string $name, string $id): ?array
{
    foreach (store_all($name) as $row) {
        if (($row['id'] ?? '') === $id) {
            return $row;
        }
    }
    return null;
}

/** Write the whole set back. Returns false if the write did not land. */
function store_put(string $name, array $rows): bool
{
    $dir = store_dir();
    if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
        error_log('[store] could not create ' . $dir);
        return false;
    }

    $file = store_path($name);
    $json = json_encode(array_values($rows), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    if ($json === false) {
        error_log('[store] could not encode ' . $name . ': ' . json_last_error_msg());
        return false;
    }

    /* Write beside the target and rename over it: rename is atomic on the same
       filesystem, so a reader never sees a partial file. */
    $tmp = $file . '.' . bin2hex(random_bytes(4)) . '.tmp';
    if (@file_put_contents($tmp, $json, LOCK_EX) === false) {
        error_log('[store] could not write ' . $tmp);
        return false;
    }
    @chmod($tmp, 0644);

    if (!@rename($tmp, $file)) {
        @unlink($tmp);
        error_log('[store] could not replace ' . $file);
        return false;
    }

    store_forget($name);
    return true;
}

/** Add a record. Returns the record as stored, with its id and timestamp. */
function store_insert(string $name, array $record): ?array
{
    $record['id']         = $record['id'] ?? store_id();
    $record['created_at'] = $record['created_at'] ?? date('c');

    $rows = store_all($name);
    array_unshift($rows, $record);

    return store_put($name, $rows) ? $record : null;
}

/** Merge changes into one record. */
function store_update(string $name, string $id, array $changes): bool
{
    $rows  = store_all($name);
    $found = false;

    foreach ($rows as $i => $row) {
        if (($row['id'] ?? '') === $id) {
            $rows[$i] = array_merge($row, $changes, [
                'id'         => $id,
                'updated_at' => date('c'),
            ]);
            $found = true;
            break;
        }
    }

    return $found && store_put($name, $rows);
}

function store_delete(string $name, string $id): bool
{
    $rows = store_all($name);
    $kept = array_filter($rows, static fn (array $r): bool => ($r['id'] ?? '') !== $id);

    return count($kept) !== count($rows) && store_put($name, $kept);
}

/** Drop the in-request cache — needed after a write within the same request. */
function store_forget(?string $name = null): void
{
    $cache = &store_cache_ref();

    if ($name === null) {
        $cache = [];
        return;
    }
    unset($cache[$name]);
}

/**
 * The read cache, in its own function so both store_all() and store_forget()
 * can reach it. A static inside store_all() would be invisible from outside,
 * and a write would then be followed by a stale read in the same request.
 */
function &store_cache_ref(): array
{
    static $cache = [];
    return $cache;
}

/** Short, unguessable, URL-safe record id. */
function store_id(): string
{
    return bin2hex(random_bytes(8));
}
