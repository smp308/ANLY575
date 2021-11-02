<?php
$db = new Database();

if (!isset($_GET['id'])) {
	echo "<p>Error: No user selected</p>";
	return;
}
if (!is_numeric($_GET['id'])) {
	echo "<p>Error: The id must be numeric.</p>";
	return;
} else {
	$getId = $_GET['id'];
}

$postError = "<p>Error: form submission was incomplete.</p>\n";

if (isset($_POST['id'])) {

	if (!is_numeric($_POST['id'])) {
		echo '<p>Error: the posted id was not numeric.</p>';
		return;
	} else {
		$postId = $_POST['id'];
	}
	$postFirstname = $_POST['firstname'];
	$postLastname = $_POST['lastname'];
	$postEmail = $_POST['email'];

	if (!isset($_POST['id']) || !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email'])) { 
		echo $postError;
		return;
	}
	$deleteSql = "Delete FROM `users` WHERE `id` = " . $_GET['id'];
	$delete = $db->query($deleteSql);

	$success = "<h2>User Deleted</h2>\n";
	$success .= "<p>{$postFirstname} {$postLastname} ({$postEmail})</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";
	echo $success;
	return;

} 

$sql = 'SELECT * FROM `users` WHERE `id` = ' . $_GET['id'];

$user = $db->object('User', $sql);

$userData = '';

$data = $user[0];


$formStart = "<form action=\"user-delete.php?id={$getId}\" method=\"post\">\n";
$userData .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$data->id}\">\n";
$userData .= "<input type=\"hidden\" name=\"firstname\" id=\"firstname\" value=\"{$data->firstname}\">\n";
$userData .= "<input type=\"hidden\" name=\"lastname\" id=\"lastname\" value=\"{$data->lastname}\">\n";
$userData .= "<input type=\"hidden\" name=\"email\" id=\"email\" value=\"{$data->email}\">\n";
$userData .= "<p>Are you sure you want to delete {$data->firstname} {$data->lastname} ({$data->email})?</p>\n";
$confirm = "<p><a href=\"\"><input type=\"submit\" value=\"Delete\"> <a href=\"users.php\">Back to user list</a></p>\n";
$formEnd = "</form>";

echo $formStart . $userData . $confirm . $formEnd;
