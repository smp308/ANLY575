<?php
include 'init/init.php';

$values->title = 'Logout';
$values->heading = 'Logout';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);