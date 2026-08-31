<?php
/**
 * Admin authentication and the helpers the dashboard pages share.
 *
 * There is one account. It is created on first visit to /admin/ — the person
 * setting the site up chooses the password themselves, so nothing is ever
 * shipped with a default credential and no password passes through anyone
 * else's hands on the way there.
 *
 * The credential file lives in storage/, which .htaccess denies over HTTP
 * three times over (the site root rule, storage/.htaccess, and the
 * RedirectMatch). It holds a bcrypt hash, never the password.
 */

declare(strict_types=1);

require_once __DIR__ . '/store.php';

const ADMIN_SESSION_KEY   = 'admin_user';
const ADMIN_IDLE_TIMEOUT  = 3600;   // an hour of inactivity ends the session
const ADMIN_MAX_ATTEMPTS  = 5;      // per IP
const ADMIN_LOCKOUT       = 900;    // 15 minutes

function admin_file(): string
{
    return APP_ROOT . '/storage/admin.json';
}

/** The stored account, or null when the site has not been set up yet. */
function admin_account(): ?array
{
    if (!is_file(admin_file())) {
        return null;
    }
    $data = json_decode((string) @file_get_contents(admin_file()), true);

    return is_array($data) && isset($data['username'], $data['password_hash']) ? $data : null;
}

function admin_exists(): bool
{
    return admin_account() !== null;
}

/** Create the single account. Refuses to overwrite an existing one. */
function admin_create(string $username, string $password): bool
{
    if (admin_exists()) {
        return false;
    }

    $dir = dirname(admin_file());
    if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
        return false;
    }

    $ok = @file_put_contents(admin_file(), json_encode([
        'username'      => $username,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'created_at'    => date('c'),
    ], JSON_PRETTY_PRINT), LOCK_EX) !== false;

    if ($ok) {
        /* Owner-only: this file is the whole authentication system. */
        @chmod(admin_file(), 0600);
    }

    return $ok;
}

function admin_set_password(string $password): bool
{
    $account = admin_account();
    if ($account === null) {
        return false;
    }

    $account['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    $account['updated_at']    = date('c');

    $ok = @file_put_contents(admin_file(), json_encode($account, JSON_PRETTY_PRINT), LOCK_EX) !== false;
    if ($ok) {
        @chmod(admin_file(), 0600);
    }

    return $ok;
}

/* ------------------------------------------------------------------
 | Brute-force throttle
 |
 | Per IP, in the same file the public forms use for rate limiting. Five
 | wrong passwords buys a fifteen-minute wait. Without this a single admin
 | password is one long-running script away from being guessed.
 | ------------------------------------------------------------------ */

function admin_attempts_file(): string
{
    return APP_ROOT . '/storage/admin-attempts.json';
}

function admin_locked_out(): int
{
    $all = json_decode((string) @file_get_contents(admin_attempts_file()), true);
    $rec = is_array($all) ? ($all[admin_client_ip()] ?? null) : null;

    if (!is_array($rec) || ($rec['count'] ?? 0) < ADMIN_MAX_ATTEMPTS) {
        return 0;
    }

    $remaining = ((int) ($rec['last'] ?? 0) + ADMIN_LOCKOUT) - time();

    return $remaining > 0 ? $remaining : 0;
}

function admin_record_failure(): void
{
    $all = json_decode((string) @file_get_contents(admin_attempts_file()), true);
    $all = is_array($all) ? $all : [];
    $ip  = admin_client_ip();

    $rec = $all[$ip] ?? ['count' => 0, 'last' => 0];
    /* A lockout that has expired starts the count again rather than leaving
       the visitor one attempt away from another lockout forever. */
    if (time() - (int) $rec['last'] > ADMIN_LOCKOUT) {
        $rec['count'] = 0;
    }
    $rec['count']++;
    $rec['last'] = time();
    $all[$ip]    = $rec;

    /* Drop entries nobody is waiting on any more. */
    $all = array_filter($all, static fn (array $r): bool => time() - (int) $r['last'] < ADMIN_LOCKOUT * 4);

    @file_put_contents(admin_attempts_file(), json_encode($all), LOCK_EX);
}

function admin_clear_failures(): void
{
    $all = json_decode((string) @file_get_contents(admin_attempts_file()), true);
    if (is_array($all)) {
        unset($all[admin_client_ip()]);
        @file_put_contents(admin_attempts_file(), json_encode($all), LOCK_EX);
    }
}

function admin_client_ip(): string
{
    return (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
}

/* ------------------------------------------------------------------
 | Session
 | ------------------------------------------------------------------ */

function admin_login(string $username, string $password): bool
{
    $account = admin_account();

    /* Verify against a dummy hash when there is no account or the username is
       wrong, so a wrong username and a wrong password take the same time and
       the response cannot be used to enumerate the username. */
    $hash = ($account && hash_equals($account['username'], $username))
        ? $account['password_hash']
        : '$2y$12$usesomesillystringfore7hnbRJHxXVLeakoG8K30oukPsA.ztMG';

    if (!password_verify($password, $hash) || $account === null) {
        admin_record_failure();
        return false;
    }

    admin_clear_failures();

    /* New session id on privilege change, so a session fixed before login is
       not the session that ends up authenticated. */
    session_regenerate_id(true);

    $_SESSION[ADMIN_SESSION_KEY] = [
        'username' => $account['username'],
        'since'    => time(),
        'seen'     => time(),
        'ua'       => substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 120),
    ];

    return true;
}

function admin_logout(): void
{
    unset($_SESSION[ADMIN_SESSION_KEY]);
    session_regenerate_id(true);
}

/** True when the current request is an authenticated, non-idle admin. */
function admin_is_logged_in(): bool
{
    $s = $_SESSION[ADMIN_SESSION_KEY] ?? null;
    if (!is_array($s)) {
        return false;
    }

    if (time() - (int) ($s['seen'] ?? 0) > ADMIN_IDLE_TIMEOUT) {
        admin_logout();
        return false;
    }

    /* A session that changes browser mid-life is a stolen cookie far more
       often than it is a real person, and the cost of being wrong is one
       extra login. */
    if (($s['ua'] ?? '') !== substr((string) ($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 120)) {
        admin_logout();
        return false;
    }

    $_SESSION[ADMIN_SESSION_KEY]['seen'] = time();

    return true;
}

function admin_username(): string
{
    return (string) ($_SESSION[ADMIN_SESSION_KEY]['username'] ?? '');
}

/** Send anyone who is not logged in to the login screen. */
function admin_require_login(): void
{
    if (!admin_is_logged_in()) {
        header('Location: /admin/login.php', true, 302);
        exit;
    }
}

/* ------------------------------------------------------------------
 | Flash messages between redirects
 | ------------------------------------------------------------------ */

function admin_flash(?string $type = null, string $message = ''): ?array
{
    if ($type !== null) {
        $_SESSION['admin_flash'] = ['type' => $type, 'message' => $message];
        return null;
    }

    $flash = $_SESSION['admin_flash'] ?? null;
    unset($_SESSION['admin_flash']);

    return is_array($flash) ? $flash : null;
}

/** Redirect after a POST so a refresh cannot repeat the action. */
function admin_redirect(string $path): never
{
    header('Location: ' . $path, true, 303);
    exit;
}
