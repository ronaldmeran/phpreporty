<?php
/*
  |--------------------------------------------------------------------------
  | Config file
  |--------------------------------------------------------------------------
  | Configuration file for PHPReporty
  | Includes report directory, database environment,
  | bootstrap theme, reports format
  | @author Ronald Meran
 */

define('APP_ROOT', realpath(__DIR__ . '/..'));

return array(
	/*
     * The root directory of all the reports created
     * Reports can be organized in subdirectories
     */
	'reportDir' => 'sample_reports',

	//the directory where things will be cached
	//this is relative to the project root by default, but can be set to an absolute path too
	//the cache has some relatively long lived data so don't use /tmp if you can avoid it
	//(for example historical report timing data is stored here)
	'cacheDir' => 'cache',

	//this maps file extensions to report types
	//to override this for a specific report, simply add a TYPE header
	//any file extension not in this array will be ignored when pulling the report list
	'default_file_extension_mapping' => array(
		'sql'=>'Pdo',
		'php'=>'Php',
		'js'=>'Mongo',
		'ado'=>'Ado',
		'pivot'=>'AdoPivot',
	),

	//turns on app debug, set to true to display php/application error
	'app_debug' => true,

	//gets the template directory
	'template_dir' => APP_ROOT.'/templates/default/html/',

	//this enables listing different types of download formats on the report page
	//to change that one can add or remove any format from the list below
	//in order to create a divider a list entry have to be added with any key name and
	//a value of 'divider'
	'report_formats' => array(
		'csv'=>'CSV',
		'xlsx'=>'Download Excel 2007',
		'xls'=>'Download Excel 97-2003',
		'text'=>'Text',
		'table'=>'Simple table',
		'raw data'=>'divider',
		'json'=>'JSON',
		'xml'=>'XML',
		'sql'=>'SQL INSERT command',
		'technical'=>'divider',
		'debug'=>'Debug information',
		'raw'=>'Raw report dump',
	),

	//this enebales one to change the default bootstrap theme
	'bootstrap_theme' => 'cosmo',

	//this list all the available themes for a user to switch and use the one he or she likes
	//once removed the theme will not appear in the dropdown
	//if all to be removed - no dropdown will be visible for the user and the default (above) will be used
	'bootstrap_themelist' => array(
	    'default',
	    'amelia', 'cerulean', 'cosmo', 'cyborg', 'flatly', 'journal', 'readable', 'simplex', 'slate', 'spacelab', 'united'
	),

	//sets the active environment
	'active_environment' => 'default',

	//sets the driver
	'default_driver' => 'pdo',

	//this defines the database environments
	//the keys are the environment names (e.g. "default", "production")
	//the values are arrays that contain connection info
	'environments' => array(

		'default' => array(
			// Supports AdoDB connections
			'ado'=>array(
				'uri'=>'mysql://username:password@localhost/database'
			),

			// Supports and PDO database
			'pdo'=>array(
				'dsn'=>'mysql:host=localhost;dbname=topdraw',
				'hostname' => 'localhost',
				'username' => 'root',
				'password' => '1qaz2wsx',
				'database' => 'topdraw',
				'dbdriver' => 'pdo_mysql',
				'dbprefix' => 'dbprefix',
				'char_set' => 'utf8mb4',
				'port' => '3306',
				'path' => '',
			),

			// Supports MongoDB
			'mongo'=>array(
				'host'=>'localhost',
				'port'=>'27017'
			),
		),
	),

	// This is called twice, once for each Twig_Environment that is used
	'twig_init_function' => function (Twig_Environment $twig) {

	}
);
?>
