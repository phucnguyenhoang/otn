<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $URLParams = $this->uri->segments;
        // check parameter from URL
        switch (count($URLParams)) {
            case 0:
                $lang = $this->language;
                $page = 'home';
                $params = array();
                break;
            case 1:
                if ($this->language->check($URLParams[1])) {
                    $lang = $URLParams[1];
                    $this->language->setLang($lang);
                    $page = 'home';
                    $params = array();
                } else {
                    $lang = $this->language;
                    $page = $URLParams[1];
                    $params = array();
                }
                break;
            case 2:
                if ($this->language->check($URLParams[1])) {
                    $lang = $URLParams[1];
                    $this->language->setLang($lang);
                    $page = $URLParams[2];
                    $params = array();
                } else {
                    $lang = $this->language;
                    $page = $URLParams[1];
                    $params = array($URLParams[2]);
                }
                break;
            default:
                if ($this->language->check($URLParams[1])) {
                    $lang = $URLParams[1];
                    $this->language->setLang($lang);
                    $page = $URLParams[2];
                    unset($URLParams[1]);
                    unset($URLParams[2]);
                    $params = $URLParams;
                } else {
                    $lang = $this->language;
                    $page = $URLParams[1];
                    unset($URLParams[1]);
                    $params = $URLParams;
                }
        }

        $moduleConf = $this->template->getModules();
        foreach ($moduleConf as $region => $modules) {

        }
    }
}
