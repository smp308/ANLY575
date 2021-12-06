<?php

// localhost
if ( ($_SERVER['HTTP_HOST'] == 'localhost') || ($_SERVER['HTTP_HOST'] == '127.0.0.1') ) {
	define("ROOT_PATH", '/Users/stephanieplaza/Documents/GitHub/ANLY575/data-site3/');
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
	define("ROOT_PATH", '/home/stephan4/public_html/data-site3');
//	define("PROTOCOL", 'https://'); // change to https:// if necessary
	define("DOMAIN", 'https://stephanieplaza.georgetown.domains/');
	define('DB', array(
		'host' => 'gtown2',
		'db'   => 'stephan4_anly575',
	    'user' => 'stephan4_anly575',
		'pass' => 'DSANanly575',
		'charset' => 'utf8mb4'
	));
}

define("ADMIN_EMAIL", 'smp308@georgetown.edu');
define("CLASS_PATH", ROOT_PATH . '/classes/');
define("TEMPLATE_PATH", ROOT_PATH . '/templates/');
define("SUBFOLDER", 'data-site3/');
define("URL_ROOT",  DOMAIN . SUBFOLDER); //PROTOCOL .
define ('TABLES', array(
	'User' => 'users',
	'Assignment' => 'assignments',
	'Submission' => 'submissions',
	'Course' => 'courses'
));