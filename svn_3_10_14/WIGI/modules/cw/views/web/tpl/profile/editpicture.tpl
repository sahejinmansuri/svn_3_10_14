{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Edit Profile Picture</li>
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
                <h1>Edit Profile Picture</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar">	
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editcellphone formlayout subformlayout  box-info">
						<h4 class="widgettitle">Edit Profile Picture</h4>
						<div class="widgetcontent">
						<!--<h4>Edit Profile Picture</h4>-->
						
						<form action="{$formbase}profile/editpicture" method="post"  class="stdform" enctype="multipart/form-data">
							
							
								
								<p>
									<label>Profile Picture</label>
									<span class="field">
										<input type="file" class="formfield" name="picture" id="picture" />
									</span>
									<small class="desc">Upload new profile picture</small>
								</p>
										
								<!--<div class="prompt celldesc">
									<label for="celldesc">Profile Picture</label>
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" value="{$CELLDESC}" />
									<p class="tip">This will be the name you see for this cell phone</p>
								</div>-->
								
						
							
							<div class="submit stdformbutton">
								
								<input type="hidden" name="doaction" value="edit" />
								<a href="{$formbase}profile/home" class="btn btn-info">Cancel</a>
								<input type="submit" value="Update" class="btn btn-info" />
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellphone box-info">
						
						<h4 class="widgettitle">Edit Profile Picture</h4>
						<div class="widgetcontent">
						
						<p>Your profile picture has been updated.</p>
						<div class="submit stdformbutton">

								<a href="{$formbase}profile/home" class="btn btn-info">Back</a>
								
							</div>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}