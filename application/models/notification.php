<?php

/**
 * Group Class
 * Allows users to belong to one or more groups.
 *
 * @license 	MIT License
 * @category	Models
 * @author  	Phil DeJarnett
 * @link    	http://www.overzealous.com/dmz/
 */
class Notification extends DataMapper {
	public function __construct($mobile = FALSE) {
		parent::__construct();
		
		if ($mobile === TRUE) {
			$this->error_prefix = "";
			$this->error_suffix = "";
		}
	}
	
	public function show_date($timezone) {
		if ( $this->exists() === FALSE ) return array();
		
		$result = array();
		
		$register = new User();
		$register->get_by_id($this->register_id);
		
		$result['userid']	= $register->id;
		$result['avatar']	= WEB_UPLOAD_PATH.$register->avatar;
		$result['sented']	= my_get_format_datetime($this->registed, $timezone, "n/j g:i A");
		
		$result['type']		= $this->type;
		$result['msg']		= $register->fullname;
		if ($this->type == 'follow') {
			$result['msg'].= " is now following you.";
		} elseif ($this->type == 'reply') {
			$result['msg'].= " replled to your post.";
		} elseif ($this->type == 'like') {
			$result['msg'].= " liked your post.";
		} elseif ($this->type == 'resay') {
			$result['msg'].= " re-said your post.";
		} elseif ($this->type == 'chat') {
			$result['msg'].= " sent you a Private Message.";
		} elseif ($this->type == 'post') {
			$result['msg'].= " shared new post.";
		}
		
		
		$result['media'] = array(); 
		if ($this->media_id > 0) {
			$media = new Media();
			$media->get_by_id($this->media_id);
			
			if ( $media->exists() ) {
				$result['media'] = array(
						"postid"	=> $media->id,
						"message"	=> $media->contents,
						"type"		=> $media->getType() 
				);
			}
		}
		
		
		return $result;
	}
}

/* End of file group.php */
/* Location: ./application/models/group.php */