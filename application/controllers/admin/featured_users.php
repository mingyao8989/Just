<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured_users extends My_Controller {
	
	public $title = "Tags";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	function index() {
		$view_datas = array();
		
		// search featured_user
		$featured_users = new Featured_user();
		$featured_users->get();
		
		$view_datas['featured_users'] = $featured_users;
		
		$this->add_body_view("admin/featured_users/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function edit() {
		$featured_userid = $this->uri->segment(4);
	
		$featured_user = new Featured_user();
		$featured_user->get_by_id($featured_userid);
	
		if ($this->input->post('sort_num') !== FALSE) {
			$userid = $this->input->post('user_id');
			$user = new User();
			$user->get_by_id($userid);
			
			$featured_user->from_array($_POST, array("user_id", "sort_num"), FALSE);
			
			if ($user->exists()) {
				if ($featured_user->exists()) {
					
				} else {
					$featured_user->created = my_datenow();
				}
				$featured_user->updated = my_datenow();
				
				$success = $featured_user->save();
				if ($success) {
					$this->session->set_flashdata("message", $featured_user->name . ' was successfully updated.');
					redirect("admin/featured_users");
				}
			} else {
				$this->session->set_flashdata("error", $featured_user->user_id . ' is incorrect.');
				redirect("admin/featured_users/edit/".$featured_userid);
			}
		}
		
		$featured_user->load_extension('htmlform');
		$this->add_body_view("admin/featured_users/edit", array("featured_user"=>$featured_user));
		
		$this->show_admin_page();
	}
	
	function delete() {
		$featured_userid = $this->uri->segment(4);
		
		$featured_user = new Featured_user();
		$featured_user->get_by_id($featured_userid);
		
		if($featured_user->exists()) {
			$featured_username = $featured_user->key;
			$featured_user->delete();
			
			$this->session->set_flashdata('message', $featured_username . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $featured_userid.": Invalid featured_user id.");
		}
		
		redirect("admin/featured_users");
	}

	function __make_where(&$featured_users, $type, $status, $user_id) {
		if ($type != '') {
			$featured_users->where("type", $type);
		}
		if ($status != '') {
			$featured_users->where("status", $status);
		}
		if ($user_id != '') {
			$featured_users->where("user_id", $user_id);
		}
	}
}