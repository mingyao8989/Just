<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Medias extends My_Controller {
	
	public $title = "Medias";
	
	function __construct()
	{
		parent::__construct(array("required_group"=>1));
	}
	
	public function index() {
		redirect("admin/medias/search/order/created:DESC");
	}
	
	function search() {
		if (isset($_POST) && isset($_POST['type'])) {
			redirect(my_get_search_url("admin/medias/search/order/joined:DESC", array("type", "status", "user_id")));
		}
		
		$view_datas = array();
		
		// search options
		$page		= my_get_param($this->_segments, "page", 1);
		$order		= my_get_param($this->_segments, "order");
		$type		= my_get_param($this->_segments, "type");
		$status	= my_get_param($this->_segments, "status");
		$user_id		= my_get_param($this->_segments, "user_id");
		
		$view_datas['order']	= $order;
		$view_datas['type']		= $type;
		$view_datas['status']	= $status;
		$view_datas['user_id']	= $user_id;
		
		// search media
		$medias = new Media();
		$this->__make_where($medias, $type, $status, $user_id);
		if ($order != '') {
			$order = explode(":", $order);
		
			$medias->order_by($order[0], $order[1]);
		}
		
		$view_datas['medias'] = $medias->get_paged_iterated(($page-1) * MAX_DISPLAY_COUNT_ONE_PAGE, MAX_DISPLAY_COUNT_ONE_PAGE, TRUE);
		
		$this->add_body_view("admin/medias/list", $view_datas);
		
		$this->show_admin_page();
	}
	
	function actived() {
		$mediaid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$media = new Media();
		$media->get_by_id($mediaid);
		
		if($media->exists()) {
			$media->actived = 'Y';
			
			if ($media->save()) {
				$this->session->set_flashdata("message", $mediaid.": This media`s status successfully seted to active.");
			} else {
				$this->session->set_flashdata("error", $mediaid.": This media`s falied status set to active.");
			}
		} else {
			$this->session->set_flashdata("error", $mediaid.": Invalid media id.");
		}
		
		redirect("admin/medias/search".$ext_params); 
	}
	
	function delete() {
		$mediaid = $this->uri->segment(4);
		$ext_params = my_ext_param($this->_segments, 4);
		
		$media = new Media();
		$media->get_by_id($mediaid);
		if($media->exists()) {
			$medianame = $media->medianame;
			$media->delete_by_id($mediaid);
			
			$this->session->set_flashdata('message', 'The media ' . $medianame . ' was successfully deleted.');
		} else {
			$this->session->set_flashdata("error", $mediaid.": Invalid media id.");
		}
		
		redirect("admin/medias/search".$ext_params);
	}

	function __make_where(&$medias, $type, $status, $user_id) {
		if ($type != '') {
			$medias->where("type", $type);
		}
		if ($status != '') {
			$medias->where("status", $status);
		}
		if ($user_id != '') {
			$medias->where("user_id", $user_id);
		}
	}
}