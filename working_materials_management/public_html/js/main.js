function deletePost(id) {
	apprise('Soll der Eintrag wirklich gel&ouml;scht werden?', {'verify':true, 'textYes': 'Ja', 'textNo' : 'Nein'}, function(r) {
	    if(r) {
	    	$("#post_" + id).fadeOut();
	    	jQuery.ajax("index.php?action=delete&type=post&post=" + id);
	    } else {
	       
	    }
	});
}

function deleteComment(id) {
	apprise('Soll der Kommentar wirklich gel&ouml;scht werden?', {'verify':true, 'textYes': 'Ja', 'textNo' : 'Nein'}, function(r) {
	    if(r) {
	    	$("#comment_" + id).fadeOut();
	    	jQuery.ajax("index.php?action=delete&type=comment&comment=" + id);
	    } else {
	       
	    }
	});
}

function startOrderingPosts(){
	$("#order_edit").toggle();
	$("#order_submit").toggle();
	$(".post_comments").slideUp(1000);
	$("#sortable").sortable();
	$(".post").css('cursor','move')
}

function submitOrderForm(){
	var values = $(".order_input")

	for(var i = 0; i< values.length; i++ )
	{
	    var temp = "<input type='hidden' value='" + $(".order_input:eq("+i+")").attr("data-value") + "' name='post[]'>";
	    $("#order").append(temp);
	}
	 $("#order").submit();
}

function addLink() {
	
	$("[name='link[]']:last").after("<br><label></label> <input type='text' name='name[]' placeholder='Name'> <input type='text' name='link[]' placeholder='Adresse'>");
	
}

function deleteLink(id) {
	$.ajax({
	  url: 'index.php?action=delete_link&type=post&id='+id
	});
	$("#link_" + id).fadeOut();
}

function deleteFile(id) {
	$.ajax({
	  url: 'index.php?action=delete_file&type=post&id='+id
	});
	$("#file_" + id).fadeOut();
}

function deleteImage(id) {
	$.ajax({
	  url: 'index.php?action=delete_image&type=post&id='+id
	});
	$("#image_" + id).fadeOut();
}