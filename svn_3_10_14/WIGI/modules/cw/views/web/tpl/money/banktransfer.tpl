{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Add Funds</li>
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
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Add Funds</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info">	
		<div id="page">
				
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				<div class="setup addedfunds">
					
					<h4 class="widgettitle">Add money to your cell phone</h4>
					<div class="widgetcontent">
					
					{if $success=='success'}
						<p>Money has been added to your cell phone.</p>
						<p>Funds may take several days to appear in your Available Balance.</p>
					{else if $success=='already'}
						<p>Money has already been added to your cell phone.</p>
					{else}
						<p>Money has not been added to your cell phone.</p>
					{/if}
					
				</div></div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}