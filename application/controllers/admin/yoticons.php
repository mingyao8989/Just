<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yoticons extends My_Controller {
	
	public $title = "Yoticons";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	function index() {
		$view_datas = array();
		
		// search yoticon
		$yoticons = new Yoticon();
		$yoticons->get();
		
		$view_datas['yoticons'] = $yoticons;
		
		$this->add_body_view("admin/yoticons/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function actived() {
		$yoticonid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$yoticon = new Yoticon();
		$yoticon->get_by_id($yoticonid);
		
		if($yoticon->exists()) {
			$yoticon->actived = 'Y';
			
			if ($yoticon->save()) {
				$this->session->set_flashdata("message", $yoticonid.": This yoticon`s status successfully seted to active.");
			} else {
				$this->session->set_flashdata("error", $yoticonid.": This yoticon`s falied status set to active.");
			}
		} else {
			$this->session->set_flashdata("error", $yoticonid.": Invalid yoticon id.");
		}
		
		redirect("admin/yoticons/search".$ext_params); 
	}
	
	function delete() {
		$yoticonid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$yoticon = new Yoticon();
		$yoticon->get_by_id($yoticonid);
		if($yoticon->exists()) {
			$yoticonname = $yoticon->yoticonname;
			$yoticon->delete_by_id($yoticonid);
			
			$this->session->set_flashdata('message', 'The yoticon ' . $yoticonname . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $yoticonid.": Invalid yoticon id.");
		}
		
		redirect("admin/yoticons/search".$ext_params);
	}

	function __make_where(&$yoticons, $type, $status, $user_id) {
		if ($type != '') {
			$yoticons->where("type", $type);
		}
		if ($status != '') {
			$yoticons->where("status", $status);
		}
		if ($user_id != '') {
			$yoticons->where("user_id", $user_id);
		}
	}
}