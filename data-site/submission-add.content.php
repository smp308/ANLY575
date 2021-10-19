<?php
$db = new Database();

$postError = "<p>Error: form submission was incomplete.</p>\n";

if (isset($_POST['user_id'])) {

	$postUserID = $_POST['user_id'];
	$postAssignmentID = $_POST['assignment_id'];
	$postDatetime = $_POST['datetime'];
	$postGrade = $_POST['grade'];

	if (!isset($_POST['user_id']) || !isset($_POST['assignment_id']) || !isset($_POST['datetime']) || !isset($_POST['grade'])) { 
		echo $postError;
		return;
	}
	$insertSql = "INSERT INTO `submissions` (`user_id`, `assignment_id`, `datetime`, `grade`) ";
	$insertSql .= " VALUES (\"{$postUserID}\", \"{$postAssignmentID}\", \"{$postDatetime}\", \"{$postGrade}\");";
	$insertId = $db->insert($insertSql);
	
	$sql = 'SELECT * FROM `submissions` WHERE `id` = ' . $insertId;
	$submission = $db->object('Submission', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$submission = $submission[0];

	$success = "<h2>Submission Created</h2>\n";
	$success .= "<p>User ID: {$submission->user_id}</p>\n";
	$success .= "<p>Assignment ID: {$submission->assignment_id}</p>\n";
	$success .= "<p>Datetime: {$submission->datetime}</p>\n";
	$success .= "<p>Grade: {$submission->grade}</p>\n";
	$success .= "<p><a href=\"submissions.php\" class=\"button\">Back to submission list</a></p>";
	echo $success;
	return;
} 

$formStart = "<form action=\"submission-add.php\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$form .= "<p><label for=\"user_id\">User ID</label> <input type=\"text\" name=\"user_id\" id=\"user_id\" value=\"\"></p>";
$form .= "<p><label for=\"assignment_id\">Assignment ID</label> <input type=\"text\" name=\"assignment_id\" id=\"assignment_id\" value=\"\"></p>";
$form .= "<p><label for=\"datetime\">Datetime</label> <input type=\"text\" name=\"datetime\" id=\"datetime\" value=\"\"></p>";
$form .= "<p><label for=\"grade\">Grade</label> <input type=\"text\" name=\"grade\" id=\"grade\" value=\"\"></p>";


echo $formStart . $form . $formEnd;