<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurations extends My_Controller {
	
	public $title = "System Options";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function index() {
		$this->add_body_view("admin/configurations");
		
		$this->show_admin_page();
	}
	
	public function save() {
		$this->db->empty_table("configurations");
				
		$name		= $this->input->post("name");
		$value		= $this->input->post("value");
		$comment	= $this->input->post("comment");
		$ordernum	= $this->input->post("ordernum");
			
		for ($i = 0; $i < count($name); $i ++) {
			$config = array(
					'name'		=> $name[$i],
					'value'		=> $value[$i],
					'comment'	=> $comment[$i],
					'ordernum'	=> $ordernum[$i]
			);
	
			
			$this->db->insert("configurations", $config);
		}
		
		$this->session->set_flashdata("message", "System configurations successfully updated.");
		
		redirect("admin/configurations");
	}
}