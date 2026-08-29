-- ==========================================================================
-- homemoverandpaker.com — MySQL schema
--
-- The site runs without a database (leads fall back to append-only file
-- storage). Import this and set DB_ENABLED=true to store leads in MySQL.
--
--   mysql -u root -p < database/schema.sql
--
-- Services, locations, FAQs and blog content deliberately live in PHP data
-- files rather than tables: they are edited by developers, versioned in git,
-- and need no runtime queries. Only submitted data belongs in the database.
-- ==========================================================================

CREATE DATABASE IF NOT EXISTS `homemoverandpaker`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `homemoverandpaker`;

-- --------------------------------------------------------------------------
-- Quote requests — the primary conversion
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quote_submissions` (
  `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(120)  NOT NULL,
  `phone`         VARCHAR(32)   NOT NULL,
  `email`         VARCHAR(160)  NULL,
  `moving_from`   VARCHAR(160)  NOT NULL,
  `moving_to`     VARCHAR(160)  NOT NULL,
  `property_type` VARCHAR(60)   NULL,
  `moving_date`   DATE          NULL,
  `service`       VARCHAR(80)   NULL,
  `details`       TEXT          NULL,
  `source`        VARCHAR(120)  NULL COMMENT 'Which page or campaign the lead came from',
  `status`        ENUM('new','contacted','quoted','won','lost') NOT NULL DEFAULT 'new',
  `ip_address`    VARCHAR(45)   NULL,
  `user_agent`    VARCHAR(255)  NULL,
  `created_at`    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_status` (`status`),
  KEY `idx_phone` (`phone`),
  KEY `idx_service` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------------------
-- General contact messages — the secondary route
-- --------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contact_submissions` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(120) NOT NULL,
  `phone`      VARCHAR(32)  NULL,
  `email`      VARCHAR(160) NULL,
  `subject`    VARCHAR(160) NULL,
  `message`    TEXT         NOT NULL,
  `source`     VARCHAR(120) NULL,
  `status`     ENUM('new','read','replied','closed') NOT NULL DEFAULT 'new',
  `ip_address` VARCHAR(45)  NULL,
  `user_agent` VARCHAR(255) NULL,
  `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------------------------
-- Optional: a database-backed application user.
-- Replace the password before running this on a real server, and never use
-- the root account for the website's own connection.
-- --------------------------------------------------------------------------
-- CREATE USER IF NOT EXISTS 'homemovers'@'localhost' IDENTIFIED BY 'CHANGE_THIS_PASSWORD';
-- GRANT SELECT, INSERT, UPDATE ON `homemoverandpaker`.* TO 'homemovers'@'localhost';
-- FLUSH PRIVILEGES;
