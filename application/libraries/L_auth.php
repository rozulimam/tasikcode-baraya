<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_auth {
 
	protected $CI;

	function __construct()
	{
		$this->CI = &get_instance();
	} 

	public function checkLogin()
	{ 
		$login = $this->CI->session->userdata('login_id_user');  
		if(!$login){
			redirect(base_url('admin/login'),'refresh');
		}
	} 

	public function checkLogout()
	{ 
		$login = $this->CI->session->userdata('login_id_user');  
		if($login){
			redirect(base_url('admin/dashboard'),'refresh');
		}
	} 

	public function checkAccess()
	{
		$allowList = $this->CI->session->userdata('login_access'); 
		$menu      = $this->CI->uri->segment('2');
		$sub_menu  = $this->CI->uri->segment('3');

		$getUrl    =  rtrim($menu."/".$sub_menu,"/"); 

		if(!in_array($getUrl, $allowList)){
			redirect(base_url('admin/dashboard'),'refresh');
		} 
	}
}