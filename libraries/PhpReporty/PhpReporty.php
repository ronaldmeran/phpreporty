<?php

use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

class PhpReporty {
	
	public static $app;
	public static $config;

	 /**
     * Instantiate a PHPReporty
     *
     * Initializes, autoloads all required dependencies
     *
     * @param string $config The parameters in config file.
     */
    public static function init($config = 'config/config.php') 
	{
		// Initialize Silex
		self::$app = new Silex\Application();

		// Validate if file exists
		if(!file_exists($config)) {
			throw new Exception("Cannot find config file. Please make sure that the config file is in `config/config.php`.");
		}

		// Includes config file
		self::$config = include($config);

		// Debug
		self::$app['debug'] =  self::$config['app_debug'];

		// Return
		return (object) array(
			'app' => self::$app, // New Silex application
			'config' => self::$config // Configuration in config/config.php
		);

	}

	/**
     * Gets default page
     *
     * Default page for PHPReporty
     *
     * @param array $values The parameters or objects.
     */
	public static function default_page() 
	{
		// Get the template
		$template = self::render('report_list', array('test' => 1));

		return $template;
	}

	/**
     * Renders view page for the Reports
     *
     * Initialize twig template
     *
     * @param array $values The parameters or objects.
     */
	public static function render($twig_template, $data=array()) 
	{
		// Register twig templating service provider
		$template = self::$app->register(new Silex\Provider\TwigServiceProvider(), array(
    		'twig.path' => self::$config['template_dir']
		));

		$default = array(
			'base'=>'http://localhost/phpreporty',
			'path'=>'http://localhost/phpreporty',
			'report_list_url'=>'http://localhost/phpreporty/',
			'request'=>'',
			'querystring'=>$_SERVER['QUERY_STRING'],
			'config'=>self::$config,
			'environment'=>'',
			'recent_reports'=>'',
			'session'=>'',
			'theme'=>self::$config['bootstrap_theme'],
			'error'=>'',
			'reports'=>'',
			'report_errors'=>'',
			'notice'=>''
		);

		return $template['twig']->render($twig_template.'.twig', $default);
	}

}