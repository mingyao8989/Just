<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends My_Controller {
	
	public $title = "Home";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function index() {
		$this->add_body_view("admin/home");
		
		$this->show_admin_page();
	}
}