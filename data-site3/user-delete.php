<?php
include 'init/init.php';

$values->title = 'Delete User';
$values->heading = 'Delete User';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);