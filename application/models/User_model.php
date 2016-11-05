<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_users_id( $id, $pass )
	{	
		$sql = "SELECT * FROM userData WHERE userId='".$id."' AND password='".$pass."'";
		$query = $this->db->query($sql); 
		return $query->result();
	}
	
	
}