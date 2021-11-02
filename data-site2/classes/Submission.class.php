<?php
class Submission extends Base {
	public $id;
	public $user_id;
	public $assignment_id;
	public $datetime;
	public $grade;
	public $table;

	function __construct() {
	    $this->table = 'submissions';
	  }

	function add() {

		$db = new Database();

		$postError = "<p>Error: form submission was incomplete.</p>\n";

		if (isset($_POST['assignment_id'])) {
			
			$postCourseId = $_POST['course_id'];
			$postAssignmentId = $_POST['assignment_id'];
			$postUserId = $_POST['user_id'];
			$postDatetime = $_POST['datetime'];
			$postGrade = $_POST['grade'];

			if (!isset($postAssignmentId) || !isset($postUserId) || !isset($postDatetime) || !isset($postGrade)) { 
				echo $postError;
				return;
			}

			$insertSql = "INSERT INTO `submissions` (`user_id`, `assignment_id`, `datetime`, `grade`) ";
			$insertSql .= " VALUES (\"{$postUserId}\", \"{$postAssignmentId}\", \"{$postDatetime}\", \"{$postGrade}\");";
			
			$insertId = $db->insert($insertSql);
			
			$sql = '
			SELECT 
				`s`.`id`, 
				`s`.`assignment_id`,
				`a`.`name` AS `assignment_name`,
				`s`.`user_id`,
				`u`.`firstname` AS `user_firstname`,
				`u`.`lastname` AS `user_lastname`,
				`s`.`datetime`,
				`s`.`grade`
			FROM `submissions` AS `s`
			LEFT JOIN `assignments` AS `a` ON `s`.`assignment_id` = `a`.`id`
			LEFT JOIN `users` AS `u` ON `s`.`user_id` = `u`.`id`
			WHERE `s`.`id` = ' . $insertId;

			//echo $sql;
			
			$submissions = $db->object('Submission', $sql);

			// the above action returns an array, but we only need one object, so we'll limit the result to the first object
			$submission = $submissions[0];

			$success = "<h2>Submission Added</h2>\n";
			$success .= "<p>Submission ID: {$submission->id}</p>\n";
			$success .= "<p>Assignment ID: {$submission->assignment_id}</p>\n";
			$success .= "<p>Assignment Name: {$submission->assignment_name}</p>\n";
			$success .= "<p>User ID: {$submission->user_id}</p>\n";
			$success .= "<p>User First Name: {$submission->user_firstname} </p>\n";
			$success .= "<p>User Last Name: {$submission->user_lastname}</p>\n";
			$success .= "<p>Datetime: {$submission->datetime}</p>\n";
			$success .= "<p>Grade: {$submission->grade}</p>\n";
			$success .= "<p><a href=\"submissions.php\" class=\"button\">Back to submission list</a></p>";
			echo $success;
			return true;

		} else {
			return false;
		}
	}
}