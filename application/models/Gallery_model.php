<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Gallery_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    
    function get_gallery_total($c)
    {
        if($c == "all")
        {
            $rows = $this->db->get('galleryData')->num_rows();
        }
        else
        {
            $rows = $this->db->where('category', $c)->get('galleryData')->num_rows();
        } 
        
        return $rows;
    }
    
    function get_gallery_data($c, $l, $e)
    {
        if($c == "")
        {
            $sql = "SELECT * FROM galleryData ORDER BY viewNum DESC LIMIT ".$l." OFFSET ".$e;    
        }
        else 
        {
            $sql = "SELECT * FROM galleryData WHERE (category='".$c."') ORDER BY id DESC LIMIT ".$l." OFFSET ".$e;
        }
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function insert_video_data($date, $cate, $subCate, $title, $desc, $thumb, $videoPath2160, $videoPath1080, $videoPath720, $videoPath540, $videoPath480, $videoPath360 )
    {
        $query = $this->db->get('videoData')->row();

        $viewNum = $query->viewNum + 1;
        $sql = "INSERT INTO videoData (date, category, subCategory, videoPath_2160, videoPath_1080, videoPath_720, videoPath_540, videoPath_480, videoPath_360, thumbPath, videoTitle, decsribe, viewNum)";
        $sql .= "VALUES ('".$date."', '".$cate."', '".$subCate."', '".$videoPath2160."', '".$videoPath1080."', '".$videoPath720."', '".$videoPath540."', '".$videoPath480."', '".$videoPath360."', '".$thumb."', '".$title."', '".$desc."', '".$viewNum."')";
        $query = $this->db->query($sql);
        return $query;
    }

    function insert_game_data($date, $cate, $subCate, $title, $desc, $thumb, $gamePath)
    {
        $query = $this->db->get('videoData')->row();

        $viewNum = $query->viewNum + 1;
        $sql = "INSERT INTO videoData (date, category, subCategory, game_path, thumbPath, videoTitle, decsribe, viewNum)";
        $sql .= "VALUES ('".$date."', '".$cate."', '".$subCate."', '".$gamePath."', '".$thumb."', '".$title."', '".$desc."', '".$viewNum."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    function delete_video( $id )
    {
        return $this->db->where_in('id', $id)->delete('videoData');
    }
    
    function add_view_count( $id, $count )
    {
       return $this->db->where_in('id', $id)->update('videoData', array('viewCount' => ($count+1))); 
    }
    
    
    function get_video_list_row( $id )
    {
        $sql = "SELECT * FROM videoData WHERE id='".$id."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function modify_video_data($id, $data)
    {
        return $this->db->where('id', $id)->update('videoData', $data);  
    }

    

    function sort_video( $viewNum, $sort )
    {
        if($sort === 'up')
        {
            $sql = "SELECT * FROM videoData WHERE (viewNum > ".$viewNum.") ORDER BY id LIMIT 1";
        }
        else
        {
            $sql = "SELECT * FROM videoData WHERE (viewNum < ".$viewNum.") ORDER BY id DESC LIMIT 1";
        }
        $query = $this->db->query($sql);
        return $query->row();
    }
	
	
}