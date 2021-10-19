<?php
include 'init/init.php';

$values->title = 'Add Course';
$values->heading = 'Add Course';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);