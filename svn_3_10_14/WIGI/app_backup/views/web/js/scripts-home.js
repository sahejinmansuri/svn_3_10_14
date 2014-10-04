$(document).ready(function() {
	
	$("#page .tools ul li").each(function() {
	
		var i = $(this).index() + 1;
		$(this).css({ height: '1px' });
		
		$(this).delay(i*70).animate({
			height: '105px'
		}, 1000, function() {
			
			$(this).find("a").hover(function() {
				
				$(this).parent().css({
					margin: '3px 35px 2px 3px',
					width: '99px',
					height: '99px',
					backgroundSize: '65px 65px'
				});
				$(this).css({
					padding: '81px 0 0',
					fontSize: '10px'
				});
				
			}, function() {
				
				$(this).parent().css({
					margin: '0 32px 0 0',
					height: '105px',
					width: '105px',
					backgroundSize: 'auto auto'
				});
				$(this).css({
					padding: '85px 0 2px',
					fontSize: 'inherit'
				});
				
			});
			
		});
		
	});
		
	/*$(".setup").each(function() {
		
		if ($(this).is(":visible") && !($(this).parents(".setup").length > 0)) {
			$(this).css({
				display: 'none'
			});
			$(this).fadeIn(500);
		}
		
	});*/
	
	$(".setup").each(function() {
		
		if ($(this).parents(".setup").length > 0) { return false; }
		
		$(this).find(".dtable .dbody .drow").each(function() {
			if ($(this).children(".dextend").length > 0) {
				$(this).hover(function() {
					$(this).addClass("drowsel");
				}, function() {
					$(this).removeClass("drowsel");
				});
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
		
	});
	
});
