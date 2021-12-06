<?php
class Safety extends Base {
	public $Country;
	public $Olympic_Committee_code;
	public $ISO_code;
	public $country_id;

		function __construct() {
	    $this->table = 'safety';
	  }
}
	

