<?php
$db = new Database();

$postError = "<p>Error: form submission was incomplete.</p>\n";

if (isset($_POST['first_name'])) {

	$postFirstname = $_POST['first_name'];
	$postLastname = $_POST['last_name'];
	$postEmail = $_POST['email'];

	if (!isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email'])) { 
		echo $postError;
		return;
	}
	$insertSql = "INSERT INTO `users` (`first_name`, `last_name`, `email`) ";
	$insertSql .= " VALUES (\"{$postFirstname}\", \"{$postLastname}\", \"{$postEmail}\");";
	$insertId = $db->insert($insertSql);
	
	$sql = 'SELECT * FROM `users` WHERE `id` = ' . $insertId;
	$user = $db->object('User', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$user = $user[0];

	$success = "<h2>User Created</h2>\n";
	$success .= "<p>First name: {$user->first_name}</p>\n";
	$success .= "<p>Last name: {$user->last_name}</p>\n";
	$success .= "<p>Email: {$user->email}</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";
	echo $success;
	return;
} 

$formStart = "<form action=\"user-add.php\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$form .= "<p><label for=\"first_name\">First name</label> <input type=\"text\" name=\"first_name\" id=\"first_name\" value=\"\"></p>";
$form .= "<p><label for=\"last_name\">Last name</label> <input type=\"text\" name=\"last_name\" id=\"last_name\" value=\"\"></p>";
$form .= "<p><label for=\"email\">Email</label> <input type=\"text\" name=\"email\" id=\"email\" value=\"\"></p>";


echo $formStart . $form . $formEnd;
