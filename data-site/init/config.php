<?php
define("ROOT_PATH", '/Users/stephanieplaza/Documents/GitHub/ANLY575/data-site/');
define("CLASS_PATH", ROOT_PATH . '/classes/');
define("TEMPLATE_PATH", ROOT_PATH . '/templates/');
define("PROTOCOL", 'http://');
define("DOMAIN", 'localhost/');
define("SUBFOLDER", 'data-site/');
define("URL_ROOT", PROTOCOL . DOMAIN . SUBFOLDER);
const TABLES = array(
	'User' => 'users',
	'Assignment' => 'assignments',
	'Submission' => 'submissions',
	'Course' => 'courses',
);
const DB = array(
	'host' => 'localhost',
	'db'   => 'anly575',
	'user' => 'anly575',
	'pass' => 'DSANanly575',
	'charset' => 'utf8mb4'
);