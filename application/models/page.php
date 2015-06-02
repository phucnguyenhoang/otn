<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class page extends CI_Model {
    public function getModules() {
        $tplPath = APPPATH.'cache/template';
        if (is_file($tplPath)) {
            $templateConf = json_decode(file_get_contents($tplPath), true);
            if (is_array($templateConf)) {
                return $templateConf;
            }
        }

        $query = $this->cimongo->get('template_modules');
        $templateConf = $query->row_array();
        unset($templateConf['_id']);
        file_put_contents($tplPath, json_encode($templateConf));

        return $templateConf;
    }
}