<!DOCTYPE html>
<html>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel Admin | Dashboard</title>

    <link href="<?=base_url('assets/plugins/bootstrap3/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/all.css')?>">

    <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/loading.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/custom.css');?>" rel="stylesheet">
    <?php if(isset($css)){$this->l_skin->css_load($css);} ?>
</head>

<body>
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation"> 
            <?=$menu;?>
        </nav> 
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
                    <?=$header;?>
                </nav>
            </div>  
            <?=$content;?> 
            <div class="footer"> 
                <?=$footer;?>
            </div>
        </div> 
    </div>
     <?=$modal;?>
    <!-- Mainly scripts -->
    <script src="<?=base_url('assets/plugins/jquery/jquery-3.4.1.min.js');?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap3/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
    <script src="<?=base_url('assets/plugins/slimscroll/jquery.slimscroll.min.js');?>"></script>
 
    <!-- Peity -->
    <script src="<?=base_url('assets/plugins/peity/jquery.peity.min.js');?>"></script>
    <script src="<?=base_url('assets/js/peity-demo.js');?>"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?=base_url('assets/js/inspinia.js');?>"></script>
    <script src="<?=base_url('assets/js/alert.js');?>"></script>
    <script src="<?=base_url('assets/plugins/pace/pace.min.js');?>"></script> 
    <script src="<?=base_url('assets/plugins/sweetalert/sweetalert2.all.min.js');?>"></script>  
    <script>
        var base_url = "<?=base_url();?>";
    </script>
    <?php if(isset($js)){$this->l_skin->js_load($js);} ?>
</body> 
</html>
