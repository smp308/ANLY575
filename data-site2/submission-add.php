<?php
include 'init/init.php';

$values->title = 'Add Submission';
$values->heading = 'Add Submission';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);
?>
