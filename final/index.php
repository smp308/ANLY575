<?php
include 'init/init.php';

$values->title = 'Home';
$values->heading = 'Home';
$values->header = 'main.header.template.php';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);