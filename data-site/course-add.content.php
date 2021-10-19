<?php
$db = new Database();

$postError = "<p>Error: form submission was incomplete.</p>\n";

if (isset($_POST['course_title'])) {

	$postCourseTitle = $_POST['course_title'];

	if (!isset($_POST['course_title'])) { 
		echo $postError;
		return;
	}
	$insertSql = "INSERT INTO `courses` (`course_title`) ";
	$insertSql .= " VALUES (\"{$postCourseTitle}\");";
	$insertId = $db->insert($insertSql);
	
	$sql = 'SELECT * FROM `courses` WHERE `id` = ' . $insertId;
	$course = $db->object('Course', $sql);

	// the above action returns an array, but we only need one object, so we'll limit the result to the first object
	$course = $course[0];

	$success = "<h2>Course Created</h2>\n";
	$success .= "<p>Course Title: {$course->course_title}</p>\n";
	$success .= "<p><a href=\"courses.php\" class=\"button\">Back to course list</a></p>";
	echo $success;
	return;
} 

$formStart = "<form action=\"course-add.php\" method=\"post\">\n";
$formEnd = "<p><input type=\"submit\" id=\"submit\"></p>\n</form>\n";
$form = '';

$form .= "<p><label for=\"course_title\">Course Title</label> <input type=\"text\" name=\"course_title\" id=\"course_title\" value=\"\"></p>";


echo $formStart . $form . $formEnd;
