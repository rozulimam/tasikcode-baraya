<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public $dir_v = 'admin/users';
	public $dir_m = 'admin';
	public $dir_l = 'admin';

	public function __construct(){
		parent::__construct(); 

		$this->l_auth->checkLogin();

		$this->load->helper('string');
		$this->load->model($this->dir_m.'/m_users'); 
		$this->load->library('form_validation');
	}

	public function index()
	{ 
		
		$this->l_auth->checkAccess();
		$data['title']  = "Daftar pengguna";
		$data['css']    = array(
								'assets/plugins/datatables/datatables.min.css',
								'assets/plugins/croppie/croppie.css', 
						  	  ); 

		$data['js']    = array( 
								'assets/plugins/datatables/datatables.min.js', 
								'assets/plugins/datatables/dataTables.bootstrap4.min.js',
								'assets/plugins/croppie/croppie.js',
								'assets/js/check_pass.js', 
								'assets/js/admin/users/view.js'
							  );  

		$this->l_skin->admin($this->dir_v.'/view',$data);
	} 

	public function profile()
	{
		$data['title']  = "Profil Saya";
		$data['css']    = array(
								'assets/plugins/datatables/datatables.min.css',
								'assets/plugins/croppie/croppie.css', 
						  	  ); 

		$data['js']    = array( 
								'assets/plugins/datatables/datatables.min.js', 
								'assets/plugins/datatables/dataTables.bootstrap4.min.js',
								'assets/plugins/croppie/croppie.js',
								'assets/js/check_pass.js', 
								'assets/js/admin/users/view.js'
							  );  
		$id_user 	   = $this->session->userdata('login_id_user');
		$data['user']  = $this->m_users->getById($id_user);
		$data['level'] = $this->m_users->getLevel(); 
		$this->l_skin->admin($this->dir_v.'/profile',$data);
	}

	public function data()
	{ 
        $list = $this->m_users->get_datatables();  
        $no   = $this->input->post('start');
        $data = array();
        foreach ($list as $d) { 
        	$no++;

			$btn_reset = '<a href="javascript:;" class="btnReset" data-id="'.$d->id_user.'"><i class="fa fa-key"></i> Ganti Password</a>';
			$btn_edit  = '<a href="'.base_url('admin/users/edit/'.$d->id_user).'"><i class="fa fa-edit"></i> Edit</a>';
			$btn_del   = '<a href="javascript:;" class="btnDelete" data-id="'.$d->id_user.'"><i class="fa fa-trash"></i> Hapus</a>'; 

			$action = 
			'<div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle" aria-expanded="true">
                	Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>'.$btn_edit.'</li>
                    <li>'.$btn_reset.'</li> 
                    <li class="divider"></li>
                    <li>'.$btn_del.'</li>
                </ul>
            </div>'; 

            $last_login = '<small><i class="fa fa-clock-o"></i> Last login : '.datetime_id($d->last_login).'</small>';
            $username   = '<small><i class="fa fa-user"></i> '.$d->username.'</small>';
            $checkbox   = '<input type="checkbox" class="myCheckbox" name="id[]" value="'.$d->id_user.'">';
            $access     = ($d->access == 'Y') ? 'check' : 'times';

            $avatar     = '<span class="pull-left" style="margin-right:10px">
            					<img width="38" class="img-circle" src="'.get_avatar($d->avatar).'">
            			   </span>';

            $row 	= array();
            $row[]  = $checkbox;   
            $row[]  = $action;  
            $row[]  = $avatar.$d->name.'<br>'.$username.' | '.$last_login;   
            $row[]  = $d->email;  
            $row[]  = $d->level;  
            $row[]  = '<center><i class="fa fa-'.$access.'"></i></center>'; 
            $data[] = $row; 
        } 

        $output = array(
            "draw" 			  => $this->input->post('draw'),
            "recordsTotal" 	  => $this->m_users->count_all(),
            "recordsFiltered" => $this->m_users->count_filtered(),
            "data" 			  => $data,
        );

        echo json_encode($output); 
		exit();
	}

	public function add()
	{ 
		$data['title']  = "Tambah pengguna";
		$data['css']    = array(
								'assets/plugins/datatables/datatables.min.css',
								'assets/plugins/croppie/croppie.css', 
						  	  ); 

		$data['js']    = array( 
								'assets/plugins/datatables/datatables.min.js', 
								'assets/plugins/datatables/dataTables.bootstrap4.min.js',
								'assets/plugins/croppie/croppie.js',
								'assets/js/check_pass.js', 
								'assets/js/admin/users/view.js'
							  );   
		$data['level'] = $this->m_users->getLevel(); 
		$this->l_skin->admin($this->dir_v.'/add',$data);
	}

	public function edit($id_user)
	{ 
		$data['title']  = "Rubah data";
		$data['css']    = array(
								'assets/plugins/datatables/datatables.min.css',
								'assets/plugins/croppie/croppie.css', 
						  	  ); 

		$data['js']    = array( 
								'assets/plugins/datatables/datatables.min.js', 
								'assets/plugins/datatables/dataTables.bootstrap4.min.js',
								'assets/plugins/croppie/croppie.js',
								'assets/js/check_pass.js', 
								'assets/js/admin/users/view.js'
							  );   
		$data['user']  = $this->m_users->getById($id_user);
		$data['level'] = $this->m_users->getLevel(); 
		$this->l_skin->admin($this->dir_v.'/edit',$data);
	}  

	public function reset()
	{  
		$this->load->view($this->dir_v.'/reset'); 
	}  

	public function actPassword()
	{ 
		$id_user  = $this->input->post('id'); 

		$this->form_validation->set_rules('pass','Password','required|min_length[6]');
		$this->form_validation->set_rules('conf','Konfirmasi Password','required|min_length[6]|matches[pass]');

		if($this->form_validation->run() == false){
			$notif['message']  = validation_errors();
			$notif['status'] = 'warning';
			echo json_encode($notif); 
			return false;
		} 

		$salt = random_string('alpha', 10);
		$data = array( 
					'salt' 	      => $salt, 
					'pass' 		  => password_hash($this->input->post('pass').$salt, PASSWORD_BCRYPT,["cost" => 8]), 
				);  
 		
		$update = $this->m_users->update($data, $id_user);
		if($update){
			$notif['message'] = "Password pengguna berhasil diperbaharui";
			$notif['status']  = "success";
		}else{
			$notif['message'] = "Password pengguna gagal diperbaharui";
			$notif['status']  = "failed";
		}
		echo json_encode($notif);
	} 

	public function actSave()
	{   
		$this->form_validation->set_rules('username','Username','required|min_length[5]|max_length[20]|alpha_numeric|callback_username_check');

		$this->form_validation->set_rules('name','Nama','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email','Email','required|valid_email|callback_email_check');
		$this->form_validation->set_rules('pass','Password','required|min_length[6]');
		$this->form_validation->set_rules('conf','Konfirmasi Password','required|min_length[6]|matches[pass]');

		if($this->form_validation->run() == false){
			$notif['message']  = validation_errors();
			$notif['status'] = 'warning';
			echo json_encode($notif); 
			return false;
		} 

		$salt = random_string('alpha', 10);
		$data = array(
					'name' 		  => ucwords($this->input->post('name')), 
					'email' 	  => strtolower($this->input->post('email')), 
					'username' 	  => strtolower($this->input->post('username')), 
					'gender' 	  => $this->input->post('gender'), 
					'id_level' 	  => $this->input->post('id_level'), 
					'access' 	  => $this->input->post('access'), 
					'avatar' 	  => $this->uploadAvatar(), 
					'salt' 	      => $salt, 
					'pass' 		  => password_hash($this->input->post('pass').$salt, PASSWORD_BCRYPT,["cost" => 8]), 
					'insert_date' => set_datetime(), 
					'last_update' => set_datetime(), 
				); 

		$insert = $this->m_users->insert($data);
		if($insert){
			$notif['message'] = "Data pengguna berhasil disimpan";
			$notif['status']  = "success";
		}else{
			$notif['message'] = "Data pengguna gagal disimpan";
			$notif['status']  = "Failed";
		}
		echo json_encode($notif);
	}  

	public function actUpdate()
	{  
		$id    = $this->input->post('id'); 

		$this->form_validation->set_rules('username','Username','required|min_length[5]|max_length[20]|alpha_numeric|callback_username_check');

		$this->form_validation->set_rules('name','Nama','required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email','Email','required|valid_email|callback_email_check'); 

		if($this->form_validation->run() == false){
			$notif['message']  = validation_errors();
			$notif['status'] = 'warning';
			echo json_encode($notif); 
			return false;
		} 
 		
 		$this->removeAvatar();

 		$data = array(
					'name' 		  => ucwords($this->input->post('name')), 
					'email' 	  => strtolower($this->input->post('email')), 
					'username' 	  => strtolower($this->input->post('username')), 
					'gender' 	  => $this->input->post('gender'), 
					'id_level' 	  => $this->input->post('id_level'), 
					'access' 	  => $this->input->post('access'), 
					'avatar' 	  => $this->uploadAvatar(),   
					'last_update' => set_datetime(), 
				); 

		$insert = $this->m_users->update($data,$id);
		$this->updateLoginSession();

		if($insert){
			$notif['message'] = "Data pengguna berhasil diupdate";
			$notif['status']  = "success";
		}else{
			$notif['message'] = "Data pengguna gagal diupdate";
			$notif['status']  = "Failed";
		}
		echo json_encode($notif);
	} 

	public function actDelete()
	{  
		$arr_id   = $this->input->post('id'); 
		foreach ($arr_id as $id) { 

			$data      = $this->m_users->getById($id);
			$dir       = "./upload/avatar/".$data->avatar;
			
			if(is_file($dir)){ unlink($dir); } 

			$delete   = $this->m_users->delete($id);
		}
		
		
		if($delete){
			$notif['message'] = "Data pengguna berhasil dihapus";
			$notif['status']  = "success";
		}else{
			$notif['message'] = "Data pengguna gagal dihapus";
			$notif['status']  = "Failed";
		}
		echo json_encode($notif);
	}

	public function removeAvatar()
	{
		$avatar    = $this->input->post('avatar');
		$id  	   = $this->input->post('id'); 
		$data      = $this->m_users->getById($id);
		$dir       = "./upload/avatar/".$data->avatar;

		$upload    = substr($avatar, 0, 4) == "data";
		$filename  = $data->avatar != '';
		$location  = is_file($dir); 

		if($upload AND $filename AND $location){  
			unlink($dir);
		} 
	} 

	function uploadAvatar(){
 
		$avatar   	   = $this->input->post('avatar');
		$last_avatar   = $this->input->post('last_avatar');

		$filename = strtolower( random_string('alnum', 5) ).".jpg";
		$dir      = "./upload/avatar/".$filename;
		if(substr($avatar, 0, 4) == "data"){ 
			$this->base64ToJpeg($avatar, $dir);
			return $filename;
		}else{
			return $last_avatar;
		} 
	}
		
	function base64ToJpeg($base64_string, $output_file) { 
	    $ifp = fopen( $output_file, 'wb' );  
	    $data = explode( ',', $base64_string ); 
	    fwrite( $ifp, base64_decode( $data[ 1 ] ) ); 
	    fclose( $ifp );  
	    return $output_file; 
	} 

	function username_check($str){
		$id = $this->input->post('id');
		if($this->m_users->getUsername($str,$id)){
			$this->form_validation->set_message('username_check', 'Maaf username sudah digunakan');
			return false;
		}else{
			return true;
		}
	}

	function email_check($str){
		$id = $this->input->post('id');
		if($this->m_users->getEmail($str,$id)){
			$this->form_validation->set_message('email_check', 'Maaf email sudah digunakan');
			return false;
		}else{
			return true;
		}
	}

	public function updateLoginSession()
	{
		$id_user  = $this->session->userdata('login_id_user');
		$user 	  = $this->m_users->getById($id_user);
		$arr_sess = array(
							'login_id_user'  => $user->id_user, 
							'login_username' => $user->username, 
							'login_name' 	 => $user->name,  
							'login_avatar'   => $user->avatar, 
							'login_email'    => $user->email,  
						 );

		$this->session->set_userdata($arr_sess); 
	}


}
