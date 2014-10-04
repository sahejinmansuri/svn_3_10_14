{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Messages</li>
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
                <h1>Messages</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar box-info">
		<div id="page">				
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletemessage formlayout subformlayout">
						
						{if $msgid == "all"}
							<h4 class="widgettitle">Delete messages</h4>
							<div class="widgetcontent" >
							<p>Are you sure you want to delete all your messages?</p>
						{else}
							<h4 class="widgettitle">Delete message</h4>
							<div class="widgetcontent" >
							<p>Are you sure you want to delete your message?</p>
						{/if}
						
						<form action="{$formbase}advanced/messagesdelete" method="post">
							
							<div class="submit">
								<input type="hidden" name="C" value="{$cellid}" />
								<input type="hidden" name="M" value="{$msgid}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" class="btn btn-info" />
								<a href="{$formbase}advanced/message"><input type="button" value="Back" class="btn btn-info" /></a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/message">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedmessage">
						
						{if $msgid == "all"}
							<h4 class="widgettitle">Delete messages</h4>
							<div class="widgetcontent" >
							<p>Your messages have been deleted.</p>
						{else}
							<h4 class="widgettitle">Delete message</h4>
							<div class="widgetcontent" >
							<p>Your message has been deleted.</p>
						{/if}
						<a href="{$formbase}advanced/message"><input type="button" value="Back" class="btn btn-info" /></a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/message">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}