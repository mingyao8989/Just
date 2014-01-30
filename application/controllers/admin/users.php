<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends My_Controller {
	
	public $title = "Users";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function index() {
		redirect("admin/users/search/order/joined:DESC");
	}
	
	function search() {
		if (isset($_POST) && isset($_POST['text'])) {
			$dont_search = array("page", "order", "text", "actived", "status");
			
			$text = $this->input->post('text');
			if (in_array($text, $dont_search)) {
				redirect(my_get_search_url("admin/users/search/order/joined:DESC", array("actived", "status")));
			} else {
				redirect(my_get_search_url("admin/users/search/order/joined:DESC", array("text", "actived", "status")));
			}	
		}
		
		$view_datas = array();
		
		// search options
		$page		= my_get_param($this->_segments, "page", 1);
		$text		= my_get_param($this->_segments, "text");
		$actived	= my_get_param($this->_segments, "actived");
		$order		= my_get_param($this->_segments, "order");
		$status		= my_get_param($this->_segments, "status");
		
		$view_datas['text']		= $text;
		$view_datas['actived']	= $actived;
		$view_datas['order']	= $order;
		$view_datas['status']	= $status;
		
		// search user
		$users = new User();
		$this->__make_where($users, $text, $actived, $status);
		if ($order != '') {
			$order = explode(":", $order);
		
			$users->order_by($order[0], $order[1]);
		}
		
		$view_datas['users'] = $users->get_paged_iterated(($page-1) * MAX_DISPLAY_COUNT_ONE_PAGE, MAX_DISPLAY_COUNT_ONE_PAGE, TRUE);
		
		$this->add_body_view("admin/users/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function edit() {
		$userid = $this->uri->segment(4);
	
		$user = new User();
		$user->get_by_id($userid);
	
		if ($this->input->post('email') !== FALSE) {
			$user->trans_start();
			$user->group_id = 2;
			if ($userid == 0) {
				if(empty($_POST['password'])) {
					$this->session->set_flashdata("error", 'Input password.');
					redirect("admin/users/edit");
				}
			}
			if( ! empty($_POST['password']))
			{
				$user->salt = md5(uniqid(rand(), true));
				$user->from_array($_POST, array('password', 'confirm_password'));
			}
			
			$success = $user->from_array($_POST, array("username", "name", "email", "phone"), TRUE);
			if ($success) {
				$user->trans_complete();
		
				$this->session->set_flashdata("message", 'The user ' . $user->username . ' was successfully updated.');
				redirect("admin/users");
			}
		}
		
		$user->load_extension('htmlform');
		$this->add_body_view("admin/users/edit", array("user"=>$user));
		
		$this->show_admin_page();
	}
	
	function actived() {
		$userid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$user = new User();
		$user->get_by_id($userid);
		
		if($user->exists()) {
			$user->actived = 'Y';
			
			if ($user->save()) {
				$this->session->set_flashdata("message", $userid.": This user`s status successfully seted to active.");
			} else {
				$this->session->set_flashdata("error", $userid.": This user`s falied status set to active.");
			}
		} else {
			$this->session->set_flashdata("error", $userid.": Invalid user id.");
		}
		
		redirect("admin/users/search".$ext_params); 
	}
	
	function blocked() {
		$userid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$user = new User();
		$user->get_by_id($userid);
		
		if($user->exists()) {
			$user->actived = 'N';
			
			if ($user->save()) {
				$this->session->set_flashdata("message", $userid.": This user`s status successfully seted to block.");
			} else {
				$this->session->set_flashdata("error", $userid.": This user`s falied status set to block.");
			}
		} else {
			$this->session->set_flashdata("error", $userid.": Invalid user id.");
		}
		
		redirect("admin/users/search".$ext_params);
	}
	
	function delete() {
		$userid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$user = new User();
		$user->get_by_id($userid);
		if($user->exists()) {
			$username = $user->username;
			$user->delete_by_id($userid);
			
			$this->session->set_flashdata('message', 'The user ' . $username . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $userid.": Invalid user id.");
		}
		
		redirect("admin/users/search".$ext_params);
	}

	function __make_where(&$users, $text, $actived, $status) {
		if ($text != '') {
			$users->group_start();
			$users->where("id", $text);
			$users->or_like("name", $text);
			$users->or_like("username", $text);
			$users->or_like("email", $text);
			$users->group_end();
		}
		
		if ($actived != '') {
			$users->where("actived", $actived);
		}
		if ($status != '') {
			$users->where("status", $status);
		}
		
		$users->where("group_id", 2);
	}
	
	
	
	public function onlineusers() {
		$page 	= my_get_param($this->_segments, "page", 1);
		$order	= my_get_param($this->_segments, "order");
	
		$view_datas = array();
		$view_datas['order']	= $order;
	
		$users = new User();
		$users->where("status", "online");
		if ($order != '') {
			$order = explode(":", $order);
			$appsesions->order_by($order[0], $order[1]);
		}
	
		$view_datas['users'] = $users->get_paged_iterated(($page-1) * MAX_DISPLAY_COUNT_ONE_PAGE, MAX_DISPLAY_COUNT_ONE_PAGE, TRUE);
	
		$this->add_body_view("admin/users/onlineusers", $view_datas);
	
		$this->show_admin_page();
	}
}