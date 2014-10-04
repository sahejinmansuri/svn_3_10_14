{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#moneysources">Money sources</a> <span class="separator"></span></li>
		<li>Confirm account</li>
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
                <h1>Confirm account</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup confirmmoney formlayout subformlayout" >
						<h4 class="widgettitle">Confirm account</h4>
						<div class="widgetcontent" >
						<!--<h4>Confirm account</h4>-->
						
						<p>We have earlier deposited two small random amounts to your bank account as InCashMe&#8482;, Inc. Please enter those amounts in the fields below to confirm your account.</p>
						
						<form action="{$formbase}profile/confirmmoney" method="post" class="stdform"> 
							
							<p>
								<label>Confirm first amount ₹</label>
								<span class="field">
									<input type="text" name="CONFIRMAMOUNT" id="confirmamount" value="0.00" maxlength="4" />
								</span>
								<small class="desc">The amount we have transferred to you first</small>
							</p>
							<p>
								<label>Confirm second amount ₹</label>
								<span class="field">
									<input type="text" name="CONFIRMAMOUNT2" id="confirmamount2" value="0.00" maxlength="4" />
								</span>
								<small class="desc">The amount we have transferred to you second</small>
							</p>
							
							<!--<div class="stepbox">
																
								<div class="prompt confirmamount">
									<label for="confirmamount">Confirm first amount ₹</label>
									<input type="text" name="CONFIRMAMOUNT" id="confirmamount" value="0.00" maxlength="4" />
									<p class="tip">The amount we have transferred to you first</p>
								</div>
								<div class="prompt confirmamount2">
									<label for="confirmamount2">Confirm second amount ₹</label>
									<input type="text" name="CONFIRMAMOUNT2" id="confirmamount2" value="0.00" maxlength="4" />
									<p class="tip">The amount we have transferred to you second</p>
								</div>
							
							</div>-->
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm" class="btn btn-info" />
								<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>-->
						</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup confirmedmoney">
						
						<h4 class="widgettitle">Confirm account</h4>
						<div class="widgetcontent" >
						
						<p>Your account has been confirmed.</p>
						
						<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup confirmedmoney">
						
						<h4 class="widgettitle">Confirm account</h4>
						<div class="widgetcontent" >
						
						<p>We're sorry, but that's not the correct amount.</p>
						<div class="submit stdformbutton">
							<a href="{$formbase}profile/confirmmoney/ITEM/{$ITEM}" class="btn btn-info">Try again</a>
							<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Cancel</a>
						</div>
						
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/confirmmoney/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
