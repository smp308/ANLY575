<?php

$db = new Database();

$session = new Session();
//$loggedIn = $session->checkLoginStatus();

$medals = $db->object('Medals');

$caption = 'Medals';
$headers = array('Country', 'NOC_Code', 'Totals', 'Golds', 'Silvers', 'Bronzes');
$data = $medals; // note: this would be an array of rows from a database query
$attributes = array('id' => 'medalsTable', 'class' => 'somePredefinedClass');

include CLASS_PATH . 'UI.class.php'; // if the UI file has not been included yet
$ui = new UI(); // if the UI class has not been called yet;

// Call tables and dialog
$tableRows = array();
$counter = 0;
foreach ($medals as $medal) {
$tableRows[$counter][] = $medal->Country;
$tableRows[$counter][] = $medal->NOC_Code ;
$tableRows[$counter][] = $medal->Totals;
$tableRows[$counter][] = $medal->Golds;
$tableRows[$counter][] = $medal->Silvers;
$tableRows[$counter][] = $medal->Bronzes;
$counter++; // increment the counter by 1
}
// Call tables and dialog
$table = $ui->simpleTable($caption, $headers, $tableRows, $attributes);
$dialog = $ui->dialog();

echo $dialog;
echo "<div class='medals-table'>";
echo $table;
echo  "</div>"; 











/*$db = new Database();

$session = new Session();
$loggedIn = $session->checkLoginStatus();

$mwSql = '
SELECT 
	`m`.`Country`, 
	`m`.`NOC_Code`,
	`m`.`Totals`,
	`m`.`Golds`,
	`m`.`Silvers`,
	`m`.`Bronzes`,
	`w`.`Annual_temp` AS `average_temperature`
FROM `medalcounts` AS `m`
LEFT JOIN `weather` AS `w`
ON `m`.`NOC_code` = `w`.`ISO_3DIGIT`';

$medals = $db->object('Medals', $mwSql);

echo '<pre>';
print_r($medals);
echo '</pre>';*/


/*$m = $db->object('Medals', $mwSql);
$medalsCourseIndex = array();
foreach ($m as $k => $medalsObj) {
		$medalsCourseIndex[$medalsObj->id] = array('average_temperature' => $medalsObj->Annual_temp);
		//, 'course_name' => $assignmentObj->course_name);
}*/

/*$sql = '
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

*/



/*if ($loggedIn) { 
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

echo $tableStart . $rows . $tableEnd;*/
/*
echo '<pre>';
print_r($submissions);
echo '</pre>';
*/