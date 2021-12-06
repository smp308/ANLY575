<?php
include 'init/init.php';

$values->title = 'Users';
$values->heading = 'Users';

$page = new Page('main.page.template.php');
$page->render($values, __FILE__);

//include 'init/init.php';

// $values->title = 'Users';
// $values->heading = 'Users';

// $page = new Page('main.page.template.php');
// $page->render($values, __FILE__);

// $caption = 'Users';
// $headers = array('ID', 'First Name', 'Last Name', 'Email', 'Approved');
// $data = array('3', 'Steph', 'Smith', 'steph@gmail.com', '1'); // note: this would be an array of rows from a database query
// $attributes = array('id' => 'userTable', 'class' => 'somePredefinedClass');

// include CLASS_ROOT . 'UI.class.php'; // if the UI file has not been included yet
// $ui = new UI(); // if the UI class has not been called yet;

// $table = simpleTable($caption, $headers, $data, $attributes);
// echo $table; // this would render a fully complete table
