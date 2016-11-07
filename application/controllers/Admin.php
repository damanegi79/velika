<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		//$this->load->model('video_model');
		//$this->load->model('main_model');
		$this->load->helper(array('url', 'form', 'string', 'util'));
		$this->load->library(array('form_validation', 'session'));
		$this->user_id = $this->session->userdata('user_id');
	}
		

	public function index()
	{
		$this->session->unset_userdata('user_id');
		redirect('admin/login');
	}


	/*======================================================================
	*	login
	* ======================================================================*/
	
	public function login()
	{
		$this->load->view('admin/login_view');
	}
	
	public function login_check()
	{
		$reqLoginId = $this->input->post('loginId');
		$reqLoginPass = $this->input->post('loginPass');
		
		$loginRst = $this->user_model->get_users_id($reqLoginId, $reqLoginPass);
		
		
		if($loginRst == TRUE)
		{
			$this->session->set_userdata('user_id' , $reqLoginId);
			redirect('admin/main');
		}
		else
		{
			$data['errorMsg'] = "아이디/비밀번호를 다시 확인하시기 바랍니다.";
			$this->load->view('admin/login_view', $data);
		}
	}



	/*======================================================================
	*	main
	* ======================================================================*/

	public function main()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$page = 0;
		if(isset($_GET['per_page']) && $_GET['per_page'] != "")  $page = $_GET['per_page'];

		
		$low = $this->main_model->get_main_total();
		
		$main_list = $this->main_model->get_main_data(10, $page);
		
		$data = array();
		$data['main_list'] = $main_list;
		$data['pagination'] = get_pagination_link('/admin/main', $low); 
		$data['page'] = $page;
		$data['pageTotal'] = $low;
		$this->load->admin_layout('main_view', $data);
	}


	public function main_write()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$data = array();
		$this->load->admin_layout('main_write_view', $data);
	}

	public function main_upload()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$date = date('Y-m-d h:m:s');
			$thumbPath = $_POST['thumb_path'];
			$linkPath = $_POST['link_path'];
			$query = $this->main_model->insert_main_data($date, $thumbPath, $linkPath);
			
			if($query)
			{
				alertMsg('저장되었습니다.', '/admin/main');
			}
			else
			{
				alertMsg('저장실패.', '/admin/main');
			}
			
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}


	public function main_delete()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$del_list = $_POST["chk_list"];
			
			if($this->main_model->delete_main( $del_list ))
			{
				alertMsg('삭제 되었습니다.', $_POST['prev']);
			}
			else
			{
				alertMsg('삭제 실패.');
			}
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}



	/*======================================================================
	*	video
	* ======================================================================*/
	
	public function video()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$page = 0;
		if(isset($_GET['per_page']) && $_GET['per_page'] != "")  $page = $_GET['per_page'];
		
		$cate = "all";
		if(isset($_GET['cate']) && $_GET['cate'] != "")	$cate = $_GET['cate'];
		
		$low = $this->video_model->get_video_total($cate, '');
		
		$video_list = $this->video_model->get_video_data($cate, 10, $page, '');
		
		$data = array();
		$data['video_list'] = $video_list;
		$data['pagination'] = get_pagination_link('/admin/video?cate='.$cate, $low); 
		$data['page'] = $page;
		$data['pageTotal'] = $low;
		$data['cate'] = $cate;
		$totalPage = ceil($low/10)-1;
		
		
		$this->load->admin_layout('video_view', $data);
	}
	
	public function video_write()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$data = array();
		$this->load->admin_layout('video_write_view', $data);
	}
	
	public function video_detail()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if(isset($_GET['id']) && $_GET['id'] != "")
		{
			$id = $_GET['id'];
			$video_list = $this->video_model->get_video_list_row( $id );
			
			if(count($video_list) > 0)
			{
				$data = array();
				$data['video_list'] = $video_list;
				$data['cate'] = $_GET['cate'];
				$data['page'] = $_GET['per_page'];
				$this->load->admin_layout('video_detail_view', $data);
			}
			else
			{
				alertMsg('페이지가 존재하지 않습니다.', '/admin/video');	
			}
		}
		else
		{
			alertMsg('페이지가 존재하지 않습니다.', '/admin/video');
		}
	}
	
	public function upload_file()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);
			
		if ( $this->upload->do_upload())
		{
			$data =$this->upload->data();
			echo '/uploads/'.$data['file_name'];
		}
	}

	public function video_upload()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			//print_r($_POST);
			
			$date = date('Y-m-d h:m:s');
			$cate = $_POST['cate_slt'];
			$subCate = $_POST['sub_cate_txt'];
			$title = $_POST['title_txt'];
			$desc = $_POST['desc_txt'];
			$thumb = $_POST['thumb_path'];
			$videoPath2160 = $_POST['video_path_2160'];
			$videoPath1080 = $_POST['video_path_1080'];
			$videoPath720 = $_POST['video_path_720'];
			$videoPath540 = $_POST['video_path_540'];
			$videoPath480 = $_POST['video_path_480'];
			$videoPath360 = $_POST['video_path_360'];
			$gamePath = $_POST['game_path'];

			if(strtolower($cate) !== 'interaction')
			{
				$query = $this->video_model->insert_video_data($date, $cate, $subCate, $title, $desc, $thumb, $videoPath2160, $videoPath1080, $videoPath720, $videoPath540, $videoPath480, $videoPath360);
			}
			else
			{
				$query = $this->video_model->insert_game_data($date, $cate, $subCate, $title, $desc, $thumb, $gamePath);
			}
			
			if($query)
			{
				alertMsg('저장되었습니다.', '/admin/video');
			}
			else
			{
				alertMsg('저장실패.', '/admin/video');
			}
			
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}
	
	
	public function video_delete()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$del_list = $_POST["chk_list"];
			
			if($this->video_model->delete_video( $del_list ))
			{
				alertMsg('삭제 되었습니다.', $_POST['prev']);
			}
			else
			{
				alertMsg('삭제 실패.');
			}
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}
	
	public function video_modify()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$id = $this->input->post('id');
			$data = array(
				'date' => date('Y-m-d h:m:s'),
				'category' => $this->input->post('cate_slt'),
				'subCategory' => $this->input->post('sub_cate_txt'),
				'videoPath_2160' => $this->input->post('video_path_2160'),
				'videoPath_1080' => $this->input->post('video_path_1080'),
				'videoPath_720' => $this->input->post('video_path_720'),
				'videoPath_540' => $this->input->post('video_path_540'),
				'videoPath_480' => $this->input->post('video_path_480'),
				'videoPath_360' => $this->input->post('video_path_360'),
				'thumbPath' => $this->input->post('thumb_path'),
				'videoTitle' => $this->input->post('title_txt'),
				'decsribe' => $this->input->post('desc_txt')
			);			
			
			$query = $this->video_model->modify_video_data($id, $data);
			
			if($query)
			{
				alertMsg('수정 되었습니다.', $this->input->post('prev'));
			}
			else
			{
				alertMsg('수정 실패.',  $this->input->post('prev'));
			}
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}

	public function video_sort()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$id = $_POST["chk_id"];
			$viewNum = $_POST["chk_num"];
			$arrow = $_POST['arrow'];
			$sort_target = $this->video_model->sort_video( $viewNum,  $arrow);

			if($sort_target)
			{

				$data = array('viewNum' => $sort_target->viewNum);

				$query = $this->video_model->modify_video_data($id, $data);
				if($query)
				{
					$data = array('viewNum' => $viewNum);
					$query = $this->video_model->modify_video_data($sort_target->id, $data);
					if($query)
					{
						alertMsg('이동 되었습니다.', $this->input->post('prev'));
					}
					else
					{
						alertMsg('이동 실패.',  $this->input->post('prev'));
					}
				}
				else
				{
					alertMsg('이동 실패.',  $this->input->post('prev'));
				}
			}
			else
			{
				alertMsg('더이상 이동할 수 없습니다.',  $this->input->post('prev'));
			}
			
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}
	
	
}
