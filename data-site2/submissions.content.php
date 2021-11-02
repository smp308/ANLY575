<?php
$db = new Database();

$sql = '
SELECT 
	`s`.`id`,
	`s`.`user_id`,
	`u`.`firstname`,
	`u`.`lastname`,
	`s`.`assignment_id`,
	`a`.`name`,
	`s`.`datetime`,
	`s`.`grade`
FROM `submissions` AS `s`
LEFT JOIN `users` AS `u`
	ON `s`.`user_id` = `u`.`id`
LEFT JOIN `assignments` AS `a`
	ON `s`.`assignment_id` = `a`.`id`
';


$submissions = $db->object('Submission', $sql);

echo '<pre>';
print_r($submissions);
echo '</pre>';