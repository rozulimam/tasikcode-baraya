<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model {  

    var $table         = 'conf_users';

    public function __construct(){
            parent::__construct();
    } 
 
    public function getData($username)
    {  
         $this->db->select(); 
         $this->db->where('username', $username);   
        $this->db->join('conf_level', $this->table.'.id_level  = conf_level.id_level','left'); 
         $query = $this->db->get($this->table); 
         return $query->row();
    }   
    
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }   


    public function update($data,$id)
    {
       
        $this->db->where('id_user', $id);
        return $this->db->update($this->table, $data);
    } 

    public function delete($id)
    { 
        $this->db->where('id_user', $id);
        return $this->db->delete($this->table);
    }

    public function getUsername($username, $id = NULL)
    { 
         $this->db->select('username'); 
         $this->db->where('username', $username); 
         if($id){  $this->db->where('id_user !=', $id); }

         $query = $this->db->get($this->table);  
         if($query->num_rows() == 0){ return false; } else { return true; }
    } 

    public function getMenu($id_level)
    {  
         $this->db->select(); 
         $this->db->like('level', "#".$id_level."#");  
         $this->db->order_by('position', 'asc');  
         $query = $this->db->get('conf_menu'); 
         return $query->result_array();
    }     

    public function getSubmenu($id_level, $id_menu = null)
    {  
         $this->db->select(); 
         $this->db->like('level', "#".$id_level."#");  
         if($id_menu){
            $this->db->where('id_menu', $id_menu); 
         }  
         $this->db->order_by('position', 'asc');  
         $query = $this->db->get('conf_submenu'); 
         return $query->result_array();
    }   
}