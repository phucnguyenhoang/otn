<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->config->set_item('language', 'admin');
        $this->lang->load(array('common', 'product'));
        $this->load->model('product_model');
    }

    public function index()
    {
        $breadCrumb = array(
            $this->lang->line('products') => ''
        );
        $buttons = array(
            'create' => true
        );
        $header = array(
            //'js' => array('js/brand_page'),
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );

        $products = $this->product_model->getProducts(false);
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_list_title' => $this->lang->line('list_title'),
            'lang_image' => $this->lang->line('image'),
            'lang_product_name' => $this->lang->line('product_name'),
            'lang_price' => $this->lang->line('price'),
            'lang_quantity' => $this->lang->line('quantity'),
            'lang_status' => $this->lang->line('status'),
            'products' => $products
        );
        $this->load->view('layout/header', $header);
        $this->load->view('products/index', $content);
        $this->load->view('layout/footer');
    }

    public function create() {
        $breadCrumb = array(
            $this->lang->line('products') => 'admin/products',
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
        $this->load->view('products/create', $content);
        $this->load->view('layout/footer');
    }
}