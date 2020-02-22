$(document).on('click', '#btn_search', function(e) {
	e.preventDefault();
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
			} else {
				$.each(result, function(i, data) {
					$('.intro').after(`
					<div class="col-lg-3 col-md-6 col-sm-12 members">
						<div class="card mb-4 shadow-sm"> 
							<img class='bd-placeholder-img card-img-top' src="asset/img/`+ data.link_img +`.png" onerror="this.src='asset/img/github-logo.png';"/>
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
				}
	  		}
		});
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

var currentPage = 1,
bussy = false,
hasTouchTheLimit = false;

$(document).scroll(function(){
	var _this = $(this),
	delimiterHeight = $(document).height() - 10,
	pixelElapse = $(window).height() + _this.scrollTop();

	if(pixelElapse > delimiterHeight){
		if(hasTouchTheLimit == true || bussy == true){
			return;
		}

		bussy = true;
		currentPage++;
		$.ajax({
			url: 'home/page',
			type: 'post',
			data: {page : currentPage},
			dataType: 'json',
			success: function(result) {
				if(result.length < 1) {
					hasTouchTheLimit = true;
				} else {
					$.each(result, function(i, data) {
						$('.intro').parent().append(`
						<div class="col-lg-3 col-md-6 col-sm-12 members">
							<div class="card mb-4 shadow-sm"> 
								<img class='bd-placeholder-img card-img-top' src="`+ data.link_git +`.png" onerror="this.src='asset/img/github-logo.png';"/>
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
				}

				bussy = false;
			},
			error: function(err){
				console.log(err.statusText);
				currentPage--;
			}
		});
	}
});