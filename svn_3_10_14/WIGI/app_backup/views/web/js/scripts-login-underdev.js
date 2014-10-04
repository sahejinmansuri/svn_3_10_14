$(document).ready(function() {
	
	/* Initializing */
	
	var loginid = $.cookie('loginid');
	if (loginid) {
		$('#email').val(loginid);
		$('#remember').attr("checked", "checked");
	}
	
	
	/* Submit Form */
	
	$(".loginstep").find("form").live("submit", function() {
		if (!($(this).find("p.errormsg:visible").length > 0)) {
			var form = $(this);
			var url = $(this).attr("action");
			// show waiting when sent
			var defvalue = form.find("input:submit").val();
			form.find("input:submit").val("Please wait...").attr("disabled", "disabled").delay(3000).queue(function() {
				$(this).removeAttr("disabled");
				$(this).val(defvalue);
				$(this).dequeue();
			});
			form.find(".loading").show();
			// send form
			var formdata = $(this).serializeArray();
			$.post(url, formdata, function(data) {
				// hide waiting
				form.find(".loading").hide();
				// show new content
				if (data.error != undefined) {
					$.wigialert(data.error);
				} else if (data.redirect != undefined) {
					
				} else {
					form.parents(".loginstep").each(function() {
						$(this).slideUp(400, function() {
							$(this).html(data);
							$(this).slideDown();
						});
					});
				}
			});
		}
		return false;
	});
	
});
