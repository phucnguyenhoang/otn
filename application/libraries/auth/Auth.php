<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('PasswordHash.php');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

class Auth {
	protected $CI;
	/**
	 * __construct
	 *
	 * @return void
	**/
	public function __construct(){	
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->model('auth_model');
		// $this->logout("admin");
	}

	/**
	 * check permission access 
	 *
	 * @return boolean
	**/
	public function isAccess($pageAccess = "",$functionAccess = ""){

		//get function access
		if($functionAccess == ""){
			$functionAccess = $this->getFunctionAccess();
		}

		switch ($pageAccess) {
			case 'admin':
				//user logined			
				if(!empty($this->CI->session->userdata('user_admin_info'))){
					$userInfo = $this->CI->session->userdata('user_admin_info');
					if(in_array($functionAccess,$userInfo['function'])){
						return true;
					}else{
						return false;
					}
				}
				//user not login
				else{
					//get user guess permission
					$userGuessPermission = $this->CI->auth_model->getUserGuessPermission();
					if(in_array($functionAccess,$userGuessPermission)){
						return true;
					}else{
						// return false;
						redirect(base_url('admin/verify'));
					}
				}
				break;
			default:
				//user logined
				if(!empty($this->CI->session->userdata('user_info'))){
					$userInfo = $this->CI->session->userdata('user_info');			
					if(in_array($functionAccess,$userInfo['function'])){
						return true;
					}
					return false;
				}
				//user not login
				else{
					//get user guess permission
					$userGuessPermission = $this->CI->auth_model->getUserGuessPermission();
					if(in_array($functionAccess,$userGuessPermission)){
						return true;
					}
					return false;
				}
				break;
		}		
		
	}

	/**
	 * login user 
	 * @param string (usernsme/email)
	 * @param string
	 * @return boolean
	**/
	public function login($login, $password, $pageAccess = ""){
		switch ($pageAccess) {
			case 'admin':
				//check exsit user/email login
				$userInfo = $this->CI->auth_model->get_user_by_login($login,true);
		  		if($userInfo != NULL){
		  			//check password
		  			$hasher = new PasswordHash(8,false);
					// $password_hash = $hasher->HashPassword($password);
					if($hasher->CheckPassword($password,$userInfo->password)){
						$userdata = array(
							'username' => $userInfo->username,
							'email' => $userInfo->email,
							'function' => $userInfo->function 
						);
						$this->CI->session->set_userdata(array('user_admin_info' => $userdata));
						return true;
					}			
		  		}		
				break;
			
			default:
				//check exsit user/email login
				$userInfo = $this->CI->auth_model->get_user_by_login($login);
		  		if($userInfo != NULL){
		  			//check password
		  			$hasher = new PasswordHash(8,false);
					// $password_hash = $hasher->HashPassword($password);
					if($hasher->CheckPassword($password,$userInfo->password)){
						$userdata = array(
							'username' => $userInfo->username,
							'email' => $userInfo->email,
							'function' => $userInfo->function 
						);
						$this->CI->session->set_userdata(array('user_info' => $userdata));
						return true;
					}			
		  		}				
				break;
		}
		return false;
	}

	/**
	 * logout user
	 *
	 * @return void
	**/
	public function logout($pageAccess = ""){
		switch ($pageAccess) {
			case 'admin':
				$this->CI->session->unset_userdata('user_admin_info');
				break;
			
			default:
				$this->CI->session->unset_userdata('user_info');
				break;
		}
	}

	/**
	 * get user info
	 *
	 * @return string
	**/
	public function getUserGuessPermission(){
		if(!empty($this->CI->session->userdata('user_info'))){
			$userInfo = $this->CI->session->userdata('user_info');
			return $userInfo['group_id'];
		}
		return 'guess';
	}

	/**
	 * get function access
	 *
	 * @return string
	**/
	public function getFunctionAccess(){
		$controller = $this->CI->router->fetch_class();
		$function = $this->CI->router->fetch_method();
		$module = $this->CI->router->fetch_module(); 
		return $module.'/'.$controller.'/'.$function;
	}

	/**
	 * Create new user on the site and return some data about it:
	 * user_id, username, password, email, 
	 *
	 * @param	array
	 * @return	array
	 */
	function create_user($data)
	{
		//check exist username
		if($this->CI->auth_model->is_username_available($data['username'])){
			//username in use
			return NULL;
		}elseif($this->CI->auth_model->is_email_available($data['email'])){
			//email in use
			return NULL;
		}else{
			$hasher = new PasswordHash(8,false);
			$hashed_password = $hasher->HashPassword($data['password']);
			$data['password'] = $hashed_password;
			$res = $this->CI->auth_model->create_user($data);
			if(!empty($res)){
				return $res;
			}
		}
		return NULL;
	}

	/**
	 * sync permission with user 
	 *
	 * @param	string
	 * @return	array
	 */
	function sync_account($group_name)
	{
		return $this->CI->auth_model->sync_account($group_name);
	}


}


/*
{
    "_id" : ObjectId("556ec03cae2a06ff048b4567"),
    "email" : "lvphu6099@gmail.com",
    "group_id" : "admin",
    "username" : "admin1",
    "function" : [ 
        "test/test/data1", 
        "test/test/data2", 
        "test/test/data3"
    ],
    "created_at" : "2015-06-03 15:52:12",
    "is_active" : 1
}

*/