<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('brand', 'admin');
    }
    public function index() {
        $header = array(
            'css' => array(
                'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css',
                'bower_components/datatables-responsive/css/dataTables.responsive.css'
            ),
            'js' => array(
                'bower_components/datatables/media/js/jquery.dataTables.min.js',
                'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'
            ),
            'lang_title' => $this->lang->line('title')
        );
        $content = array(
            'lang_title' => $this->lang->line('title')
        );
        $this->load->view('layout/header', $header);
        $this->load->view('brands/index', $content);
        $this->load->view('layout/footer');
    }
}