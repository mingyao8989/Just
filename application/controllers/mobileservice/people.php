<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."core/Mobile_Controller.php";

class People extends Mobile_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function find_facebook_friend()
	{
		$this->load->library("facebook");
		
		$friends = $this->facebook->get_friends($this->user->facebook_id, $this->user->facebook_token);

		$result = array();

		if ($friends) {
			$user = new User();
				
			for ($i = 0; $i < count($friends); $i ++) {
				$fb_id = $friends[$i]->id;
				$userid = 0;

				$user->get_by_facebook_id($fb_id);
				$status = "invite";
				if ($user->exists()) {
					$userid = $user->id;
					if (my_check_following($user->id, $this->user->id)) {
						$status = "following";
					} else {
						$status = "follow";
					}
				}

				$result[] = array(
						"userid"		=> (string)$userid,
						"facebook_id"	=> $fb_id,
						"name"			=> $friends[$i]->name,
						"status"		=> $status
				);
			}
		}

		$this->success("friends", $result);
	}
	
	public function find_twitter_friend()
	{
		$this->load->library("twitter");
		
		$friends = $this->twitter->get_friends($this->user->twitter_auth_token, $this->user->twitter_auth_token_secret, $this->user->twitter_id);

		$result = array();

		if ($friends) {
			$user = new User();
				
			for ($i = 0; $i < count($friends); $i ++) {
				$tw_id = $friends[$i]->id_str;
				$userid = 0;

				$user->get_by_twitter_id($tw_id);
				$status = "invite";
				if ($user->exists()) {
					$userid = $user->id;
					if (my_check_following($user->id, $this->user->id)) {
						$status = "following";
					} else {
						$status = "follow";
					}
				}

				$result[] = array(
						"userid"		=> $userid,
						"twitter_id"	=> $tw_id,
						"name"			=> $friends[$i]->name,
						"status"		=> $status
				);
			}
		}

		$this->success("friends", $result);
	}

	public function follow()
	{
		$validation = array(
				"follower_id"		=> array('rules'=>'trim|required|xss_clean'),
		);
		 
		$this->form_validate($validation);

		if (my_check_following($this->request->follower_id, $this->user->id)) {
			
		} else {
			$following = new Following();
			$following->follower_id = $this->request->follower_id;
			$following->following_id = $this->user->id;			
			
			my_new_notification($following->following_id, "follow", $following->follower_id);
			
			$following->save();
		}
		
		$this->success();
	}

	public function unfollow()
	{
		$validation = array(
				"follower_id"		=> array('rules'=>'trim|required|xss_clean'),
		);
		 
		$this->form_validate($validation);

		$this->db->query("delete from followings where follower_id='".$this->request->follower_id."' and following_id='".$this->user->id."'");
		
		$this->success();
	}

	public function find_uses()
	{
		$friends = fb_find_friends($this->user->facebook_id, $this->user->facebook_token);

		$result = array();

		if ($friends) {
			$user = new User();
				
			for ($i = 0; $i < count($friends); $i ++) {
				$fb_id = $friends[$i]->id;
				$userid = 0;

				$user->get_by_facebook_id($fb_id);
				$status = "invite";
				if ($user->exists()) {
					$userid = $user->id;
					if (my_check_following($user->id, $this->user->id)) {
						$status = "following";
					} else {
						$status = "follow";
					}
				}

				$result[] = array(
						"userid"		=> $userid,
						"facebook_id"	=> $fb_id,
						"name"			=> $friends[$i]->name,
						"status"		=> $status
				);
			}
		}

		$this->success("friends", $result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */