<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Template {
    protected $CI;
    public $name;
    public $path;
    public $realPath;
    public $config;
    public $css;
    public $js;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('page');
        $this->CI->config->load('template');
        $this->name = is_string($this->CI->config->item('template')) ? $this->CI->config->item('template') : 'default';
        $this->realPath = FCPATH.'templates/'.$this->name.'/';
        $this->path = base_url('templates/'.$this->name).'/';
        //$this->CI->load->library('session');

        // get config from template
        $config = array();
        require_once($this->realPath.'config.php');
        $this->config = $config;
        // get css file
        $this->css = !empty($config['css']) ? $config['css'] : array();
        // get js file
        $this->js = !empty($config['js']) ? $config['js'] : array();
    }

    public function __toString() {
        return $this->name;
    }

    public function config() {
        return $this->config;
    }

    public function getCSS() {
        $result = array();
        if (!empty($this->css)) {
            foreach ($this->css as $css) {
                $tmpCSSFile = $this->path.'resources/css/'.$css.'.css';
                array_push($result, $tmpCSSFile);
            }
        }

        return $result;
    }

    public function getJS() {
        $result = array();
        if (!empty($this->js)) {
            foreach ($this->js as $js) {
                $tmpJSFile = $this->path.'resources/js/'.$js.'.js';
                array_push($result, $tmpJSFile);
            }
        }

        return $result;
    }

    public function getModules($page) {
        return $this->CI->page->getModules($page);
    }
}