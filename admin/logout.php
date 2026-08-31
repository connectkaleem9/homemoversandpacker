<?php
/** Ends the admin session. POST only, so a link cannot log someone out. */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && csrf_verify($_POST['csrf_token'] ?? null)) {
    admin_logout();
}

header('Location: /admin/login.php', true, 303);
