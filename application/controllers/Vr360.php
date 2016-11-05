<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vr360 extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(isset($_GET['sort']))
		{
			$sort = $_GET['sort'];
		}
		else
		{
			$sort = "";
		}
        $data = array();
		$data['sort'] = $sort;
		$this->load->layout('vr360_view', $data);
	}
}
