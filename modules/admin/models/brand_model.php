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

    public function getBrands() {
        $query = $this->cimongo->get('brands');

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