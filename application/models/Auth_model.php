<?php

class Auth_model extends CI_Model {
   	
   	function __construct() 
  	{
    	parent::__construct();
  	}
  	/**
	 * Get user guess permission
	 *
	 * @return	array
	 */
  	public function getUserGuessPermission(){
  		$arrTemp = [
  			'test/test/data1',
  			'test/test/data3'
  		];
  		return $arrTemp;
  	}

  	public function login(){
  		$arrTemp = array(
			'user_info' => array(
				'user_id' => 1,
				'group_id' => 'admin',
				'user_name' => 'Le Vinh Phu',
				'role' => [
					'test/test/data1',
					'test/test/data2',
					'test/test/data3'
				]
			)
		);
		return $arrTemp;
  	}

  	/**
	 * Get user record by Id
	 *
	 * @param	string => new MongoId($user_id)
	 * @param	bool (TRUE/FALSE)
	 * @return	object
	 */
	function get_user_by_id($user_id, $activated)
	{
		$query = $this->cimongo->where(array('_id' => new MongoId($user_id)));
		$query = $query->or_where(array('is_active' => $activated ? 1 : 0));
		$query = $query->get('user');
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by login (username or email)
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_login($login)
	{
		$query = $this->cimongo->where(array("username" => strtolower($login)));
		$query = $query->get('user');
		if ($query->num_rows() == 1){
			return $query->row();
		}else{
			$query = $this->cimongo->where(array("email" => strtolower($login)));
			$query = $query->get('user');
			if ($query->num_rows() == 1){
				return $query->row();
			}
		}
		return NULL;
	}

	/**
	 * Get user record by username
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_username($username)
	{
		$query = $this->cimongo->where(array("username" => strtolower($username)));
		$query = $query->get('user');
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_user_by_email($email)
	{
		$query = $this->cimongo->where(array("email" => strtolower($email)));
		$query = $query->get('user');
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Check if username available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_username_available($username)
	{
		$query = $this->cimongo->where(array("username" => strtolower($username)));
		$query = $query->get('user');
		return $query->num_rows() == 1;
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function is_email_available($email)
	{
		$query = $this->cimongo->where(array("email" => strtolower($email)));
		$query = $query->get('user');
		return $query->num_rows() == 1;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function create_user($data, $activated = TRUE)
	{
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['is_active'] = $activated ? 1 : 0;

		if ($this->cimongo->insert('user', $data)) {
			$user_id = $this->cimongo->insert_id();
			return array('user_id' => $user_id);
		}
		return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activate_user($user_id, $activated = TRUE)
	{
		$query = $this->cimongo->where(array('_id' => new MongoId($user_id)));
		$query = $query->get('user');
		if ($query->num_rows() == 1) {
			$this->cimongo->update('user',array('is_active' => $activated ? 1 : 0),array('_id' => new MongoId($user_id)));
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($user_id)
	{
		$this->cimongo->where(array('_id' => new MongoId($user_id)))->delete();
		// $this->cimongo->delete('user',array('_id' => new MongoId($user_id)));
		/*if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;*/
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_password_key($user_id, $new_pass_key)
	{
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function can_reset_password($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function change_password($user_id, $new_pass)
	{
		$this->db->set('password', $new_pass);
		$this->db->where('id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function set_new_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'new_email' : 'email', $new_email);
		$this->db->set('new_email_key', $new_email_key);
		$this->db->where('id', $user_id);
		$this->db->where('activated', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function activate_new_email($user_id, $new_email_key)
	{
		$this->db->set('email', 'new_email', FALSE);
		$this->db->set('new_email', NULL);
		$this->db->set('new_email_key', NULL);
		$this->db->where('id', $user_id);
		$this->db->where('new_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function update_login_info($user_id, $record_ip, $record_time)
	{
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);

		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));

		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}



}