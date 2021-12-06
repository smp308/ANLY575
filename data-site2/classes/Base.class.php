<?php
class Base {

	function set($property, $object) {

	}

	function get($property, $object) {
		return $this->$property;
	}

	function delete($object) {

	}

	/**
	 * Process an external file
	 * to turn it into a placeholder for a template
	 */
	function renderExternalFile($file) {
		ob_start();
	    require($file);
	    return ob_get_clean();
	}
}