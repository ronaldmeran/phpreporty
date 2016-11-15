<?php  
/**
 * Schema Manager Class
 * Handles all database interactions
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */
 
class Schema {

	/** Silex app */
	protected static $app = '';
	protected $conn = '';
	protected $sm = '';

	/**
     * Initialize silex app and database connection
     *
     * @param null
     */
	public function __construct($conn='', $sm=''){

		// Run Silex App
		self::$app = Silex_App::run();
	}

	/**
     * Initialize silex app and database connection
     *
     * @param null
     */
	private function _select(){

		// Run Silex App
		$sql = "SELECT ". implode(",", array($selector)) ." FROM ".$main_table."";	

		// Execute query
		$data = self::$conn['dbs']['pdo']->fetchAssoc($sql, array((int) $id));
	}

	/**
     * Initialize silex app and database connection
     *
     * @param null
     */
	public function _fields(){

		// Database connection
		// $entityManager->getClassMetadata->getFieldForColumn($column);

		$conn = Database::connect();

		// Schema Manager
		$sm = $conn['dbs']['pdo']->getSchemaManager();
		$data = $sm->listTables();
		
		print "<pre>";print_r($data);print "</pre>";
		exit;
	}
	
}

?>