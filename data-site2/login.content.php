<?php 
$emailInvalid = "false";
$passwordInvalid = "false";

if ( (isset($_POST['email'])) && (isset($_POST['password'])) ) {

	$session = new Session();
	$session->login($_POST['email'], $_POST['password']);
	print_r($_POST);
}
?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<p><label for="email">Email</label> 
	<input type="email" id="email" name="email" 
	required aria-invalid="<?php echo $emailInvalid; ?>"></p>

<p><label for="email">Password</label> 
	<input type="password" id="password" name="password" 
	required aria-invalid="<?php echo $passwordInvalid; ?>"></p>

<p><input type="submit" value="Login" id="login"></p>

</form>