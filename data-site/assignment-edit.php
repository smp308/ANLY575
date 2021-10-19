<?php
include 'init/init.php';

$values->title = 'Edit Assignment';
$values->heading = 'Edit Assignment';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);