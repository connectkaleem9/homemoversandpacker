<?php
/**
 * MySQL access via PDO, with prepared statements only.
 *
 * The database is optional. DB_ENABLED is false by default, and even when it
 * is on, a connection failure never loses a lead — the form handlers fall back
 * to append-only file storage and still notify by email. A lead is revenue;
 * losing one because MySQL was restarting is not acceptable.
 */

declare(strict_types=1);

function db(): ?PDO
{
    static $pdo = null;
    static $attempted = false;

    if (!DB_ENABLED) {
        return null;
    }
    if ($attempted) {
        return $pdo;
    }
    $attempted = true;

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', DB_HOST, DB_PORT, DB_NAME, DB_CHARSET);

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_STRINGIFY_FETCHES  => false,
        ]);
    } catch (PDOException $e) {
        error_log('[db] connection failed: ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}

/** Run a prepared statement and return all rows. Returns [] when the DB is off. */
function db_select(string $sql, array $params = []): array
{
    $pdo = db();
    if ($pdo === null) {
        return [];
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log('[db] select failed: ' . $e->getMessage());
        return [];
    }
}

/** Run a prepared write. Returns the inserted id, or null on failure. */
function db_insert(string $sql, array $params = []): ?string
{
    $pdo = db();
    if ($pdo === null) {
        return null;
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log('[db] insert failed: ' . $e->getMessage());
        return null;
    }
}
