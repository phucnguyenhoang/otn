<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('common', 'admin');
        $this->lang->load('category', 'admin');
    }
    public function index() {
        $breadCrumb = array(
            $this->lang->line('category') => ''
        );
        $buttons = array(
            'create' => true
        );
        $header = array(
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );
        $content = array(
            'lang_title' => $this->lang->line('title')
        );
        $this->load->view('layout/header', $header);
        $this->load->view('category/index', $content);
        $this->load->view('layout/footer');
    }

    public function create(){
    	$breadCrumb = array(
    		$this->lang->line('category') => 'admin/category',
    		$this->lang->line('create') => ''  
    	);
    	$buttons = array(
    		'cancel' =>true
    	);
    	$header = array(
    		'lang_title' => $this->lang->line('create_title'),
    		'bread_crumb' => $breadCrumb,
    		'buttons' => $buttons
    	);

    	$content = array(
    		
    	);
		$this->load->view('layout/header',$header);
		$this->load->view('category/index',$content);
		$this->load->view('layout/footer');
    }

   
}