{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editposdevice formlayout subformlayout">
						
						<h4>Change user status</h4>
						
						<form action="{$formbase}profile/edituserstatus" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt posuserstatus">
									<label for="posuserstatus">Status</label>
									<select name="POSUSERSTATUS" id="posuserstatus"><option value="active"{if $POSUSERSTATUS == "active"} selected="selected"{/if}>Active</option><option value="locked"{if $POSUSERSTATUS == "locked"} selected="selected"{/if}>Locked</option></select>
									<p class="tip">Set a status for the user</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="ITEM" value="{$ITEM}" />
									<input type="hidden" name="doaction" value="update" />
								<input type="hidden" name="userid" value="{$userid}" />
									<input type="submit" value="Update" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedposdevice">
						
						<h4>Change user status</h4>
						
						<p>The user's status has been edited.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedposdevice">
						
						<h4>Change user status</h4>
						
						<p>The user's status could not be edited.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}