<?php
$db = new Database();

if (!isset($_GET['id'])) {
	echo "<p>Error: No submission selected</p>";
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
	$postUserID = $_POST['user_id'];
	$postAssignmentID = $_POST['assignment_id'];
	$postDatetime = $_POST['datetime'];
	$postGrade = $_POST['grade'];

	if (!isset($_POST['user_id']) || !isset($_POST['assignment_id']) || !isset($_POST['datetime']) || !isset($_POST['grade'])) { 
		echo $postError;
		return;
	}
	$deleteSql = "Delete FROM `submissions` WHERE `id` = " . $_GET['id'];
	$delete = $db->query($deleteSql);

	$success = "<h2>Submission Deleted</h2>\n";
	$success .= "<p>{$postUserID} {$postAssignmentID} ({$postDatetime}) ({$postGrade})</p>\n";
	$success .= "<p><a href=\"submission.php\" class=\"button\">Back to submission list</a></p>";
	echo $success;
	return;

} 

$sql = 'SELECT * FROM `submissions` WHERE `id` = ' . $_GET['id'];

$submission = $db->object('Submission', $sql);

$submissionData = '';

$data = $submission[0];


$formStart = "<form action=\"submission-delete.php?id={$getId}\" method=\"post\">\n";
$submissionData .= "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$data->id}\">\n";
$submissionData .= "<input type=\"hidden\" name=\"user_id\" id=\"user_id\" value=\"{$data->user_id}\">\n";
$submissionData .= "<input type=\"hidden\" name=\"assignment_id\" id=\"assignment_id\" value=\"{$data->assignment_id}\">\n";
$submissionData .= "<input type=\"hidden\" name=\"datetime\" id=\"datetime\" value=\"{$data->datetime}\">\n";
$submissionData .= "<input type=\"hidden\" name=\"grade\" id=\"grade\" value=\"{$data->grade}\">\n";

$submissionData .= "<p>Are you sure you want to delete {$data->user_id} {$data->assignment_id} {$data->datetime} ({$data->grade})?</p>\n";
$confirm = "<p><a href=\"\"><input type=\"submit\" value=\"Delete\"> <a href=\"submissions.php\">Back to submission list</a></p>\n";
$formEnd = "</form>";

echo $formStart . $submissionData . $confirm . $formEnd;