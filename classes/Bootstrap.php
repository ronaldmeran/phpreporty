<?php

/**
 * Bootstrap
 * Bootstrap class for PHPReporty
 * 
 * @author: Ronald M. Meran
 * @copyright: 2016 November Aremem
 */

/** PHPReporty root directory */
if (!defined('LIBRARY_DIR')) {
    define('LIBRARY_DIR', 'libraries/');
}

class Bootstrap {

    /**
     * Register the Autoloader with SPL
     *
     */
    public static function Register(){

        /** register bootstrap autoload */
        return spl_autoload_register(array('Bootstrap', 'autoload'));
    }

    /**
     * Autoloads all classes found in library directory
     *
     */
    public static function autoload() 
    {
        /** Get the realpath */
        $path = realpath(LIBRARY_DIR);

        /** Get directories */
        $directory = new RecursiveDirectoryIterator($path);

        /** Implement new Iterator */
        $iterator = new RecursiveIteratorIterator($directory);

        /** Get php objects */
        $objects = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach($objects as $name => $object){
             include_once $name;
        }

      }

}

Bootstrap::Register();
