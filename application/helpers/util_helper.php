<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function alertMsg($msg='', $url='') 
{
	$CI =& get_instance();
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
	echo "<script type='text/javascript'>alert('".$msg."');";
	if ($url)
	echo "location.replace('".$url."');";
	else
	echo "history.go(-1);";
	echo "</script>";
	exit;
}

function get_pagination_link( $baseUrl, $totalRows )
{
	$CI =& get_instance();
	$CI->load->library('pagination');
	
	$config['base_url'] = $baseUrl;
	$config['total_rows'] = $totalRows;
	$config['per_page'] = 10;
	$config['page_query_string'] = TRUE;
	$config['enable_query_strings'] = TRUE;
	
	$config['display_always'] = TRUE;
	$config['use_fixed_page'] = TRUE;
	$config['fixed_page_num'] = 5;
	
	$config['display_first_always'] = TRUE;
	$config['display_last_always'] = TRUE;
	$config['disable_first_link'] = TRUE;
	$config['disable_last_link'] = TRUE;
	
	$config['display_prev_always'] = TRUE;
	$config['display_next_always'] = TRUE;
	$config['disable_prev_link'] = TRUE;
	$config['disable_next_link'] = TRUE;
	$config['first_link'] = "<<";
	$config['last_link'] = ">>";
	
	
	
	$config['full_tag_open']='<ul class="pagination">';
	$config['full_tag_close']='</ul>';
	
	$config['num_tag_open']='<li>';
	$config['num_tag_close']='</li>';
	
	$config['prev_tag_open']='<li class="prev">';
	$config['prev_tag_close']='</li>';
	
	$config['next_tag_open']='<li class="next">';
	$config['next_tag_close']='</li>';
	
	$config['first_tag_open']='<li class="first">';
	$config['first_tag_close']='</li>';
	
	$config['last_tag_open']='<li class="last">';
	$config['last_tag_close']='</li>';
	
	$config['disabled_prev_tag_open'] = '<li class="prev disabled"><a>';
	$config['disabled_prev_tag_close'] = '</a></li>';
	
	$config['disabled_next_tag_open'] = '<li class="next disabled"><a>';
	$config['disabled_next_tag_close'] = '</a></li>';
	
	$config['disabled_first_tag_open'] = '<li class="first disabled"><a>';
	$config['disabled_first_tag_close'] = '</a></li>';
	
	$config['disabled_last_tag_open'] = '<li class="last disabled"><a>';
	$config['disabled_last_tag_close'] = '</a></li>';
	
	$config['cur_tag_open']='<li class="active"><a>';
	$config['cur_tag_close']='</a></li>';
	
	
	
	$CI->pagination->initialize($config);
	$link = $CI->pagination->create_links();
	
	return $link;
}

function month_to_eng( $month )
{
	switch ( $month )
	{
		case 1 : return 'January';break;
		case 2 : return 'February';break;
		case 3 : return 'March';break;
		case 4 : return 'April';break;
		case 5 : return 'May';break;
		case 6 : return 'June';break;
		case 7 : return 'July';break;
		case 8 : return 'August';break;
		case 9 : return 'September';break;
		case 10 : return 'October';break;
		case 11 : return 'November';break;
		case 12 : return 'December';break;
	}
}

function removeZero( $num )
{
	$first = substr($num, 0, 1);
	if((int)$first == 0) 
	{
		return substr($num, -1);
	}
	return $num;
}

function spriteDate( $date )
{
	$ar = explode(" ", $date);
	$d = $ar[0];
	return str_replace("-", ". ", $d);
}

function addComma( $num )
{
	$num_text = (string)$num;
	$arr = str_split($num_text, "3");
	$num_new_text = implode(",", $arr);
	return $num_new_text;
}

 
