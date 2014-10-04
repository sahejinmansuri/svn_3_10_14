{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup lockaccount formlayout subformlayout">
						
						<h4>Lock account</h4>
						
						<p>When you Lock your Account, no new transactions of any type will be able to be initiated. You will have to call Customer Service to unlock it. All cell phones associated with this account will also be locked. You must have no pending transactions in order to be able to lock your account.</p>
						
						<form action="{$formbase}profile/lockaccount" method="post" autocomplete="off">
							
							<div class="stepbox">
																
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your InCashMe&#8482; Account password</p>
								</div>
							
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="lock" />
								<input type="submit" value="Lock" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#preferences">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup lockedaccount">
						
						<h4>Lock account</h4>
						
						<p>Your account cannot be locked.</p>
						<p>Make sure you entered your password correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/lockaccount">Try again</a></li>
							<li><a href="{$formbase}profile/home#preferences">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}