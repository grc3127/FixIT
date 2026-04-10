<?php
/**
 * Bootstrap file for all entry points.
 * Loads config, security, configures session, starts session, connects DB.
 *
 * Usage: require_once __DIR__ . "/../../config/bootstrap.php";
 *        (or adjust relative path as needed)
 */

// Load security class first (no dependencies)
require_once dirname(__DIR__) . '/src/security.php';

// Load environment config
$envConfig = require dirname(__DIR__) . '/config/env.php';

// Configure and start session (only if not already started)
if (session_status() === PHP_SESSION_NONE) {
    Security::configureSession($envConfig['session']);
    session_start();
}

// Load DB connection and helpers
require_once dirname(__DIR__) . '/config/db.php';
