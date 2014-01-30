<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_urls extends My_Controller {
	
	public $title = "URLs";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	function index() {
		$view_datas = array();
		
		// search featured_url
		$featured_urls = new Featured_url();
		$featured_urls->get();
		
		$view_datas['featured_urls'] = $featured_urls;
		
		$this->add_body_view("admin/featured_urls/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function edit() {
		$featured_urlid = $this->uri->segment(4);
	
		$featured_url = new Featured_url();
		$featured_url->get_by_id($featured_urlid);
	
		if ($this->input->post('url') !== FALSE) {
			if ($featured_url->exists()) {
				
			} else {
				$featured_url->created = my_datenow();
			}
			$featured_url->updated = my_datenow();
			
			$success = $featured_url->from_array($_POST, array("url"), TRUE);
			if ($success) {
				$this->session->set_flashdata("message", $featured_url->url . ' was successfully updated.');
				redirect("admin/featured_urls");
			}
		}
		
		$featured_url->load_extension('htmlform');
		$this->add_body_view("admin/featured_urls/edit", array("featured_url"=>$featured_url));
		
		$this->show_admin_page();
	}
	
	function delete() {
		$featured_urlid = $this->uri->segment(4);
		
		$featured_url = new Featured_url();
		$featured_url->get_by_id($featured_urlid);
		
		if($featured_url->exists()) {
			$featured_urlname = $featured_url->key;
			$featured_url->delete();
			
			$this->session->set_flashdata('message', $featured_urlname . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $featured_urlid.": Invalid featured_url id.");
		}
		
		redirect("admin/featured_urls");
	}
}