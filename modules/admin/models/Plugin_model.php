<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_model extends CI_Model {
    /*
     {
        "alias": <string>,
        "name": <string>,
        "author": <string>,
        "author_link": <string>,
        "version": <string>,
        "description": <string>,
        "type": <number>,
        "status": <number>,
        "create_date": <datetime>,
        "update_date": <datetime>
     }
     */

    public function getPlugin() {
        $query = $this->cimongo->get('modules');
        $query->sort(array('type' => 1, 'name' => 1));

        return $query->result_object();
    }
}