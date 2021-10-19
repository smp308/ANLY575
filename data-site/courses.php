<?php
include 'init/init.php';

$values->title = 'Courses';
$values->heading = 'Courses';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);