<?php

/**
 * Featured_url Model Class
 */
class Featured_url extends DataMapper {
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
		'url' => array(
			'label' => "URL",
			'rules' => array('required', 'trim', 'unique')
		)
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->url) ? "New URL" : "Edit URL";
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */