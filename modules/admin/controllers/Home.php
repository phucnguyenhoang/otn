<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('home', 'admin');
    }
    public function index() {
        $header = array(
            'lang_title' => $this->lang->line('title')
        );
        $this->load->view('layout/header', $header);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}