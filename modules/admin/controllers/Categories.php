<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->config->set_item('language', 'admin');
        $this->lang->load(array('common', 'category'));
        $this->load->model('category_model');
    }
    public function index() {
        $breadCrumb = array(
            $this->lang->line('categories') => ''
        );
        $buttons = array(
            'create' => true
        );
        $header = array(
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );

        $categories = $this->category_model->getCategories(false);
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'categories' => $categories
        );
        $this->load->view('layout/header', $header);
        $this->load->view('categories/index', $content);
        $this->load->view('layout/footer');
    }

    public function create() {
        $breadCrumb = array(
            $this->lang->line('categories') => 'admin/categories',
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
        $this->load->view('categories/create', $content);
        $this->load->view('layout/footer');
    }

    public function store(){
        if(!$this->category_model->setFormValidate()){
            $this->create();
        }else{
            $data = $this->input->post();
            $this->category_model->storeCategory($data);
            redirect(base_url('admin/categories'));
        }
    }

    public function edit($param){
        $breadCrumb = array(
            $this->lang->line('categories') => 'admin/categories',
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
            'record' => $this->category_model->getCategoryById($param[4])
        );
        $this->load->view('layout/header', $header);
        $this->load->view('categories/edit', $content);
        $this->load->view('layout/footer');
    }

    public function update(){
        $data =$this->input->post();
        if(!$this->category_model->setFormValidate() && !$this->category_model->isCategoryAliasNameAvailable($data['name'],$data['_id'])){
            $this->edit(array(4 => $data['_id']));
        }else{
            $this->category_model->updateCategory($data);
            redirect(base_url('admin/categories'));
        }
    }

    public function destroy(){
        $id = $this->input->post('id');
        $status = 'success';
        $message = '';
        if(!$this->category_model->deleteCategoryById($id)){
            $status = 'failure';
            $message = 'can not delete!';
        }
        $result = array(
            'status' => $status,
            'message' => '
                <div class="col-lg-12 alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    '.$message.'
                </div>'
        );
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($result)); 
    }
}