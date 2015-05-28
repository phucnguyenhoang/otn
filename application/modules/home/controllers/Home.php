<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', $this->language);
    }

	public function index()
	{
		$data = array(
            'lang_title' => $this->lang->line('title'),
            'hello' => 'Welcome to OTN shop'
        );

        $this->layout = 'home';
        $this->render($data);
	}
}
