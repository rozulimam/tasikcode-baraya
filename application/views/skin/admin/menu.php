<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" 
                     src="<?=get_avatar($this->session->userdata('login_avatar'));?>" width='48'/>
                     </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> 
                        <span class="block m-t-xs"> 
                            <strong class="font-bold"><?=$this->session->userdata('login_name')?></strong>
                        </span> 
                    <span class="text-muted text-xs block">
                        <?=$this->session->userdata('login_level')?></span> 
                    </span>
                </a> 
            </div>
            <div class="logo-element">
                NS+
            </div>
        </li> 
        <?php echo $this->l_menu->getMenu();?>
        
    </ul>

</div>