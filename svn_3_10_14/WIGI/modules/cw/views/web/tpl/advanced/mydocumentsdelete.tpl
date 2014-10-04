{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>My Documents</li>
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
                <h1>My Documents</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar box-info">
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletedocument formlayout subformlayout">
						
						<h4  class="widgettitle">Delete document</h4>
						<div class="widgetcontent" >
						<p>Are you sure you want to delete your document?</p>
						
						<form action="{$formbase}advanced/mydocumentsdelete" method="post" class="stdform">
							
							<div class="submit">
								<input type="hidden" name="C" value="{$cellid}" />
								<input type="hidden" name="D" value="{$docid}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" class="btn btn-info" />
								<a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deleteddocument">
						
						<h4  class="widgettitle">Delete document</h4>
						<div class="widgetcontent" >
						
						<p>Your document has been deleted.</p>
						
						<a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}