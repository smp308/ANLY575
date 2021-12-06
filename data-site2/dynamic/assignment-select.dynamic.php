<?php

include '../init/init.php';

if (!isset($_GET['course_id'])) {
	echo '<p>Error: Missing course ID</p>';
	return;
} elseif (!is_numeric($_GET['course_id'])) {
	echo '<p>Error: Course ID must be numeric. (' .$_GET['course_id'] . ') </p>';
	return;
}

$db = new Database();

$sql = 'SELECT `id`, `name` FROM `assignments` WHERE `course_id` = ' . $_GET['course_id'];

if (!$assignments = $db->object('Assignment', $sql)) {
	echo '<p>Error: No assignments for the specified course: ' . $_GET['course_id'] . '</p>';
	return;
}

$assignmentOptionsList = array();

foreach ($assignments as $k => $assignmentObject) {
	$assignmentOptionsList[$assignmentObject->id] = $assignmentObject->name;
}

if (!class_exists('UI')) {
	include CLASS_PATH . 'UI.class.php';
}
$ui = new UI();

echo $ui->selectList('assignmentSelect', 'assignment_id', $assignmentOptionsList, 'Step 2: Choose an Assignment', true);

$sql = 'SELECT `id`, `first_name`, `last_name` FROM `users`';

if (!$users = $db->object('User', $sql)) {
	echo '<p>Error: No users available</p>';
	return;
}
$studentOptionsList = array();
foreach ($users as $k => $userObject) {
	$studentOptionsList[$userObject->id] = $userObject->first_name . ' ' . $userObject->last_name;
}

echo $ui->selectList('studentSelect', 'user_id', $studentOptionsList, 'Step 3: Choose a Student', true);

echo '<p><label for="datetime">Datetime</label> ';
echo '<input required type="datetime-local" id="datetime" name="datetime"></p>';

echo '<p><label for="grade">Grade</label> ';
echo '<input required type="number" step="0.01" id="grade" name="grade" maxlength="5" style="width:70px"></p>';

echo '<input type="submit" id="submit" name="submit" value="Add Submission"></p>';