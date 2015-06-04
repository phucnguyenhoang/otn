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

		// $this->login('user','123456');
		// $this->logout();
		// $this->test();
		/*$this->create_user(
			array(
				'username' => 'user2',
				'email' => 'lvphu609822@gmail.com',
				'password' => '654321'
			)
		);*/
		$this->sync_account('admin');
	}

	/**
	 * check permission access 
	 *
	 * @return boolean
	**/
	public function isAccess(){
		//get function access
		$functionAccess = $this->getFunctionAccess();
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
	}

	/**
	 * login user 
	 * @param string (usernsme/email)
	 * @param string
	 * @return boolean
	**/
	public function login($login, $password){
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
		return false;
	}

	/**
	 * logout user
	 *
	 * @return void
	**/
	public function logout(){
		$this->CI->session->unset_userdata('user_info');
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
data temp

{
    "_id" : ObjectId("556ec04cae2a0602058b4572"),
    "email" : "lvphu6098@gmail.com",
    "group_id" : "user",
    "username" : "user",
    "role" : [ 
        "test/test/data1", 
        "test/test/data3"
    ],
    "created_at" : "2015-06-03 15:52:28",
    "is_active" : 1,
    "password" : "$2a$08$YiO0P1287X2r5GnE1CcDY.mBcNy3WkG/ozvCThC5AibFMdN/Y7JsK"
}

pass: 123456

*/