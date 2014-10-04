{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editposuser formlayout subformlayout">
						
						<h4>Edit user</h4>
						
						<form action="{$formbase}profile/edituser" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt firstname">
									<label for="firstname">First Name</label>
									<input type="text" name="FIRST_NAME" id="firstname" maxlength="30" value="{$FIRST_NAME}" />
									<p class="tip">What is the user's first name?</p>
								</div>
								<div class="prompt lastname">
									<label for="lastname">Last Name</label>
									<input type="text" name="LAST_NAME" id="lastname" maxlength="30" value="{$LAST_NAME}" />
									<p class="tip">What is the user's last name?</p>
								</div>
								<div class="prompt username">
									<label for="username">Username</label>
									<input type="text" name="USERNAME" id="username" maxlength="60" value="{$USERNAME}" readonly="readonly" />
									<p class="tip">Enter your username</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="ITEM" value="{$ITEM}" />
									<input type="hidden" name="doaction" value="update" />
									<input type="submit" value="Update" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#users">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedposuser">
						
						<h4>Edit user</h4>
						
						<p>Your user has been edited.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#users">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedposuser">
						
						<h4>Edit user</h4>
						
						<p>Your user cannot be edited.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#users">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}