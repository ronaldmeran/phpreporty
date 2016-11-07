<?php

//sets up autoloading of composer dependencies
include 'vendor/autoload.php';

// Sets up main class for PHP
require 'libraries/PhpReporty/PhpReporty.php';

// Initialize application
$phpreporty = PhpReporty::init();

// Application
$app = $phpreporty->app;

// Configurations
$config = $phpreporty->config;

// Include routers
$app->get('/', function() use ($app) {
	return PhpReporty::default_page();
});

$app->run();

?>