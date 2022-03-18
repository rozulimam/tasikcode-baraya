<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct(); 
		$this->load->model('m_home'); 
		$this->load->library('form_validation');
	}

	public function index()
	{ 
		$total 				= $this->m_home->count_member();

		$data['js']    = array(  
			'assets/js/user/home.js'
		);  
		$data['gform']  	= "https://forms.gle/EvtGoZHScckNUk9MA"; 
		$data['about']   	= "Adalah kumpulan pemersatu dan tidak bercerai berai dikala menghadapi suatu perbedaan serta senang menjalin silaturahmi";  
		$data['meta_desc']  = "Hallo coders semuanya, kami adalah para coder enthusiast yang berasal dari Tasikmalaya saat ini sedang mengumpulkan data keahlian para coder, engineer, database administrator, system administrator, IT enthusiast  yang berasal dari Tasikmalaya,  tujuan kami mengumpulkan ini untuk kebutuhan skill mapping untuk komunitas yang sedang kami rintis kembali yaitu TasikCode,  diharapkan dengan adanya data tersebut dapat terbuka kesempatan di masa depan untuk kita saling berkolaborasi satu sama lain, selain agar terjalin ikatan silaturahmi yang erat antar sesama barayaTasikmalaya.";
		$data['message']    = "Hallo baraya semuanya 👋, terimakasih sudah mengunjungi halaman ini 🙏. saat ini sudah ada <b>".$total."</b> baraya tasikmalaya yang sudah berkenan untuk memperkenalkan diri, ayo sekarang giliran kamu untuk mengisi biodata ✍️ <a href='".base_url('register')."' target='_self'><b>Di sini</b></a>";
		
		
		$data['family'] 	= $this->card(); 
		$this->l_skin->user('user/home',$data);
	}

	function regist(){
		$data['about']   	= "Adalah kumpulan pemersatu dan tidak bercerai berai dikala menghadapi suatu perbedaan serta senang menjalin silaturahmi";  
		$data['meta_desc']  = "Hallo coders semuanya, kami adalah para coder enthusiast yang berasal dari Tasikmalaya saat ini sedang mengumpulkan data keahlian para coder, engineer, database administrator, system administrator, IT enthusiast  yang berasal dari Tasikmalaya,  tujuan kami mengumpulkan ini untuk kebutuhan skill mapping untuk komunitas yang sedang kami rintis kembali yaitu TasikCode,  diharapkan dengan adanya data tersebut dapat terbuka kesempatan di masa depan untuk kita saling berkolaborasi satu sama lain, selain agar terjalin ikatan silaturahmi yang erat antar sesama barayaTasikmalaya.";
		
		$this->load->helper('form');

		$data['js']    = array(  
			'assets/js/user/regist.js'
		);  
		$this->l_skin->user('user/regist',$data);
	}

	function insert_regist(){
 
		$this->form_validation->set_rules('name','Nama','required|trim');     
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');     
		$this->form_validation->set_rules('title','Bekerja Sebagai','required|trim');     
		$this->form_validation->set_rules('skill','Keahlian','required|trim');         
		
		$notif['token']   = $this->security->get_csrf_hash();
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
			'publish'	=> 0,     
			'dt_insert' => set_datetime(),  
		); 

		$this->db->insert('tbl_family', $data_family);
 
		$notif['message'] = "Terimakasih baraya, data berhasil dikirim";
		$notif['status']  = "success"; 
		

		echo json_encode($notif);
	}

	public function detail($id = null)
	{
		if(!$id) { return false; }
		$data['family'] = $this->card($id);  
		$this->load->view('user/detail',$data);
	}

	function card($id = null)
	{
		$data = $this->m_home->get_family($id); 
		$card = array();
		foreach ($data as $d) {
			$card[] = array(
					'id'    	=> $d->id, 
					'name'  	=> strtoupper($d->name), 
					'email' 	=> $d->email, 
					'title' 	=> $d->title, 
					'skill' 	=> $this->get_skill($d->skill), 
					'image' 	=> $d->link_git.'.png', 
					'link_git'  => $d->link_git,
					'link_fb'   => $d->link_fb,
					'link_in'   => $d->link_in,
			);
		}

		return $card;
	}

	public function get_skill($skill)
	{
		$skill     = explode(',', rtrim($skill, ',') );
		$all_skill = '';
		foreach ($skill as $d) {
			$all_skill .= "<span class='badge badge-secondary'>".strtoupper($d)."</span> ";
		}
		return $all_skill;
	} 
	
	public function search()
	{
		$keyword = $this->input->get('keyword');   
		echo json_encode($this->m_home->searchMember($keyword));
	}

	public function page()
	{ 
		$page   = $this->input->get('page');
		$offset = ($page - 1) * M_home::PERPAGE;
		echo json_encode(
			$this->m_home->get_family(null, $offset)
		);
	}
}
