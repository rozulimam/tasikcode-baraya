$(document).ready(function(){

	var url_ctrl = base_url + "admin/users/"; 

	var table = $('#table').DataTable({
	    	"processing": true, 
			"serverSide": true, 
			"order": [],  
			"columnDefs":[{"orderable":false,"targets":[0,1,5]}],
			"ajax": {
				"url": url_ctrl+'data',
				"type": "POST"
			}
	});
	initCrope(); 

	$(document).on('click','.btnEdit',function(e){
		var id = $(this).attr('data-id');
		e.preventDefault();
		$.ajax({
			method:"POST",
			cache:false,
			url:url_ctrl+'edit',
			data:{ id:id }
		})
		.done(function(view) {
			$('#MyModalTitle').html('<b><i class="fa fa-user"></i> Ubah data pengguna</b>');
			$('div.modal-dialog').addClass('modal-lg');
			$("div#MyModalContent").html(view);
			$("div#MyModalFooter").html('<button class="btn btn-primary" id="update" data-id="'+id+'"><i class="fa fa-save"></i> Perbaharui</button>');
			$("div#MyModal").modal('show');
			initCrope();
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	}); 

	$(document).on('click','.btnReset',function(e){
		var id = $(this).attr('data-id');
		e.preventDefault();
		$.ajax({
			method:"POST",
			cache:false,
			url:url_ctrl+'reset',
			data:{ id:id }
		})
		.done(function(view) {
			$('#MyModalTitle').html('<b><i class="fa fa-user"></i> Ubah password</b>');
			$('div.modal-dialog').removeClass('modal-lg');
			$('div.modal-dialog').addClass('modal-sm');
			$("div#MyModalContent").html(view);
			$("div#MyModalFooter").html('<button class="btn btn-primary" id="reset" data-id="'+id+'"><i class="fa fa-save"></i> Perbaharui</button>');
			$("div#MyModal").modal('show'); 
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	}); 


	$(document).on('click','#btnDelete',function(e){
		e.preventDefault();
		var arr_id 	   = $("input[name='id[]']:checked").map(function(){return $(this).val();}).get(); 
		actDelete(arr_id);
	}); 
	$(document).on('click','.btnDelete',function(e){
		e.preventDefault();
		var id 	   = $(this).attr('data-id');	
		var arr_id = new Array(id); 
		actDelete(arr_id);
	}); 

	function actDelete(id){
		swal({
		  title: 'Perhatian',
		  text: "Data tidak bisa di kembalikan lagi, Yakin akan menghapus data ini ?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, Saya yakin!'
		}).then((result) => {
			  if (result.value) {
					$.ajax({
						method:"POST",
						cache:false,
						url:url_ctrl+'actDelete',
						data:{ id:id }
					})
					.done(function(result) {
						var obj = jQuery.parseJSON(result);
						if(obj.status == 'failed'){  
							swal('Oops...',obj.message,'danger');
						}else if(obj.status == 'success'){ 
							swal('Good job!',obj.message,'success');
							$("div#MyModal").modal('hide');
							table.ajax.reload();
						}  
					})
					.fail(function(res){
						alert('Error Response !');
						console.log("responseText", res.responseText);
					});
			  }
		}) 
	}

	$(document).on('click','#save',function(e){ 
		e.preventDefault();
		$.ajax({ 
			url:url_ctrl+'actSave',
			method:"POST",
			cache:false,
			data : {
				name	:$("#name").val(),
				email	:$("#email").val(),
				username:$("#username").val(),
				gender	:$("#gender").val(),
				id_level:$("#id_level").val(),
				access	:$("#access").val(),
				pass 	:$("#pass").val(),
				conf 	:$("#conf_pass").val(),
				avatar	:$("#avatar").attr('src'),
			}
		})
		.done(function(result) {
			var obj = jQuery.parseJSON(result);
			if(obj.status == 'failed'){   
				swal('Gagal',obj.message,'danger');
			}else if(obj.status == 'success'){ 
				swal('Good job!',obj.message,'success').then((value) => {
				  location.reload();
				});
				$("div#MyModal").modal('hide'); 
			}else if(obj.status == 'warning'){
				swal('Perhatian',obj.message,'warning');
			}  
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	}); 

	$(document).on('click','#update',function(e){ 
		e.preventDefault();
		$.ajax({ 
			url:url_ctrl+'actUpdate',
			method:"POST",
			cache:false,
			data : {
				id	    	 :$(this).attr('data-id'),
				name		 :$("#name").val(),
				email		 :$("#email").val(),
				username	 :$("#username").val(),
				gender		 :$("#gender").val(),
				id_level	 :$("#id_level").val(),
				access		 :$("#access").val(),
				avatar		 :$("#avatar").attr('src'),
				last_avatar  :$("#last_avatar").val(),
			}
		})
		.done(function(result) {
			var obj = jQuery.parseJSON(result);
			if(obj.status == 'failed'){   
				swal('Gagal',obj.message,'danger');
			}else if(obj.status == 'success'){ 
				swal('Good job!',obj.message,'success').then((value) => {
				  location.reload();
				});
				$("div#MyModal").modal('hide'); 
			}else if(obj.status == 'warning'){
				swal('Perhatian',obj.message,'warning');
			}  
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
		});
	}); 

	$(document).on('click','#reset',function(e){ 
		e.preventDefault();
		$.ajax({ 
			url:url_ctrl+'actPassword',
			method:"POST",
			cache:false,
			data : {
				id		:$(this).attr('data-id'), 
				pass 	:$("#pass").val(),
				conf 	:$("#conf_pass").val(),
			}
		})
		.done(function(result) { 
			var obj = jQuery.parseJSON(result);
			if(obj.status == 'failed'){   
				swal('Gagal',obj.message,'danger');
			}else if(obj.status == 'success'){ 
				swal('Good job!',obj.message,'success').then((value) => {
				  location.reload();
				});
				$("div#MyModal").modal('hide'); 
			}else if(obj.status == 'warning'){
				swal('Perhatian',obj.message,'warning');
			}  
		})
		.fail(function(res){
			alert('Error Response !');
			console.log("responseText", res.responseText);
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

function initCrope() {
	var $uploadCrop; 
	$uploadCrop = $('#crop_area').croppie({
		viewport: {
			width	:200,
			height	:200,
			type	:'bind'
		},
		enableExif: true
	}); 

	function readFile(input) {
			if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) { 
	        	$uploadCrop.croppie('bind', {
	        		url: e.target.result
	        	}).then(function(){

	        	}); 
	        	
	        } 
	        reader.readAsDataURL(input.files[0]);
	        $("#avatar_area").hide(); 
	        $("#upload").hide(); 
	        $("#avatar").hide(); 

	        $('#crop_area').show();
	        $('#btn_get').show();


	    }
	    else {
	        console.log("Sorry - you're browser doesn't support the FileReader API");
	    }
	}

	$('#upload').on('change', function () { readFile(this); });

	$('#btn_get').on('click', function (ev) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			$("#avatar").attr('src', resp); 
			$('#crop_area').hide();
	        $('#btn_get').hide();

	        $("#avatar").show(); 
	        $("#upload").show();  
		});
	});
}