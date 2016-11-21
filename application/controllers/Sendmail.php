<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sendmail extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'date', 'util', 'language'));
	}
	
	public function index()
	{
		if($_POST)
		{
			$config['mailtype']  = 'html';
			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = '465';
			$config['smtp_user'] = 'hohomkd@gmail.com';
			$config['smtp_pass'] = 'ansruden1';
			$config['smtp_timeout'] = 10;
			
			$mail_title = isset($_POST['qna_title']) ? $_POST['qna_title'] : "";
			$mail_name = isset($_POST['qna_name']) ? $_POST['qna_name'] : "";
			$mail_addr = isset($_POST['qna_email']) ? $_POST['qna_email'] : "";
			$mail_phone = isset($_POST['qna_phone']) ? $_POST['qna_phone'] : "";
			$mail_type = isset($_POST['qna_type']) ? $_POST['qna_phone'] : "";
			$mail_desc = isset($_POST['qna_desc']) ? $_POST['qna_desc'] : "";

			if($mail_type == "email") $type = "이메일";
			else                      $type = "전화";			
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->from($mail_addr, $mail_name);
			$this->email->to('hohomkd@gmail.com');
			$this->email->subject($mail_title);

			
			$message = '<h4>작성자</h4>';
			$message .= '<p>'.$mail_name.'</p>';
			$message .= '<h4>메일주소</h4>';
			$message .= '<p>'.$mail_addr.'</p>';
			$message .= '<h4>연락처</h4>';
			$message .= '<p>'.$mail_phone.'</p>';
			$message .= '<h4>답변 수신방법</h4>';
			$message .= '<p>'.$type.'</p>';
			$message .= '<h4>내용</h4>';
			$message .= '<p>'.$mail_desc.'</p>';
			
			$this->email->message($message);
			
			if($this->email->send())
			{
				alertMsg('이메일 전송이 완료되었습니다.');
			}
			else 
			{
				alertMsg('이메일 전송 실패.');
			}
			
		}
		else 
		{
			alertMsg('잘못된 접근 입니다.');
		}
	}
	
	
	
}
