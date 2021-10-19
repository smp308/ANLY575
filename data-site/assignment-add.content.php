<?php
$db = new Database();

$postError = "<p>Error: form assignment was incomplete.</p>\n";

if (isset($_POST['name'])) {

	$postName = $_POST['name'];
	$postDescription = $_POST['description'];
	$postDeadline = $_POST['deadline'];

	if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['deadline'])) { 
		echo $postError;
		return;
	}
	$insertSql = "INSERT INTO `assignments` (`name`, `description`, `deadline`) ";
	$insertSql .= " VALUES (\"{$postName}\", \"{$postDescription}\", \"{$postDeadline}\");";
	$insertId = $db->insert($insertSql);
	
	$sql = 'SELECT * FROM `assignments` WHERE `id` = ' . $insertId;
	$assignment = $db->object('Assignment', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$assignment = $assignment[0];

	$success = "<h2>Assignment Created</h2>\n";
	$success .= "<p>Assignment Name: {$assignment->name}</p>\n";
	$success .= "<p>Description: {$assignment->description}</p>\n";
	$success .= "<p>Deadline: {$assignment->deadline}</p>\n";
	$success .= "<p><a href=\"assignments.php\" class=\"button\">Back to assignment list</a></p>";
	echo $success;
	return;
} 

$formStart = "<form action=\"assignment-add.php\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$form .= "<p><label for=\"name\">Assignment Name</label> <input type=\"text\" name=\"name\" id=\"name\" value=\"\"></p>";
$form .= "<p><label for=\"assignment_id\">Description</label> <input type=\"text\" name=\"description\" id=\"description\" value=\"\"></p>";
$form .= "<p><label for=\"deadline\">Deadline</label> <input type=\"text\" name=\"deadline\" id=\"deadline\" value=\"\"></p>";


echo $formStart . $form . $formEnd;