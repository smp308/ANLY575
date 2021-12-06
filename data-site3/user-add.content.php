<?php

include('register.content.php');

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

	// Remove user add logic here to prevent duplicated user addition. 

	$success = "<h2>User Created</h2>\n";
	$success .= "<p>First name: {$postFirstname}</p>\n";
	$success .= "<p>Last name: {$postLastname}</p>\n";
	$success .= "<p>Email: {$postEmail}</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";
	echo $success;
	return;
}
/*

$db = new Database();

$postError = "<p>Error: form submission was incomplete.</p>\n";

if (isset($_POST['firstname'])) {

	$postFirstname = $_POST['firstname'];
	$postLastname = $_POST['lastname'];
	$postEmail = $_POST['email'];

	if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email'])) { 
		echo $postError;
		return;
	}
	$insertSql = "INSERT INTO `users` (`firstname`, `lastname`, `email`) ";
	$insertSql .= " VALUES (\"{$postFirstname}\", \"{$postLastname}\", \"{$postEmail}\");";
	$insertId = $db->insert($insertSql);
	
	$sql = 'SELECT * FROM `users` WHERE `id` = ' . $insertId;
	$user = $db->object('User', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$user = $user[0];

	$success = "<h2>User Created</h2>\n";
	$success .= "<p>First name: {$user->firstname}</p>\n";
	$success .= "<p>Last name: {$user->lastname}</p>\n";
	$success .= "<p>Email: {$user->email}</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";
	echo $success;
	return;
} 

$formStart = "<form action=\"user-add.php\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$form .= "<p><label for=\"firstname\">First name</label> <input type=\"text\" name=\"firstname\" id=\"firstname\" value=\"\"></p>";
$form .= "<p><label for=\"lastname\">Last name</label> <input type=\"text\" name=\"lastname\" id=\"lastname\" value=\"\"></p>";
$form .= "<p><label for=\"email\">Email</label> <input type=\"text\" name=\"email\" id=\"email\" value=\"\"></p>";


echo $formStart . $form . $formEnd;
*/