<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->config->set_item('language', 'admin');
        $this->lang->load(array('common', 'brand'));
        $this->load->model('brand_model');
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

        $brands = $this->brand_model->getBrands(false);
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_list_title' => $this->lang->line('list_title'),
            'lang_name' => $this->lang->line('name'),
            'lang_description' => $this->lang->line('description'),
            'brands' => $brands
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
            'cancel' => true,
            'save' => true
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

    public function store(){
        if(!$this->brand_model->setFormValidate()){
            $this->create();
        }else{
            $data = $this->input->post();
            $this->brand_model->storeBrand($data);
            redirect(base_url('admin/brands'));
        }
    }

    public function edit($param){
        $breadCrumb = array(
            $this->lang->line('brands') => 'admin/brands',
            $this->lang->line('edit') => ''
        );
        $buttons = array(
            'cancel' => true,
            'save' => true
        );
        $header = array(
            'lang_title' => $this->lang->line('edit_title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );
        $content = array(
            'lang_title' => $this->lang->line('edit_title'),
            'lang_edit' => $this->lang->line('edit'),
            'lang_btn_edit' => $this->lang->line('btn_edit'),
            'lang_file_manager_title' => $this->lang->line('file_manager_title'),
            'record' => $this->brand_model->getBrandById($param[4])
        );
        $this->load->view('layout/header', $header);
        $this->load->view('brands/edit', $content);
        $this->load->view('layout/footer');
    }

    public function update(){
        $data =$this->input->post();
        if(!$this->brand_model->setFormValidate() && !$this->brand_model->is_brand_alias_name_available($data['name'],$data['_id'])){
            $this->edit(array(4 => $data['_id']));
        }else{
            $this->brand_model->updateBrand($data);
            redirect(base_url('admin/brands'));
        }
    }
}