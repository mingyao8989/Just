<?php

/**
 * Yoticon Model Class
 */
class Yoticon extends DataMapper {
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
		'icon' => array(
			'label' => "Icon",
			'rules' => array('required', 'trim')
		),
		'price' => array(
			'label' => "Price",
			'rules' => array('required', 'trim')
		),
		'in_app' => array(
			'label' => "In App",
			'rules' => array('required', 'trim')
		),
		'name' => array(
			'label' => "Name",
			'rules' => array('required', 'trim', 'unique')
		)
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->name) ? "New Icon" : $this->name;
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */