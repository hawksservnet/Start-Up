<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';

\Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',

	'MyRules'		=> __DIR__ .'/classes/myrules.php',
	'myPagination'	=> __DIR__ .'/classes/model/mypagination.php',
	'Auth_Login_Simpleauth' => APPPATH.'classes/auth/login/simpleauth.php',
));

// Register the autoloader
\Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */
if (!empty($_SERVER['SERVER_PORT']) and $_SERVER['SERVER_PORT'] == 443) {
	// SSHなら基本本番
	\Fuel::$env = \Arr::get($_SERVER, 'FUEL_ENV', \Arr::get($_ENV, 'FUEL_ENV', \Fuel::PRODUCTION));
} else {
	\Fuel::$env = \Arr::get($_SERVER, 'FUEL_ENV', \Arr::get($_ENV, 'FUEL_ENV', \Fuel::DEVELOPMENT));
}
// Initialize the framework with the config file.
\Fuel::init('config.php');
