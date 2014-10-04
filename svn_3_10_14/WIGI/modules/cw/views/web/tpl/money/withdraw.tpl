{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Withdraw Funds</li>
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
                <h1>Withdraw Funds</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info ">	
		<div id="page">
				
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				<div class="setup withdrawn">
					
					<h4 class="widgettitle">Withdraw money from your cell phone</h4>
					<div class="widgetcontent">
					{if !isset($error)}
						<p>Money has been withdrawn from your cell phone.</p>
						<p>Funds may take several days to appear in your Bank Account.</p>
					{else}
						<p>Money has not been withdrawn from your cell phone.</p>
					{/if}
                            </div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}