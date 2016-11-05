<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Main_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    
    function get_main_total()
    {
        $rows = $this->db->get('mainData')->num_rows(); 
        return $rows;
    }
    
    function get_main_data($l, $e)
    {
        $sql = "SELECT * FROM mainData ORDER BY id DESC LIMIT ".$l." OFFSET ".$e;
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_main_data()
    {
        $sql = "SELECT * FROM mainData ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function insert_main_data($date, $thumbPath, $linkPath)
    {
        $sql = "INSERT INTO mainData (date, thumbPath, linkPath)";
        $sql .= "VALUES ('".$date."', '".$thumbPath."', '".$linkPath."')";
        $query = $this->db->query($sql);
        return $query;
    }


    function delete_main( $id )
    {
        return $this->db->where_in('id', $id)->delete('mainData');
    }

    
	
}