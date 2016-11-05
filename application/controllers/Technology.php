<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technology extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $data = array();
		$this->load->layout('technology_view', $data);
	}
}
