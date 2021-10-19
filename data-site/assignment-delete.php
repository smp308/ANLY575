<?php
include 'init/init.php';

$values->title = 'Delete Assignment';
$values->heading = 'Delete Assignment';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);