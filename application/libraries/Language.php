<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * {
 *      alias: <string>,
 *      name: <string>,
 *      image: <string>,
 *      sort: <number>,
 *      status: <number>,
 *      default: <number>
 * }
 */

Class Language {
    const LANG = 'vn';
    public $lang;
    private $default;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->config->load('language');
        $this->lang = self::LANG;
        $this->default = array(
            'alias' => 'vn',
            'name' => 'Việt Nam',
            'image' => 'vn.png',
            'sort' => 1,
            'status' => 1,
            'default' => 1
        );
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

    public function getLang() {
        $tplPath = APPPATH.'cache/language';
        if (is_file($tplPath)) {
            $result = array();
            $lang = json_decode(file_get_contents($tplPath), true);
            foreach ($lang as $row) {
                unset($row['_id']);
                $result[$row['sort']] = $row;
            }
            ksort($result);
            return $result;
        }

        return $this->default;
    }
}