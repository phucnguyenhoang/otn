<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beauty_currency extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->document->setTitle('background module running');
        return true;
    }
}
