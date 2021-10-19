<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/CHANGE/THIS/PATH/data-site/init/config.php';
include CLASS_PATH . 'Base.class.php';
include CLASS_PATH . 'Database.class.php';
include CLASS_PATH . 'Page.class.php';

$values = new stdClass();