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

	if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['deadline'])) { 
		echo $postError;
		return;
	}
	$deleteSql = "Delete FROM `assignments` WHERE `id` = " . $_GET['id'];
	$delete = $db->query($deleteSql);

	$success = "<h2>Assignment Deleted</h2>\n";
	$success .= "<p>{$postName} {$postDescription} ({$postDeadline})</p>\n";
	$success .= "<p><a href=\"assignments.php\" class=\"button\">Back to assignment list</a></p>";
	echo $success;
	return;

} 

$sql = 'SELECT * FROM `assignments` WHERE `id` = ' . $_GET['id'];

$assignment = $db->object('Assignment', $sql);

$assignmentData = '';

$data = $assignment[0];


$formStart = "<form action=\"assignment-delete.php?id={$getId}\" method=\"post\">\n";
$assignmentData .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$data->id}\">\n";
$assignmentData .= "<input type=\"hidden\" name=\"name\" id=\"name\" value=\"{$data->name}\">\n";
$assignmentData .= "<input type=\"hidden\" name=\"description\" id=\"description\" value=\"{$data->description}\">\n";
$assignmentData .= "<input type=\"hidden\" name=\"deadline\" id=\"deadline\" value=\"{$data->deadline}\">\n";
$assignmentData .= "<p>Are you sure you want to delete {$data->name} {$data->description} ({$data->deadline})?</p>\n";
$confirm = "<p><a href=\"\"><input type=\"submit\" value=\"Delete\"> <a href=\"assignments.php\">Back to assignment list</a></p>\n";
$formEnd = "</form>";

echo $formStart . $assignmentData . $confirm . $formEnd;