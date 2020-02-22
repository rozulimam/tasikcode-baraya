$(document).ajaxStart(function(){
	$('.spinner').remove();
	$('.not-found').remove();
	$('.content').append(`<div class="spinner">
	<div class="bounce1"></div>
	<div class="bounce2"></div>
	<div class="bounce3"></div>
	</div>`);
	setTimeout(() => {
		$('.spinner').remove();
	},600);
});

function searchMember() {
	let keyword = $('#keyword').val();
	if(keyword != ''){
		$.ajax({
			url: 'home/search',
			type: 'post',
			data: {keyword : keyword},
			dataType: 'json',
			success: function(result) {
				$('.members').remove();
				if(result.length < 1) {
					$('.members').remove();
					$('#keyword').val('');
					$('main > div.py-5').css('min-height', '610px');
					setTimeout(() => {
						$('.content').append(`
						<p class="not-found ml-4"><em>Data tidak ditemukan</em></p>`);
					}, 600);
				} else {
					$('#keyword').val('');
					$('main > div.py-5').removeAttr('style');
					setTimeout(() => {
						$.each(result, function(i, data) {
							$('.content').append(`
							<div class="col-lg-3 col-md-6 col-sm-12 members">
								<div class="card mb-4 shadow-sm"> 
									<img class='bd-placeholder-img card-img-top' src="`+ data.link_img +`" onerror="this.src='asset/img/github-logo.png';"/>
									<div class="card-body"> 
										<p class="card-text">
											<center>
												<b>`+ data.name.toUpperCase()  +`</b><br>
												<small class='text-black-50'>`+ data.title +`</small>
											</center>
										</p>
										<div class="d-flex justify-content-between align-items-center"> 
											<button class="btn btn-sm btn-outline-secondary btn-block btn-detail" data-id="`+ data.id +`">Kenali lebih dekat</button>  
										</div>
									</div>
								</div>
							</div> 
							`);
						});
					}, 600);
				}
			}
		});
	} else {
		window.location.reload();
	}
}

$(document).on('click', '#btn_search', function() {
	searchMember(); 
});

$(document).on('keyup', '#keyword', function(e) {
	if(e.keyCode == 13) {
		searchMember();	
	}
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