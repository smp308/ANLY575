<?php
class Course extends Base {
	public $id;
	public $name;
	public $description;

	function __construct() {
	    $this->table = 'courses';
	  }
}