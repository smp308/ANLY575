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
}