{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Cellphone Role</li>
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
                <h1>Cellphone Role</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				{if $showcontent == "form"}
					
					<div class="setup editcellphone formlayout subformlayout">
						
						<h4  class="widgettitle">Edit cell phone : {$selectedcellphone}</h4>
						<div class="widgetcontent" >
						<form action="{$formbase}profile/getrole" method="post" class="stdform">
							
							<div class="">
								
								<p>
									<label>Select Role </label>
									<span class="field">
										<select name="rolename">
                                                            <option value="" selected="selected">Select</option>
                                                            {foreach from=$existing_roles item=data2}
                                                            <option value="{$data2.rolename}" {if {$currentrole == $data2.rolename}} selected="selected" {/if}>
																{$data2.rolename}
															</option>
                                                            {/foreach}
                                                            </select>
									</span>
								</p>
								<!--<div class="prompt celldesc">
									<label for="celldesc">Select Role</label>
									<select name="rolename">
                                                            <option value="" selected="selected">Select</option>
                                                            {foreach from=$existing_roles item=data2}
                                                            <option value="{$data2.rolename}" {if {$currentrole == $data2.rolename}} selected="selected" {/if}>
																{$data2.rolename}
															</option>
                                                            {/foreach}
                                                            </select>
								</div>-->
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellphone">
						
						<h4  class="widgettitle">Role</h4>
						<div class="widgetcontent" >
						
						<p>Role for the cell phone has been updated.</p>
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