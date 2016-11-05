<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Loader extends CI_Loader
{

    public function layout($body, $vars,  $return = FALSE)
    {
    	if($return):
    	
	    	$content = $this->view("layout/header_view", $vars, $return);
    		$content .= $this->view($body, $vars, $return);
	    	$content .= $this->view("layout/footer_view", $vars, $return);
	    	return $content;
    	
    	else:
    	
	    	$this->view("layout/header_view", $vars, $return);
    		$this->view($body, $vars, $return);
	    	$this->view("layout/footer_view", $vars, $return);
    	
    	endif;
    }
	
	public function admin_layout($body, $vars,  $return = FALSE)
    {
    	if($return):
    	
	    	$content = $this->view("admin/layout/header_view", $vars, $return);
    		$content .= $this->view('admin'.$body, $vars, $return);
	    	$content .= $this->view("admin/layout/footer_view", $vars, $return);
	    	return $content;
    	
    	else:
    	
	    	$this->view("admin/layout/header_view", $vars, $return);
    		$this->view('admin/'.$body, $vars, $return);
	    	$this->view("admin/layout/footer_view", $vars, $return);
    	
    	endif;
    }
}

/* End of file Someclass.php */