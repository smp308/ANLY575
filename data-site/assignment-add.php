<?php
include 'init/init.php';

$values->title = 'Add Assignment';
$values->heading = 'Add Assignment';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);