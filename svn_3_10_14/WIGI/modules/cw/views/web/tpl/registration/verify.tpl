{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Profile</li>
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
                <h1>Profile</h1>
            </div>
        </div>
		
		<div class="box_wide box_withsidebar box-info">	
		<div id="page">
            <p>Thank you! You have successfully verified your email.</p>
            <p>Your InCashMe Account is now completely Activated. You can now use the InCashMe Mobile App.</p>
            <p>Login to the Mobile App with your cell phone number and your PIN.</p>
            <p>You can also start using your Web based InCashMe Account.</p>
            <p>Login to the Web Account with the email address and Web password you entered.</p>
            <p>Once you Login to the Web account, review the lower tab: "How it Works", for more important information.</p>
			<p><a href="{$formbase}login/home">Click here to log in</a></p>
		</div>
		
	</div>
	
{include file='footer.tpl'}