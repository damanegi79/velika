<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('gallery_model');
		//$this->load->model('video_model');
		//$this->load->model('main_model');
		$this->load->helper(array('url', 'form', 'string', 'util'));
		$this->load->library(array('form_validation', 'session'));
		$this->user_id = $this->session->userdata('user_id');
		date_default_timezone_set('Asia/Seoul');
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
			redirect('admin/gallery');
		}
		else
		{
			$data['errorMsg'] = "아이디/비밀번호를 다시 확인하시기 바랍니다.";
			$this->load->view('admin/login_view', $data);
		}
	}


	/*======================================================================
	*	gallery
	* ======================================================================*/
	public function gallery()
	{
		if($this->user_id == NULL)   redirect('admin/login');

		$page = 0;
		if(isset($_GET['per_page']) && $_GET['per_page'] != "")  $page = $_GET['per_page'];

		$cate = "";
		if(isset($_GET['cate']) && $_GET['cate'] != "")	$cate = $_GET['cate'];

		$low = $this->gallery_model->get_gallery_total($cate);

		$gallery_list = $this->gallery_model->get_gallery_data($cate, 10, $page);


		$data = array();
		$data['cate'] = $cate;
		$data['gallery_list'] = $gallery_list;
		$data['pagination'] = get_pagination_link('/admin/gallery?cate='.$cate, $low); 
		$data['page'] = $page;
		$data['pageTotal'] = $low;
		$this->load->admin_layout('gallery_view', $data);
	}


	public function gallery_write()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$data = array();
		$data['cate'] = $_GET['cate'];
		if($data['cate'] == '') $data['cate'] = '1';
		$this->load->admin_layout('gallery_write_view', $data);
	}

	public function gallery_upload()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			//print_r($_POST);
			
			$date = date('Y-m-d h:m:s');
			$cate = $_POST['cate_slt'];
			$title = $_POST['title_txt'];
			$subTitle = $_POST['sub_title_txt'];
			$desc = $_POST['editor'];
			$thumb = $_POST['thumb_path'];
			$query = $this->gallery_model->insert_gallery_data($date, $cate,  $title, $subTitle, $desc, $thumb);
			
			if($query)
			{
				alertMsg('저장되었습니다.', '/admin/gallery');
			}
			else
			{
				alertMsg('저장실패.', '/admin/gallery');
			}
			
		}
		else
		{
			alertMsg('잘못된 접근입니다.');
		}
	}

	public function gallery_delete()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$del_list = $_POST["chk_list"];
			
			if($this->gallery_model->delete_gallery( $del_list ))
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

	public function gallery_sort()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if($_POST)
		{
			$id = $_POST["chk_id"];
			$viewNum = $_POST["chk_num"];
			$arrow = $_POST['arrow'];
			$sort_target = $this->gallery_model->sort_gallery( $viewNum,  $arrow);

			if($sort_target)
			{

				$data = array('viewNum' => $sort_target->viewNum);

				$query = $this->gallery_model->modify_gallery_data($id, $data);
				if($query)
				{
					$data = array('viewNum' => $viewNum);
					$query = $this->gallery_model->modify_gallery_data($sort_target->id, $data);
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

	public function gallery_detail()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		if(isset($_GET['id']) && $_GET['id'] != "")
		{
			$id = $_GET['id'];
			$gallery_list = $this->gallery_model->get_gallery_list_row( $id );
			
			if(count($gallery_list) > 0)
			{
				$data = array();
				$data['gallery_list'] = $gallery_list;
				$data['cate'] = $_GET['cate'];
				$data['page'] = $_GET['per_page'];
				$this->load->admin_layout('gallery_detail_view', $data);
			}
			else
			{
				alertMsg('페이지가 존재하지 않습니다.', '/admin/gallery');	
			}
		}
		else
		{
			alertMsg('페이지가 존재하지 않습니다.', '/admin/gallery');
		}
	}

	public function gallery_modify()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		if($_POST)
		{
			$id = $this->input->post('id');
			$data = array(
				'date' => date('Y-m-d h:m:s'),
				'category' => $this->input->post('cate_slt'),
				'title' => $this->input->post('title_txt'),
				'subTitle' => $this->input->post('sub_title_txt'),
				'content' => $this->input->post('editor'),
				'thumbPath' => $this->input->post('thumb_path')
			);			
			
			$query = $this->gallery_model->modify_gallery_data($id, $data);
			
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



	/*======================================================================
	*	upload
	* ======================================================================*/
	public function upload_edit()
	{
		if (isset ( $_FILES ) && isset ( $_FILES ['upload'] ))
		{
			$CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
			$config['upload_path'] = './uploads/editor/';
			$config['encrypt_name'] = TRUE;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			
			if ( $this->upload->do_upload('upload'))
			{
				$data =$this->upload->data();
				echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '/uploads/editor/".$data['file_name']."', '전송에 성공 했습니다')</script>";
			}
			else 
			{
				echo "<script>alert('업로드에 실패 했습니다.')</script>";
			}
			
			return;
		}
		echo "<script>alert('첨부파일이 없습니다.')</script>";
	}

	public function upload_file()
	{
		if($this->user_id == NULL)   redirect('admin/login');
		
		$config['upload_path'] = './uploads/thumb/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config);
			
		if ( $this->upload->do_upload())
		{
			$data =$this->upload->data();
			echo '/uploads/thumb/'.$data['file_name'];
		}
	}

	

	
	
}
