<?php
$db = new Database();

$sql = '
SELECT * from `courses`';


$courses = $db->object('Course', $sql);

echo '<pre>';
print_r($courses);
echo '</pre>';