<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."core/Mobile_Controller.php";

class Users extends Mobile_Controller {

	public function __construct() {
		parent::__construct(FALSE);
	}
	
	public function login_facebook()
	{ 
		$validation = array(
				"facebook_token"	=> array('rules'=>'required|trim|xss_clean'),
				"os"				=> array('rules'=>'trim|xss_clean'),
				"device"			=> array('rules'=>'trim|xss_clean'),
				"timezone"			=> array('rules'=>'trim|xss_clean')
		);
	
		$this->form_validate($validation);
	
		$this->load->library("facebook");
		
		$user = new User(TRUE);
		
		$fb_user = $this->facebook->get_user_info($this->request->facebook_token);
		if ($fb_user === FALSE) {
			$this->error($this->facebook->get_error());
		}
		
		$this->user->get_by_facebook_id($fb_user->id);
		
		$this->user->facebook_id	= $fb_user->id;
		$this->user->facebook_token	= $this->request->facebook_token;
		$this->user->timezone		= $this->request->timezone;
		
		if ($this->user->exists() === false) {
			$this->user->fullname	= $fb_user->name;
			$this->user->username	= $fb_user->username;
			$this->user->email		= $fb_user->email;
			
			if (isset($fb_user->website)) {
				$this->user->url	= $fb_user->website;
			}

			if (isset($fb_user->bio)) {
				$this->user->bio	= $fb_user->bio;
			}
			
			if (isset($fb_user->location)) {
				$this->user->location	= $fb_user->location->name;
			}

			$avatar = my_download_file_from_url("https://graph.facebook.com/".$fb_user->id."/picture");
			if ($avatar) {
				$this->user->avatar	= $avatar;
			}
			
			$this->user->group_id = 2;
			$this->user->joined	= time();
		}
		
	
		$this->user->os		= $this->request->os;
		$this->user->device	= $this->request->device;
		$this->user->logined= time();
		$this->user->status	= "online";
		$this->user->security = "a";//md5(uniqid(rand(), true));
		
		$this->user->ip		= $_SERVER['REMOTE_ADDR'];
		$this->user->agent	= $_SERVER['HTTP_USER_AGENT'];
		
		$success = $this->user->save();
	
		$this->user->trans_complete();
		if ($success === FALSE) {
			$this->error($this->user->error->all);
		}
		
		$result = array();
		$result['userinfo']['userid']		= (string)$this->user->id;
		$result['userinfo']['appsecurity']	= $this->user->security;
		$result['userinfo']['fullname']		= $this->user->fullname;
		$result['userinfo']['username']		= "@".$this->user->username;
		$result['userinfo']['avatar']		= WEB_UPLOAD_PATH.$this->user->avatar;
		$result['userinfo']['facebook_id']	= $this->user->facebook_id;
		$result['friends']					= array();
		
		$friends = $this->facebook->get_friends($this->user->facebook_id, $this->user->facebook_token);
		
		if ( $friends ) {
			$_user = new User();
			
			for ($i = 0; $i < count($friends); $i ++) {
				$fb_id = $friends[$i]->id;
				$userid = 0;
		
				$_user->get_by_facebook_id($fb_id);
				$status = "invite";
				if ($_user->exists()) {
					$userid = $_user->id;
					if (my_check_following($_user->id, $this->user->id)) {
						$status = "following";
					} else {
						$status = "follow";
					}
				}
		
				$result['friends'][] = array(
						"userid"		=> (string)$userid,
						"facebook_id"	=> $fb_id,
						"name"			=> $friends[$i]->name,
						"status"		=> $status
				);
			}
		}
		
		$this->success("Successfully login", $result);
	}

	public function login_twitter()
	{
		$validation = array(
				"auth_token"		=> array('rules'=>'required|trim|xss_clean'),
				"auth_token_secret"	=> array('rules'=>'required|trim|xss_clean'),
				"os"				=> array('rules'=>'trim|xss_clean'),
				"device"			=> array('rules'=>'trim|xss_clean'),
				"timezone"			=> array('rules'=>'trim|xss_clean')
		);
	
		$this->form_validate($validation);
	
		$this->load->library("twitter");
		
		$user = new User(TRUE);
		
		$tw_user = $this->twitter->get_user_profile($this->request->auth_token, $this->request->auth_token_secret);
		
		if ($tw_user === FALSE) {
			$this->error($this->twitter->get_error());
		}
		
		$this->user->get_by_twitter_id($tw_user->id_str);
		
		$this->user->twitter_id					= $tw_user->id_str;
		$this->user->twitter_auth_token			= $this->request->auth_token;
		$this->user->twitter_auth_token_secret	= $this->request->auth_token_secret;
		$this->user->timezone					= $this->request->timezone;

		if ($this->user->exists() === false) {
			$this->user->fullname = $tw_user->name;
			$this->user->username = $tw_user->screen_name;
			
			if (isset($tw_user->expanded_url)) {
				$this->user->url	= $tw_user->expanded_url;
			}

			if (isset($tw_user->description)) {
				$this->user->bio	= $tw_user->description;
			}
			
			if (isset($tw_user->location)) {
				$this->user->location	= $tw_user->location;
			}
			
			$avatar = my_download_file_from_url($tw_user->profile_image_url_https);
			if ($avatar) {
				$this->user->avatar	= $avatar;
			}
			
			$this->user->group_id = 2;
			$this->user->joined	= time();
			
		}
		
	
		$this->user->os		= $this->request->os;
		$this->user->device	= $this->request->device;
		$this->user->logined= time();
		$this->user->status	= "online";
		$this->user->security = "a";//md5(uniqid(rand(), true));
		
		$this->user->ip		= $_SERVER['REMOTE_ADDR'];
		$this->user->agent	= $_SERVER['HTTP_USER_AGENT'];
		
		$success = $this->user->save();
	
		$this->user->trans_complete();
		if ($success === FALSE) {
			$this->error($this->user->error->all);
		}
		
		$result = array();
		$result['userinfo']['userid']		= (string)$this->user->id;
		$result['userinfo']['appsecurity']	= $this->user->security;
		$result['userinfo']['fullname']		= $this->user->fullname;
		$result['userinfo']['username']		= "@".$this->user->username;
		$result['userinfo']['avatar']		= WEB_UPLOAD_PATH.$this->user->avatar;
		$result['userinfo']['twitter_id']	= $this->user->twitter_id;
		$result['friends']					= array();
		
		$friends = $this->twitter->get_friends($this->user->twitter_auth_token, $this->user->twitter_auth_token_secret, $this->user->twitter_id);
		
		if ( $friends ) {
			$_user = new User();
			
			for ($i = 0; $i < count($friends); $i ++) {
				$tw_id = $friends[$i]->id_str;
				$userid = 0;
		
				$_user->get_by_twitter_id($tw_id);
				$status = "invite";
				if ($_user->exists()) {
					$userid = $_user->id;
					if (my_check_following($_user->id, $this->user->id)) {
						$status = "following";
					} else {
						$status = "follow";
					}
				}
		
				$result['friends'][] = array(
						"userid"		=> (string)$userid,
						"twitter_id"	=> $tw_id,
						"name"			=> $friends[$i]->name,
						"status"		=> $status,
						"avatar"		=> $friends[$i]->profile_image_url
				);
			}
		}
		
		$this->success("Successfully login", $result);
	}
	
	public function get_profile()
	{
		$validation = array(
				"userid"		=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"	=>array('rules'=>'trim|required|xss_clean'),
		);
		
		$this->form_validate($validation);
	
		$this->get_logined_user();
		
		$result = array();
		$result['name']		= $this->user->fullname;
		$result['url']		= $this->user->url;
		$result['location']	= $this->user->location;
		$result['bio']		= $this->user->bio;
		$result['joined']	= $this->user->joined;
		
		$this->success("profile", $result);
	}
	
	public function edit_profile()
	{
		$validation = array(
				"userid"		=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"	=>array('rules'=>'trim|required|xss_clean'),
				"name"				=> array('rules'=>'trim|required|xss_clean'),
				"url"				=> array('rules'=>'trim|xss_clean'),
				"location"			=> array('rules'=>'trim||xss_clean'),
				"bio"				=> array('rules'=>'trim|xss_clean'),
		);
		
		$this->form_validate($validation);
	
		$this->get_logined_user();
		
		$this->user->fullname	= $this->request->name;
		$this->user->url		= $this->request->url;
		$this->user->location	= $this->request->location;
		$this->user->bio		= $this->request->bio;
		
		if ($this->user->save()) {
			$this->user->trans_complete();
			
			$this->success("Successfully changed.");
		} else {
			$this->error($this->user->error->all);
		}
	}
	
	public function get_account()
	{
		$validation = array(
				"userid"		=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"	=>array('rules'=>'trim|required|xss_clean'),
		);
		
		$this->form_validate($validation);
	
		$this->get_logined_user();
		
		$result = array();
		$result['email']			= $this->user->email;
		$result['phone']			= $this->user->phone;
		$result['facebook_id']		= $this->user->facebook_id;
		$result['facebook_name']	= $this->user->facebook_name;
		$result['facebook_avatar']	= $this->user->facebook_avatar;
		$result['twitter_id']		= $this->user->twitter_id;
		$result['twitter_name']		= $this->user->twitter_name;
		$result['twitter_avatar']	= $this->user->twitter_avatar;
		
		$this->success("User Account", $result);
	}
	
	public function edit_account()
	{
		$validation = array(
				"userid"		=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"	=> array('rules'=>'trim|required|xss_clean'),
				"email"			=> array('rules'=>'trim|valid_email|required|xss_clean'),
				"phone"			=> array('rules'=>'trim|xss_clean'),
		);
		
		$this->form_validate($validation);
	
		$this->get_logined_user();
		
		$this->user->email		= $this->request->email;
		$this->user->phone		= $this->request->phone;
		
		if ($this->user->save()) {
			$this->success("Successfully changed.");
		} else {
			$this->error($this->user->error->all);
		}
	}
	
	public function get_notifications() {
		$validation = array(
				"userid"		=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"	=>array('rules'=>'trim|required|xss_clean'),
		);
		
		$this->form_validate($validation);
		
		$this->get_logined_user();
		
		$result = array();
		$result['push_new_post_by_following']	= $this->user->push_new_post_by_following;
		$result['push_new_reply']				= $this->user->push_new_reply;
		$result['push_new_followed']			= $this->user->push_new_followed;
		$result['email_new_post_by_following']	= $this->user->email_new_post_by_following;
		$result['email_new_reply']				= $this->user->email_new_reply;
		$result['email_new_followed']			= $this->user->email_new_followed;
		
		$this->success("User Notifications", $result);
	}
	
	public function edit_notifications() {
		$validation = array(
				"userid"					=> array('rules'=>'trim|required|xss_clean'),
				"appsecurity"				=>array('rules'=>'trim|required|xss_clean'),
				"push_new_post_by_following"=>array('rules'=>'trim|required|xss_clean'),
				"push_new_reply"			=>array('rules'=>'trim|required|xss_clean'),
				"push_new_followed"			=>array('rules'=>'trim|required|xss_clean'),
				"email_new_post_by_following"=>array('rules'=>'trim|required|xss_clean'),
				"email_new_reply"			=>array('rules'=>'trim|required|xss_clean'),
				"email_new_followed"		=>array('rules'=>'trim|required|xss_clean'),
		);
		
		$this->form_validate($validation);
		
		$this->get_logined_user();
		
		$result = array();
		$this->user->push_new_post_by_following	= $this->request->push_new_post_by_following;
		$this->user->push_new_reply				= $this->request->push_new_reply;
		$this->user->push_new_followed			= $this->request->push_new_followed;
		$this->user->email_new_post_by_following= $this->request->email_new_post_by_following;
		$this->user->email_new_reply			= $this->request->email_new_reply;
		$this->user->email_new_followed			= $this->request->email_new_followed;
		
		$this->user->save();
		
		$this->success("Successfully changed.");
	}
	
	public function chagne_avatar()
	{
		$validation = array(
				"userid"		=> array("model"=>'app', 'rules'=>'trim|required|xss_clean'),
				"appsecurity"	=> array("model"=>'app', 'rules'=>'trim|required|xss_clean'),
		);
		
		$this->form_validate($validation);
		
		$this->get_logined_user();
	
		if (isset($_FILES['avatar']) && $_FILES['avatar']['tmp_name'] != '') {
		} else {
			$this->error("Select avatar file.");
		}
		
		$this->load->config("upload");

		$config = $this->config->item('attache');
		$this->load->library('upload', $config);
		if ( $this->upload->do_upload("avatar") ) {
			$attache = $this->upload->data();
			
			$avatar = my_finish_upload_file($attache['full_path']);
			
			$this->user->avatar = $avatar;
		}
		
		$this->user->save();
		
		$this->success("Update avatar", array("avatar"=>WEB_UPLOAD_PATH.$this->user->avatar));
	}
	
	public function logout()
	{
		$validation = array(
				"userid"		=> array("model"=>'app', 'rules'=>'trim|required|xss_clean'),
				"appsecurity"=>array("model"=>'app', 'rules'=>'trim|required|xss_clean')
		);
	
		$this->form_validate($validation);
	
		$this->get_logined_user();
		
		$this->user->status		= "offline";
		$this->user->security	= md5(uniqid(rand(), true));
		
		if ($this->user->save()) {
			$this->success("Successfully logout.");
		} else {
			$this->error("Failed logout.");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */