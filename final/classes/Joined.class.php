<?php
class Joined extends Base {
	public $Country;
	public $Olympic_Committee_code;
	public $ISO_code;
	public $country_id;

		function __construct() {
	    $this->table = 'joined';
	  }
}
	

