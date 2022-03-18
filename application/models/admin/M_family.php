<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_family extends CI_Model { 

    var $table         = 'tbl_family';
    var $column_order  = array(null,null,'dt_insert','name','email', 'title','status');
    var $column_search = array('dt_insert','name','email','title');
    var $order         = array('id' => 'desc');  


    public function __construct(){
            parent::__construct();
    } 

    private function _get_datatables_query(){
        $i         = 0;
        $search    = @$_POST['search']['value'];
        $order     = @$_POST['order']; 

        $this->db->select();  
        $this->db->from('tbl_family');      
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
        return $this->db->count_all_results();
    }

    public function get($id = NULL)
    {  
        $this->db->select(); 
        $this->db->from('tbl_family');    
         if($id){
            $this->db->where('id',$id);
            return $this->db->get()->row();
         }else{
           return $this->db->get()->result();
         } 
    } 

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }    

    public function update($data,$id)
    {
       
        $this->db->where('id', $id);
        return $this->db->update('tbl_family', $data);
    }     

    public function delete($id)
    { 
        $this->db->where('id', $id);
        return $this->db->update('tbl_family', array('deleted' => 1) );
    }    
}