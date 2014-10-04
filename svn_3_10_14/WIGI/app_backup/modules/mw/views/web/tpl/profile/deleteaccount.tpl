{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deleteaccount formlayout subformlayout">
						
						<h4>Delete account</h4>
						
						<p>Are you sure you would like to delete your account? You might want to consider <a href="{$formbase}profile/lockaccount">locking your account</a> instead.</p>
						
						<form action="{$formbase}profile/deleteaccount" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your password</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#preferences">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup deletedaccount">
						
						<h4>Delete account</h4>
						
						<p>Your account cannot be deleted.</p>
						<p>Make sure you entered your password correctly, you don't have any non-withdrawn funds on your account, and you don't have any pending transactions.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/deleteaccount">Try again</a></li>
							<li><a href="{$formbase}profile/home#preferences">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}