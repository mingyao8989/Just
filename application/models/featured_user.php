<?php

/**
 * Featured_user Model Class
 */
class Featured_user extends DataMapper {
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
	
	public $has_one = array("user");
	
	// --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
	public $validation = array(
		'user_id' => array(
			'label' => "User",
			'rules' => array('required', 'trim')
		),
		'sort_num' => array(
			'label' => "Sort",
			'rules' => array('required', 'trim')
		)
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->user_id) ? "New Featured User" : "Edit Featured User";
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */