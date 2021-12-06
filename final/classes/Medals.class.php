<?php
class Medals extends Base {
	public $Country;
	public $NOC_Code;
	public $Totals;
	public $Golds;
	public $Silvers;
	public $Bronzes;

	function __construct() {
	    $this->table = 'medals';
	  }
}