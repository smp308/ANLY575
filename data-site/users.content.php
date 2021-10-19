<?php
$db = new Database();

$sql = 'SELECT `id` FROM `users`;';

$users = $db->object('User');

$tableStart = "<table>\n<caption>Users</caption>\n<tr>\n";
$tableStart .= "<th scope=\"col\">ID</th>\n";
$tableStart .= "<th scope=\"col\">First name</th>\n";
$tableStart .= "<th scope=\"col\">Last name</th>\n";
$tableStart .= "<th scope=\"col\">Email</th>\n";
$tableStart .= "<th scope=\"col\">Actions</th>\n";
$tableStart .= "</tr>\n";

$tableEnd = "</table>\n";

$tableData = '';

foreach ($users as $user) {
	$tableData .= "<tr>\n";
	$tableData .= "<td>{$user->id}</td>\n";
	$tableData .= "<td>{$user->first_name}</td>\n";
	$tableData .= "<td>{$user->last_name}</td>\n";
	$tableData .= "<td>{$user->email}</td>\n";
	$tableData .= "<td><a href=\"user-edit.php?id={$user->id}\" class=\"icon-button\"><i class=\"fas fa-pencil-alt\" role=\"img\" aria-label=\"Edit\"></i></a> ";
	$tableData .= "<a href=\"user-delete.php?id={$user->id}\" class=\"icon-button\"><i class=\"far fa-trash-alt\" role=\"img\" aria-label=\"Delete\"></i></a></td>\n";
	$tableData .= "</tr>\n";
}

$addUser = "<p><a href=\"user-add.php\" class=\"icon-button\"><i class=\"fas fa-plus-circle\"></i> Add user</a></p>";

echo $tableStart . $tableData . $tableEnd . $addUser;