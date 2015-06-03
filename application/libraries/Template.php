<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Template {
    protected $CI;
    public $page;
    public $name;
    public $path;
    public $realPath;
    public $config;
    public $data;
    public $container;
    public $css;
    public $js;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('page');
        $this->CI->config->load('template');
        $this->page = 'home';
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

    public function setPage($page) {
        $this->page = $page;
    }

    public function render($data = null) {
        $regions = array();
        $pagePath = $this->realPath.'/pages/'.$this->page.'.php';
        if (!file_exists($pagePath)) {
            show_404();
        }
        @require_once($pagePath);
        $this->container = $regions['container'];
        unset($regions['container']);
        $tagData = '';
        foreach ($regions as $region => $attributes) {
            $tag = '<div';
            $subRegionData = '';
            foreach ($attributes as $attrName => $attrValue) {
                if ($attrName != 'regions') {
                    $tag .= ' '.$attrName.'="'.$attrValue.'"';
                } else {
                    foreach ($attrValue as $subRegion => $subAttributes) {
                        $subTag = '<div';
                        foreach ($subAttributes as $subAttrName => $subAttrValue) {
                            $subTag .= ' '.$subAttrName.'="'.$subAttrValue.'"';
                        }
                        $subTag .= '>';
                        // set data for sub tag
                        $subTag .= !empty($data[$subRegion]) ? $data[$subRegion] : '';
                        $subTag .= '</div>';
                        $subRegionData .= $subTag;
                    }
                }
            }
            $tag .= '>';
            // set data for tag
            $tag .= $subRegionData;
            $tag .= !empty($data[$region]) ? $data[$region] : '';
            $tag .= '</div>';
            $tagData .= $tag;
        }
        $this->data = $tagData;
    }

    public function getData() {
        return $this->data;
    }
}