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
             'field'   => 'name', 
             'label'   => 'lang:brands_name', 
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

        $query->sort(array('name' => 1));

        return $query->result_object();
    }

    public function getBrandById($id) {
        $query = $this->cimongo->get_where('brands', array('_id' => new MongoId($id)));
        $result = $query->result_object();
        if(count($result)>0){
            return  $result[0];
        }
        return array();
    }

    public function getBrandByName($name) {
        $query = $this->cimongo->get_where('brands', array('name' => $name));

        return $query->result_object();
    }

    public function getBrandLikeName($name) {
        $query = $this->cimongo->get_where('brands', array('name' => new MongoRegex("/".$name."/")));

        return $query->result_object();
    }

    public function storeBrand($data){
        $record = array(
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description'],
            'products' => array()
        );
        $query = $this->cimongo->insert('brands',$record);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function updateBrand($data){
        $record = array(
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description']
        );
        $is_update = $this->cimongo->where(array('_id' => new MongoId($data['_id'])))->update_batch('brands',$record);
        if($is_update) return TRUE;
        return FALSE;
    }


}