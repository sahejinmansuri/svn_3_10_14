{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>How It Works</li>
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
                <h1>How It Works</h1>
            </div>
        </div>
		</div>
		
	<div class="box_wide box_withsidebar box-info">
		<div id="page">
			<div class="information">
				<h4 class="widgettitle">How InCashMe Works! </h4>
				<div class="widgetcontent" >
					{include file='how-it-works/home.tpl'}
				</div>
			</div>
		</div>
	</div>
	
{include file='footer.tpl'}