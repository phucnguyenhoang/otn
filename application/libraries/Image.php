<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image {

    protected $allowType;

    public function __construct() {
        $this->CI =& get_instance();
        $this->allowType = array(
            'ls', 'lm', 'll',
            'ps', 'pm', 'pl',
            'qs', 'qm', 'ql',
            'thumb'
        );
    }

    public function get($url, $type = null) {
        if (!empty($type) && in_array($type, $this->allowType)) {
            if ($type == 'thumb') {
                $url = base_url('resources/files/thumbs/'.$url);
            } else {
                $url = base_url('resources/files/resize/'.substr($type, 0, 1).'/'.substr($type, 1, 1).'/'.$url);
            }
        } elseif (empty($type)) {
            $url = base_url('resources/files/source/'.$url);
        } else {
            $url = base_url('resources/images/no-image.png');
        }

        return $url;
    }
}