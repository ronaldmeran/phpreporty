<?php

/**
 * PHPReporty Class
 * Main php-report class to create reports based on set templates,
 * generate sql queries and database model objects
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */

use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

class PhpReporty 
{	
	public static $app;
	public static $config;
	protected static $conn;
	protected static $sm;
	protected static $query;
	protected static $dbal;

	 /**
     * Instantiate a PHPReporty
     *
     * Initializes, autoloads all required dependencies
     *
     * @param string $config The parameters in config file.
     */
    public static function init() 
	{
		// Run Silex App
		self::$app = Silex_App::run();

		// Database connection
		self::$conn = Database::connect();

		// Set debug
		self::set_debug();

		// Set DBAL
		self::set_dbal();

		// Set schema manager
		self::set_schema_manager();

		// Set query builder
		self::set_query_builder();

		// Return
		return (object) array(
			'app' => self::$app, // New Silex application
			'config' => self::$config // Configuration in config/config.php
		);

	}

	/**
     * Set Debugger
     *
     * Sets the debugging on the page
     *
     * @param null
     */
	public static function set_debug() 
	{
		// Debug
		self::$app['debug'] = self::$config['app_debug'];
	}

	/**
     * Set Schema Manager
     *
     * Sets the schema manager
     *
     * @param null
     */
	public static function set_dbal() 
	{
		// Set schema manager
		self::$dbal = self::$conn['dbs'][self::$config['default_driver']];
	}

	/**
     * Set Schema Manager
     *
     * Sets the schema manager
     *
     * @param null
     */
	public static function set_schema_manager() 
	{
		// Set schema manager
		self::$sm = self::$dbal->getSchemaManager();
	}

	/**
     * Set Schema Manager
     *
     * Sets the schema manager
     *
     * @param null
     */
	public static function set_query_builder() 
	{
		// Set schema manager
		self::$query = self::$dbal->createQueryBuilder();
	}

	/**
     * Sets the default configuration file
     *
     * Default page for PHPReporty
     *
     * @param string $config Collection/array of application settings
     */
	public static function set_config($config = 'config/config.php') 
	{
		// Validate if file exists
		if(!file_exists($config)) {
			throw new Exception("Cannot find config file. Please make sure that the config file is in `config/config.php`.");
		}

		// Require config file
		return self::$config = require_once($config);
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
		$data = array(
			'reportCategory' => array(
				'simple'	=> 'Simple Report', 
				'customized' => 'Customized Report',
				'chart' => 'Charts / Graph'
			)
		);

		// Get the template
		$template = self::render('report_list', $data);

		return $template;
	}

	/**
     * Get the table list
     *
     * @param void
     * @return array
     */
	public function getTableList()
	{
		// Get list of tables
   		return self::$sm->listTables();
	}

	/**
     * Get the table array
     *
     * @param void
     * @return array
     */
	public function getTables()
	{
		// Get list of tables
   		$tb = self::getTableList();

		foreach ($tb as $key => $table)
			$tb[$key] = $table->getName();

		return $tb;
	}

	/**
     * Get the column names in the table
     *
     * @param string $table Name of the table
     * @return array
     */
	public function getFieldList($table='')
	{
		return self::$sm->listTableColumns($table);
	}

	/**
     * Get the table array
     *
     * @param string $table Name of the table
     * @return array
     */
	public function getFields($table='')
	{
		// Initialize array
		$cols = array();

		// Get list of tables
   		$col = self::getFieldList($table);

		foreach ($col as $key => $column){
			$cols[$key]['name'] = $column->getName();
			$cols[$key]['type'] = $column->getType();
		}

		return $cols;
	}

	/**
     * Get the table array
     *
     * @param string $table Name of the table
     * @return array
     */
	public function index()
	{
		$data = array(
			'dbtables' => self::getTables(),
			'dbfields' => self::getFields()
		);

		return self::render('dbsuccess', $data); 
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

		// Get the url
		$url = explode("/", $_SERVER['REQUEST_URI']);
		$url = isset($url[1]) ? $url[1] : false;
		$url = !empty($url) ? $url : false; 

		$default = array(
			'base'=> $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$url,
			'path'=> $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$url,
			'report_list_url'=> $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$url,
			'request'=> '',
			'querystring'=> $_SERVER['QUERY_STRING'],
			'config'=> self::$config,
			'environment'=> '',
			'recent_reports'=> '',
			'session'=>'',
			'theme'=> self::$config['bootstrap_theme'],
			'error'=> '',
			'reports'=> '',
			'report_errors'=> '',
			'notice'=>''
		);

		/** Merge default and user data */
		$default = array_merge($data, $default);

		return $template['twig']->render($twig_template.'.twig', $default);
	}

}