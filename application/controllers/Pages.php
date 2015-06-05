<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        /*$this->load->model('brand_model');
        $brands = $this->brand_model->getBrandLikeName('p');
        var_dump($brands);die();*/
    }

    public function index()
    {
        $URLParams = $this->uri->segments;
        // check parameter from URL
        if (!empty($URLParams[1]) && $URLParams[1] == 'admin') {
            $this->admin($URLParams);
            exit;
        }
        switch (count($URLParams)) {
            case 0:
                $lang = $this->language;
                $page = '';
                $params = array();
                break;
            case 1:
                if ($this->language->check($URLParams[1])) {
                    $lang = $URLParams[1];
                    $page = '';
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
        // check page exist in language
        $this->language->setLang($lang);
        $this->lang->load('common', $this->language);
        if (empty($page)) {
            $page = $this->lang->line((string)$lang);
        }
        $langPage = $this->lang->line($page);
        if (empty($langPage)) {
            show_404();
        }

        // set curr language and page
        $this->template->setPage($langPage);

        $moduleConf = $this->template->getModules($langPage);
        if (!$moduleConf) {
            show_404();
        }


        // check exist and run background module
        if (!empty($moduleConf['background_modules'])) {
            $bgModules = $moduleConf['background_modules'];
            unset($moduleConf['background_modules']);
            foreach ($bgModules as $bgModule) {
                modules::run($bgModule, $params);
            }
        }

        // sort module and run it
        $data = array();
        foreach ($moduleConf as $region => $modules) {
            $moduleOrdered = array();
            $regionData = '';
            if (count($modules) > 0) {
                foreach ($modules as $module) {
                    $moduleOrdered[$module['order']] = $module['module'];
                }
                ksort($moduleOrdered);

                foreach ($moduleOrdered as $module) {
                    $regionData .= modules::run($module, $params);
                    $config = array();
                    $configPath = FCPATH.'modules/'.$module.'/config.php';
                    if (file_exists($configPath)) {
                        require_once($configPath);
                        // get module css
                        if (!empty($config['css'])) {
                            foreach ($config['css'] as $css) {
                                $cssPath = base_url('modules/'.$module.'/resources/css/'.$css.'.css');
                                $this->document->pushCSS($cssPath);
                            }
                        }
                        // get module js
                        if (!empty($config['js'])) {
                            foreach ($config['js'] as $js) {
                                $jsPath = base_url('modules/'.$module.'/resources/js/'.$js.'.js');
                                $this->document->pushJS($jsPath);
                            }
                        }
                    }
                }
            }
            $data[$region] = $regionData;
        }
        $this->render($data);
    }

    public function admin($URLParams) {
        unset($URLParams[1]);
        // get controller
        $controller = 'home';
        if (!empty($URLParams[2])) {
            $controller = $URLParams[2];
            unset($URLParams[2]);
        }
        // get function
        $function = 'index';
        if (!empty($URLParams[3])) {
            $function = $URLParams[3];
            unset($URLParams[3]);
        }
        //check permission
        if(!$this->auth->isAccess("admin",'admin/'.$controller.'/'.$function)){
            return false;
        }
        
        echo modules::run('admin/'.$controller.'/'.$function, $URLParams);
    }
}
