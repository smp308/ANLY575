<?php
include 'init/init.php';

$values->title = 'Winners';
$values->heading = 'Winners';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);