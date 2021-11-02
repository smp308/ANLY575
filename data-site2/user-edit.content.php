<?php
$db = new Database();

// make sure a user is 
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
	if (isset($_POST['approved'])) {
		$postApproved = 1;
	} else {
		$postApproved = 0;
	}
	$postApprovedOriginalValue = $postApproved;
	

	//echo 'post';
	if (!isset($_POST['id']) || !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email'])) { 
		echo $postError;
		return;
	}
	$updateSql = "UPDATE `users` SET `firstname` = \"{$postFirstname}\", `lastname` = \"{$postLastname}\", `email` = \"{$postEmail}\", `approved` = \"{$postApproved}\" WHERE `id` = " . $_GET['id'];
	$update = $db->query($updateSql);
	$sql = 'SELECT * FROM `users` WHERE `id` = ' . $_POST['id'];
	$user = $db->object('User', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$user = $user[0];

	$success = "<h2>User Updated</h2>\n";
	$success .= "<p>First name: " . $user->firstname . "</p>\n";
	$success .= "<p>Last name: {$user->lastname}</p>\n";
	$success .= "<p>Email: {$user->email}</p>\n";
	$success .= "<p>Approved: {$user->approved}</p>\n";
	$success .= "<p><a href=\"users.php\" class=\"button\">Back to user list</a></p>";

	//include CLASS_PATH . 'User.class.php';
	$userObj = new User();

	// Send an email notification if the approval changed
	if ($postApprovedOriginalValue !== $user->approved) {
		if ($user->approved == 1) {
			if (!$userObj->sendApprovalEmail($user->email)) {
				$success .= '<p>Error: Could not send approval email notification.</p>';
			}
		} elseif ($user->approved == 0) {
			if (!$userObj->sendUnapprovalEmail($user->email)) {
				$success .= '<p>Error: Could not send removal email notification.</p>';
			}
		}
	}
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
// Note: we store the original approval value below in a hidden field
// so we can check if it changed after submission
$form .= "<input type=\"hidden\" name=\"approvedOriginalValue\" id=\"approvedOriginalValue\" value=\"{$data->approved}\">";
$form .= "<p><label for=\"firstname\">First name</label> <input type=\"text\" name=\"firstname\" id=\"firstname\" value=\"{$data->firstname}\"></p>";
$form .= "<p><label for=\"lastname\">Last name</label> <input type=\"text\" name=\"lastname\" id=\"lastname\" value=\"{$data->lastname}\"></p>";
$form .= "<p><label for=\"email\">Email</label> <input type=\"text\" name=\"email\" id=\"email\" value=\"{$data->email}\"></p>";
if ($data->approved == 1) {
	$approvedChecked = 'checked';
} else {
	$approvedChecked = '';
}
$form .= "<p><label for=\"email\">Approved</label> <input type=\"checkbox\" name=\"approved\" id=\"approved\" value=\"1\" {$approvedChecked}></p>";

echo $formStart . $form . $formEnd;
