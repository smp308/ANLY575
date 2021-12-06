<?php
include 'init/init.php';

$values->title = 'Login';
$values->heading = 'Login';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);