{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Confirm Cellphone</li>
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
                <h1>Confirm Cellphone</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup confirmcell formlayout subformlayout">
						
						<h4 class="widgettitle">Confirm cell phone</h4>
						<div class="widgetcontent" >
						<form action="{$formbase}profile/confirmcell" method="post" class="stdform">
							<p>
								<label>Activation Code</label>
								<span class="field">
									<input type="text" name="CONFIRMCODE" id="safepasscode" value="" />
								</span>
								<small class="desc">You should have received this on addition</small>
							</p>
							
							<!--<div class="stepbox">								
								<div class="prompt safepasscode">
									<label for="safepasscode">Activation Code</label>
									<input type="text" name="CONFIRMCODE" id="safepasscode" value="" />
									<p class="tip">You should have received this on addition</p>
								</div>
							</div>-->
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm"  class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup confirmedcell">
						
						<h4 class="widgettitle">Confirm cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone has been confirmed.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup confirmedcell">
						
						<h4 class="widgettitle">Confirm cell phone</h4>
						<div class="widgetcontent" >
						
						<p>We're sorry, but that's not the correct activation code.</p>
						
						<a href="{$formbase}profile/confirmcell/ITEM/{$ITEM}" class="btn btn-info">Try again</a>
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/confirmcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}