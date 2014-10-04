{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Lock Cellphone</li>
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
                <h1>Lock Cellphone</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup lockcellphone formlayout subformlayout">
						
						<h4 class="widgettitle">Lock cell phone: {$selectedcellphone}</h4>
						<div class="widgetcontent" >
						
						<p>A locked cell phone can not log in. The funds are still available and can be withdrawn online. To unlock a cell phone, login to wigime.com and unlock through profile settings.</p>
						
						<form action="{$formbase}profile/lockcell" method="post" autocomplete="off" class="stdform">
							
							<div class="">
								<p>
									<label>PIN </label>
									<span class="field">
										<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									</span>
									<small class="desc">Please enter your PIN number for this cell phone</small>
								</p>
								{if count($cellphones) > 1 and $isdefaultcell == 1}
								<p>
									<label>Set Default Cell </label>
									<span class="field">
										<select name="SETDEFAULT" id="setdefaultcell">
										<option value="">Leave this</option>
										{foreach from=$cellphones key=k item=v}
											{if $v.is_default == 0}
											<option value="{$v.mobile_id}">{$v.cellphone}</option>
											{/if}
										{/foreach}
									</select>
									</span>
									<small class="desc">Would you like to set another cell phone to default?</small>
								</p>
								{/if}
								<!--<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								{if count($cellphones) > 1 and $isdefaultcell == 1}
								<div class="prompt setdefaultcell">
									<label for="setdefaultcell">Set Default Cell</label>
									<select name="SETDEFAULT" id="setdefaultcell">
										<option value="">Leave this</option>
										{foreach from=$cellphones key=k item=v}
											{if $v.is_default == 0}
											<option value="{$v.mobile_id}">{$v.cellphone}</option>
											{/if}
										{/foreach}
									</select>
									<p class="tip">Would you like to set another cell phone to default?</p>
								</div>
								{/if}-->
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="lock" />
								<input type="submit" value="Lock" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup lockedcellphone">
						
						<h4 class="widgettitle">Lock cell phone: {$selectedcellphone}</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone has been locked.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup lockedcellphone">
						
						<h4 class="widgettitle">Lock cell phone: {$selectedcellphone}</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be locked.</p>
						<p>Make sure you entered your password and PIN number correctly.</p>
						
						<a href="{$formbase}profile/lockcell/ITEM/{$ITEM}" class="btn btn-info">Try again</a>
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/lockcell/ITEM/{$ITEM}" class="btn btn-info">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
