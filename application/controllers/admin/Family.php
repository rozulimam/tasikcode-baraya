<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends CI_Controller {

	public $dir_v = 'admin/family';
	public $dir_m = 'admin';
	public $dir_l = 'admin';

	public function __construct(){
		parent::__construct(); 

		$this->l_auth->checkLogin();

		$this->load->helper('string');
		$this->load->model($this->dir_m.'/m_family'); 
		$this->load->library('form_validation');
	}

	public function index()
	{ 
		
		$this->l_auth->checkAccess();
		$data['title']  = "Data family";
		$data['css']    = array(
								'assets/plugins/datatables/datatables.min.css', 
						  	  ); 

		$data['js']    = array( 
								'assets/plugins/datatables/datatables.min.js', 
								'assets/plugins/datatables/dataTables.bootstrap4.min.js', 
								'assets/js/admin/family/view.js'
							  );  

		$this->l_skin->admin($this->dir_v.'/view',$data);
	} 

	public function action_menu($id,$status)
	{

		if($status == 0){
			$status_title  = '<i class="fa fa-unlock"></i> Aktifkan';
			$status_action = '1';
		}else{
			$status_title  = '<i class="fa fa-lock"></i> Blokir';
			$status_action = '0'; 
		}
		 

		$action = 
		'<div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true">
            	Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu"> 
                <li><a href="javascript:;" class="btn_edit" data-id="'.$id.'"><i class="fa fa-edit"></i> Ubah Data</a></li>  
                <li><a href="javascript:;" class="btn_status" data-id="'.$id.'" data-status='.$status_action.'>'.$status_title.'</a></li> 
            </ul>
        </div>';  

        return $action;
	}

	public function data()
	{ 
        $list = $this->m_family->get_datatables();  
        $no   = $this->input->post('start');
        $data = array();
        foreach ($list as $d) { 
        	$no++;   
            $checkbox   = '<input type="checkbox" class="myCheckbox" name="id[]" value="'.$d->id.'">'; 

			if($d->publish == 0){
            	$status = "<span class='label label-danger'>Tidak Aktif</label>";
            }else{
            	$status = "<span class='label label-primary'>Aktif</label>";
            }

            $row 	= array();
            $row[]  = $checkbox;   
            $row[]  = $this->action_menu($d->id, $d->publish);   
            $row[]  = $no;   
            $row[]  = date_id($d->dt_insert); 
            $row[]  = strtoupper($d->name);       
            $row[]  = $d->email;     
            $row[]  = $d->title;              
            $row[]  = $status;              
            $data[] = $row; 

        } 

        $output = array(
            "draw" 			  => $this->input->post('draw'),
            "recordsTotal" 	  => $this->m_family->count_all(),
            "recordsFiltered" => $this->m_family->count_filtered(),
            "data" 			  => $data,
			"token" 		  => $this->security->get_csrf_hash()
        );

        echo json_encode($output); 
		exit();
	}

	public function add()
	{       
		$this->load->view($this->dir_v.'/add');
	}

	public function edit()
	{ 
		$id 		    = $this->input->get('id');
		$data['data']   = $this->m_family->get($id);   
		$this->load->view($this->dir_v.'/edit',$data);  
	}   

	public function act_insert()
	{   
		$notif['token']  = $this->security->get_csrf_hash();
		$this->form_validation->set_rules('name','Nama','required|trim');     
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');     
		$this->form_validation->set_rules('title','Bekerja Sebagai','required|trim');     
		$this->form_validation->set_rules('skill','Keahlian','required|trim');         
		
		if($this->form_validation->run() == false){
			$notif['message']  = validation_errors();
			$notif['status'] = 'warning';
			echo json_encode($notif); 
			return false;
		}    

		$data_family = array(
			'name'		=> strtoupper($this->input->post('name')),      
			'email'		=> $this->input->post('email'),      
			'title'		=> $this->input->post('title'),      
			'skill'		=> $this->input->post('skill'),      
			'link_fb'	=> $this->input->post('link_fb'),      
			'link_git'	=> $this->input->post('link_git'),      
			'link_in'	=> $this->input->post('link_in'),      
			'publish'	=> $this->input->post('publish'),     
			'dt_insert' => set_datetime(),  
		); 
		$this->m_family->insert($data_family);
 
		$notif['message'] = "Data berhasil di simpan";
		$notif['status']  = "success"; 
		echo json_encode($notif);
	} 

	public function act_update()
	{  
		$notif['token']  = $this->security->get_csrf_hash();
		$id 			 = $this->input->post('id'); 
		$this->form_validation->set_rules('name','Nama','required|trim');     
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');     
		$this->form_validation->set_rules('title','Bekerja Sebagai','required|trim');     
		$this->form_validation->set_rules('skill','Keahlian','required|trim');     

		if($this->form_validation->run() == false){
			$notif['message']  = validation_errors();
			$notif['status'] = 'warning';
			echo json_encode($notif); 
			return false;
		}  
		  
		$data = array(
			'name'		=> strtoupper($this->input->post('name')),      
			'email'		=> $this->input->post('email'),      
			'title'		=> $this->input->post('title'),      
			'skill'		=> $this->input->post('skill'),      
			'link_fb'	=> $this->input->post('link_fb'),      
			'link_git'	=> $this->input->post('link_git'),      
			'link_in'	=> $this->input->post('link_in'),      
			'publish'	=> $this->input->post('publish'),     
			'dt_update' => set_datetime(),   
		); 
		$this->m_family->update($data,$id);

		$notif['message'] = "Data berhasil di perbaharui";
		$notif['status']  = "success"; 
		echo json_encode($notif);
	} 

	public function act_update_status()
	{  
		$id_std    = $this->input->post('id'); 
		$status    = $this->input->post('status');

		for ($i=0; $i < count($id_std); $i++) { 
			$data = array( 
				'publish' => $status,  
			); 
			$this->m_family->update($data,$id_std[$i]); 
		}
		
		$notif['message'] = "Status siswa berhasil di perbaharui";
		$notif['status']  = "success"; 
		$notif['token']   = $this->security->get_csrf_hash();
		echo json_encode($notif);
	} 
}
