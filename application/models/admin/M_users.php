<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model { 

    var $table         = 'conf_users';
    var $column_order  = array(null,'name','email','id_level','access');
    var $column_search = array('username','name','email','id_level','access');
    var $order         = array('id_user' => 'desc'); 

    public function __construct(){
            parent::__construct();
    } 

    private function _get_datatables_query(){
        $i         = 0;
        $search    = @$_POST['search']['value'];
        $order     = @$_POST['order']; 

        $this->db->select();  
        $this->db->from($this->table);   
        $this->db->join('conf_level', $this->table.'.id_level  = conf_level.id_level','left');   
        $this->db->where('id_user !=',$this->session->userdata('login_id_user'));

        foreach ($this->column_search as $item) {

            if($search) { 
                if($i===0){
                    $this->db->group_start(); 
                    $this->db->like($item, $search);
                }
                else{
                    $this->db->or_like($item, $search);
                } 
                if(count($this->column_search) - 1 == $i) 
                $this->db->group_end(); 
            } $i++;
        }
     
        if(isset($order)){
            $this->db->order_by($this->column_order[$order['0']['column']], $order['0']['dir']);
        } 

        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $this->_get_datatables_query();
        if($length != -1){
            $this->db->limit($length, $start);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    } 

    public function count_all()
    {
        $this->db->from($this->table); 
        $this->db->join('conf_level', $this->table.'.id_level  = conf_level.id_level','left');  
        $this->db->where('id_user !=',$this->session->userdata('login_id_user'));
        return $this->db->count_all_results();
    }

    public function getById($id)
    {  
         $this->db->select(); 
         $this->db->where('id_user', $id);  
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

    public function getEmail($email, $id = NULL)
    { 
         $this->db->select('email'); 
         $this->db->where('email', $email); 
         if($id){  $this->db->where('id_user !=', $id); }

         $query = $this->db->get($this->table); 
         if($query->num_rows() == 0){ return false; } else { return true; }
    }

    //Other table

    public function getLevel()
    { 
        $this->db->select();    
        $query = $this->db->get('conf_level'); 
        return $query->result();
    }
}