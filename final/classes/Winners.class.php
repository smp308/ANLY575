<?php
class Winners extends Base {
	public $City;
	public $Edition;
	public $Sport;
	public $Discipline;
	public $NOC;
	public $Gender;
	public $Event;
	public $Event_gender;
	public $Medal;
	public $table;

	function __construct() {
	    $this->table = 'winners';
	  }
}