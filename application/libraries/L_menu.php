<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class L_menu {
 
	protected $CI;

	function __construct()
	{
		$this->CI = &get_instance();
	}   

	public function getMenu()
	{
		$menu    = '';
        $submenu = '';
        $arrow   = ''; 
		$arrMenu = $this->CI->session->userdata('login_menu'); 

        foreach ($arrMenu as $d) {
            if(isset($d['submenu'])){
                $arrow   = '<span class="fa arrow"></span>';
                $submenu .= $this->getSubmenu($d['submenu']); 
            }

            $menu .= '<li>';
                    $menu.= '<a href="'.$d['link'].'">
                                <i class="'.$d['icon'].'"></i> 
                                <span class="nav-label">'.$d['menu'].'</span> 
                                '.$arrow.'
                            </a>'.$submenu;
            $menu.= '<li>';

            $submenu = '';
            $arrow   = '';
        } 
		return $menu;
	}

	public function getSubmenu($arrSubmenu)
	{ 
		$submenu = '<ul class="nav nav-second-level">';
		foreach ($arrSubmenu as $d) { 
              $submenu.= '<li><a href="'.$d['link'].'">'.$d['menu'].'</a></li>';  
        }
        $submenu.= '</ul>';
        return $submenu;
	} 
}