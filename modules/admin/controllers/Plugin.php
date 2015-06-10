<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->config->set_item('language', 'admin');
        $this->lang->load(array('common', 'plugin'));
        $this->load->model('plugin_model');
    }

    public function index() {
        $breadCrumb = array(
            $this->lang->line('title') => ''
        );
        $buttons = array(
            'customize' => array(
                'type' => 'primary',
                'label' => $this->lang->line('install'),
                'icon' => 'glyphicon-log-in',
                'link' => 'admin/plugin/install'
            )
        );
        $header = array(
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );

        $plugin = $this->plugin_model->getPlugin(false);
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_list_title' => $this->lang->line('list_title'),
            'lang_name' => $this->lang->line('name'),
            'lang_author' => $this->lang->line('author'),
            'lang_version' => $this->lang->line('version'),
            'lang_description' => $this->lang->line('description'),
            'plugin' => $plugin
        );
        $this->load->view('layout/header', $header);
        $this->load->view('plugin/index', $content);
        $this->load->view('layout/footer');
    }
}