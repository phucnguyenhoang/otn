<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('common', 'admin');
        $this->lang->load('brand', 'admin');
    }
    public function index() {
        $breadCrumb = array(
            $this->lang->line('brands') => ''
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
        $this->load->view('brands/index', $content);
        $this->load->view('layout/footer');
    }

    public function create() {
        $breadCrumb = array(
            $this->lang->line('brands') => 'admin/brands',
            $this->lang->line('create') => ''
        );
        $buttons = array(
            'cancel' => true
        );
        $header = array(
            'lang_title' => $this->lang->line('create_title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
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