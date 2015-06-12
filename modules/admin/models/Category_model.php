<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    /*
     *** categories ***
    {
        "image": <string>,
        "top": <number>,
        "order": <number>,
        "status": <number>,
        "parent": [<_id>],
        "products": [
            {
                "<_id>": [
                    {
                        "color": <string>,
                        "size": <string>,
                        "label": <string>,
                        "price": <number>,
                        "quantity": <number>
                    }
                ]
            }
        ]
    }
    *** category_description ***
    {
        "<language>" : {
            "<alias>" : {
                "_id": <string>,
                "alias": <string>,
                "name": <string>,
                "description": <string>,
                "keyword": <string>,
                "products": {
                    "<_id>": {
                        "alias": <string>,
                        "name": <string>,
                        "description": <string>
                    }
                }
            }
        }
    }
    */

    function construct(){
        parent::__construct();

    }
   /* public  $rules = array(
        array(
             'field'   => 'vn_category[name]', 
             'label'   => 'lang:category_name', 
             'rules'   => 'required|categories_name_is_unique[categories.alias]'
        )
    );*/
    
    public function getRuleName($aliasLang){
        return 
        array(
             'field'   => $aliasLang.'_category[name]', 
             'label'   => 'lang:category_name', 
             'rules'   => 'required|categories_name_is_unique[categories.alias]'
        );
    }

    public function setFormValidate(){
        $this->lang->load('category');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $rules = array();

        $arrLang = $this->language->getLang();

        if(count($arrLang) > 0){
            foreach ($arrLang as $key => $lang) {
                array_push($rules, $this->getRuleName($lang['alias']));
            }
        }
        $this->form_validation->set_rules($rules);

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
        // var_dump($data); die();

        //save category and get id inseted
        $category_record = array(
            'image' => $data['category']['image'],
            'top' => ($data['category']['top'] == "on") ? 1 : 0,
            'order' => is_numeric(trim($data['category']['order'])) ? (int) trim($data['category']['order']) : 0,
            'status' => is_numeric(trim($data['category']['status'])) ? (int) trim($data['category']['status']) : 0,
            'parent' => $data['category']['parent'],
            'products' => array()
        );
        $this->cimongo->insert('categories',$category_record);
        $category_id = $this->cimongo->insert_id();

        //save category_description
        $arrLang = $this->language->getLang();

        if(count($arrLang) > 0){
            foreach ($arrLang as $key => $lang) {
                
            }
        }

        /*$record = array(
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
        }*/
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
