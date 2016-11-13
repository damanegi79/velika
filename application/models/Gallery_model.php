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
        if($c == "")
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
    
    function insert_gallery_data($date, $cate,  $title, $subTitle, $desc, $thumb)
    {
        $this->db->select_max('viewNum');
        $query = $this->db->get('galleryData');
        if($query->num_rows()>0)
        {
            $viewNum = $query->row()->viewNum + 1;
        }
        else
        {
            $viewNum = 1;
        }
        $sql = "INSERT INTO galleryData (category, title, subTitle, thumbPath, content, date, viewNum)";
        $sql .= "VALUES ('".$cate."', '".$title."', '".$subTitle."', '".$thumb."', '".$desc."', '".$date."', '".$viewNum."')";
        $query = $this->db->query($sql);
        return $query;
    }

    function delete_gallery( $id )
    {
        return $this->db->where_in('id', $id)->delete('galleryData');
    }


    function sort_gallery( $viewNum, $sort )
    {
        if($sort === 'up')
        {
            $sql = "SELECT * FROM galleryData WHERE (viewNum > ".$viewNum.") ORDER BY id LIMIT 1";
        }
        else
        {
            $sql = "SELECT * FROM galleryData WHERE (viewNum < ".$viewNum.") ORDER BY id DESC LIMIT 1";
        }
        $query = $this->db->query($sql);
        return $query->row();
    }

    function modify_gallery_data($id, $data)
    {
        return $this->db->where('id', $id)->update('galleryData', $data);  
    }

    function get_gallery_list_row( $id )
    {
        $sql = "SELECT * FROM galleryData WHERE id='".$id."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
	
}