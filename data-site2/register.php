<?php
include 'init/init.php';

$values->title = 'Register';
$values->heading = 'Register';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);