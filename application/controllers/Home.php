<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct(){
		parent::__construct(); 
		$this->load->model('m_home'); 
	}

	public function index()
	{
		$data['family'] = $this->card();  
		$data['gform']  = "https://forms.gle/EvtGoZHScckNUk9MA";  
		$data['desc']   = "Adalah kumpulan pemersatu dan tidak bercerai berai dikala menghadapi suatu perbedaan serta senang menjalin silaturahmi";  
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
}
