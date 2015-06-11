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
                array(
                    'type' => 'primary',
                    'label' => $this->lang->line('install'),
                    'icon' => 'glyphicon-log-in',
                    'link' => 'admin/plugin/install'
                ),
                array(
                    'type' => 'info',
                    'label' => $this->lang->line('refresh'),
                    'icon' => 'glyphicon-refresh',
                    'link' => 'admin/plugin/refresh',
                    'attr' => array(
                        'id' => 'btn_plugin_refresh'
                    )
                )
            )
        );
        $header = array(
            'js' => array('js/plugin'),
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );

        $plugin = $this->plugin_model->getPlugin(false);
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_list_title' => $this->lang->line('list_title'),
            'lang_name' => $this->lang->line('name'),
            'lang_type' => $this->lang->line('type'),
            'lang_description' => $this->lang->line('description'),
            'plugin' => $plugin
        );
        $this->load->view('layout/header', $header);
        $this->load->view('plugin/index', $content);
        $this->load->view('layout/footer');
    }

    public function refresh() {
        $this->load->model('admin/auth_model');
        $functions = $this->plugin_model->getPluginFunction();
        $guest = array();
        $admin = array();
        $user = array();
        foreach ($functions as $i => $function) {
            switch ($function['permission']) {
                case 1:
                    array_push($admin, $function['alias']);
                    break;
                case 2:
                    array_push($user, $function['alias']);
                    break;
                case 3:
                    array_push($admin, $function['alias']);
                    array_push($user, $function['alias']);
                    break;
                case 4:
                    array_push($guest, $function['alias']);
                    break;
                case 5:
                    array_push($admin, $function['alias']);
                    array_push($guest, $function['alias']);
                    break;
                case 6:
                    array_push($user, $function['alias']);
                    array_push($guest, $function['alias']);
                    break;
                case 7:
                    array_push($admin, $function['alias']);
                    array_push($user, $function['alias']);
                    array_push($guest, $function['alias']);
                    break;
            }
            unset($functions[$i]['permission']);
        }
        $this->plugin_model->removeFunction();
        $this->plugin_model->saveMultiFunction($functions);
        $this->plugin_model->updateDefaultGroup($admin, $user, $guest);
        $this->auth_model->sync_account('admin');
        $this->auth_model->sync_account('user');
        $this->auth_model->sync_account('guest');

        return NULL;
    }
}