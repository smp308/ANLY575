<?php
$db = new Database();

$sql = 'SELECT `id` FROM `courses`;';

$courses = $db->object('Course');

$tableStart = "<table>\n<caption>Courses</caption>\n<tr>\n";
$tableStart .= "<th scope=\"col\">ID</th>\n";
$tableStart .= "<th scope=\"col\">Course Title</th>\n";
$tableStart .= "</tr>\n";

$tableEnd = "</table>\n";

$tableData = '';

foreach ($courses as $course) {
	$tableData .= "<tr>\n";
	$tableData .= "<td>{$course->id}</td>\n";
	$tableData .= "<td>{$course->course_title}</td>\n";
	$tableData .= "<td><a href=\"course-edit.php?id={$course->id}\" class=\"icon-button\"><i class=\"fas fa-pencil-alt\" role=\"img\" aria-label=\"Edit\"></i></a> ";
	$tableData .= "<a href=\"course-delete.php?id={$course->id}\" class=\"icon-button\"><i class=\"far fa-trash-alt\" role=\"img\" aria-label=\"Delete\"></i></a></td>\n";
	$tableData .= "</tr>\n";
}

$addCourse = "<p><a href=\"course-add.php\" class=\"icon-button\"><i class=\"fas fa-plus-circle\"></i> Add course</a></p>";

echo $tableStart . $tableData . $tableEnd . $addCourse;