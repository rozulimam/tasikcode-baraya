<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model { 

    public function __construct(){
            parent::__construct();
    } 


    public function get()
    {
        $this->db->select();
        $this->db->from('tbl_room');
        return $this->db->get()->result();
    }

    public function get_time()
    {
        $time = date("H");
        $this->db->select();
        $this->db->from('tbl_room');
        $this->db->where('HOUR(time) >=',$time.":00");
        $this->db->where('HOUR(time) <=',$time.":59");
        return $this->db->get()->result();
    }

    public function insert($data)
    {

        $this->db->truncate('tbl_room');
        return $this->db->insert_batch('tbl_room',$data);
    }

}