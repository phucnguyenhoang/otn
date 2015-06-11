<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->config->set_item('language', 'admin');
        $this->lang->load(array('common', 'country'));
        $this->load->model('country_model');
    }

    public function index()
    {
        $breadCrumb = array(
            $this->lang->line('country') => ''
        );
        $buttons = array(
            'create' => true
        );
        $header = array(
            'lang_title' => $this->lang->line('title'),
            'bread_crumb' => $breadCrumb,
            'buttons' => $buttons
        );

        $countries = $this->country_model->getCountries();
        $content = array(
            'lang_title' => $this->lang->line('title'),
            'lang_list_title' => $this->lang->line('list_title'),
            'lang_name' => $this->lang->line('name'),
            'lang_iso_code' => $this->lang->line('iso_code'),
            'lang_status' => $this->lang->line('status'),
            'countries' => $countries
        );
        $this->load->view('layout/header', $header);
        $this->load->view('country/index', $content);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        $breadCrumb = array(
            $this->lang->line('country') => 'admin/countries',
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
        );
        $this->load->view('layout/header', $header);
        $this->load->view('country/create', $content);
        $this->load->view('layout/footer');
    }

    public function store()
    {
        if (!$this->country_model->setFormValidate(true)) {
            $this->create();
        } else {
            $data = $this->input->post();
            $this->country_model->storeCountry($data);
            redirect(base_url('admin/countries'));
        }
    }

    public function edit($param)
    {
        //var_dump($param[4]); exit();
        $breadCrumb = array(
            $this->lang->line('country') => 'admin/countries',
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
            'record' => $this->country_model->getCountriesById($param[4])
        );
        $this->load->view('layout/header', $header);
        $this->load->view('country/edit', $content);
        $this->load->view('layout/footer');
    }

    public function checkedit($id,$notify)
    {
        //var_dump($param[4]); exit();
        $breadCrumb = array(
            $this->lang->line('country') => 'admin/countries',
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
            'record' => $this->country_model->getCountriesById($id),
            'notify' => $notify
        );
        $this->load->view('layout/header', $header);
        $this->load->view('country/edit', $content);
        $this->load->view('layout/footer');
    }

    public function update()
    {
        //$data =$this->input->post();
        if (is_numeric(($this->input->post('status')))) {
            $data = array(
                'name' => $this->input->post('name'),
                'iso_code' => $this->input->post('iso_code'),
                'status' => (int)($this->input->post('status')),
                '_id' => $this->input->post('_id')
            );
        }
        //var_dump($data); exit();
        if (!$this->country_model->setFormValidate(false))
            $this->edit(array(4 => $data['_id']));
        else{
            $result = $this->country_model->updateCountry($data);
            //var_dump($result);
            if($result == '-1') {
                redirect(base_url('admin/countries'));
            }
            else{
                if($result == '0')
                    $this->checkedit($data['_id'],'Ten nuoc da ton tai!');
                else
                {
                    if($result == '1')
                        $this->checkedit($data['_id'],'Ma nuoc da ton tai!');
                    else{
                        if($result == '2')
                            redirect(base_url('admin/countries'));
                        else
                            $this->checkedit($data['_id'],'Da xay ra loi trong csdl!');
                    }
                }
            }


        }
    }
}
