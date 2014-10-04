{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#moneysources">Money sources</a> <span class="separator"></span></li>
		<li>Delete Money Source</li>
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
                <h1>Delete Money Source</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletemoneysource formlayout subformlayout">
						<h4 class="widgettitle">Delete money source</h4>
						<div class="widgetcontent" >
						<!--<h4>Delete money source</h4>-->
						
						<form action="{$formbase}profile/deletemoney" method="post">
							
							<div class="notes">
								<p>Are you sure you want to delete your money source?</p>
								<input type="hidden" name="ITEM" value="{$ITEM}" />
							</div>
							
							<div class="submit stdformbutton">
								
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" class="btn btn-info" />
								<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>-->
						</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedmoney">
						
						<h4 class="widgettitle">Delete money source</h4>
						<div class="widgetcontent" >
						
						<p>Your money source has been deleted.</p>
						<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>-->
						
					</div>						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}