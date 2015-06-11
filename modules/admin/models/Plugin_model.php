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

    public function getPluginFunction() {
        $result = array();
        $query = $this->cimongo->select(array('dir'))->get_where('modules', array('status' => 1));
        $dirList = $query->result_object();
        if (count($dirList) > 0) {
            foreach ($dirList as $item) {
                $config = array();
                @require_once(FCPATH.'modules/'.$item->dir.'/config.php');
                foreach ($config['function'] as $alias => $detail) {
                    $detail['alias'] = $alias;
                    $detail['can_remove'] = 1;
                    array_push($result, $detail);
                }
            }
        }

        return $result;
    }

    public function removeFunction() {
        return $this->cimongo->where(array('can_remove' => 1))->delete('function');
    }

    public function saveMultiFunction($functions) {
        return $this->cimongo->insert_batch('function', $functions);
    }

    public function updateDefaultGroup($admin, $user, $guest) {
        if (!empty($admin)) {
            $this->updateGroupFunction('admin', $admin);
        }
        if (!empty($user)) {
            $this->updateGroupFunction('user', $user);
        }
        if (!empty($guest)) {
            $this->updateGroupFunction('guest', $guest);
        }

        return true;
    }

    public function updateGroupFunction($name, $function) {
        $query = $this->cimongo->get_where('group_user', array('name' => $name));
        $groups = $query->row_array();
        if (!empty($groups)) {
            $functions = array_merge($groups['function'], $function);
            return $this->cimongo->where(array('_id' => $groups['_id']))->update('group_user', array('function' => array_unique($functions)));
        }

        return false;
    }
}