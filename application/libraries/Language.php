<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Language {
    const LANG = 'vn';
    public $lang;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->config->load('language');
        $this->lang = self::LANG;
        $this->langSupport = $this->CI->config->item('lang');
    }

    public function __toString() {
        return $this->lang;
    }

    public function check($lang) {
        return in_array($lang, $this->langSupport);
    }

    public function setLang($lang) {
        if ($this->check((string)$lang)) {
            $this->lang = (string)$lang;
            $this->CI->document->setLang((string)$lang);
        } else {
            $this->lang = self::LANG;
            $this->CI->document->setLang(self::LANG);
        }
    }
}