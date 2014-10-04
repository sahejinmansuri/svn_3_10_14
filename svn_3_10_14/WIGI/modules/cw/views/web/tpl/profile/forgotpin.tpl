{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Forgot pin</li>
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
                <h1>Forgot PIN</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup forgotpin formlayout subformlayout">
						
						<h4 class="widgettitle">Forgot PIN number</h4>
						<div class="widgetcontent" >
						
						<p>After you enter your password, we will send a new PIN number to your email address.</p>
						
						<form action="{$formbase}profile/forgotpin" method="post" autocomplete="off" class="stdform">
							
							<div class="">
								<p>
									<label>Password </label>
									<span class="field">
										<input type="password" name="PASSWORD" id="password" value="" />
									</span>
									<small class="desc">Enter your password</small>
								</p>							
								<!--<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" />
									<p class="tip">Enter your password</p>
								</div>-->
															
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="forgot" />
								<input type="submit" value="Reset PIN" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
								
							</div>
						
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup forgotpin">
						
						<h4 class="widgettitle">Forgot PIN number</h4>
						<div class="widgetcontent" >
						
						<p>You will now be able to reset your PIN number from the email we have sent to your email address.</p>
						<p>Note: If you aren't receiving an email, please check the spam folder in your email account.</p>
						<a href="{$formbase}profile/home#cellphones"  class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones"  class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup forgotpin">
						
<h4 class="widgettitle">Forgot PIN number</h4>
						<div class="widgetcontent" >
						
						<p>The password you entered doesn't match our records.</p>
						<a href="{$formbase}profile/forgotpin/ITEM/{$ITEM}" class="btn btn-info">Try again</a>
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/forgotpin/ITEM/{$ITEM}" class="btn btn-info">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}