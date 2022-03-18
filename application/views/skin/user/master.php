<!DOCTYPE html>
<html>
<head>
<title>Baraya Tasik Code</title>

<meta charset="utf-8">
<meta name="description" content="<?=$meta_desc?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/all.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/loading.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/all.css')?>">

<?php if(isset($css)){$this->l_skin->css_load($css);} ?>
</head>
<body>
<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
<?php echo $header ?> 
<?php echo $content ?>
<?php echo $footer ?> 
<?php echo $modal ?>




<script src="<?php echo base_url('assets/plugins/jquery/jquery-3.4.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/popper.min.js')?>"></script> 
<script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert2.all.min.js')?>"></script>  

<script>
    var base_url = "<?=base_url();?>";
</script>
<?php if(isset($js)){$this->l_skin->js_load($js);} ?>
</body>
</html> 