{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Profile</i> <span class="separator"></span> <li>Change Password</i></li>
		
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
                <h1>Change Password</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpassword formlayout subformlayout">
							<p>You may change your InCashMe&#8482; Web Account password on this page.</p>
						<h4 class="widgettitle ">Change password</h4>
						<div class="widgetcontent form-horizontal">
					
						
						<form action="{$formbase}profile/editpassword" method="post" class="stdform" autocomplete="off">
							
						<p>
                            <label>Old password</label>
                            <span class="field"><input type="password" name="OLDPASSWORD" id="oldpassword" value="" />
								</span>
                            <small class="desc">Enter your old password</small>
                        </p>
						<p>
                            <label>New password</label>
                            <span class="field"><input type="password" name="NEWPASSWORD" id="newpassword" value="" />
								</span>
                            <small class="desc">Enter your password (min. 8 characters)</small>
                        </p>
						<p>
                            <label>New password (Confirm)</label>
                            <span class="field"><input type="password" name="NEWPASSWORD_CONFIRM" id="newpassword_confirm" value="" />
								</span>
                            <small class="desc">Repeat your new password</small>
                        </p> 
							<!--
							<div class="stepbox">
																
								<div class="prompt oldpassword password">
									<label for="oldpassword">Old password</label>
									<input type="password" name="OLDPASSWORD" id="oldpassword" value="" />
									<p class="tip">Enter your old password</p>
								</div>
								<div class="prompt newpassword advpassword">
									<label for="newpassword">New password</label>
									<input type="password" name="NEWPASSWORD" id="newpassword" value="" />
									<p class="tip">Enter your password (min. 8 characters)</p>
								</div>
								<div class="prompt newpassword_confirm password">
									<label for="newpassword_confirm">New password (Confirm)</label>
									<input type="password" name="NEWPASSWORD_CONFIRM" id="newpassword_confirm" value="" />
									<p class="tip">Repeat your new password</p>
								</div>
															
							</div>
							-->
							
							<div class="submit">
								
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" class="btn btn-info" value="Change" />
								<a href="{$formbase}profile/home#personalinfo"><input type="button" class="btn btn-info" value="Cancel"/></a>
							</div>
						
						</form>
						</div>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#personalinfo"><input type="button" class="btn btn-info" value="Cancel"/></a></li>
						</ul>
						
					</div>-->
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpassword">
						
						<h4>Change password</h4>
						
						<p>Your password has been changed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#personalinfo"><input type="button" class="btn btn-info" value="Back"/></a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedpassword">
						
						<h4>Change password</h4>
						
						<p>Your password cannot be changed.</p>
						<p>Make sure you entered your passwords correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/editpassword"><input type="button" class="btn btn-info" value="Try again"/></a></li>
							</br>
							<li><a href="{$formbase}profile/home#personalinfo"><input type="button" class="btn btn-info" value="Back"/></a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}