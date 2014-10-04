$(document).ready(function() {
	
	/* Initializing */
	
	var loginid = $.cookie('loginid');
	if (loginid) {
		$('#email').val(loginid);
		$('#remember').attr("checked", "checked");
	}
	
	
	/* Submit Form */
	
	$("#login #step1 form").submit(function() {
		if (!($(this).find("p.errormsg:visible").length > 0)) {
			var url = $(this).attr("action");
			var email = $("#email").val();
			var password = $("#password").val();
			var msgtype = $('#msgtype').val();
			var defvalue = $(this).find(".submit input:submit").val();
			$(this).find(".submit input:submit").val("Please wait...").attr("disabled", "disabled").delay(3000).queue(function() {
				$(this).removeAttr("disabled");
				$(this).val(defvalue);
				$(this).dequeue();
			});
			$(".submit .loading").show();
			
			if (url.indexOf('sendtoken') == -1) {
				$.post(url, {
					LOGIN: email,
					PASSWD: password
				}, function(data) {
					$(".submit .loading").hide();
					if (data.error == undefined) {
						if ($('#remember').attr('checked')) {
							var loginid = $('#email').val();
							$.cookie('loginid', loginid, { expires: 14, secure: true });
						} else {
							$.cookie('loginid', null);
						}
						if (url.indexOf('mw/') != -1) {
							location.replace("/v2/mw/dashboard/home");
						} else if (url.indexOf('aw/') != -1) {
							location.replace("/v2/aw/dashboard/home");
						} else {
							location.replace("/v2/mw/dashboard/home");
						}
					} else {
						$.wigialert(data.error.message);
					}
				});
			} else {
				$.post(url, {
					LOGIN: email,
					PASSWD: password,
					MSGTYPE: msgtype
				}, function(data) {
					$(".submit .loading").hide();
					if (data.error == undefined) {
						if ($('#remember').attr('checked')) {
							var loginid = $('#email').val();
							$.cookie('loginid', loginid, { expires: 14, secure: true });
						} else {
							$.cookie('loginid', null);
						}
						$("#step1").slideUp();
						$("#step2").slideDown(400, function() {
							$(document).delay(600000).queue(function() {
								$.wigialert("Your login session has timed out.");
								$("#step1").slideDown();
								$("#step2").slideUp();
							});
							$("#safepasscode").focus();
						});
					} else {
						if (data.error.message.indexOf("User ID does not exist") != -1) {
							$.wigialert("Invalid username or password.");
						} else {
							$.wigialert(data.error.message);
						}
					}
				});
			}
		}
		
		return false;
	});
	
	
	/* Confirmation Form */
	
	$("#login #step2 form").submit(function() {
		
		if (!($(this).find("p.errormsg:visible").length > 0)) {
			var url = $(this).attr("action");
			var email = $("#email").val();
			var password = $("#password").val();
			var code = $("#safepasscode").val();
			var defvalue = $(this).find(".confirm input:submit").val();
			$(this).find(".confirm input:submit").val("Please wait...").attr("disabled", "disabled").delay(3000).queue(function() {
				$(this).removeAttr("disabled");
				$(this).val(defvalue);
				$(this).dequeue();
			});
			$(".confirm .loading").show();
			
			$.post(url, {
				LOGIN: email,
				PASSWD: password,
				CODE: code
			}, function(data) {
				$(".confirm .loading").hide();
				if (data.error == undefined) {
					if (data.changepass == 0) {
						location.replace("/v2/cw/dashboard/home");
					} else {
						
					}
				} else {
					$.wigialert(data.error.message);
				}
			});
		}
		
		return false;
	});
	
	
	/* Confirmation Links */
	
	$("#step2 .return").click(function() {
		
		var defcolor = $(this).css("color");
		var defhref = $(this).attr("href");
		if (!$(this).hasClass("wait")) {
			$("#login #step1 form").trigger("submit");
			$.wigialert("A new Activation Code has been sent.");
		}
		$(this).css("color", "#ccc");
		$(this).addClass("wait").delay(10000).queue(function() {
			$(this).css("color", defcolor);
			$(this).removeClass("wait");
			$(this).dequeue();
		});
		
		return false;
		
	});
	
});
