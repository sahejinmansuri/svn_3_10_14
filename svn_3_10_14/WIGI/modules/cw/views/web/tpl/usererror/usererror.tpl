{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Error</li>
		{if $logged_in == 1}
		<li class="right">
			Last login: {$lastlogin}<br />IP address: {$lastip}
		</li>
		
		{/if}
	</ul>
	<div class="maincontent">
        <div class="maincontentinner">
			<div class="row">
				<div id="dashboard-left" class="col-md-12">
		
	
	<div class="box_wide box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			<h4 class="widgettitle">An error has occurred.</h4>
					<div class="widgetcontent"> 
			<!--<p>An error has occurred.</p>-->
			<p>{$message}</p>
			<p class="buttons_login">
				<a href="javascript:history.go(-1);" class="btn btn-info"><small>Back</small></a>
			</p>
			<!--<ul class="actionlinks">
				<li></li>
			</ul>-->
			
		</div>
		</div>
		
	</div>
	
{include file='footer.tpl'}
