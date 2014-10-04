{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Edit pin</li>
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
                <h1>Edit PIN</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpin formlayout subformlayout">
						<h4 class="widgettitle">Change PIN number</h4>
						<div class="widgetcontent" >
						<!--<h4>Change PIN number</h4>-->
						
						<p>Each cell phone has its own PIN. The same PIN can be chosen for all phones.</p>
						
						<form action="{$formbase}profile/editpin" method="post" autocomplete="off" class="stdform">
							
							<div class="">
								<p>
									<label>Old PIN </label>
									<span class="field">
										<input type="password" name="OLDPIN" id="oldpin" maxlength="7" />
									</span>
									<small class="desc">Enter your current PIN number</small>
								</p>
								<p>
									<label>New PIN </label>
									<span class="field">
										<input type="password" name="NEWPIN" id="newpin" maxlength="7" />
									</span>
									<small class="desc">Enter new PIN number (7 digits, unordered)</small>
								</p>
								<p>
									<label>PIN (confirm) </label>
									<span class="field">
										<input type="password" name="NEWPIN_CONFIRM" id="newpin_confirm" maxlength="7" />
									</span>
									<small class="desc">Repeat new PIN number</small>
								</p>
								<!--<div class="prompt oldpin pin">
									<label for="oldpin">PIN</label>
									<input type="password" name="OLDPIN" id="oldpin" maxlength="7" />
									<p class="tip">Enter your current PIN number</p>
								</div>
								<div class="prompt newpin pin">
									<label for="newpin">PIN</label>
									<input type="password" name="NEWPIN" id="newpin" maxlength="7" />
									<p class="tip">Enter new PIN number (7 digits, unordered)</p>
								</div>
								<div class="prompt newpin_confirm pin">
									<label for="newpin_confirm">PIN (confirm)</label>
									<input type="password" name="NEWPIN_CONFIRM" id="newpin_confirm" maxlength="7" />
									<p class="tip">Repeat new PIN number</p>
								</div>-->
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Change" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
								
							</div>
						
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpin">
						
						<h4 class="widgettitle">Change PIN number</h4>
						<div class="widgetcontent" >
						
						<p>Your PIN number has been changed.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedpin">
						
						<h4 class="widgettitle">Change PIN number</h4>
						<div class="widgetcontent" >
						
						<p>Your PIN number cannot be changed.</p>
						<p>Make sure you entered your PIN numbers correctly.</p>
						
						<a href="{$formbase}profile/editpin/ITEM/{$ITEM}"  class="btn btn-info">Try again</a>
						<a href="{$formbase}profile/home#cellphones"  class="btn btn-info">Back</a>
							
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/editpin/ITEM/{$ITEM}"  class="btn btn-info">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones"  class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}