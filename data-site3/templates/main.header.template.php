<div id="logo">
	<a href="<?php echo URL_ROOT; ?>">My Website</a>
</div>
<?php echo '<div id="loginWrapper">';
if (isset($_SESSION['firstName'])) {
	echo '<span id="userAccountWrapper"><i class="fas fa-user"></i> ' . $_SESSION['firstName'] . '</span> ';
	echo '<a href="' . URL_ROOT . 'logout.php" class="smallButton">Logout</a>';
} else {
	echo '<a href="' . URL_ROOT . 'login.php" class="button" id="loginButton">Login</a> or <a href="' . URL_ROOT . 'register.php" id="registerButton">Register</a>';
}
echo '</div>';
?>