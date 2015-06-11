<?php

class Auth_model extends CI_Model {
   	
   	function __construct() 
  	{
    	parent::__construct();
  	}
  	/**
	 * Get user guest permission
	 *
	 * @return	array
	 */
  	public function getUserGuessPermission(){
  		$query = $this->cimongo->where(array('name' => 'guest'));
		$query = $query->get('group_user');
		if ($query->num_rows() == 1){
			$group = $query->row();
			return $group->function;
		} 
		return array();
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
	function get_user_by_login($login,$user_system = false)
	{
		$where = array(
				"username" => strtolower($login),
				"email" => strtolower($login)
		);
		$query = $this->cimongo->or_where($where);
		if($user_system){
			$query = $this->cimongo->where(array('user_system' => 1));
		}
		$query = $query->get('user');
		if ($query->num_rows() == 1){
			return $query->row();
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
		$is_delete = $this->cimongo->where(array('_id' => new MongoId($user_id)))->delete('user');
		if ($is_delete == 1) {
			return TRUE;
		}
		return FALSE;
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
		$is_update = $this->cimongo->update('user',array('password' => $new_pass),array('_id' => new MongoId($user_id)));
		if($is_update) return TRUE;
		return FALSE;
	}

	/**
	 * sync permisson to all account by group_id
	 *
	 * @param	string
	 * @return	bool
	 */
	function sync_account($group_name)
	{
		//get functions
		$function = $this->getFunctionFromGroupUser($group_name);
		$is_update = $this->cimongo->where(array('group_id' => $group_name))->update_batch('user',array('function'=>$function));
		if($is_update) return TRUE;
		return FALSE;
	}

	function getFunctionFromGroupUser($group_name){
		$query = $this->cimongo->where(array('name' => $group_name));
		$query = $query->get('group_user');
		if ($query->num_rows() == 1) {
			$res = $query->row();
			return $res->function;
		}
		return array();
	}


}

