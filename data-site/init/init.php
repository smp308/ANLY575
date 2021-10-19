<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/Users/stephanieplaza/Documents/GitHub/ANLY575/data-site/init/config.php';
include CLASS_PATH . 'Base.class.php';
include CLASS_PATH . 'Database.class.php';
include CLASS_PATH . 'Page.class.php';

$values = new stdClass();