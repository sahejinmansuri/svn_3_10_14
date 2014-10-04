{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deleteuser formlayout subformlayout">
						
						<h4>Delete user</h4>
						
						<p>Are you sure you want to delete the user?</p>
						
						<form action="{$formbase}profile/deleteuser" method="post">
							
							<div class="stepbox">
								
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your merchant account password</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="hidden" name="userid" value="{$userid}" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deleteduser">
						
						<h4>Delete user</h4>
						
						<p>The user has been deleted.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup deleteduser">
						
						<h4>Delete user</h4>
						
						<p>The user cannot be deleted.</p>
						<p>Please make sure you entered your password correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/deleteuser/ITEM/{$ITEM}/userid/{$userid}">Try again</a></li>
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}