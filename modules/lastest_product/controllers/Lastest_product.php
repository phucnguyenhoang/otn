<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lastest_product extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return '<div class="alert alert-info">lastest product</div>';
    }
}
