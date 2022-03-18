$(document).ready(function(){
	var csrfName = $('.txt_csrfname').attr('name');
	var url_ctrl = base_url + "admin/family/"; 
	var table = $('#table').DataTable({
	    	"processing": true, 
			"serverSide": true, 
			"order": [],  
			"columnDefs":[
					{"orderable":false,"targets":[0,1]},
					{"className":"text-center","targets":[0,1,2]}
			],
			"ajax": {
				"url": url_ctrl+'data',
				"type": "POST",
				"data": function(d){ 
					d.tokenbaraya = $('.txt_csrfname').val();
				 },
				"dataSrc": function ( json ) {
					//Make your callback here.
					$('.txt_csrfname').val(json.token);
					console.log(json.token)
					return json.data;
				}       
			}
	});

	$(document).on('click','#btn_add',function(e){
		$('#loading').show();

		e.preventDefault();
		$.ajax({
			method:"GET",
			cache:false,
			url:url_ctrl+'add'
		})
		.done(function(view) {
			$('#loading').hide();

			$('div#MyModal').modal({backdrop: 'static', keyboard: false});
			$('#MyModalTitle').html('<b><i class="fa fa-dropbox"></i> Tambah data</b>');
			$('div.modal-dialog').addClass('modal-md');
			$("div#MyModalContent").html(view);
			$("div#MyModalFooter").html('<button class="btn btn-primary" id="save"><i class="fa fa-save"></i> Simpan</button>');
			$("div#MyModal").modal('show');

			get_province(); 
		})
		.fail(function(res){
			console.log('Error Response !');
			console.log("responseText", res.responseText);
		});
	}); 
    
    $(document).on('click','.btn_status',function(e){ 
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status'); 
		act_status(new Array(id),status); 
	});  

	$(document).on('click','#btn_lock',function(e){   
		var id = $("input[name='id[]']:checked").map(function(){return $(this).val();}).get();  
		var status = 0; 
		act_status(id,status); 
	});  

	$(document).on('click','#btn_unlock',function(e){ 
		var id = $("input[name='id[]']:checked").map(function(){return $(this).val();}).get();  
		var status = 1; 
		act_status(id,status); 
	});  

    function act_status(id,status){
		var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val(); 

		swal({
		  title: 'Perhatian',
		  text: "Yakin akan perbaharui status data ini ?",
		  type: 'warning',
		  showCancelButton: true, 
		  confirmButtonText: 'Ya, Saya yakin!'
		}).then((result) => {
			  if (result.value) {
		  		$('#loading').show();  
				$.ajax({ 
					url:url_ctrl+'act_update_status',
					method:"POST",
					cache:false,
					data : {
						id	: id,
						status	: status, 
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
						swal('Good job!',obj.message,'success'); 
						table.ajax.reload();
					}else if(obj.status == 'warning'){ 
						swal('Informasi',obj.message,'warning');
					}  

					hide_checklist();
				})
				.fail(function(res){
					console.log('Error Response !');
					console.log("responseText", res.responseText);
				});
			  }
		}); 
	} 


	$(document).on('click','.btn_edit',function(e){
		$('#loading').show();

		var id = $(this).attr('data-id');
		e.preventDefault();
		$.ajax({
			method:"GET",
			cache:false,
			url:url_ctrl+'edit',
			data:{ id:id }
		})
		.done(function(view) {
			$('#loading').hide();

			$('div#MyModal').modal({backdrop: 'static', keyboard: false});
			$('#MyModalTitle').html('<b><i class="fa fa-dropbox"></i> Perbaharui data</b>');
			$('div.modal-dialog').addClass('modal-md');
			$("div#MyModalContent").html(view);
			$("div#MyModalFooter").html('<button class="btn btn-primary" id="update"><i class="fa fa-save"></i> Perbaharui</button>');
			$("div#MyModal").modal('show');  
		})
		.fail(function(res){
			console.log('Error Response !');
			console.log("responseText", res.responseText);
		});
	});  

	$(document).on('click','#update',function(e){ 
		var id          = $('#id').val();
		var	name		= $('#name').val();  
		var	email		= $('#email').val();  
		var	title		= $('#title').val();  
		var	skill		= $('#skill').val();  
		var	link_fb		= $('#link_fb').val();  
		var	link_in		= $('#link_in').val();  
		var	link_git    = $('#link_git').val();  
		var	publish		= $('#publish').val();    
		var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val(); 
		
		swal({
		  title: 'Perhatian',
		  text: "Yakin akan perbaharui data ini ?",
		  type: 'warning',
		  showCancelButton: true, 
		  confirmButtonText: 'Ya, Saya yakin!'
		}).then((result) => {
			  if (result.value) {
			  		$('#loading').show(); 

					$.ajax({ 
						url:url_ctrl+'act_update',
						method:"POST",
						cache:false,
						data : { 
							id: id,
						    name:name,
                            email:email,
                            title:title,
                            skill:skill,
                            link_fb:link_fb,
                            link_in:link_in,
                            link_git:link_git,
                            publish:publish,
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
							swal('Good job!',obj.message,'success');
							$("div#MyModal").modal('hide');
							table.ajax.reload();
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


	$(document).on('click','#save',function(e){  
		var	name		= $('#name').val();  
		var	email		= $('#email').val();  
		var	title		= $('#title').val();  
		var	skill		= $('#skill').val();  
		var	link_fb		= $('#link_fb').val();  
		var	link_in		= $('#link_in').val();  
		var	link_git    = $('#link_git').val();  
		var	publish		= $('#publish').val();    
		var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val(); 

		swal({
		  title: 'Perhatian',
		  text: "Yakin akan simpan data ini ?",
		  type: 'warning',
		  showCancelButton: true, 
		  confirmButtonText: 'Ya, Saya yakin!'
		}).then((result) => {
			  if (result.value) {
			  		$('#loading').show(); 

					$.ajax({ 
						url:url_ctrl+'act_insert',
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
                            publish:publish,
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
							swal('Good job!',obj.message,'success');
							$("div#MyModal").modal('hide');
							table.ajax.reload();
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
 	 

	$(document).on('click','input.myCheckbox',function(){

		var val_check = $( "input.myCheckbox:checked" ).length;
		if ( val_check > 0 )
		    $('#menu_popup').removeClass( "hidden" ).addClass( "show" );
		else
		    $('#menu_popup').removeClass( "show" ).addClass( "hidden" );
	});

	$(document).on('click','input#AllCheck',function(){ 
		var val_allCheck = $( "input#AllCheck:checked" ).length;
		if(val_allCheck > 0)	
		{
		    $("input.myCheckbox").prop('checked', true);
		    var val_checked = $( "input.myCheckbox:checked" ).length;
			if(val_checked > 0){
				$('#menu_popup').removeClass( "hidden" ).addClass( "show" );
			}
		}
		else
		{
		    $('#menu_popup').removeClass( "show" ).addClass( "hidden" );
		    $("input.myCheckbox").prop('checked', false);
		}
	});

	function hide_checklist()
	{
		$("input[type='checkbox']").prop('checked', false); 
        $('#menu_popup').removeClass( "show" ).addClass( "hidden" );
	}  
 
}); 