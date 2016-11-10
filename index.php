<?php

//sets up autoloading of composer dependencies
include 'vendor/autoload.php';

// Require phpreport class
require('classes/Bootstrap.php');

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

$app->get('/db/{id}', function($id) use ($app) {
	return PhpReporty::db_page_test($id);
});

$app->run();

?>