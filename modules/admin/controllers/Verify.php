<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('verify', 'admin');
    }
    public function index() {
        $header = array(
            'lang_title' => $this->lang->line('title')
        );
        $this->load->view('verify/index');
    }
    
    public function logout(){
       $this->auth->logout("admin");
       $this->load->view('verify/index');
    }

    public function auth(){
    	$dataPost = $this->input->post();
    	//check login
    	if(!$this->auth->login($dataPost['username'],$dataPost['password'],"admin")){
    		$data['message'] = "user name or password is wrong!";
    		$this->load->view('verify/index',$data);
    	}else{
    		/*require_once(APPPATH.'../modules/admin/controllers/Home.php'); 
		    $Home =  new Home();
		    $Home->index();*/
		    redirect(base_url('admin'));
    	}
    }
}