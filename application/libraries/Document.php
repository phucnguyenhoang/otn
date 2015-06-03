<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document {
    public $title;
    public $keyword;
    public $description;
    protected $css = array();
    protected $js = array();

    public function __construct() {
        $this->CI =& get_instance();
        $this->_getDefaultValue();
    }

    public function setLang($lang) {
        $this->CI->lang->load('common', $lang);
        $this->_getDefaultValue();
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setKeyword($keyword) {
        if (is_array($keyword)) {
            $this->keyword = implode(', ', $keyword);
        } elseif (is_string($keyword)) {
            $this->keyword = $keyword;
        }
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function pushCSS($css) {
        array_push($this->css, $css);
    }

    public function getCSS() {
        return $this->css;
    }

    public function pushJS($js) {
        array_push($this->js, $js);
    }

    public function getJS() {
        return $this->js;
    }

    private function _getDefaultValue() {
        $this->title = $this->CI->lang->line('title');
        $this->keyword = $this->CI->lang->line('keyword');
        $this->description = $this->CI->lang->line('description');
    }
}