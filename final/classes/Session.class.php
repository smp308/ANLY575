<?php
class Session extends Base {
	public $user;

	function __construct() {

	}

	function print($console = null) {
		if ($console === true) {
			echo '<script>';
			foreach ($_SESSION as $k => $v) {
				echo 'console.log("$_SESSION[\'' . $k . '\'] = ' . $v . '");';
			}
			echo '</script>';
		} else {
			echo '<pre>';
			print_r($_SESSION);
			echo '</pre>';
		}
	}

	function checkLoginStatus() {
		if (isset($_SESSION["loggedIn"])) {
			if ($_SESSION["loggedIn"] === true) {
				return true;
			} else {
				return false;
			}
		} else {
			$_SESSION["loggedIn"] = false;
		}
	}

	function login($email, $password) {
		if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
		    header("location: " . URL_ROOT);
		    exit;
		} else {

		}
		$db = new Database();

		$sql = 'SELECT * FROM `users` WHERE `email` = "' . $email . '";';

		if (!$userList = $db->object('User', $sql)) {
			echo '<p>Error: Invalid login credentials.</p>';
			return;
		} else {
			$user = $userList[0];
		}
		if ($user->approved !== 1) {
			echo '<p>Error: This account is not approved for admin privileges.</p>';
			return;
		}
		if(password_verify($password, $user->password)){
			echo '<p>Credentials are valid</p>';	        
	        
	        $_SESSION["loggedIn"] = true;
	        $_SESSION["id"] = $user->id;
	        $_SESSION["firstName"] = $user->first_name;
	        $_SESSION["lastName"] = $user->last_name;
	        $_SESSION["email"] = $email;
	        
	        header('location: ' . URL_ROOT . 'index.php', true);
	        exit;
        } else {
	        echo "Invalid username or password";
	    }
	}

	function logout() {
		if (!$_SESSION || is_array($_SESSION)) {
			session_start();
		}
		 
		// unset 
		$_SESSION = array();
		 
		session_destroy();
		 
		header("location: " . URL_ROOT, true);
		exit();
	}

	function validateEmail($email) {
		$email = trim($email);

	}

	function validateMatchingPassword($password) {

	}

}