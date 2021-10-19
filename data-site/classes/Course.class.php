<?php
class Course extends Base {
	public $id;
	public $course_title;

	function __construct() {
	    $this->table = 'courses';
	  }
}