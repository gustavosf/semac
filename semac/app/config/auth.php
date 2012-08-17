<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
	// SemacAuth é basicamente igual a simpleauth, exceto a parte de acl
	// A implementação está em app/classes/auth
	'driver' => 'SemacAuth',
	'verify_multiple_logins' => false,
	'salt' => 'S3M@c--s41t=hEr3',
);

