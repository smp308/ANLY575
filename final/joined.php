<?php
include 'init/init.php';

$values->title = 'Weather';
$values->heading = 'Weather';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);