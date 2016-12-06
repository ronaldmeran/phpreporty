<?php

//sets up autoloading of composer dependencies
$config = 'vendor/autoload.php';

// Validate if file exists
if(!file_exists($config))
	throw new Exception("Cannot find autoload.php. Please make sure that you run composer install.");
else
	include $config;

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

$app->get('/fields/{table}', function($table) use ($app) {
	return PhpReporty::getFields($table);
});

$app->get('/test', function($table) use ($app) {
	return PhpReporty::index($table);
});

$app->get('create_report/{reportType}', function($reportType) use ($app) {
	return Reports::createReport($reportType);
});

$app->get('/charts', function() use ($app) {
	return PhpReporty::charts();
});

$app->get('/generateData', function() use ($app) {
	return PhpReporty::generateData();
});

$app->get('/testreport', function() use ($app) {
	return Reports::index();
});

$app->post('/getTableFields', function() use ($app) {
	return Reports::getTableFields();
});

$app->run();

?>