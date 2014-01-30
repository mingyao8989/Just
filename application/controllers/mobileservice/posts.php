<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."core/Mobile_Controller.php";

class Posts extends Mobile_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function get_tags()
	{
		$tags = new Featured_tag();
		$tags->get();

		$result = array();
		foreach($tags as $t) {
			$result[] = $t->name;
		}

		$this->success("tags", $result);
	}

	public function uploadfile()
	{
		$this->load->config("upload");

		$config = $this->config->item('attache');

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload("file")) {
			$this->error($this->upload->display_errors());
		}

		$attache = $this->upload->data();

		$this->success("uploaded file", array("server_filename"=>$attache["file_name"]));
	}

	public function newpost() {
		$validation = array(
				"parent_id"	=> array('rules'=>'trim|xss_clean'),
				"contents"	=> array('rules'=>'trim|xss_clean'),
				"photo"		=> array('rules'=>'trim|xss_clean'),
				"audio"		=> array('rules'=>'trim|xss_clean'),
				"video"		=> array('rules'=>'trim|xss_clean'),
				"location"	=> array('rules'=>'trim|xss_clean'),
				"latitude"	=> array('rules'=>'trim|xss_clean'),
				"longitude"	=> array('rules'=>'trim|xss_clean'),
				"share_facebook"=> array('rules'=>'trim|xss_clean'),
				"share_twitter"	=> array('rules'=>'trim|xss_clean')
		);

		$this->form_validate($validation);

		if (is_null($this->request->contents) && is_null($this->request->photo) && is_null($this->request->audio) && is_null($this->request->video) && is_null($this->request->location)) {
			$this->error("Empty upload data");
		}
		
		$this->load->config("upload");
		$this->load->library("image_lib");
		
		$size = 0;
		
		$media = new Media();
		$media->user_id		= $this->user->id;
		$media->parent_id	= $this->request->parent_id;
		$media->created		= time();
		
		if ( !is_null($this->request->contents) ) {
			$media->contents = $this->request->contents;
			
			$size += strlen($this->request->contents);
		}
		
		if ( !is_null($this->request->photo) ) {
			$property = $this->image_lib->get_image_properties(DIR_UPLOAD_TEMP_FOLDER.$this->request->photo, TRUE);
			
			if ($property !== FALSE && $property['width'] > 50 && $property['height'] > 50) {
				$size += (int)@filesize(DIR_UPLOAD_TEMP_FOLDER.$this->request->photo);
				
				$media->photo = my_finish_upload_file(DIR_UPLOAD_TEMP_FOLDER.$this->request->photo);
				$media->width = $property['width'];
				$media->height = $property['height'];
			} else {
				@unlink(DIR_UPLOAD_TEMP_FOLDER.$this->request->photo);
			}	
		}
		
		if ( !is_null($this->request->audio) ) {
			$s = (int)@filesize(DIR_UPLOAD_TEMP_FOLDER.$this->request->audio);
			
			if ($s > 100) {
				$size += $s;
				
				$media->audio = my_finish_upload_file(DIR_UPLOAD_TEMP_FOLDER.$this->request->audio);
			} else {
				@unlink(DIR_UPLOAD_TEMP_FOLDER.$this->request->audio);
			}	
		}
		
		if ( !is_null($this->request->video) ) {
			$s = (int)@filesize(DIR_UPLOAD_TEMP_FOLDER.$this->request->video);
			
			if ($s > 100) {
				$size += $s;
				
				$media->video = my_finish_upload_file(DIR_UPLOAD_TEMP_FOLDER.$this->request->video);
			} else {
				@unlink(DIR_UPLOAD_TEMP_FOLDER.$this->request->video);
			}	
		}
		
		$media->location = "";
		if ( !is_null($this->request->location) && !is_null($this->request->latitude) && !is_null($this->request->longitude) ) {
			$media->location	= $this->request->location;
			$media->latitude	= $this->request->latitude;
			$media->longitude	= $this->request->longitude;
		}
		
		if ($size == 0 && $media->location == '') {
			$this->error("Empty upload data");
		}
		$media->size = $size;
		
		if ( $media->save() ) {
			if ( strlen($media->contents) > 0 ) {
				$tag = new Featured_tag();
				
				$tags = explode(" ", $media->contents);
				for ( $i = 0; $i < count($tags); $i ++ ) {
					if ( substr($tags[$i], 0, 1) == '#' &&  strlen($tags[$i]) > 1 ) {
						$tag->get_by_name($tags[$i]);
						if ( $tag->exists() === FALSE ) {
							$tag->name = $tags[$i];
							$tag->save();
						}
						
						if ( $tag->exists() ) {
							
						}
					}
				}
			}
			
			$followings = my_get_followings($this->user->id);
			if ( $followings ) {
				for ( $i = 0; $i < count($followings); $i ++ ) {
					my_new_notification($followings[$i], "post", $this->user->id, $media->id, $media->created);
				}
			}
			
			if ($media->parent_id > 0) {
				$parent_media = new Media();
				$parent_media->get_by_id($media->parent_id);
				
				my_new_notification($parent_media->user_id, "reply", $this->user->id, $parent_media->id, $media->created);
			}
			
			$post_status = array(
					"facebook_error"=>"",
					"twitter_error"=>""
			);
			
			
			if ($this->request->share_facebook == 'Y') {
				$this->load->library("facebook");
				
				$fb_postid = $this->facebook->post($this->user->facebook_id, $this->user->facebook_token);
				
				if ( $fb_postid ) {
					$media->facebook_postid = $fb_postid;
					$media->save();
				} else {
					$post_status['facebook_error'] = $this->facebook->get_error();
				}
			}
			
			if ($this->request->share_twitter == 'Y') {
				$this->load->library("twitter");
				
				$fb_postid = $this->twitter->post($this->user->twitter_auth_token, $this->user->twitter_auth_token_secret, $media);
				
				if ( $fb_postid ) {
					$media->twitter_postid = $fb_postid;
					$media->save();
				} else {
					$post_status['twitter_error'] = $this->twitter->get_error();
				}
			}
			
			$this->success("Successfully uploaded new post", $post_status);
		} else {
			$this->error("Failed upload new post");
		}
	}
	
	public function get_latest() {
		$lastid = $this->input->post("lastid", 0);
		$keyword = $this->input->post("keyword", "");
		
		$posts = new Media();
		
		if ( $keyword != '' ) {
			$posts->like("contents", $keyword);
		}
		
		if ( $lastid == 0 ) {
			
		} else {
			$posts->where("id <", $lastid);
		}
		$posts->order_by("id", "desc");
		$posts->limit(10);
		$posts->get();
		
		$result = array();
		foreach ($posts as $post) {
			$result[] = $post->show_postdata($this->user->timezone);
		}
		
		$this->success("latest_posts", $result);
	}
	
	public function get_newsfeed() {
		$lastid = $this->input->post("lastid", 0);
		$keyword = $this->input->post("keyword", "");
		
		$result = array();
		
		$query = my_get_newsfeed($this->user->id, $keyword, 10, $lastid);
		
		if ( $query ) {
			$posts = $this->db->query($query);
			
			$post = new Media();
			foreach ($posts->result() as $p) {
				$post->get_by_id($p->id);
					
				$result[] = $post->show_postdata($this->user->timezone);
			}	
		}
		
		$this->success("newsfeed_posts", $result);
	}
	
	public function get_notifications() {
		$lastid = $this->input->post("lastid", 0);
		
		$result = array();
		
		$notifications = new Notification();
		if ( $lastid > 0 ) {
			$notifications->where("id < ", $lastid);
		}
		$notifications->where("user_id", $this->user->id);
		$notifications->order_by("registed", "desc");
		$notifications->limit(10);
		$notifications->get();
		
		$result = array();
		foreach ( $notifications as $n ) {
			$result[]  = $n->show_date($this->user->timezone);
		}
		
		$this->success("notifications", $result);
	}
	
	public function view_post() {
		$psotid = $this->input->post("psotid");
		
		$post = new Media();
		$post->get_by_id();
		
		
		
		$notifications = new Notification();
		if ( $lastid > 0 ) {
			$notifications->where("id < ", $lastid);
		}
		$notifications->where("user_id", $this->user->id);
		$notifications->order_by("registed", "desc");
		$notifications->limit(10);
		$notifications->get();
		
		$result = array();
		foreach ( $notifications as $n ) {
			$result[]  = $n->show_date($this->user->timezone);
		}
		
		$this->success("notifications", $result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */