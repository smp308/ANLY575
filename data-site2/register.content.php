<?php 
$emailInvalid = "false";
$passwordInvalid = "false";

$session = new Session();
include CLASS_PATH . 'User.class.php';
$user = new User();
$registration = $user->processRegistration();


$valueFirstName = '';
$valueLastName = '';
$valueEmail = '';


if (isset($_POST['firstname'])) {
	$valueFirstName = $_POST['first_name'];
}
if (isset($_POST['last_name'])) {
	$valueLastName = $_POST['last_name'];
}
if (isset($_POST['email'])) {
	$valueEmail = $_POST['email'];
}
if (isset($_POST['password'])) {
	$valueEmail = $_POST['password'];
}

$firstNameError = '';
$lastNameError = '';
$emailError = '';
$passwordError = '';
if (is_array($registration)) {
	if($registration['first_name']['status'] === false) {
		$firstNameError = '<span class="formError">Error: ' . $registration['first_name']['message'] . '</span>';
	}
	if($registration['last_name']['status'] === false) {
		$lastNameError = '<span class="formError">Error: ' . $registration['last_name']['message'] . '</span>';
	}
	if($registration['email']['status'] === false) {
		$emailError = '<span class="formError">Error: ' . $registration['email']['message'] . '</span>';
	}
	if($registration['password']['status'] === false) {
		$passwordError .= '<span class="formError">Error: ' . $registration['password']['message'] . '</span>';
	}
	if($registration['comparePasswords']['status'] === false) {
		$passwordError .= '<span class="formError">Error: ' . $registration['comparePasswords']['message'] . '</span>';
	}
} else {
	if (isset($_POST['firstname'])) {
		// Return so it does not show the form again when submission is successful
		return;
	}
}
?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<p>Note: Your account must be approved by an administrator before you can log in.</p>

<p><label for="first_name">First Name</label> 
	<span id="firstNameError"><?php echo $firstNameError; ?></span>
	<input type="text" id="first_name" name="first_name" maxlength="255"  
	required aria-describedby="firstNameError" value="<?php echo $valueFirstName; ?>"></p>
	

<p><label for="last_name">Last Name</label> 
	<span id="lastNameError"><?php echo $lastNameError; ?></span>
	<input type="text" id="last_name" name="last_name" maxlength="255"  
	required aria-describedby="lastNameError" value="<?php echo $valueLastName; ?>"></p>
	

<p><label for="email">Email</label> 
	<span id="emailError"><?php echo $emailError; ?></span>
	<input type="email" id="email" name="email" maxlength="255" 
	required aria-describedby="emailError" value="<?php echo $valueEmail; ?>"></p>
	

<p><label for="password">Password (Minimum 8 characters)</label> 
	<span id="passwordError"><?php echo $passwordError; ?></span>
	<input type="password" id="password" name="password" minlength="8" maxlength="255" 
	required aria-describedby="passwordError"></p>
	

	<p><label for="confirmPassword">Confirm Password</label> 
	<input type="password" id="confirmPassword" name="confirmPassword" minlength="8" maxlength="255" 
	required></p>

<p><input type="submit" value="Register" id="register"></p>

</form>