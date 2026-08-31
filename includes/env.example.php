<?php
/**
 * Server-specific settings — copy to includes/env.php and fill in.
 *
 * includes/env.php is gitignored: it holds credentials and the environment
 * name, which differ per machine and must never be committed. Anything left
 * out here falls back to the environment and then to the default in
 * config.php, so an incomplete file is safe.
 */

declare(strict_types=1);

return [
    /* 'local' on a developer machine, 'production' on the live server.
       'production' turns off displayed errors and switches on error logging
       to storage/logs/php-error.log. */
    'APP_ENV' => 'local',

    /* Leads are written to storage/leads.jsonl whether or not this is on.
       Switch it to 'true' once the MySQL database exists and the schema in
       database/schema.sql has been imported. */
    'DB_ENABLED' => 'false',
    'DB_HOST'    => 'localhost',
    'DB_PORT'    => '3306',
    'DB_NAME'    => '',
    'DB_USER'    => '',
    'DB_PASS'    => '',

    /* Where new enquiries are emailed. Leave blank to use EMAIL_ADDRESS from
       config.php — a blank value here means "not set", not "send to nobody". */
    'LEAD_NOTIFY_EMAIL' => '',
];
