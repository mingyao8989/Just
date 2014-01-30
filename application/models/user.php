<?php

/**
 * User Model Class
 */
class User extends DataMapper {
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
	
	public $has_one = array('group');
	
	// --------------------------------------------------------------------
	// Validation
	// --------------------------------------------------------------------
	public $validation = array(
		'username' => array(
			'rules' => array('required', 'trim', 'max_length' => 100)
		),
		'email' => array(
			'rules' => array('trim', 'valid_email')
		),
		'fullname' => array(
			'rules' => array('trim')
		),
		'password' => array(
			'rules' => array('trim', 'min_length' => 3, 'max_length' => 20, 'encrypt'),
			'type' => 'password'
		),
		'confirm_password' => array(
			'rules' => array('encrypt', 'matches' => 'password'),
			'type' => 'password'
		),
		'actived' => array(
			'rules' => array('trim')
		),
		'joined' => array(
			'rules' => array('trim')
		)
	);
	
	// --------------------------------------------------------------------
	function __toString()
	{
		return empty($this->username) ? $this->localize_label('newuser') : $this->username;
	}
	
	/**
	 * Login
	 *
	 * Authenticates a user for logging in.
	 *
	 * @access	public
	 * @return	bool
	 */
	function login($type="username")
	{
		// Create a temporary user object
		$u = new User();
		
		if ($type == 'username') {
			// backup username for invalid logins
			$uname = $this->username;
			
			// Get this users stored record via their username
			$u->where('username', $uname)->get();
		} elseif ($type == 'email') {
			// backup email for invalid logins
			$email = $this->email;
				
			// Get this users stored record via their email
			$u->where('email', $email)->get();
		}
		
		// Give this user their stored salt
		$this->salt = $u->salt;

		// Validate and get this user by their property values,
		// this will see the 'encrypt' validation run, encrypting the password with the salt
		$this->validate()->get();

		// If the username and encrypted password matched a record in the database,
		// this user object would be fully populated, complete with their ID.

		// If there was no matching record, this user would be completely cleared so their id would be empty.
		if ($this->exists())
		{
			// Login succeeded
			return TRUE;
		}
		else
		{
			// Login failed, so set a custom error message
			$this->error_message('login', $this->localize_label('error_login'));

			if ($type == 'username') {
				// restore username for login field
				$this->username = $uname;
			} elseif ($type == 'email') {
				// restore email for login field
				$this->email = $email;
			}		

			return FALSE;
		}
	}
	 
	// --------------------------------------------------------------------
	
	/**
	 * Encrypt (prep)
	 *
	 * Encrypts this objects password with a random salt.
	 *
	 * @access	private
	 * @param	string
	 * @return	void
	 */
	function _encrypt($field)
	{
		if (!empty($this->{$field}))
		{
			if (empty($this->salt))
			{
				$this->salt = md5(uniqid(rand(), true));
			}

			$this->{$field} = sha1($this->salt . $this->{$field});
		}
	}
	
	public function delete_by_id($id) {
		foreach ($this->has_many as $class=>$params) {
			$model = new $class();
							
			$this->db->where("user_id", $id)->delete($model->table);
		}
		
		return $this->delete();
	}
	
	public function create_username() {
		if ($this->username != '') {
			return;
		}
		$temp = explode("@", $this->email);
		$this->username = $temp[0];
		
		$user = new User();
		$user->where("username", $this->username);
		if ($this->id) {
			$user->where("userid", $this->id, "<>");
		}
		if ($user->count() == 0) {
			return;
		}
		
		$user->select_max("id");
		$user->get();
		$this->username.= ($user->id + 1);
	}
}

/* End of file user.php */
/* Location: ./application/models/user.php */