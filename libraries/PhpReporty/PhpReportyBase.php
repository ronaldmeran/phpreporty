<?php

/**
 * PHPReportyBase Class
 * Abstract class for PHPReporty
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November PHPReporty
 */
abstract class PhpReportyBase {
	
	/* Public static application */
	public static $ap;

	 /**
     * Instantiate a PHPReporty
     *
     * Initializes, autoloads all required dependencies
     *
     * @param null
     */
    public function run() 
	{
		// Initialize Silex
		return self::$ap = new Silex\Application();
	}

}
