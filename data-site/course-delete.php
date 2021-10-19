<?php
include 'init/init.php';

$values->title = 'Delete Course';
$values->heading = 'Delete Course';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);