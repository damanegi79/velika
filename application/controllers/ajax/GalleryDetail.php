<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GalleryDetail extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->helper('util');
        $this->load->model('gallery_model');
	}
    
	public function index($id = 0)
	{   
        if(empty($_GET['id']) == false && $_GET['id'] != "")
        {
            $id = $_GET["id"];
        }
        header('Content-Type: application/json');

        $galleryData = $this->gallery_model->get_gallery_list_row($id); 
        $data["galleryData"] = array('items' => $galleryData);
        echo json_encode($data);
	}
}