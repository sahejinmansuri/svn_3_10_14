{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->	
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Advanced Features</i> <span class="separator"></span> <li>MoveFunds</i></li>
		
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
		<div class="pageheader">
			<div class="searchbar">{include file='dashboard/status.tpl'}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>MoveFunds</h1>
            </div>
        </div>	
		
		
	<div class="box_wide box_withsidebar">
		<div id="page">
				
		<!--	{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				
				
				<div class="setup movedfunds box-info">
					
					<h4 class="widgettitle">Move funds</h4>
					<div class="widgetcontent form-horizontal">
					{if !isset($error)}
						<p>Money has been moved to your default cell phone.</p>
					{else}
						<p>Money has not been moved to your default cell phone.</p>
					{/if}
					</div>
					<ul class="actionlinks">
						<li><a href="{$formbase}advanced/movefund"><input type="button" class="btn btn-info" value="Back"/></a></li>
					</ul>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}