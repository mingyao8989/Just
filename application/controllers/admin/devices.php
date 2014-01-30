<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devices extends My_Controller {
	
	public $title = "Mobile Devices";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function index() {
		redirect("admin/devices/search/os/ios");
	}
	
	public function search() {
		if (isset($_POST) && isset($_POST['os'])) {
			redirect("admin/devices/search/os/".$this->input->post('os'));
		}
		
		$page 	= my_get_param($this->_segments, "page", 1);
		$os		= my_get_param($this->_segments, "os");
		
		$view_datas = array();
		$view_datas['os']	= $os;
		
		$devices = new Device();
		$devices->where("os", $os);
		
		$view_datas['devices'] = $devices->get_paged_iterated(($page-1) * MAX_DISPLAY_COUNT_ONE_PAGE, MAX_DISPLAY_COUNT_ONE_PAGE, TRUE);
		
		$this->add_body_view("admin/devices", $view_datas);
		
		$this->show_admin_page();
	}
}