{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li>Set Default</li>
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
                <h1>Set Default</h1>
            </div>
        </div>
		
		<div class="box_wide box_withsidebar box-info">	
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup defaultcellphone formlayout subformlayout">
						<h4 class="widgettitle">Set default cell phone</h4>
						<div class="widgetcontent" >
						<!--<h4>Set default cell phone</h4>-->
						
						<p>Every InCashMe&#4842; Account needs exactly one default cell phone for logging into the website. For added security, an activation code is sent to your default phone during login.</p>
						
						<form action="{$formbase}profile/setdefaultcell" method="post" autocomplete="off" class="stdform">
							
							<p>
								<label>Received Code</label>
								<span class="field">
									<input type="text" name="code" id="code" maxlength="7" />
								</span>
								<small class="desc">Enter the code you have received to your cell phone</small>
							</p>
							<!--<div class="stepbox">
																
								<div class="prompt code">
									<label for="code">Received Code</label>
									<input type="text" name="code" id="code" maxlength="7" />
									<p class="tip">Enter the code you have received to your cell phone</p>
								</div>
								
							</div>-->
							
							<div class="submit stdformbutton">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="set" />
								<input type="submit" value="Set default" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
								
							</div>
						
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup defaultedcellphone">
						
						<h4 class="widgettitle">Set default cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone has been set to default.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup defaultedcellphone">
						
						<h4 class="widgettitle">Set default cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone could not be set as default.</p>
						<div class="submit stdformbutton">
							<a href="{$formbase}profile/setdefaultcell/ITEM/{$ITEM}" class="btn btn-info">Try again</a>
							<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
						</div>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/setdefaultcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}