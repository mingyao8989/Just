<?php

/**
 * Cms_content Model Class
 */
class Cms_content extends DataMapper {
	public function __construct($mobile = FALSE) {
		parent::__construct();
		
		if ($mobile === TRUE) {
			$this->error_prefix = "";
			$this->error_suffix = "";
		}
	}
	

	// --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
	public $has_many = array();
	
	public $has_one = array();
	
	// --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
	public $validation = array(
		'key' => array(
			'label' => "Key",
			'rules' => array('required', 'trim', 'unique')
		),
		'value' => array(
			'label' => "value",
			'rules' => array('required', 'trim')
		),
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->key) ? "New CMS" : $this->key;
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */