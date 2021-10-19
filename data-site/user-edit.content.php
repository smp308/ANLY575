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
	$postFirstname = $_POST['first_name'];
	$postLastname = $_POST['last_name'];
	$postEmail = $_POST['email'];

	//echo 'post';
	if (!isset($_POST['id']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email'])) { 
		echo $postError;
		return;
	}
	$updateSql = "UPDATE `users` SET `first_name` = \"{$postFirstname}\", `last_name` = \"{$postLastname}\", `email` = \"{$postEmail}\" WHERE `id` = " . $_GET['id'];
	$update = $db->query($updateSql);
	$sql = 'SELECT * FROM `users` WHERE `id` = ' . $_POST['id'];
	$user = $db->object('User', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$user = $user[0];

	$success = "<h2>User Updated</h2>\n";
	$success .= "<p>First name: " . $user->first_name . "</p>\n";
	$success .= "<p>Last name: {$user->last_name}</p>\n";
	$success .= "<p>Email: {$user->email}</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";
	echo $success;
	return;

} 

$sql = 'SELECT * FROM `users` WHERE `id` = ' . $_GET['id'];

$user = $db->object('User', $sql);

$formStart = "<form action=\"user-edit.php?id={$getId}\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$data = $user[0];

$form .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$data->id}\">";
$form .= "<p><label for=\"first_name\">First name</label> <input type=\"text\" name=\"first_name\" id=\"first_name\" value=\"{$data->first_name}\"></p>";
$form .= "<p><label for=\"last_name\">Last name</label> <input type=\"text\" name=\"last_name\" id=\"last_name\" value=\"{$data->last_name}\"></p>";
$form .= "<p><label for=\"email\">Email</label> <input type=\"text\" name=\"email\" id=\"email\" value=\"{$data->email}\"></p>";


echo $formStart . $form . $formEnd;
