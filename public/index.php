<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Enviroment setup
 */

use Dotenv\Dotenv;
// Import .env variables and add them the enviroment
$dotenv = new Dotenv(__DIR__."/../");
$dotenv->load();

/**
 * Loging
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$stream = new StreamHandler('logs/main.log', Logger::DEBUG);
// Create a logger for the debugging-related stuff
$logger = new Logger('debug');
$logger->pushHandler($stream);

/**
 * Error and Exception handling
 */

// Whoops error handling
$whoops = new Whoops\Run();
// Set Whoops as the default error and exception handler used by PHP:
$whoops->register();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());

require_once('../App/Routes.php');