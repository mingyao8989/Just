<?php

/**
 * Media Model Class
 */
class Media extends DataMapper {
	public function __construct($mobile = FALSE) {
		parent::__construct();
		
		if ($mobile === TRUE) {
			$this->error_prefix = "";
			$this->error_suffix = "";
		}
	}
	

	// --------------------------------------------------------------------
	// Relationships
	// --------------------------------------------------------------------
	public $has_many = array();
	
	public $has_one = array("user");
	
	// --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
	public $validation = array(
		'user_id' => array(
			'label' => "User",
			'rules' => array('required', 'trim')
		),
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->contents) ? $this->getType() : $this->contents;
	}
	
	function getType() {
		if ($this->exists() === FALSE) return "";
		
		$type = "";
		if ($this->photo != '') {
			$type = "Photo";
		}
		
		if ($this->audio != '') {
			$type.= ($type==""?"Audio":" + Audio");
		}
		
		if ($this->video != '') {
			$type.= ($type==""?"Video":" + Video");
		}
		
		if ($this->location != '') {
			$type.= ($type==""?"Location":" + Location");
		}
		
		return $type;
	}
	
	public function getRepliesCount() {
		$media = new Media();
		return $media->where("parent_id", $this->id)->count();
	}
	
	public function getLikesCount() {
		$media_like = new Media_like();
		return $media_like->where("media_id", $this->id)->count();
	}
	
	public function getResaysCount() {
		$media_resay = new Media_resay();
		return $media_resay->where("media_id", $this->id)->count();
	}
	


	public function show_postdata($timezone) {
		if ( $this->exists() === FALSE ) return array();
	
		$result = array(
				"user"		=> array(),
				"postdata"	=> array(),
				"count"		=> array()
		);
	
		$user = new User();
		$user->get_by_id($this->user_id);
		if ( !$user->exists() ) return $result;
	
		$result['user'] = array(
				"id"		=> (string)$user->id,
				"username"	=> "@".$user->username,
				"fullname"	=> $user->fullname,
				"avatar"	=> WEB_UPLOAD_PATH.$user->avatar,
				"posted"	=> my_get_after_time($this->created, $timezone, "j M")
		);
	
		$result['postdata'] = array(
				"postid"	=> (string)$this->id,
				"type"		=> $this->getType(),
				"message"	=> $this->contents,
				"photo"		=> WEB_UPLOAD_PATH.$this->photo,
				"width"		=> WEB_UPLOAD_PATH.$this->width,
				"height"	=> WEB_UPLOAD_PATH.$this->height,
				"audio"		=> WEB_UPLOAD_PATH.$this->audio,
				"audio_time"=> WEB_UPLOAD_PATH.$this->audio_time,
				"video"		=> WEB_UPLOAD_PATH.$this->video,
				"video_time"=> WEB_UPLOAD_PATH.$this->video_time,
		);
	
		$result['count']['replies'] = (string)$this->getRepliesCount();
		$result['count']['resays'] = (string)$this->getRepliesCount();
		$result['count']['likes'] = (string)$this->getLikesCount();
	
		return $result;
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */