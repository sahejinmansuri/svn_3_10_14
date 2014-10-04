function getpage(data, link) {
	if (data.error == undefined) {
		$("#page").html($("#page", data).html()).find(".setup").each(function() {
			// fade in fx
			if ($(this).is(":visible") && !($(this).parents(".setup").length > 0)) {
				$(this).css({
					display: 'none'
				});
				$(this).fadeIn(500);
			}
			// tabs
			$(".tabfield").each(function() {
				var tabfield = $(this);
				var tabnavigation = $(this).children(".tabnavigation");
				var hash = "";
				if (link.indexOf("#") != -1) {
					hash = link.split("#");
					hash = "#" + hash[1];
				}
				var truehash = false;
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
			});
			// tables
			if (!($(this).parents(".setup").length > 0)) {
				$(this).find(".dtable .dbody .drow").each(function() {
					$(this).hover(function() {
						$(this).addClass("drowsel");
					}, function() {
						$(this).removeClass("drowsel");
					});
					if ($(this).children(".dextend").length > 0) {
						$(this).children(".dnormal").css({ cursor: "pointer" }).click(function() {
							if ($(this).hasClass("dextended")) {
								$(this).removeClass("dextended");
							} else {
								$(this).addClass("dextended");
							}
							$(this).parent().siblings(".drow").find(".dnormal").removeClass("dextended");
							$(this).parent().siblings(".drow").find(".dextend").slideUp(400);
							$(this).parent().stop().animate({ opacity: 1.0 });
							$(this).parent().siblings(".drow").stop().animate({ opacity: 0.5 });
							$(this).siblings(".dextend").slideToggle(400, function() {
								if (! $(this).is(":visible")) {
									$(this).parent().siblings(".drow").stop().animate({ opacity: 1.0 });
								}
							});
							if ($(this).hasClass("dunread")) {
								var id = $(this).parents(".drow").attr("id");
								var markeddiv = $(this);
								var path = $(location).attr('href');
								var usertype = "cw";
								if (path.indexOf("/cw/") != -1) { usertype = "cw"; }
								if (path.indexOf("/mw/") != -1) { usertype = "mw"; }
								$.post(
									"/v2/" + usertype + "/history/setviewed",
									{ TID: id },
									function(data) {
										markeddiv.removeClass("dunread");
									}
								);
							}
						});
					}
				});
			}
		});
	} else {
		$.wigialert(data.error.message);
	}
}

$(".post").find("a:not(.tabnavigation a)").live("click", function() {
	var linkhref = $(this).attr("href");
	var linktarget = $(this).attr("target");
	if ($(this).parents("#sidebar").length > 0) {
		$(".current").removeClass("current");
		$(this).parents("li").addClass("current");
	}
	if (linktarget != "_blank") {
		$.post(linkhref, {}, function(data) {
			getpage(data, linkhref);
		});
		return false;
	}
});

$(".post").find("form").live("submit", function() {
	var action = $(this).attr("action");
	var fields = $(this).serialize();
	$.post(action, fields, function(data) {
		getpage(data, action);
	});
	return false;
});
