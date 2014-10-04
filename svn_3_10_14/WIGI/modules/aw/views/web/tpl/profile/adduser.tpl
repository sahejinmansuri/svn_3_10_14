{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup adduser formlayout subformlayout">
						
						<h4>Add User</h4>
						
						<form action="{$formbase}profile/adduser?userid={$userid}" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt firstname">
									<label for="firstname">First Name</label>
									<input type="text" name="FIRST_NAME" id="firstname" maxlength="30" value="" />
									<p class="tip">What is the new user's first name?</p>
								</div>
								<div class="prompt lastname">
									<label for="lastname">Last Name</label>
									<input type="text" name="LAST_NAME" id="lastname" maxlength="30" value="" />
									<p class="tip">What is the new user's last name?</p>
								</div>
								<div class="prompt username">
									<label for="username">Username</label>
									<input type="text" name="USERNAME" id="username" maxlength="60" value="" />
									<p class="tip">Enter your username</p>
								</div>
								<div class="prompt advpassword">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" maxlength="30" />
									<p class="tip">Enter your password (min. 8 characters, strong)</p>
								</div>
								<div class="prompt advpassword_confirm">
									<label for="password_confirm">Password (confirm)</label>
									<input type="password" name="PASSWORD_CONFIRM" id="password_confirm" maxlength="30" />
									<p class="tip">Repeat password</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="add" />
									<input type="submit" value="Add" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addeduser">
						
						<h4>Add User</h4>
						
						<p>Your new user has been added.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup addeduser">
						
						<h4>Add User</h4>
						
						<p>Your user cannot be added.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}