<?php
$db = new Database();

if (!isset($_GET['id'])) {
	echo "<p>Error: No assignment selected</p>";
	return;
}
if (!is_numeric($_GET['id'])) {
	echo "<p>Error: The id must be numeric.</p>";
	return;
} else {
	$getId = $_GET['id'];
}

$postError = "<p>Error: form assignment was incomplete.</p>\n";

if (isset($_POST['id'])) {

	if (!is_numeric($_POST['id'])) {
		echo '<p>Error: the posted id was not numeric.</p>';
		return;
	} else {
		$postId = $_POST['id'];
	}

	$postName = $_POST['name'];
	$postDescription = $_POST['description'];
	$postDeadline = $_POST['deadline'];

	if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['deadline'])) { 
		echo $postError;
		return;
	}
	$updateSql = "UPDATE `assignments` SET `name` = \"{$postName}\", `description` = \"{$postDescription}\", `deadline` = \"{$postDeadline}\" WHERE `id` = " . $_GET['id'];
	$update = $db->query($updateSql);
	$sql = 'SELECT * FROM `assignments` WHERE `id` = ' . $_POST['id'];
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

$sql = 'SELECT * FROM `assignments` WHERE `id` = ' . $_GET['id'];

$assignment = $db->object('Assignment', $sql);

$formStart = "<form action=\"assignment-edit.php?id={$getId}\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$data = $assignment[0];

$form .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$data->id}\">";
$form .= "<p><label for=\"name\">Assignment Name</label> <input type=\"text\" name=\"name\" id=\"name\" value=\"\"></p>";
$form .= "<p><label for=\"description\">Description</label> <input type=\"text\" name=\"description\" id=\"description\" value=\"\"></p>";
$form .= "<p><label for=\"deadline\">Deadline</label> <input type=\"text\" name=\"deadline\" id=\"deadline\" value=\"\"></p>";


echo $formStart . $form . $formEnd;