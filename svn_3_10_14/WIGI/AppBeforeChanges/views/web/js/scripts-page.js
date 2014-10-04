$(document).ready(function() {
	
	/* Main Menu */
	
	$("#navigation > ul > li").hover(function() {
		$(this).children("ul").show();
		$(this).children("ul").find("li").hide().stop().slideDown("fast");
	}, function() {
		$(this).children("ul").hide();
	});
	
	/* Tabs */
	
	$(".tabfield").each(function() {
		var tabfield = $(this);
		var tabnavigation = $(this).children(".tabnavigation");
		var hash = window.location.hash;
		var truehash = false;
		if (tabnavigation.find("li.selected").length == 0) {
			if (hash != "") {
				$(this).children(".tabnavigation").find("ul li a").each(function() {
					if ($(this).attr("href").indexOf(hash) != -1) {
						$(this).parent().addClass("selected");
						tabfield.find("."+hash.substring(1)).show();
						truehash = true;
					}
				});
			}
			if (truehash == false) {
				tabnavigation.find("ul li:first").addClass("selected");
				$(this).children(".tab:first").show();
			}
			tabnavigation.find("ul li a").click(function() {
				if ($(this).parents("li.disabled").length > 0) {
					return false;
				} else {
					$(this).parent().siblings().removeClass("selected");
					$(this).parent().addClass("selected");
					var target = $(this).attr("href").substring(1);
					tabfield.find(".tab").hide();
					tabfield.find("."+target).show();
					if ($(this).attr("href").indexOf("http") == -1) {
						return false;
					}
				}
			});
		}
	});
	
	/* Disable Non-links */
	
	$("a[href='#']").click(function(event) {
		event.preventDefault();
	});
	
	/* Popup Alerts */
	
	$.wigialert = function(text, actions) {
		if ($(".popup").length > 0) {
			$(".popup").remove();
		}
		var message = '';
		message += '<div class="popup">';
		message += '<h4>InCashMe&trade;</h4>';
		message += '<p>' + text + '</p>';
		message += '<ul>';
		if (actions != undefined) {
			for (var b in actions) {
				message += '<li><a href="#" class="' + b + '" onclick="return false;">' + actions[b] + '</a></li>';
			}
		} else {
			message += '<li><a href="#" class="close">Okay</a></li>';
		}
		message += '</ul>';
		message += '</div>';
		$("#page").append(message);
		$(".popup").hide();
		$(".popup").lightbox_me({
			centered: true
		});
		$(".popup").find(".close").focus();
	}
	
	/* Check for Cookies */
	
	$.cookie('cookieCheck', 'enabled');
	var cookieCheck = $.cookie('cookieCheck');
	if (cookieCheck != 'enabled') {
		$.wigialert("Alert: Cookies have to be allowed to use InCashMe.");
	}
	
	/* Auto Suggest */
	
	var autosuggestions = {
		"text": "",
		"primary": "",
		"secondary": "",
		"data": ""
	};
	$.autosuggest = function(input, url, variable, saveid) {
		if (url != null && variable != null) {
			input.keyup(function() {
				var w = input.width();
				var h = input.height();
				var v = input.val();
				autosuggestions["primary"] = input;
				if (saveid != null) {
					autosuggestions["secondary"] = saveid;
				} else {
					autosuggestions["secondary"] = "";
				}
				if (v.length >= 3) {
					if (autosuggestions["text"] != v) {
						autosuggestions["text"] = input.val();
						var variables = {};
						variables[variable] = input.val();
						$.post(url, variables, function(data) {
							$(".autosuggest").remove();
							var suggestions = $.parseJSON(data);
							autosuggestions["data"] = suggestions;
							var suggbox = "";
							suggbox += "<div class=\"autosuggest\">";
							suggbox += "<ul>";
							for (s in suggestions) {
								suggbox += "<li>";
								suggbox += "<a href=\"#" + suggestions[s]["id"] + "\">";
								suggbox += suggestions[s]["name"];
								suggbox += "</a>";
								suggbox += "</li>";
							}
							suggbox += "</ul>";
							suggbox += "</div>";
							input.after(suggbox);
							$(".autosuggest").css({
								top: h + 25,
								left: 1,
								width: w + 10
							});
						});
					}
				} else {
					$(".autosuggest").remove();
				}
			});
			input.blur(function() {
				//$(".autosuggest").remove();
			});
		}
		return autosuggestions;
	}
	$(".autosuggest a").live("click", function() {
		var id = $(this).attr("href").substr(1);
		var text = $(this).text();
		if (autosuggestions["primary"] != "") {
			autosuggestions["primary"].val(text);
		}
		if (autosuggestions["secondary"] != "") {
			autosuggestions["secondary"].val(id);
			autosuggestions["secondary"].trigger("change");
		}
		$(".autosuggest").remove();
		return false;
	});
	
	/* AJAX Testing */
	
	var enableajax = false;
	if (enableajax) {
		$.getScript("/v2/js/scripts-ajax.js");
	}
	
});