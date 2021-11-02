<?php
class User extends Base {
	public $id;
	public $firstname;
	public $lastname;
	public $email;
	public $table;

	function __construct() {
	    $this->table = 'users';
	  }


	  // Need to check for empty strings for all required fields

	function validatePassword($password) {
		if (strlen($password) < 8) {
			return array(
				'status' => false,
				'message' => 'Password must be at least 8 characters'
			);
		} else {
			return array(
				'status' => true,
				'message' => ''
			);
		}
	}

	function comparePasswords($password1, $password2) {
		if ($password1 !== $password2) {
			return array(
				'status' => false,
				'message' => 'Passwords do not match'
			);
		} else {
			return array(
				'status' => true,
				'message' => ''
			);
		}
	}

	function validateFirstname($firstname) {
		//echo $firstname;
		if (strlen($firstname) > 255) {
			return array(
				'status' => false,
				'message' => 'First name cannot exceed 255 characters'
			);
		} else {
			return array(
				'status' => true,
				'message' => ''
			);
		}
	}

	function validateLastname($lastname) {
		if (strlen($lastname) > 255) {
			return array(
				'status' => false,
				'message' => 'Last name cannot exceed 255 characters'
			);
		} else {
			return array(
				'status' => true,
				'message' => ''
			);
		}
	}

	function validateEmail($email) {
		$output = array(
			'status' => true,
			'message' => ''
		);
		if (strlen($email) > 255) {
			$output['status'] = false;
			$output['message'] .= 'Email cannot exceed 255 characters.';
		} else {
			$output['status'] = true;
			$output['message'] .= '';
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$output['status'] = false;
			$output['message'] .= ' Email is invalid';
		} 
		return $output;
	}

	function ensureUniqueEmail($email) {
		$sql = 'SELECT * from `users` WHERE `email` = "' . $email  .'";';
		$db = new Database();
		// if a user with this email already exists, reject the user because it is a duplicate
		if ($users = $db->object('User', $sql)) {
			return false;
		} else {
			return true;
		}
	}

	function processRegistration() {
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//echo 'POST';

			$postFirstname = $_POST['firstname'];
			$postLastname = $_POST['lastname'];
			$postEmail = $_POST['email'];
			$postPassword = $_POST['password'];
			$postConfirmPassword = $_POST['confirmPassword'];
		
			$result = array();
			$result['firstname'] = $this->validateFirstname($postFirstname);
			$result['lastname'] = $this->validateLastname($postLastname);
			$result['email'] = $this->validateEmail($postEmail);
			if (!$this->ensureUniqueEmail($postEmail)) {
				echo '<p>Error: User account already exists.</p><p><a href="' . URL_ROOT . 'login.php" class="button">Login</a> or <a href="' . URL_ROOT . 'register.php">Register a different email address.</a></p>';
				return;
			}
			$result['password'] = $this->validatePassword($postPassword);
			$result['confirmPassword'] = $this->validatePassword($postConfirmPassword);
			$result['comparePasswords'] = $this->comparePasswords($postPassword, $postConfirmPassword);

			// obscure the password
			$hashedPassword = password_hash($postPassword, PASSWORD_DEFAULT); 

			if ($this->registrationDataOk($result) === false) {
				// there is a problem, so return the error details
				echo '<p class="formError">Uh oh! There were errors in the form</p>';
				return $result;
			} else {
				// submit the registration
				$db = new Database();
				$insertSql = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`) ";
				$insertSql .= " VALUES (\"{$postFirstname}\", \"{$postLastname}\", \"{$postEmail}\", \"{$hashedPassword}\");";
				$insertId = $db->insert($insertSql);
				
				$sql = 'SELECT * FROM `users` WHERE `id` = ' . $insertId;
				//echo $sql;
				$user = $db->object('User', $sql);


				// then show a success message
				$output = '<div class="formSuccess">';
				$output .= '<p>Registration submitted successfully.</p>';
				$output .= '<p>You will receive an email notification when your account is approved.</p>';
				$output .= '</div>';
				echo $output;
				//print_r($result);
			}
		}

	}

	function registrationDataOk($array) {
		$status = true;	
		foreach ($array as $k => $v) {
			if ($v['status'] === false) {
				$status = false;
			} else {
				$status = true;
			}
		}
		return $status;
	}

	function sendApprovalEmail($email) {
		$to      = $email;
		$subject = 'Approved admin access';
		$message = 'Your administrator account at ' . URL_ROOT . ' has been approved.';
		//$headers = 'From: ' . ADMIN_EMAIL;
		$headers = '';

		mail($to, $subject, $message, $headers);
	}

	function sendUnapprovalEmail($email) {
		$to      = $email;
		$subject = 'Revoked admin access';
		$message = 'Your administrator account at ' . URL_ROOT . ' has been revoked.';
		//$headers = 'From: ' . ADMIN_EMAIL;
		$headers = '';

		mail($to, $subject, $message, $headers);
	}
}