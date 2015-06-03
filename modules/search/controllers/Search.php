<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return '<div class="alert alert-info">search</div>';
    }
}
