<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public $dir_v = 'admin/auth';
	public $dir_m = 'admin';
	public $dir_l = 'admin';

	public function __construct(){
		parent::__construct(); 

		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->model($this->dir_m.'/m_auth');  
	}

	public function index() {}   
	public function login()
	{ 
		$this->l_auth->checkLogout();
		$data['js'] = array( 
							'assets/js/admin/auth/login.js'
						   );
		$this->l_skin->login($this->dir_v.'/login',$data);
	} 

	public function actLogin()
	{ 
		$notif['token']   = $this->security->get_csrf_hash();
		
		//Validasi untuk form login
		$this->form_validation->set_rules('username','Username','required|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == false){

			$notif['message']  = validation_errors();
			$notif['status']   = 'warning';
			echo json_encode($notif); 
			return false;

		} 

		//Get value dan cak apakah username ada di databse
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user     = $this->m_auth->getData($username);
		if($user){

			//Cek apakah access aktif/nonaktif
			if($user->access == 'N'){
				$notif['message']  = "Mohon maaf <b>$user->name</b> akun anda sudah di blokir";
				$notif['status']   = 'failed';
				echo json_encode($notif);
				return false; 
			}

			//Gabungkan value password dan salt dari database, kemudian cocokan denga password_verify
			$password = $password.$user->salt;
			$check    = password_verify($password, $user->pass);

			if($check){ 

				//Jika berhasil buat session login
				$this->setSession($user); 

				//Perbaharui last login user
				$this->updateLastLogin($user->id_user);

				$notif['message']  = "Selamat datang, <b>$user->name</b> anda berhasil login";
				$notif['status']   = 'success';
				echo json_encode($notif);
				return false; 

			}else{

				//Notifikasi password salah
				$notif['message']  = "Mohon maaf <b>$user->name</b> password anda salah";
				$notif['status']   = 'warning';
				echo json_encode($notif);
				return false; 

			} 

		}else{

			//Notifikasi username tidak ada
			$notif['message']  = "Mohon maaf username anda tidak di temukan";
			$notif['status']   = 'warning';
			echo json_encode($notif);
			return false;
		} 
	}

	public function setSession($user)
	{
		$arr_sess = array(
							'login_id_user'  => $user->id_user, 
							'login_username' => $user->username, 
							'login_name' 	 => $user->name,  
							'login_avatar'   => $user->avatar, 
							'login_email'    => $user->email,  
							'login_access'   => $this->setAccess($user->id_level), 
							'login_menu'     => $this->getMenu($user->id_level), 
						 );

		$this->session->set_userdata($arr_sess);
	}

	public function updateLastLogin($id_user)
	{
		$data = array('last_login' => set_datetime());
		$this->m_auth->update($data, $id_user);
	}

	public function setAccess($id_level)
	{
		 $menu 	    = $this->getLinkMenu($id_level);
		 $submenu   = $this->getLinkSubmenu($id_level);
		 $allowList = array_merge($menu, $submenu);
		 return $allowList;  
	}

	public function getLinkMenu($id_level)
	{
		$data = $this->m_auth->getMenu($id_level);
		$menu = array();
		foreach ($data as $d) {
			$menu[] = $d['link'];
		}
		return $menu;
	}

	public function getLinkSubmenu($id_level)
	{
		$data = $this->m_auth->getSubmenu($id_level);
		$submenu = array();
		foreach ($data as $d) {
			$submenu[] = $d['link'];
		}
		return $submenu;
	}

	public function getMenu($id_level)
	{
		$data = $this->m_auth->getMenu($id_level);
		$menu = array();
		foreach ($data as $d) {
			$row  		     	= array();
			$row['menu']     	= $d['menu'];
			$row['link']     	= base_url('admin/'.$d['link']);
			$row['icon']     	= $d['icon'];

			$submenu 		 	= $this->getSubmenu($id_level,$d['id_menu']);
			if($submenu){
				$row['submenu'] = $submenu;
			} 

			$menu[] 	     	= $row;
 		} 
		return $menu;
	} 

	public function getSubmenu($id_level,$id_menu)
	{
		$data = $this->m_auth->getSubmenu($id_level,$id_menu);
		$submenu = array();
		foreach ($data as $d) {
			$row  		     = array();
			$row['menu']     = $d['submenu'];
			$row['link']     = base_url('admin/'.$d['link']);
			$row['icon']     = $d['icon']; 
			$submenu[] 	     = $row;
 		}
		return $submenu;
	}  

	public function actLogout()
	{
		//Delete all session and redirect to form login
		$this->session->sess_destroy();  
		redirect(base_url('admin/login'),'refresh');
	} 

	public function create_password($pass)
	{
		$salt = random_string('alpha', 10);
		echo "Pass :".password_hash($pass.$salt, PASSWORD_BCRYPT,["cost" => 8])."<br>";
		echo "Salt :".$salt;
	}
}
