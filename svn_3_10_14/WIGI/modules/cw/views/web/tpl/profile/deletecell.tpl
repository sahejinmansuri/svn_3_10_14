{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Delete Cellphone</li>
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
                <h1>Delete Cellphone</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletecellphone formlayout subformlayout">
						
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Are you sure you want to delete your cell phone? This will erase all references to this cell phone from the website, and you will not be able to log in with this number from your cell phone. To delete a cell phone, you have to withdraw all funds from it, and can't have any pending transactions.</p>
						
						<form action="{$formbase}profile/deletecell" method="post"  class="stdform">
							
							<div class="">
								
								<p>
									<label>PIN </label>
									<span class="field">
										<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									</span>
									<small class="desc">Please enter your PIN number for this cell phone</small>
								</p>
								<p>
									<label>Password </label>
									<span class="field">
										<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									</span>
									<small class="desc">Please enter your password</small>
								</p>
								
								<!--<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your password</p>
								</div>-->
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedcellphone">
						
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone has been deleted.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error1"}
					
					<div class="setup deletedcellphone">
						
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Please make sure you entered your PIN and password correctly.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error2"}
					
					<div class="setup deletedcellphone">
						
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure that it's not set as default.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error3"}
					
					<div class="setup deletedcellphone">
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure you don't have any non-withdrawn funds on your cell phone.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error4"}
					
					<div class="setup deletedcellphone">
						<h4 class="widgettitle">Delete cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure you don't have any pending transactions.</p>
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}