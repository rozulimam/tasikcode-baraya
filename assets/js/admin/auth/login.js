$(document).ready(function(){

	var url_ctrl = base_url + "admin/auth/";

	$(document).on('click','#btnLogin',function(e){ 
		e.preventDefault();
		actLogin(); 
	}); 

	$('#username,#password').keypress(function(event){
    	var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){ 
	        actLogin();
	    }
	});

	function actLogin() {
		$('#loading').show();

		var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val(); 

		$.ajax({ 
			url:url_ctrl+'actLogin',
			method:"POST",
			cache:false,
			data : {
				username	:$("#username").val(),
				password	:$("#password").val(), 
				[csrfName]: csrfHash 
			}
		})
		.done(function(result) {
			$('#loading').hide();
			var obj = jQuery.parseJSON(result);
			$('.txt_csrfname').val(obj.token);
			
			if(obj.status == 'failed'){  
				notif('danger', obj.message);
			}else if(obj.status == 'success'){  
	        	notif('success', obj.message); 
				window.open(base_url + "admin/dashboard","_self");
			}else if(obj.status == 'warning'){ 
				notif('warning', obj.message);
			}  

		})
		.fail(function(res){ 
			$('#loading').hide();
			console.log('Error Response !');
			console.log("responseText", res.responseText);
		});
	}
});