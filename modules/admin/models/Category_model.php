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

    public function getCategory($products = true){
    	if($products){
    		$query = $this->cimongo->get('category');
    	}else{
    		$query = $this->cimongo->select(['name','image','description']);
    	}
        return $query->result_object();
    }

    public function getCategoryById($id){
    	if(!Mongo::isValid($id)){
    		return false;
    	}
    	$this->cimongo->get_where('category',array('_id' => new MongoId($id)));

    	return $this->result_object();
    }

    public function getCategoryByName($name){
    	$this->cimong->get_where('category',array('name' => new MongoRegex("/^$name/i")));
    	return $this->result_object();
    }

    public function getCategoryByLikeName($name){
    	// $this->cimongo->get_where('category',array('name' => new MongoRegex("/^$name/i")));
    	$this->cimongo->like('name', $name, "i", false,true);
    	$this->get('category');
    	return $this->result_object();
    }

    public function deleteCategory($id){
		$is_delete = $this->cimongo->where(array('_id' => new MongoId($id)))->delete('category');
		if ($is_delete == 1) {
			return TRUE;
		}
		return FALSE;	
    }
}