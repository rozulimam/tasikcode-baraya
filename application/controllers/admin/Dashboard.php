<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $dir_v = 'admin/dashboard';
	public $dir_m = 'admin';
	public $dir_l = 'admin';

	public function __construct(){
		parent::__construct();  
		$this->l_auth->checkLogin();

		$this->load->model($this->dir_m.'/m_dashboard'); 
	}

	public function index()
	{  
		$data['title']  = "Dashboard"; 
 
		$data['js']    = array(   
			'assets/js/admin/dashboard/view.js'
		);   
		$this->l_skin->admin($this->dir_v.'/view',$data);
	} 	 
} 