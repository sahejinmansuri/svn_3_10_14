{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Add cellphone</li>
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
                <h1>Add cellphone</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup addcellphone formlayout subformlayout">
						
						<h4 class="widgettitle">Add Cellphone</h4>
						<div class="widgetcontent" >
						
						<p>You will need to install the Wigime&#8482; App on your cell phone and verify your cell phone by activating it with the activation code that you will receive from us. Android and iPhone are supported.</p>
						
						<form action="{$formbase}profile/addcell" method="post"  class="stdform">
							<p>
								<label>First name</label>
								<span class="field">
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" value="" />
								</span>
								<small class="desc">This will be the first name you see for this cell phone</small>
							</p>
							<p>
								<label>Last name</label>
								<span class="field">
									<input type="text" name="LASTNAME" id="lastname" maxlength="30" value="" />
								</span>
								<small class="desc">This will be the last name you see for this cell phone</small>
							</p>
							<p>
								<label>Cell phone</label>
								<span class="field">
									<select id="countrycode" name="COUNTRYCODE"><option value="IN">91 (India)</option></select>
									<input type="text" name="CELLPHONE" id="cellphone" size="12" value="" maxlength="16" placeholder="5556667777" />
								</span>
								<small class="desc">Your 10-digit smartphone cell phone number</small>
							</p>
							<p>
								<label>PIN</label>
								<span class="field">
									<input type="password" name="PIN" id="pin" maxlength="7" />
								</span>
								<small class="desc">Enter new PIN number (7 digits, unordered)</small>
							</p>
							<p>
								<label>PIN (confirm)</label>
								<span class="field">
									<input type="password" name="PIN_CONFIRM" id="pin_confirm" maxlength="7" />
								</span>
								<small class="desc">Repeat PIN number</small>
							</p>
							<p>
								<label>Security question</label>
								<span class="field">
									<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
								</span>
								<small class="desc">Choose a security question</small>
							</p>
							<p>
								<label>Security answer</label>
								<span class="field">
									<input type="text" name="ANSWER" id="answer" maxlength="15" />
								</span>
								<small class="desc">Enter a security answer</small>
							</p>
							<p>
								<label>Cellphone Permissions</label>
								<span class="field">&nbsp;</span>
								<small class="desc">&nbsp;</small>
							</p>
							<p>
								<label>Profile</label>
								<span class="field">
									<input type="checkbox" name="VIEW_PROFILE_INDEX" id="VIEW_PROFILE_INDEX" />
								</span>
								<small class="desc">Set profile permission</small>
							</p>
							<p>
								<label>Change PIN</label>
								<span class="field">
									<input type="checkbox" name="CHNAGE_PIN_INDEX" id="CHNAGE_PIN_INDEX" />
								</span>
								<small class="desc">Set Change PIN permission</small>
							</p>
							<p>
								<label>Add Money</label>
								<span class="field">
									<input type="checkbox" name="ADD_MONEY_INDEX" id="ADD_MONEY_INDEX" />
								</span>
								<small class="desc">Set Add Money permission</small>
							</p>
							<p>
								<label>Withdraw Money</label>
								<span class="field">
									<input type="checkbox" name="WITHDRAW_MONEY_INDEX" id="WITHDRAW_MONEY_INDEX" />
								</span>
								<small class="desc">Set Withdraw Money permission</small>
							</p>
							<p>
								<label>Change Security Question</label>
								<span class="field">
									<input type="checkbox" name="CHANGE_QUESTION_INDEX" id="CHANGE_QUESTION_INDEX" />
								</span>
								<small class="desc">Set Change Security Question permission</small>
							</p>
							<p>
								<label>Lock Cell</label>
								<span class="field">
									<input type="checkbox" name="LOCK_CELL_INDEX" id="LOCK_CELL_INDEX" />
								</span>
								<small class="desc">Set Lock Cell permission</small>
							</p>
							
							<div class="submit">
								<div class="notes">
									<input type="hidden" name="doaction" value="add" />
									<input type="submit" value="Add" class="btn btn-info" />
									<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
								</div>
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addedcellphone">
						
						<h4 class="widgettitle">Add Cellphone</h4>
						<div class="widgetcontent" >
						
						<p>Your new cell phone has been added.</p>
						
						<p>Now, all you need to do is install the InCashMe&#8482; App on your cell phone. Android and iPhone are supported.</p>
						<p>You also need to verify your cell phone by activating it with the activation code that you will receive from us.</p>
						
						<a href="{$formbase}profile/confirmcell/ITEM/{$cellid}"><input type="button" class="btn btn-info" value="Confirm"/></a>
						<a href="{$formbase}profile/home#cellphones"><input type="button" class="btn btn-info" value="Back"/></a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/confirmcell/ITEM/{$cellid}">Confirm</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup addedcellphone">
						
						<h4 class="widgettitle">Add Cellphone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone cannot be added.</p>
						<p>It's already in use in a different InCashMe&#8482; account.</p>
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}