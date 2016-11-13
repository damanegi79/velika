<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GalleryData extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->helper('util');
        $this->load->model('gallery_model');
	}
    
	public function index($page = 1, $category = '1', $listNum = 8)
	{
       
        
        if(empty($_GET['page']) == false && $_GET['page'] != "")
        {
            $page = $_GET["page"];
        }
        
        if(empty($_GET['category']) == false && $_GET['category'] != "")
        {
            if($_GET['category'] === '1' || 
            $_GET['category'] === '2')
            {
                $category = $_GET["category"];   
            }
        }
        
        if(empty($_GET['listNum']) == false && $_GET['listNum'] != "")
        {
            $listNum = $_GET["listNum"];
        }
        
        
        $end = $listNum * ($page-1);
        
        $galleryData = $this->gallery_model->get_gallery_data($category, $listNum, $end);    
        
        header('Content-Type: application/json');
        
        $total = $this->gallery_model->get_gallery_total($category);
        $totalPage = ceil($total/$listNum);
        
        if($page >= $totalPage) 
        {
            $next = "";
        }
        else
        {
            $next = "/ajax/gallerydata?page=".($page+1);    
        }
        
        $data["galleryData"] = array("total" => $total, "next" => $next, "category" => $category, 'items' => $galleryData);
        
        echo json_encode($data);
	}

    
}