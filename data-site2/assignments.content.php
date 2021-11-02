<?php
$db = new Database();

$users = $db->object('Assignment');
echo '<pre>';
print_r($users);
echo '</pre>';