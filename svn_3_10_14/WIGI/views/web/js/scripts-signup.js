$(document).ready(function() {
	
	/* Initializing */
	
	if ($("#errormsg").length <= 0) {
		$("#signup .prompt input").val(null);
	}
	
	
	/* Other Custom Fields */
	
	$("#signup .zip input").blur(function() {
		var url = "/v2/mobws/zip/getstatefromzip";
		var zip = $(this).val();
		if (zip.length == 5) {
			$.post(url, {
				ZIP: zip
			}, function(data) {
				if (data.result.status == "success") {
					var state = data.result.data;
					$("#signup .state select, #signup .state input").val(state).trigger("blur");
				} else {
					$("#signup .state select, #signup .state input").val("").trigger("blur");
				}
			});
		}
	});
	
	$("#signup .password input").keyup(function() {
		var passwd = $(this).val();
		var intScore = 0;
		if (passwd.match(/[a-z]/)) { intScore = (intScore+1) }
		if (passwd.match(/[A-Z]/)) { intScore = (intScore+5) }
		if (passwd.match(/\d+/)) { intScore = (intScore+5) }
		if (passwd.match(/(\d.*\d.*\d)/)) { intScore = (intScore+5) }
		if (passwd.match(/[!,@#$%^&*?_~]/)) { intScore = (intScore+5) }
		if (passwd.match(/([!,@#$%^&*?_~].*[!,@#$%^&*?_~])/)) { intScore = (intScore+5) }
		if (passwd.match(/[a-z]/) && passwd.match(/[A-Z]/)) { intScore = (intScore+2) }
		if (passwd.match(/\d/) && passwd.match(/\D/)) { intScore = (intScore+2) }
		if (passwd.match(/[a-z]/) && passwd.match(/[A-Z]/) && passwd.match(/\d/) && passwd.match(/[!,@#$%^&*?_~]/)) { intScore = (intScore+2) }
		var level = (100/32) * intScore * 1.02;
		level = level + "%";
		$(this).parent().find(".password_strength .level").stop().animate({ width: level }, 500);
	});
	
	
	/* Submit Button */
	
	$("#signup form").submit(function() {
		var birthdate = "";
		var birthm = $("#birth_month").val();
		if (birthm.length == 1) { birthm = "0"+birthm; }
		var birthd = $("#birth_day").val();
		if (birthd.length == 1) { birthd = "0"+birthd; }
		var birthy = $("#birth_year").val();
		
		birthdate = birthy+"-"+birthm+"-"+birthd;
		$("#birthdate").val(birthdate);
		
		if (!($(this).find("p.errormsg:visible").length > 0)) {
			return true;
		}
		
		return false;
	});
	
});
