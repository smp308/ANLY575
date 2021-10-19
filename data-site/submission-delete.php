<?php
include 'init/init.php';

$values->title = 'Delete Submission';
$values->heading = 'Delete Submission';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);