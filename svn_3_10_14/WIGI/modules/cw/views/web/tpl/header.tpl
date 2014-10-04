<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
{if $logged_in == 1}
<meta name="robots" content="noindex, nofollow">
{/if}
<title>InCashMe&#8482; - Consumer Web Access</title>
<!--<link rel="shortcut icon" type="image/x-icon" href="/templates/rt_affinity_j15/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-page.css" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-forms.css" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/utility-icons.css" />-->



<!--new theme-->
<link rel="stylesheet" href="{$csspath}/responsive-tables.css">
    
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{$jspath}/html5shiv.js"></script>
<script src="{$jspath}/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="{$csspath}/style.default.css" type="text/css" />

<link rel="stylesheet" href="{$jspath}/prettify/prettify.css" type="text/css" />
<!--<link rel="stylesheet" href="{$csspath}/welcome/style.css" type="text/css" />-->

<script src="{$jspath}/jquery-1.10.2.min.js"></script>
<script src="{$jspath}/jquery-migrate-1.2.1.min.js"></script>
<script src="{$jspath}/jquery-ui-1.10.3.min.js"></script>

<script src="{$jspath}/bootstrap.min.js"></script>

<script src="{$jspath}/modernizr.min.js"></script>
<script src="{$jspath}/jquery.cookies.js"></script>
<script src="{$jspath}/jquery.uniform.min.js"></script>
<script src="{$jspath}/flot/jquery.flot.min.js"></script>
<script src="{$jspath}/flot/jquery.flot.resize.min.js"></script>
<script src="{$jspath}/prettify/prettify.js"></script>
<!--<script src="{$jspath}/responsive-tables.js"></script>-->
<script type="text/javascript" >
	jQuery.noConflict();
</script>
<script src="{$jspath}/elements.js"></script>


<script src="{$jspath}/jquery.slimscroll.js"></script>

<script src="{$jspath}/custom.js"></script>

<script src="{$jspath}/jquery.jgrowl.js"></script>
<script src="{$jspath}/jquery.alerts.js"></script>

<!--[if lte IE 8]>
<script src="{$jspath}/excanvas.min.js"></script>
<![endif]-->
<!-- /new theme-->


<script type="text/javascript" src="{$jspath}/jquery.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery.watermark.min.js"></script>
<script type="text/javascript" src="{$jspath}/jquery.cookie.js"></script>
<script tyoe="text/javascript" src="{$jspath}/jquery.lightbox_me.js"></script>
<script tyoe="text/javascript" src="{$jspath}/jquery.ocupload-1.1.2.packed.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-page.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-forms.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-login.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-signup.js"></script>
{if $logged_in == 1}
<script type="text/javascript" src="{$jspath}/scripts-home.js"></script>
{/if}
</head>
<body>

{literal}
<div id="fb-root"></div>
<script type="text/javascript">
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
{/literal}

<div id="mainwrapper" class="mainwrapper">
    
    <div class="header">
        <div class="logo">
            <a href="{$formbase}dashboard/home"><img src="/v2/m/cw/css/images/logo.png" alt=""  width="220" height="auto" /></a>
        </div>
        <div class="headerinner">
		{if $logged_in == 1}
            <ul class="headmenu">
                <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="count">{$message_count}</span>
                        <span class="head-icon head-message"></span>
                        <span class="headmenu-label">Messages</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Messages</li>
						{if $all_message_count == 0}
							<li><a href="#">You have no messages in your Inbox</a></li>
						{else}
							{if all_message_count > 5}
								{assign var="i" value="1"}
								{foreach from=$messages key=k item=v}
									{if i <= 5}
										<li><a href="{$formbase}advanced/messages/ITEM/{$mobile_id}#messages"><span class="icon-envelope"></span>{$v.subject}</a></li>
									{/if}
									{assign var=i value=$i+1}
								{/foreach}
								<li class="viewmore"><a href="{$formbase}advanced/messages/ITEM/{$mobile_id}#messages">View More Messages</a></li>
							{else}
								{foreach from=$messages key=k item=v}
									<li><a href="{$formbase}advanced/messages/ITEM/{$mobile_id}#messages"><span class="icon-envelope"></span>{$v.subject}</a></li>
								{/foreach}
							{/if}
						
                        <!--<li><a href=""><span class="glyphicon glyphicon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-envelope"></span> New message from <strong>Jane</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-envelope"></span> New message from <strong>Tanya</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-envelope"></span> New message from <strong>Lee</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="messages.html">View More Messages</a></li>-->
						{/if}
                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                    <span class="count">{$all_cellphone_count}</span>
                    <span class="head-icon head-users"></span>
                    <span class="headmenu-label">New Users</span>
                    </a>
                    <ul class="dropdown-menu newusers">
                        <li class="nav-header">New Users</li>
						{foreach from=$all_cellphones key=k item=v}
							<li>
								<a href="{$formbase}profile/home#cellphones">
									<img src="{$baseurl}/u/profile/{$profile_image}" alt="" class="userthumb" height="35" />
									<strong>{$v.alias}</strong>
									<small>{$v.cellphone}</small>
								</a>
							</li>
						{/foreach}
                        
                    </ul>
                </li>
                <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                    <span class="count">{$documents_count}</span>
                    <span class="head-icon head-bar"></span>
                    <span class="headmenu-label">Documents</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Documents</li>
						{foreach from=$documents key=k item=v}
							<li><a href="{$formbase}advanced/documents"><span class="glyphicon glyphicon-align-left"></span> {$v.description} <strong>{$v.type}</strong> </a></li>
						{/foreach}
                        <!--<li><a href=""><span class="glyphicon glyphicon-align-left"></span> New Reports from <strong>Products</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-align-left"></span> New Statistics from <strong>Users</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-align-left"></span> New Statistics from <strong>Comments</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-align-left"></span> Most Popular in <strong>Products</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href=""><span class="glyphicon glyphicon-align-left"></span> Most Viewed in <strong>Blog</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="charts.html">View More Statistics</a></li>-->
                    </ul>
                </li>
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="{$baseurl}/u/profile/{$profile_image}" alt="" height="86" />
                        <div class="userinfo">
                            <h5>{$user_name} <small title="{$email_full}">- {$email_display}</small></h5>
                            <ul>
                                <li><a href="{$formbase}profile/home">Profile</a></li>
                                <li><a href="{$formbase}profile/account">Account Settings</a></li>
                                <li><a href="{$formbase}index/logout">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
		{/if}
        </div>
    </div>
    

<script type="text/javascript">
    /*jQuery(document).ready(function() {
        
      // simple chart
		var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace"),
			   [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });*/
</script>
