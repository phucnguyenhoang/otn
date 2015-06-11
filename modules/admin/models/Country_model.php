<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

    /*
     * {
     *      '_id': <mongo id object>
     *      'name': <string>
     *      'iso_code': <Int32>
     *      'status': <Int32>
     *
     * }
     */

    public  $rules_create = array(
        array(
            'field'   => 'name',
            'label'   => 'lang:countries_name',
            'rules'   => 'required|is_unique[countries.name]',
        ),
        array(
            'field'   => 'iso_code',
            'label'   => 'lang:iso_code',
            'rules'   => 'required|is_unique[countries.iso_code]',
        ),
        array(
            'field'   => 'status',
            'label'   => 'lang:status',
            'rules'   => 'required',
        ),
    );
    public  $rules_edit = array(
        array(
            'field'   => 'name',
            'label'   => 'lang:countries_name',
            'rules'   => 'required',
        ),
        array(
            'field'   => 'iso_code',
            'label'   => 'lang:iso_code',
            'rules'   => 'required',
        ),
        array(
            'field'   => 'status',
            'label'   => 'lang:status',
            'rules'   => 'required',
        ),
    );

    public function setFormValidate($create){
        $this->lang->load('country_lang');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($create==true)
            $this->form_validation->set_rules($this->rules_create);
        else
            $this->form_validation->set_rules($this->rules_edit);
        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getCountries() {
        $query = $this->cimongo->select(array('name', 'iso_code', 'status'))->get('countries');

        $query->sort(array('name' => 1));

        return $query->result_object();
    }

    public function getCountriesById($id) {
        $query = $this->cimongo->get_where('countries', array('_id' => new MongoId($id)));
        $result = $query->result_object();
        if(count($result)>0){
            return  $result[0];
        }
        return array();
    }

    public function getCountriesByName($name) {
        $query = $this->cimongo->get_where('countries', array('name' => $name));

        return $query->result_object();
    }

    public function checkCountriesByName($name) {
        $query = $this->cimongo->get_where('countries', array('name' => $name));
        $result = $query->result_object();
        if(count($result)>0)
            return true;
        else
            return false;
    }

    public function checkCountriesByIso_code($iso_code) {
        $query = $this->cimongo->get_where('countries', array('iso_code' => $iso_code));

        $result = $query->result_object();
        if(count($result)>0)
            return true;
        else
            return false;
    }

    public function getCountryLikeName($name) {
        $query = $this->cimongo->get_where('countries', array('name' => new MongoRegex("/".$name."/")));

        return $query->result_object();
    }

    public function storeCountry($data){
        $record = array(
            'name' => $data['name'],
            'iso_code' => $data['iso_code'],
            'status' => $data['status']
        );
        $query = $this->cimongo->insert('countries',$record);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function updateCountry($data){
        $record = array(
            'name' => $data['name'],
            'iso_code' => $data['iso_code'],
            'status' => $data['status']
        );
        //var_dump($this->checkCountriesByName($record['name']));
        //var_dump($this->checkCountriesByIso_code($record['iso_code']));
        if($this->checkCountriesByName($record['name']) && $this->checkCountriesByIso_code($record['iso_code']))
            return '-1';
        else {

        }

    }


}