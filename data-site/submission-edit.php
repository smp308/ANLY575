<?php
include 'init/init.php';

$values->title = 'Edit Submission';
$values->heading = 'Edit Submission';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);