<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public $test_appid = "107";
	public $test_appsecurity = "a";
	
	public function index()
	{
		$action = $this->uri->segment(2);
		if ($this->uri->segment(3) != '') {
			$action.= "/".$this->uri->segment(3);
		}
		
		if ($action == '') $action = "menu";
		
		$this->load->view("test/".$action, array("action"=>$action));
	} 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */