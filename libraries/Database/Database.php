<?php  
/**
 * Database Class
 * Configuration Settings for the database connection
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */
 
class Database {

	/** Silex app */
	public static $app;

	/**
     * Connection information and database settings
     *
     * @param null
     */
	public static function connect(){

		// Run Silex App
		self::$app = Silex_App::run();

		// PHP Report
		$config = PhpReporty::set_config();

		// Active environment
		$env = $config['active_environment'];

		// Driver
		$driver = $config['default_driver'];

		// Return self
		return self::$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
		     'dbs.options' => array (
		        'pdo' => array(
		            'driver'    => $config['environments'][$env][$driver]['dbdriver'],
		            'host'      => $config['environments'][$env][$driver]['hostname'],
		            'dbname'    => $config['environments'][$env][$driver]['database'],
		            'user'      => $config['environments'][$env][$driver]['username'],
		            'password'  => $config['environments'][$env][$driver]['password'],
		            'charset'   => $config['environments'][$env][$driver]['char_set'],
		        ),
		    ),
		));
	}
	
}

?>