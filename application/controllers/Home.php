<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct(); 
		$this->load->model('m_home'); 
	}

	public function index()
	{ 
		$data['gform']  	= "https://forms.gle/EvtGoZHScckNUk9MA";

		$data['about']   	= "Adalah kumpulan pemersatu dan tidak bercerai berai dikala menghadapi suatu perbedaan serta senang menjalin silaturahmi";  


		$data['meta_desc']  = "Hallo coders semuanya, kami adalah para coder enthusiast yang berasal dari Tasikmalaya saat ini sedang mengumpulkan data keahlian para coder, engineer, database administrator, system administrator, IT enthusiast  yang berasal dari Tasikmalaya,  tujuan kami mengumpulkan ini untuk kebutuhan skill mapping untuk komunitas yang sedang kami rintis kembali yaitu TasikCode,  diharapkan dengan adanya data tersebut dapat terbuka kesempatan di masa depan untuk kita saling berkolaborasi satu sama lain, selain agar terjalin ikatan silaturahmi yang erat antar sesama barayaTasikmalaya.";

		
		$data['family'] 	= $this->card(); 
		$this->load->view('home',$data);
	}

	public function detail($id = null)
	{
		if(!$id) { return false; }
		$data['family'] = $this->card($id);  
		$this->load->view('detail',$data);
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
		$keyword = $this->input->post('keyword');
		$query = $this->m_home->searchMember($keyword);
		echo json_encode($query);
	}
}
