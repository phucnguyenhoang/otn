<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

    /*
     * {
     *      '_id': <mongo id object>
     *      'name': <string>
     *      'image': <string>
     *      'description': <string>
     *      'products': [
     *          {
     *              '_id': <mongo id object>,
     *              'group': <string>,
     *              'name': <string>,
     *              'price': <number>,
     *              'color': <string>,
     *              'size': <string>,
     *              'description': <string>,
     *              'images': <array>,
     *              'new': <number>
     *          }
     *      ]
     * }
     */

    public  $rules = array(
            array(
                 'field'   => 'username', 
                 'label'   => 'lang:brands_name', 
                 'rules'   => 'required'
            ),
            array(
                 'field'   => 'password', 
                 'label'   => 'Password', 
                 'rules'   => 'required'
            ),
            array(
                 'field'   => 'passconf', 
                 'label'   => 'Password Confirmation', 
                 'rules'   => 'required'
            ),   
            array(
                 'field'   => 'email', 
                 'label'   => 'Email', 
                 'rules'   => 'required'
            )
    );
    
    public function setFormValidate(){
        $this->lang->load('brand_lang');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules($this->rules);
        if ($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getBrands($product = true) {
        if ($product) {
            $query = $this->cimongo->get('brands');
        } else {
            $query = $this->cimongo->select(array('name', 'image', 'description'))->get('brands');
        }


        return $query->result_object();
    }

    public function getBrandById($id) {
        if (!MongoId::isValid($id)) {
            return false;
        }
        $query = $this->cimongo->get_where('brands', array('_id' => new MongoId($id)));

        return $query->result_object();
    }

    public function getBrandByName($name) {
        $query = $this->cimongo->get_where('brands', array('name' => $name));

        return $query->result_object();
    }

    public function getBrandLikeName($name) {
        $query = $this->cimongo->get_where('brands', array('name' => new MongoRegex("/".$name."/")));

        return $query->result_object();
    }
}