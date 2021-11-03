<?php
class Assignment extends Base {
	public $id;
	public $name;
	public $description;
	public $table;

	function __construct() {
	    $this->table = 'pages';
	  }
}