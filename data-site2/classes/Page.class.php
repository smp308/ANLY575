<?php
class Page extends Base {

	public $name;

	public $placeholders = array(
		'title' => '',
		'cssFiles' => '',
		'headStyles' => '',
		'header' => '',
		'nav' => '',
		'heading' => '',
		'content' => '',
		'footer' => ''
	);

	/**
	 * assign the template name 
	 */
	function __construct($templateName) {
		$this->name = $templateName;
	}

	/**
	 * Combine placeholders with the template
	 * to render in the final output format
	 */
	function render($values, $path) {
		if (!$this->name) {
			echo '<p>Error: missing template name.</p>';
		}
		foreach ($this->placeholders as $k => $v) {
			if (!property_exists($values, $k)) {
				$values->$k = '';
			}
		}

		$path = str_replace('.php', '.content.php', $path);

		if (!$values->content = Base::renderExternalFile($path)) {
			$values->content = '';
		}

		$page = $values;
		include TEMPLATE_PATH . $this->name;
	}
}