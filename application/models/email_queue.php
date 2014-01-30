<?php

/**
 * Email_queue Model Class
 */
class Email_queue extends DataMapper {
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
		'subject' => array(
			'label' => "Subject",
			'rules' => array('required', 'trim')
		),
		'to_email' => array(
			'label' => "To",
			'rules' => array('required', 'trim')
		),
		'body' => array(
			'label' => "Body",
			'rules' => array('required', 'trim')
		),
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->subject) ? "New Email" : $this->subject;
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */