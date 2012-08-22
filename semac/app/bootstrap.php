<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


Autoloader::add_classes(array(
	// Add classes you want to override here
	'Validation' => APPPATH.'classes/validation.php',
	'View'       => APPPATH.'classes/view.php',

	/* Extendido simplegroup e auth para adicionar algumas features necessárias */
	'Auth_Login_SimpleAuth'  => APPPATH.'classes/auth/login/simpleauth.php',
	'Auth_Group_SimpleGroup' => APPPATH.'classes/auth/group/simplegroup.php',
));

// Register the autoloader
Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGE
 * Fuel::PRODUCTION
 */

if (isset($_SERVER['OPENSHIFT_APP_NAME']) or isset($_ENV['OPENSHIFT_APP_NAME']))
	Fuel::$env = Fuel::PRODUCTION;
else
	Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');