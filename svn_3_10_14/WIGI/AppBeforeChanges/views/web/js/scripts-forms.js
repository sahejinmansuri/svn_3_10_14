$(document).ready(function() {
	
	/* Initializing */
	
	$("form .prompt input, form .prompt select").hover(function() {
		$(this).addClass("hover");
	}, function() {
		$(this).removeClass("hover");
	});
	$("form .prompt input, form .prompt select").focus(function() {
		$(this).addClass("focus");
	});
	$("form .prompt input, form .prompt select").blur(function() {
		$(this).removeClass("focus");
	});
	
	/* Current fix to remove old balloons */
	
	$("form .prompt p").each(function() {
		if (!$(this).is(".tip")) {
			$(this).remove();
		}
	});
	
	/* Field Settings */
	
	// req, min, max, types
	var fields = {
		"email": [true, -1, -1, ["email"], "name@domain.com"],
		"password": [true, -1, -1, null],
		"adminusername": [true, -1, -1, null],
		
		"safepasscode": [true, 6, 6, null],
		
		"advpassword": [true, 8, -1, ["password"]],
		"pin": [true, 7, 7, ["pin"]],
		"firstname": [true, 3, -1, null],
		"lastname": [true, 3, -1, null],
		"birthdate#birth_year": [true, -1, -1, ["birthdate"]],
		"zip": [true, 5, -1, null],
		"address": [true, 3, -1, null],
		"city": [true, -1, -1, null],
		"state": [true, -1, -1, null],
		
		"contactfirstname": [true, 3, -1, null],
		"contactlastname": [true, 3, -1, null],
		"businessname": [true, -1, -1, null],
		"businesstype": [true, -1, -1, null],
		"businesstaxid": [true, 4, -1, null],
		"businessssn": [true, 4, -1, null],
		"businessphone#businessphone": [true, 10, 10, ["cellphone"], "5556667777"],
		"businessregistrationnumber": [true, -1, -1, null],
		"businessstateofinc": [true, -1, -1, null],
		"businessurl": [false, 4, -1, null, "domain.com"],
		
		"altemail": [false, -1, -1, ["email"], "name@domain.com"],
		"altphone#altphone": [false, 10, 10, ["cellphone"]],
		
		"amount": [true, -1, -1, ["nonzero", "maxamount", "positive"]],
		"account_list": [true, -1, -1, null],
		"cellphone_list": [true, -1, -1, null],
		
		"carddesc": [true, 3, -1, null],
		"cardnumber": [true, -1, -1, ["creditcard"]],
		"cardholdername": [true, 3, -1, null],
		"cvv2": [true, 3, 4, null],
		"cardexpiration#cardexpiration_year": [true, -1, -1, ["expiration"]],
		
		"bankaccount": [true, 3, 17, null],
		"bankroute": [true, 9, 9, ["routing"]],
		"driverslicensenumber": [true, -1, -1, null],
		"driverslicensestate": [true, -1, -1, null],
		
		"cellphone#cellphone": [true, 10, 10, ["cellphone"], "5556667777"],
		"question": [true, -1, -1, null],
		"answer": [true, 3, 15, null],
		
		"posdesc": [true, -1, -1, null],
		"possecret": [false, 8, 16, null],
		
		"username": [true, 8, 16, null],
		
		"reasonconsumer": [true, -1, -1, null],
		"reasonmerchant": [true, -1, -1, null],
		
		"minbalance": [true, -1, -1, null]
	};
	
	/* Set watermarks */
	
	$("input, select").each(function() {
		for (f in fields) {
			var inputid = false;
			var inputf = false;
			if (f.indexOf("#") != -1) {
				var checkoptions = f.split("#");
				inputf = checkoptions[0];
				inputid = checkoptions[1];
			}
			if (fields[f][4] != undefined && fields[f][4] != null) {
				if (!inputid) {
					if ($(this).parents(".prompt").is("."+f)) {
						$(this).watermark(fields[f][4]);
					}
				} else {
					if ($(this).parents(".prompt").is("."+inputf)) {
						$(this).parents(".prompt").find("#" + inputid).watermark(fields[f][4]);
					}
				}
			}
		}
	});
	
	/* Check fields */
	
	function checkFields(prompt) {
		for (f in fields) {
			var inputid = false;
			if (f.indexOf("#") != -1) {
				var checkoptions = f.split("#");
				f = checkoptions[0];
				inputid = checkoptions[1];
			}
			if (prompt.is("."+f)) {
				
				if (!inputid) {
					var inputs = prompt.find("input, select");
				} else {
					var inputs = prompt.find("input[id='"+inputid+"'], select[id='"+inputid+"']");
					f = f + "#" + inputid;
				}
				prompt.find("p.errormsg, p.valid").fadeOut(400, function() {
					$(this).remove();
				});
				inputs.removeClass("error");
				
				// required field
				if (fields[f][0] == true) {
					if (inputs.val() == "") {
						prompt.append("<p class='errormsg'>This field is required</p>");
						prompt.find("p.errormsg").fadeIn();
						inputs.addClass("error");
						return false;
					}
				} else {
					if (inputs.val().length == 0) {
						prompt.append("<p class='valid'>This field is valid</p>");
						prompt.find("p.valid").fadeIn();
						return true;
					}
				}
				
				// minimum length
				if (fields[f][1] > 0) {
					if (inputs.val().length < fields[f][1]) {
						prompt.append("<p class='errormsg'>This field has to be at least " + fields[f][1] + " characters long</p>");
						prompt.find("p.errormsg").fadeIn();
						inputs.addClass("error");
						return false;
					}
				}
				
				// maximum length
				if (fields[f][2] > 0) {
					if (inputs.val().length > fields[f][2]) {
						prompt.append("<p class='errormsg'>This field has to be no longer than " + fields[f][2] + " characters</p>");
						prompt.find("p.errormsg").fadeIn();
						inputs.addClass("error");
						return false;
					}
				}
				
				// other validations
				if (fields[f][3] != undefined && fields[f][3] != null) {
					var check = fields[f][3].join(",");
					var valid = true;
					// email
					if (check.indexOf("email") != -1) {
						var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						if (!filter.test(inputs.val())) {
							valid = false;
						}
						if (prompt.hasClass("checkexisting") && valid == true) {
							var checkemailurl = "/v2/mobws/registration/checkloginid";
							$.post(checkemailurl, {
								LOGINID: inputs.val()
							}, function(data) {
								if (data.result.status != "success") {
									prompt.find("p.errormsg, p.valid").fadeOut(400, function() {
										$(this).remove();
									});
									inputs.removeClass("error");
									prompt.append("<p class='errormsg'>This email has already been registered</p>");
									prompt.find("p.errormsg").fadeIn();
									inputs.addClass("error");
									return false;
								}
							});
						}
					}
					// password
					if (check.indexOf("password") != -1) {
						if (prompt.find(".password_strength").length > 0) {
							var m = prompt.find(".password_strength").width();
							var w = prompt.find(".password_strength").find(".level").width();
							var strength = (w/m*100);
							if (strength < 50) {
								valid = "Your password is not strong enough";
							}
						}
						if ($(".email input").length > 0) {
							if ($(".email input").val().length > 5) {
								if (inputs.val().indexOf($(".email input").val()) != -1) {
									valid = false;
								}
							}
						}
						if (inputs.val().indexOf(" ") != -1) {
							valid = false;
						}
					}
					// cellphone
					if (check.indexOf("cellphone") != -1) {
						if (prompt.hasClass("checkexisting") && valid == true) {
							var checkemailurl = "/v2/mobws/registration/checkcellphone";
							if (prompt.find("#countrycode").length > 0) {
								var getcountrycode = prompt.find("#countrycode").val();
								$.post(checkemailurl, {
									COUNTRY: getcountrycode,
									CELLPHONE: inputs.val()
								}, function(data) {
									if (data.result.status != "success") {
										prompt.find("p.errormsg, p.valid").fadeOut(400, function() {
											$(this).remove();
										});
										inputs.removeClass("error");
										prompt.append("<p class='errormsg'>This cell phone number has already been registered</p>");
										prompt.find("p.errormsg").fadeIn();
										inputs.addClass("error");
										return false;
									}
								});
							}
						}
					}
					// pin
					if (check.indexOf("pin") != -1) {
						var filter = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
						if (!filter.test(inputs.val())) {
							valid = false;
						}
						if (inputs.val() == "0000000" || inputs.val() == "1234567" || inputs.val() == "7654321") {
							valid = false;
						}
					}
					// birthdate
					if (check.indexOf("birthdate") != -1) {
						var d = new Date();
						var year = parseInt(inputs.val());
						if (year == (d.getFullYear()-18)) {
							var emonth = inputs.siblings("#birth_month");
							if (emonth.length > 0) {
								var month = parseInt(emonth.val());
								if (month == (d.getMonth()+1)) {
									var eday = inputs.siblings("#birth_day");
									if (eday.length > 0) {
										var day = parseInt(eday.val());
										if (day > (d.getDate())) {
											valid = false;
										}
									}
								} else {
									if (month > (d.getMonth()+1)) {
										valid = false;
									}
								}
							}
						} else {
							if (year > (d.getFullYear()-18)) {
								valid = false;
							}
						}
					}
					// creditcard
					if (check.indexOf("creditcard") != -1) {
						if (16 < inputs.val().length || inputs.val().length < 13) {
							valid = false;
						}
						var first2 = parseFloat(inputs.val().substr(0, 2));
						var first1 = parseFloat(inputs.val().substr(0, 1));
						if (first2 != 34 && first2 != 37 && 51 <= first2 && first2 <= 55 && first1 != 4) {
						//	valid = false;
						}
						var i, n, c, r, t;
						s = inputs.val();
						r = "";
						for (i = 0; i < s.length; i++) {
							c = parseInt(s.charAt(i), 10);
							if (c >= 0 && c <= 9) {
								r = c + r;
							}
						}
						if (r.length <= 1) {
							valid = false;
						}
						t = "";
						for (i = 0; i < r.length; i++) {
							c = parseInt(r.charAt(i), 10);
							if (i % 2 != 0) {
								c *= 2;
							}
							t = t + c;
						}
						n = 0;
						for (i = 0; i < t.length; i++) {
							c = parseInt(t.charAt(i), 10);
							n = n + c;
						}
						if (n == 0 || n % 10 != 0) {
							valid = false;
						}
						if (s == "4111111111111111") {
							valid = true;
						}
					}
					// expiration
					if (check.indexOf("expiration") != -1) {
						var d = new Date();
						var year = (2000 + parseInt(inputs.val()));
						if (year == d.getFullYear()) {
							var emonth = inputs.siblings("#cardexpiration_month");
							if (emonth.length > 0) {
								var month = parseInt(emonth.val());
								if (month <= (d.getMonth()+1)) {
									valid = false;
								}
							}
						} else {
							if (year < d.getFullYear()) {
								valid = false;
							}
						}
					}
					// routing number
					if (check.indexOf("routing") != -1) {
						var n = 0;
						for (i = 0; i < inputs.val().length; i += 3) {
							n += parseInt(inputs.val().charAt(i), 10) * 3
								+  parseInt(inputs.val().charAt(i + 1), 10) * 7
								+  parseInt(inputs.val().charAt(i + 2), 10);
						}
						if (n == 0 || n % 10 != 0) {
							valid = false;
						}
					}
					// nonzero
					if (check.indexOf("nonzero") != -1) {
						if (!(parseFloat(inputs.val()) > 0)) {
							valid = false;
						}
					}
					// positive
					if (check.indexOf("positive") != -1) {
						if (parseFloat(inputs.val()) < 0) {
							valid = false;
						}
					}
					// maxamount
					if (check.indexOf("maxamount") != -1) {
						if (parseFloat(inputs.val()) > 9999) {
							valid = false;
						}
					}
					// !error
					if (valid != true) {
						if (valid == false) {
							prompt.append("<p class='errormsg'>This seems to be invalid</p>");
						} else {
							prompt.append("<p class='errormsg'>" + valid + "</p>");
						}
						prompt.find("p.errormsg").fadeIn();
						inputs.addClass("error");
						return false;
					}
				}
				// !all good
				prompt.append("<p class='valid'>This field is valid</p>");
				prompt.find("p.valid").fadeIn();
			}
		}
		// check confirmation fields
		var checkconfirms = true;
		var checkform = prompt.parents("form");
		checkform.find("input[id$='_confirm']").each(function() {
			var confirmf = $(this);
			var watchf = $(this).attr("id").replace("_confirm", "");
			checkform.find("input[id="+watchf+"]").each(function() {
				var cprompt = confirmf.parents(".prompt");
				cprompt.find("p.errormsg, p.valid").fadeOut(400, function() {
					$(this).remove();
				});
				confirmf.removeClass("error");
				if ($(this).val() == confirmf.val()) {
					//cprompt.append("<p class='valid'>This field is valid</p>");
					//cprompt.find("p.valid").fadeIn();
				} else {
					cprompt.append("<p class='errormsg'>This seems to not match</p>");
					cprompt.find("p.errormsg").fadeIn();
					confirmf.addClass("error");
					checkconfirms = false;
				}
			});
		});
		return checkconfirms;
	}
	
	/* Other Custom Fields */
	
	function checkKeys(e, type) {
		var tests = [];
		var key = e.charCode || e.keyCode || 0;
		var shift = e.shiftKey;
		tests["number"] = (shift !== true && (key == 8 || key == 9 || key == 13 || key == 16 || key == 46 || (33 <= key && key <= 40) || (48 <= key && key <= 57) || (key >= 96 && key <= 105)));
		tests["money"] = (shift !== true && (key == 8 || key == 9 || key == 13 || key == 16 || key == 46 || (33 <= key && key <= 40) || (48 <= key && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190));
		tests["phone"] = (shift !== true && (key == 8 || key == 9 || key == 13 || key == 16 || key == 46 || (33 <= key && key <= 40) || (48 <= key && key <= 57) || (key >= 96 && key <= 105)));
		return tests[type];
	}
	
	function checkAmount(amount) {
		var naa = amount.split('.');
		if (naa[1].length > 2) {
			var f = parseFloat(amount);
			return f.toFixed(2);
		}
		return false;
	}
	
	$("form .password_strength").each(function() {
		var meter = $(this);
		$(this).parents(".prompt").find("input").keyup(function() {
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
			meter.find(".level").stop().animate({ width: level }, 500);
		});
	});
	
	$("form .amount input, form .confirmamount input, form .minbalance input, form .salestax input, form .tips input").keydown(function(e) {
		return checkKeys(e, "money");
	}).keyup(function() {
		var amount = checkAmount($(this).val());
		if (amount !== false) {
			$(this).val(amount);
		}
	});
	
	$("form .cellphone input, form .phone input").keydown(function(e) {
		return checkKeys(e, "phone"); 
	});
	
	$("form .zip input, form .pin input, form .pin_confirm input").keydown(function(e) {
		return checkKeys(e, "number");
	});
	
	$("form .businessregistrationnumber input, form .businesstaxid input").keydown(function(e) {
		return checkKeys(e, "number");
	});
	
	$("form .bankaccount input, form .bankroute input, form .cvv2 input").keydown(function(e) {
		return checkKeys(e, "number");
	});
	
	$("form .cardnumber input").keydown(function(e) {
		return checkKeys(e, "number");
	});
	
	$("form .username input").live("keyup", function() {
		$(this).val($(this).val().replace(/[^A-Za-z0-9-_]/g, ''));
	});
		
	$("form .filter .amount").keydown(function(e) {
		return checkKeys(e, "money");
	});
	
	/* On Blur */
	
	$("form").each(function() {
		$(this).find(".prompt").find("input, select").blur(function() {
			checkFields($(this).parents(".prompt"));
		});
	});
	
	/* On Submit */
	
	$("form").submit(function() {
		var validated = true;
		$(this).find(".prompt:visible").each(function() {
			if (checkFields($(this)) == false) {
				validated = false;
			}
		});
		if (!validated) {
			if ($(".errormsg").length > 0) {
				var errorpos = $(".errormsg:first").offset().top;
				var winpos = $(window).scrollTop();
				var winh = $(window).height();
				if (errorpos < winpos || (winpos+winh) < errorpos) {
					$('html, body').stop().animate({
						scrollTop: errorpos - 20
					}, 2000);
				}
			}
		}
		if (!($(this).find(".nosubmit").length > 0)) {
			return validated;
		}
	});
	
});
