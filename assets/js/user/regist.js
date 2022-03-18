$(document).ready(function(){
    var url_ctrl = base_url + "home/"; 
    $(document).on('click','#save',function(e){  
        e.preventDefault();

		var	name		= $('#name').val();  
		var	email		= $('#email').val();  
		var	title		= $('#title').val();  
		var	skill		= $('#skill').val();  
		var	link_fb		= $('#link_fb').val();  
		var	link_in		= $('#link_in').val();  
		var	link_git    = $('#link_git').val();  
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val(); 

		swal({
		  title: 'Perhatian',
		  text: "Yakin akan mengirim data ini ?",
		  type: 'warning',
		  showCancelButton: true, 
		  confirmButtonText: 'Ya, Saya yakin!'
		}).then((result) => {
			  if (result.value) {
			  		$('#loading').show(); 

					$.ajax({ 
						url:url_ctrl+'insert_regist',
						method:"POST",
						cache:false,
						data : {  
                            name:name,
                            email:email,
                            title:title,
                            skill:skill,
                            link_fb:link_fb,
                            link_in:link_in,
                            link_git:link_git,
                            [csrfName]: csrfHash 

						}
					})
					.done(function(result) {
						$('#loading').hide(); 
						var obj = jQuery.parseJSON(result);
                        $('.txt_csrfname').val(obj.token);

						if(obj.status == 'failed'){  
							swal('Informasi', obj.message,'warning');
						}else if(obj.status == 'success'){ 
							swal('Good job!',obj.message,'success',function(){
                                location.reload();
                            }); 
						}else if(obj.status == 'warning'){ 
							swal('Informasi',obj.message,'warning');
						}
                          
					})
					.fail(function(res){
						console.log('Error Response !');
						console.log("responseText", res.responseText);
					});
			  }
		});
	}); 
}); 