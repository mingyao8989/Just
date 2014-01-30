<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_Controller extends CI_Controller {
	public $user	= NULL;

	public $result = array();

	public $request = null;

	public function __construct($check_user = TRUE) {
		// Call the Model constructor
		parent::__construct();

		// define for system configuration
		$query = $this->db->get('configurations');
		$configurations = $query->result();

		foreach ($configurations as $configuration) {
			if (defined($configuration->name)) continue;
			 
			define($configuration->name, $configuration->value);
		}

		$this->lang->load("mobileservice");

		$this->form_validation->set_error_delimiters('', '');

		date_default_timezone_set('UTC');
		
		if ($check_user) {
			$validation = array(
					"userid"		=> array('rules'=>'trim|required|xss_clean'),
					"appsecurity"	=> array('rules'=>'trim|required|xss_clean'),
			);
			 
			$this->form_validate($validation);
			 
			$this->get_logined_user();
		}
	}

	public function show_result() {
		//ob_start('ob_gzhandler');

		echo json_encode($this->result);
		exit(0);
	}

	public function get_logined_user() {
		$this->user = new User();
		$this->user->get_by_id($this->request->userid);

		if ($this->user->exists() === FALSE || $this->user->security != $this->request->appsecurity) {
			$this->error("You don`t login in this app.");
		} elseif ($this->user->actived != 'Y') {
			$this->error("This account was disabled.");
		}
	}

	public function form_validate($validation) {
		$this->request = new stdClass();

		$fileds = array();
		foreach ($validation as $field=>$value) {
				
			$fileds[] = $field;
				
			$rules = $value['rules'];
			$label = $field;
				
			if (isset($value['model']) && $value['model'] != '') {
				$model = $value['model'];
				$this->lang->load("model_".$model);

				$label = $this->lang->line($model."_".$field);
			}
				
			$this->form_validation->set_rules($field, $label, $rules);
				
			$this->request->{$field} = htmlspecialchars($this->input->post($field));
		}

		if ($this->form_validation->run()) {
				
		} else {
			$errors = array();
			for ($i = 0; $i < count($fileds); $i ++) {
				$error = form_error($fileds[$i]);
				if ($error != '') {
					$errors[] = $error;
				}
			}
				
			$this->error($errors);
		}
	}

	public function success($msg="", $result="") {
		$this->result['status'] = "success";

		if ($msg != '')			$this->result['msg']	= $msg;
		if (is_array($result))	$this->result['result']	= $result;

		$this->show_result();
	}

	public function error($error) {
		$this->result['status'] = "error";
		if (is_array($error)) {
			$this->result['msg']	= implode($error, "\n");
		} else {
			$this->result['msg']	= $error;
		}

		$this->show_result();
	}

	public function write_message($to_user_id, $text, $link='') {
		$message = new Message();

		$message->from_user_id	= $this->app->user_id;
		$message->to_user_id	= $to_user_id;
		$message->message		= $text;
		$message->link			= $link;

		if ($message->save()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


	public function send_push_notification($room, $alert, $type="", $roomid="") {
		$members = explode(",", $room->users);

		$user = new User();

		$ios_devices = array();

		for ($i = 0; $i < count($members); $i++) {
			if ($members[$i]==$this->user->id) continue;

			$user->get_by_id($members[$i]);

			if ($user->exists()) {
				if ($user->device != '') {
					if ($user->os == 'ios') {
						$ios_devices[] = $user->device;
					}
				}
			}
		}

		if (count($ios_devices) > 0) {
			my_urban_push_notification_for_ios($ios_devices, $alert, 1, $type, $roomid);
		}
	}

	public function send_push_notification_with_members($members, $alert , $type="", $roomid="") {
		$user = new User();

		$ios_devices = array();

		for ($i = 0; $i < count($members); $i++) {
			if ($members[$i]==$this->user->id) continue;

			$user->get_by_id($members[$i]);

			if ($user->exists()) {
				if ($user->device != '') {
					if ($user->os == 'ios') {
						$ios_devices[] = $user->device;
					}
				}
			}
		}

		if (count($ios_devices) > 0) {
			my_urban_push_notification_for_ios($ios_devices, $alert, 1, $type, $roomid);
		}
	}

	public function send_push_notification_user($userid, $alert, $type="", $roomid="") {
		$user = new User();
		$user->get_by_id($userid);

		if ($user->exists()) {
			if ($user->device != '') {
				if ($user->os == 'ios') {
					my_urban_push_notification_for_ios($user->device, $alert, "", $type, $roomid);
				}
			}
		}
	}

	public function send_push_notification_userinfo($user, $alert, $type="", $roomid="") {
		if ($user->exists()) {
			if ($user->device != '') {
				if ($user->os == 'ios') {
					my_urban_push_notification_for_ios($user->device, $alert, "", $type, $roomid);
				}
			}
		}
	}
}
?>