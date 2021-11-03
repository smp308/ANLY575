<?php
include 'init/init.php';
$values->title = 'Test Page';
$values->heading = 'Test Page';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);