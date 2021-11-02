<?php
class Submission extends Base {
	public $id;
	public $user_id;
	public $assignment_id;
	public $datetime;
	public $grade;
	public $table;

	function __construct() {
	    $this->table = 'submissions';
	  }
}