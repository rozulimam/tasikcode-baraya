$(document).on('click','#btn_search',function(e){
	 alert("Fitur ini masih dalam pengembangan");
	 return false;
}); 

$(document).on('click','.btn-detail',function(e){ 
	var id = $(this).attr('data-id');
	$.ajax({
		method:"GET",
		cache:false,
		url:'home/detail/'+id
	})
	.done(function(view) {
		$('#loading').hide();

		$(".modal-title").html("Hai, salam kenal dari saya");
		$(".modal-body").html(view);
		$('#my-modal').modal('show'); 

	})
	.fail(function(res){
		console.log('Error Response !');
		console.log("responseText", res.responseText);
	});

	$(".modal-title").html("Hai, sala kenal dari saya");
	$('#my-modal').modal('show'); 
}); 