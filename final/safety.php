<?php
include 'init/init.php';

$values->title = 'Safety';
$values->heading = 'Safety';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);