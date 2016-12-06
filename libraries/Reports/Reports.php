<?php

/**
 * PHPReporty Class
 * Main php-report class to create reports based on set templates,
 * generate sql queries and database model objects
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Reports extends PHPReporty 
{
	
	/**
     * Creates report template
     *
     * @param string $reportType Type of report to generate
     * @param array $reportData Array data, or SQL
     * @param array $param Additional parameters in the report
     * @return array $report Generated sql table result
     */
	public function createReport($reportType='', $reportData=array(), $param=array()) 
	{	
		$data = array(
			'reportCategory' => array(
				'simple'	=> 'Simple Report', 
				'customized' => 'Customized Report',
				'chart' => 'Charts / Graph'
			),
			'dbtables' => parent::getTables(),
		);

		// Get the template
		$template = parent::render('simple_report', $data);
		
		return $template;
	}

	/**
     * Get the table fields
     *
     * @param string $table Name of the table
     * @return array
     */
	public function getTableFields()
	{
		return json_encode(parent::getFields($_POST['table']));
	}

}