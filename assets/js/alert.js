function notif(status, message) { 
		var title = notif_title(status);
		$("#notif").html('');
		$("#notif").html("<div class='alert alert-"+status+"'>"+title+message+"</div>");
} 

function notif_icon(status){
	if(status == 'warning'){
		 return "<i class='fa fa-warning'></i>";
	}else if(status == 'danger'){
		 return "<i class='fa fa-times'></i>";
	}else if(status == 'info'){
		 return "<i class='fa fa-info'></i>";
	}else {
		return "<i class='fa fa-check'></i>";
	}
}

function notif_title(status){
	var icon  = notif_icon(status);
	if(status == 'warning'){
		title = "Warning!";
	}else if(status == 'danger'){
		title = "Danger!";
	}else if(status == 'info'){
		title = "Information";
	}else{
		title = "Success";
	}
	return "<h4 class='alert-heading'>"+icon+" "+title+"</h4><hr>";
}