<?php
include 'init/init.php';

$values->title = 'Feelings';
$values->heading = 'Feelings';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);