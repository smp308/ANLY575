<?php
include 'init/init.php';

$values->title = 'Edit Course';
$values->heading = 'Edit Course';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);