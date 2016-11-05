<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoData extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->helper('util');
        $this->load->model('video_model');
	}
    
	public function index($page = 1, $category = 'all', $listNum = 12, $search ="")
	{
       
        
        if(empty($_GET['page']) == false && $_GET['page'] != "")
        {
            $page = $_GET["page"];
        }
        
        if(empty($_GET['category']) == false && $_GET['category'] != "")
        {
            if($_GET['category'] === 'travel' || 
            $_GET['category'] === 'entertainment' || 
            $_GET['category'] === 'music' ||
            $_GET['category'] === 'interaction' ||
            $_GET['category'] === 'sports' ||
            $_GET['category'] === 'drama')
            {
                $category = $_GET["category"];   
            }
        }
        
        if(empty($_GET['listNum']) == false && $_GET['listNum'] != "")
        {
            $listNum = $_GET["listNum"];
        }
        
        if(empty($_GET['search']) == false && $_GET['search'] != "")
        {
            $search = $_GET["search"];
        }
        
        
        $end = $listNum * ($page-1);
        
        $videoData = $this->video_model->get_video_data($category, $listNum, $end, $search);    
        
        header('Content-Type: application/json');
        
        $total = $this->video_model->get_video_total($category, $search);
        $totalPage = ceil($total/$listNum);
        
        if($page >= $totalPage) 
        {
            $next = "";
        }
        else
        {
            $next = "/ajax/videodata?page=".($page+1);    
        }
        
        $data["videoData"] = array("total" => $total, "next" => $next, "category" => $category, 'items' => $videoData);
        
        echo json_encode($data);
	}
}