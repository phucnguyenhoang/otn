<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('common', 'admin');
        $this->lang->load('brand', 'admin');
    }
    public function index() {
        $header = array(
            'lang_title' => $this->lang->line('title')
        );
        $content = array(
            'lang_title' => $this->lang->line('title')
        );
        $this->load->view('layout/header', $header);
        $this->load->view('brands/index', $content);
        $this->load->view('layout/footer');
    }

    public function create() {
        $header = array(
            'lang_title' => $this->lang->line('create_title')
        );
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_create' => $this->lang->line('create'),
            'lang_btn_edit' => $this->lang->line('btn_edit'),
            'lang_file_manager_title' => $this->lang->line('file_manager_title')
        );
        $this->load->view('layout/header', $header);
        $this->load->view('brands/create', $content);
        $this->load->view('layout/footer');
    }
}