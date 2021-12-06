<?php
$db = new Database();

$session = new Session();
$loggedIn = $session->checkLoginStatus();

$acSql = '
SELECT 
	`a`.`id`, 
	`a`.`name`,
	`c`.`id` AS `course_id`,
	`c`.`name` AS `course_name`
FROM `assignments` AS `a`
LEFT JOIN `courses` AS `c`
ON `a`.`course_id` = `c`.`id`';


$a = $db->object('Assignment', $acSql);
$assignmentCourseIndex = array();
foreach ($a as $k => $assignmentObj) {
		$assignmentCourseIndex[$assignmentObj->id] = array('course_id' => $assignmentObj->course_id, 'course_name' => $assignmentObj->course_name);
}

$sql = '
SELECT 
	`s`.`id`,
	`s`.`user_id`,
	`u`.`first_name` AS `user_firstname`,
	`u`.`last_name` AS 	`user_lastname`,
	`s`.`assignment_id`,
	`a`.`name` AS `assignment_name`,
	`s`.`datetime`,
	`s`.`grade`
FROM `submissions` AS `s`
LEFT JOIN `users` AS `u`
	ON `s`.`user_id` = `u`.`id`
LEFT JOIN `assignments` AS `a`
	ON `s`.`assignment_id` = `a`.`id`
ORDER BY `id`
';


$submissions = $db->object('Submission', $sql);

if ($loggedIn) { 
	echo '<p><a href="submission-add.php" class="button"><i class="fas fa-plus-circle"></i> Add submission</a></p>';
}

$tableStart = '<table><caption>Submissions</caption>';
$tableStart .= '<thead><tr><th scope="col">ID</th><th scope="col">Course</th><th scope="col">Assignment</th><th scope="col">User</th><th scope="col">Datetime</th><th scope="col">Grade</th>';
if ($loggedIn) { 
	$tableStart .= "<th scope=\"col\">Actions</th>\n"; 
} 
$tableStart .= '</tr></thead><tdata>';
$tableEnd = '</tdata></table>';

$rows = '';

foreach ($submissions as $submission => $obj) {
	$courseName = $assignmentCourseIndex[$obj->assignment_id]['course_name'];
	$courseId = $assignmentCourseIndex[$obj->assignment_id]['course_id'];

	$rows .= '<tr><td>' . $obj->id . '</td>';
	$rows .= '<td>' . $courseName . ' (' . $courseId . ')</td>';
	$rows .= '<td>' . $obj->assignment_name . ' (' . $obj->assignment_id . ')</td>';
	$rows .= '<td>' . $obj->user_firstname . ' ' . $obj->user_lastname . ' (' . $obj->user_id . ')</td>';
	$rows .= '<td>' . $obj->datetime . '</td>';
	$rows .= '<td>' . $obj->grade . '</td>';
	if ($loggedIn) { 
		$rows .= "<td><a href=\"submission-edit.php?id={$obj->id}\" class=\"icon-button\"><i class=\"fas fa-pencil-alt\" role=\"img\" aria-label=\"Edit\"></i></a> ";
		$rows .= "<a href=\"submission-delete.php?id={$obj->id}\" class=\"icon-button\"><i class=\"far fa-trash-alt\" role=\"img\" aria-label=\"Delete\"></i></a></td>\n";
	}
	$rows .='</tr>';
}

echo $tableStart . $rows . $tableEnd;
/*
echo '<pre>';
print_r($submissions);
echo '</pre>';
*/