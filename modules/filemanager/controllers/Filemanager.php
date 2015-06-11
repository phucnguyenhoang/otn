<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
    }

	public function index($params = array())
	{
		return $this->load->view('editor',$params);
	}
}

/*	------usage--------
	echo modules::run('filemanager',array(
		'class' => 'box-content-article',
		'id' => 'box-content-article',
		'name' => 'box-content-article',
		'row' => '3',
		'content' => 'content input'
	));
*/