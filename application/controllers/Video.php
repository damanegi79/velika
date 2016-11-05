<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'util'));
		$this->load->library('user_agent');
		$this->load->model('video_model');
	}

	public function index()
	{
        
		
		if(isset($_GET["id"]) && $_GET["id"] !== "" && isset($_GET["cate"]) && $_GET["cate"] !=="")
		{
			$id =$_GET["id"];
			$cate = $_GET["cate"];
			
			
			$videoList = $this->video_model->get_video_list_row($id);
			
			if(isset($videoList) && count($videoList)>0)
			{
				$count = $videoList->viewCount;
				if(empty($count)) $count = 0;
				$this->video_model->add_view_count($id, $count);
				
				$data = array();
				$data['video_list'] = $videoList;
				$data['date'] = spriteDate($videoList->date);
				$data['cate'] = $cate;
				$data['count'] = $videoList->viewCount+1;
				$this->load->layout('video_view', $data);
			}
			else
			{
				show_404();	
			}
		}
		else
		{
			show_404();	
		}
		
	}
	
	public function getVideo()
	{
		redirect("http://api.wecandeo.com/video/default/BOKNS9AQWrE99gflYX7V3jwXBItccCm2RxGqQlJxwGr3y4mPK4qDUYMOwkBTzaHcA1sIiiFisqxZw431147TteoAieie.mp4");
	}
}
