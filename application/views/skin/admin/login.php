<!DOCTYPE html>
<html> 
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title> 
    <link href="<?=base_url('assets/plugins/bootstrap3/bootstrap.min.css');?>" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/all.css')?>">

    <link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/loading.css');?>" rel="stylesheet">
    <?php if(isset($css)){$this->l_skin->css_load($css);} ?>
</head>
<body class="gray-bg">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

    <?=$content;?> 
    <div id="loading"> 
         <img  src="<?php echo base_url('assets/img/loading.gif'); ?>">
         Loading
    </div>
    <script src="<?=base_url('assets/plugins/jquery/jquery-3.4.1.min.js');?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/js/alert.js');?>"></script>
    <script>
        var base_url = "<?=base_url();?>";
    </script>
    <?php if(isset($js)){$this->l_skin->js_load($js);} ?>
</body> 
</html>
