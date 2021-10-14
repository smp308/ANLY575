<?php
include 'init/init.php';

$values->title = 'Add User';
$values->heading = 'Add User';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);