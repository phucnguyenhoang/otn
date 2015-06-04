<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('login', $this->language);
    }

	public function index($params = array())
	{
		$view = "";
		$view = $this->load->view('login_form','',true);
		if(in_array('check_login',$params)){
			$dataPost = $this->input->post();
			//check login
			$data['message'] = $this->check_login($dataPost);
			$view = $this->load->view('login_form',$data,true);
		}
		return $view;
	}

	public function check_login($dataPost){
		$is_login = $this->auth->login($dataPost['username'],$dataPost['password']);
		if(!$is_login){
			return "username or password is wrong!";
		}else{
			return "login success";
		}
	}
}
