<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

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

		// $this->login();
		// $this->logout();
		//$this->test();
	}

	public function test(){
		//get user by id
		/*$a = $this->CI->auth_model->get_user_by_id("556d84f294e275b555c6e27a",TRUE);
		var_dump($a);*/

		//get user by login
		/*$a = $this->CI->auth_model->get_user_by_login("noemail@gmail.com");
		var_dump($a);*/

		//get user by login
		/*$arrTemp = array(
			'name' => 'lvphu609',
			'email' => 'lvphu609@gmail.com'
		);
		$a = $this->CI->auth_model->create_user($arrTemp);
		var_dump($a);*/

		/*$a = $this->CI->auth_model->activate_user("556d84f294e275b555c6e27a",FALSE);
		var_dump($a);*/

		$a = $this->CI->auth_model->delete_user("556eb409ae2a0602058b4571");
		var_dump($a);
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
			if(in_array($functionAccess,$userInfo['role'])){
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
	 *
	 * @return boolean
	**/
	public function login(){
		$userInfo = $this->CI->auth_model->login();
		if(is_array($userInfo)){	
			$this->CI->session->set_userdata($arrTemp);
		}
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




}