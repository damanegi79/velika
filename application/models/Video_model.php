<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Video_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    
    function get_video_total($c, $s)
    {
        if($s == "")
        {
            if($c == "all")
            {
                $rows = $this->db->get('videoData')->num_rows();
            }
            else
            {
                $rows = $this->db->where('category', $c)->get('videoData')->num_rows();
            } 
        }
        else
        {
            $rows = $this->db->where("subCategory LIKE '%".$s."%' OR videoTitle LIKE '%".$s."%' OR decsribe LIKE '%".$s."%'", null)->get('videoData')->num_rows();
        } 
        
        return $rows;
    }
    
    function get_video_data($c, $l, $e, $s)
    {
        if($s == "")
        {
            if($c == "all")
            {
                $sql = "SELECT * FROM videoData ORDER BY viewNum DESC LIMIT ".$l." OFFSET ".$e;    
            }
            else 
            {
                $sql = "SELECT * FROM videoData WHERE (category='".$c."') ORDER BY id DESC LIMIT ".$l." OFFSET ".$e;
            }
        }
        else
        {
            $sql = "SELECT * FROM videoData WHERE (subCategory LIKE '%".$s."%' OR videoTitle LIKE '%".$s."%' OR decsribe LIKE '%".$s."%') ORDER BY id DESC LIMIT ".$l." OFFSET ".$e;
        }
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function insert_video_data($date, $cate, $subCate, $title, $desc, $thumb, $videoPath2160, $videoPath1080, $videoPath720, $videoPath540, $videoPath480, $videoPath360 )
    {
        $max = $this->db->select_max('viewNum');
        $query = $this->db->get('videoData')->row();

        $viewNum = $query->viewNum + 1;
        $sql = "INSERT INTO videoData (date, category, subCategory, videoPath_2160, videoPath_1080, videoPath_720, videoPath_540, videoPath_480, videoPath_360, thumbPath, videoTitle, decsribe, viewNum)";
        $sql .= "VALUES ('".$date."', '".$cate."', '".$subCate."', '".$videoPath2160."', '".$videoPath1080."', '".$videoPath720."', '".$videoPath540."', '".$videoPath480."', '".$videoPath360."', '".$thumb."', '".$title."', '".$desc."', '".$viewNum."')";
        $query = $this->db->query($sql);
        return $query;
    }

    function insert_game_data($date, $cate, $subCate, $title, $desc, $thumb, $gamePath)
    {
        $max = $this->db->select_max('viewNum');
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