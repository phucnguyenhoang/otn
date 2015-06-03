<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Model {
    public function getModules($page) {
        $tplPath = APPPATH.'cache/template';
        if (is_file($tplPath)) {
            $templateConf = json_decode(file_get_contents($tplPath), true);
            if (is_array($templateConf) && !empty($templateConf[$page])) {
                return $templateConf[$page];
            }
        }

        $query = $this->cimongo->get('template_modules');
        $templateConf = $query->row_array();

        if (is_array($templateConf) && !empty($templateConf[$page])) {
            $modules = $templateConf[$page];
        }

        $query = $this->cimongo->select(array('alias'))->get_where('modules', array('type' => 2, 'status' => 1));
        $bgModules = $query->result_array();
        if (!empty($bgModules)) {
            $tmp = array();
            foreach ($bgModules as $key => $value) {
                array_push($tmp, $value['alias']);
            }
            $modules['background_modules'] = $tmp;
        }

        if (!empty($modules)) {
            file_put_contents($tplPath, json_encode($modules));
            return $modules;
        }

        return false;
    }
}