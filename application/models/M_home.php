<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_model {
	
	public function __construct(){
		parent::__construct();  
	}

	public function get_family($id = null)
	{
		$this->db->select();
		$this->db->from('tbl_family');
		$this->db->where('publish',1);
		if($id){
			$this->db->where('id',$id);
		}
		$query = $this->db->get();
		return $query->result();
	}
}
