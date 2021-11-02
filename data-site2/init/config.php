<?php

// localhost
if ( ($_SERVER['HTTP_HOST'] == 'localhost') || ($_SERVER['HTTP_HOST'] == '127.0.0.1') ) {
	define("ROOT_PATH", '/Users/stephanieplaza/Documents/GitHub/ANLY575/data-site2/');
	define("PROTOCOL", 'http://');
	define("DOMAIN", 'localhost/');
	define('DB', array(
		'host' => 'localhost',
		'db'   => 'anly575',
		'user' => 'anly575',
		'pass' => 'DSANanly575',
		'charset' => 'utf8mb4'
	));
	
} else {
	// public server
	define("ROOT_PATH", 'put/your/REMOTE/path/here');
	define("PROTOCOL", 'http://'); // change to https:// if necessary
	define("DOMAIN", 'put.your.REMOTE.url.here.com');
	define('DB', array(
		'host' => 'localhost',
		'db'   => 'anly575',
		'user' => 'anly575',
		'pass' => 'DSANanly575',
		'charset' => 'utf8mb4'
	));
}

define("ADMIN_EMAIL", 'PUT-YOUR-EMAIL-HERE');
define("CLASS_PATH", ROOT_PATH . 'classes/');
define("TEMPLATE_PATH", ROOT_PATH . '/templates/');
define("SUBFOLDER", 'data-site2/');
define("URL_ROOT", PROTOCOL . DOMAIN . SUBFOLDER);
define ('TABLES', array(
	'User' => 'users',
	'Assignment' => 'assignments',
	'Submission' => 'submissions',
	'Course' => 'courses'
));