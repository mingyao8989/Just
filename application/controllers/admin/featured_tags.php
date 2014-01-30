<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_tags extends My_Controller {
	
	public $title = "Tags";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	function index() {
		$view_datas = array();
		
		// search featured_tag
		$featured_tags = new Featured_tag();
		$featured_tags->get();
		
		$view_datas['featured_tags'] = $featured_tags;
		
		$this->add_body_view("admin/featured_tags/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function edit() {
		$featured_tagid = $this->uri->segment(4);
	
		$featured_tag = new Featured_tag();
		$featured_tag->get_by_id($featured_tagid);
	
		if ($this->input->post('name') !== FALSE) {
			if ($featured_tag->exists()) {
				
			} else {
				$featured_tag->created = my_datenow();
			}
			$featured_tag->updated = my_datenow();
			
			$success = $featured_tag->from_array($_POST, array("name"), TRUE);
			if ($success) {
				$this->session->set_flashdata("message", $featured_tag->name . ' was successfully updated.');
				redirect("admin/featured_tags");
			}
		}
		
		$featured_tag->load_extension('htmlform');
		$this->add_body_view("admin/featured_tags/edit", array("featured_tag"=>$featured_tag));
		
		$this->show_admin_page();
	}
	
	function delete() {
		$featured_tagid = $this->uri->segment(4);
		
		$featured_tag = new Featured_tag();
		$featured_tag->get_by_id($featured_tagid);
		
		if($featured_tag->exists()) {
			$featured_tagname = $featured_tag->key;
			$featured_tag->delete();
			
			$this->session->set_flashdata('message', $featured_tagname . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $featured_tagid.": Invalid featured_tag id.");
		}
		
		redirect("admin/featured_tags");
	}

	function __make_where(&$featured_tags, $type, $status, $user_id) {
		if ($type != '') {
			$featured_tags->where("type", $type);
		}
		if ($status != '') {
			$featured_tags->where("status", $status);
		}
		if ($user_id != '') {
			$featured_tags->where("user_id", $user_id);
		}
	}
}