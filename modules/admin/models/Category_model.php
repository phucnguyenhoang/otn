<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    /*
     {
        "<language>": {
            "<alias>": {
                "alias": <string>,
                "name": <string>,
                "description": <string>,
                "keyword": <string>,
                "common": {
                    "image": <string>,
                    "top": <number>,
                    "order": <number>,
                    "status": <number>,
                    "parent": [<string>],
                    "products": [
                        {
                            "alias": <string>,
                            "name": <string>,
                            "description": <string>,
                            "prices": [
                                {
                                    "color": <string>,
                                    "size": <string>,
                                    "label": <string>,
                                    "price": <number>
                                }
                            ]
                        }
                    ]
                }
            }
        }
     }
     */

    function construct(){
        parent::__construct();

    }
    public  $rules = array(
        array(
             'field'   => 'name', 
             'label'   => 'lang:category_name', 
             'rules'   => 'required|categories_name_is_unique[categories.alias]'
        )
    );
    
    public function setFormValidate(){
        $this->lang->load('category_lang');
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

    public function getCategories($product = true) {
        if ($product) {
            $query = $this->cimongo->get('categories');
        } else {
            $query = $this->cimongo->select(array('name', 'image', 'description'))->get('categories');
        }

        $query->sort(array('name' => 1));

        return $query->result_object();
    }

    public function getCategoryById($id) {
        $query = $this->cimongo->get_where('categories', array('_id' => new MongoId($id)));
        $result = $query->result_object();
        if(count($result)>0){
            return  $result[0];
        }
        return array();
    }

    public function getCategoryByName($name) {
        $query = $this->cimongo->get_where('categories', array('name' => $name));

        return $query->result_object();
    }

    public function getCategoryLikeName($name) {
        $query = $this->cimongo->get_where('categories', array('name' => new MongoRegex("/".$name."/")));

        return $query->result_object();
    }

    public function storeCategory($data){
        $record = array(
            'name' => $data['name'],
            'alias' => url_slug($data['name']),
            'image' => $data['image'],
            'description' => $data['description'],
            'products' => array()
        );
        $query = $this->cimongo->insert('categories',$record);
        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function updateCategory($data){
        $record = array(
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description']
        );
        $is_update = $this->cimongo->where(array('_id' => new MongoId($data['_id'])))->update_batch('brands',$record);
        if($is_update) return TRUE;
        return FALSE;
    }


    public function isCategoryAliasNameAvailable($name,$id)
    {
        $query = $this->cimongo->where(array(
            "alias" => strtolower(url_slug($name)),
            "_id" => new MongoId($id)
        ));
        $query = $query->get('categories');
        return $query->num_rows() == 1;
    }

    public function deleteCategoryById($id){
        if ($this->cimongo->where(array('_id' => new MongoId($id)))->delete('categories')) {
            return TRUE;
        }
        return FALSE;
    }

}
