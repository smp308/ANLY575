<?php
define("ROOT_PATH", '/CHANGE/THIS/PATH/data-site/');
define("CLASS_PATH", ROOT_PATH . '/classes/');
define("TEMPLATE_PATH", ROOT_PATH . '/templates/');
define("PROTOCOL", 'http://');
define("DOMAIN", 'CHANGETHISDOMAIN/');
define("SUBFOLDER", 'data-site/');
define("URL_ROOT", PROTOCOL . DOMAIN . SUBFOLDER);
const TABLES = array(
	'User' => 'users',
	'Assignment' => 'assignments',
	'Submission' => 'submissions'
);
const DB = array(
	'host' => 'CHANGE-THIS-HOST',
	'db'   => 'CHANGE-THIS-DATABASE-NAME',
	'user' => 'CHANGE-THIS-USER-NAME',
	'pass' => 'CHANGE-THIS-PASSWORD',
	'charset' => 'utf8mb4'
);