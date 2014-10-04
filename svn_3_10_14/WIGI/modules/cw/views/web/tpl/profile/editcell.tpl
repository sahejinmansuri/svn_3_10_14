{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Edit cellphone</li>
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
                <h1>Edit cellphone</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editcellphone formlayout subformlayout">
						<h4 class="widgettitle">Edit cell phone</h4>
						<div class="widgetcontent" >
						<!--<h4>Edit cell phone</h4>-->
						
						<form action="{$formbase}profile/editcell" method="post" class="stdform">
							
							<p>
								<label>First name</label>
								<span class="field">
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" value="{$CELLDESC}" />
								</span>
								<small class="desc">This will be the first name you see for this cell phone</small>
							</p>
							<p>
								<label>Last name</label>
								<span class="field">
									<input type="text" name="LASTNAME" id="lastname" maxlength="30" value="{$LASTNAME}" />
								</span>
								<small class="desc">This will be the last name you see for this cell phone</small>
							</p>
							<p>
								<label>Cellphone Permissions</label>
								<span class="field">&nbsp;</span>
								<small class="desc">&nbsp;</small>
							</p>
							<p>
								<label>Profile</label>
								<span class="field">
									<input type="checkbox" name="VIEW_PROFILE_INDEX" id="VIEW_PROFILE_INDEX"  {if $profile == 1} checked="checked" {/if} />
								</span>
								<small class="desc">Set profile permission</small>
							</p>
							<p>
								<label>Change PIN</label>
								<span class="field">
									<input type="checkbox" name="CHNAGE_PIN_INDEX" id="CHNAGE_PIN_INDEX" {if $changepin == 1} checked="checked" {/if} />
								</span>
								<small class="desc">Set Change PIN permission</small>
							</p>
							<p>
								<label>Add Money</label>
								<span class="field">
									<input type="checkbox" name="ADD_MONEY_INDEX" id="ADD_MONEY_INDEX" {if $addmoney == 1} checked="checked" {/if}  /> 
								</span>
								<small class="desc">Set Add Money permission</small>
							</p>
							<p>
								<label>Withdraw Money</label>
								<span class="field">
									<input type="checkbox" name="WITHDRAW_MONEY_INDEX" id="WITHDRAW_MONEY_INDEX" {if $withdrawmoney == 1} checked="checked" {/if}  />
								</span>
								<small class="desc">Set Withdraw Money permission</small>
							</p>
							<p>
								<label>Change Security Question</label>
								<span class="field">
									<input type="checkbox" name="CHANGE_QUESTION_INDEX" id="CHANGE_QUESTION_INDEX" {if $secquestion == 1} checked="checked" {/if} />
								</span>
								<small class="desc">Set Change Security Question permission</small>
							</p>
							<p>
								<label>Lock Cell</label>
								<span class="field">
									<input type="checkbox" name="LOCK_CELL_INDEX" id="LOCK_CELL_INDEX" {if $lockcell == 1} checked="checked" {/if} />
								</span>
								<small class="desc">Set Lock Cell permission</small>
							</p>
							<!--<div class="stepbox">
								
								<div class="prompt celldesc">
									<label for="celldesc">Display name</label>
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" value="{$CELLDESC}" />
									<p class="tip">This will be the name you see for this cell phone</p>
								</div>
								
							</div>-->
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones"><input type="button" class="btn btn-info" value="Cancel"/></a>
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellphone">
						
						<h4 class="widgettitle">Edit cell phone</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone has been updated.</p>
						<a href="{$formbase}profile/home#cellphones"><input type="button" class="btn btn-info" value="Back"/></a>
						
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