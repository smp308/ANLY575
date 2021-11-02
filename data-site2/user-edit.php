<?php
include 'init/init.php';

$values->title = 'Edit User';
$values->heading = 'Edit User';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);