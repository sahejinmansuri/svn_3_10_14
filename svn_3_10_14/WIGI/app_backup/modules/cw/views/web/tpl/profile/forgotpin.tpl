{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup forgotpin formlayout subformlayout">
						
						<h4>Forgot PIN number</h4>
						
						<p>After you enter your password, we will send a new PIN number to your email address.</p>
						
						<form action="{$formbase}profile/forgotpin" method="post" autocomplete="off">
							
							<div class="stepbox">
																
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" />
									<p class="tip">Enter your password</p>
								</div>
															
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="forgot" />
								<input type="submit" value="Reset PIN" />
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup forgotpin">
						
						<h4>Forgot PIN number</h4>
						
						<p>You will now be able to reset your PIN number from the email we have sent to your email address.</p>
						<p>Note: If you aren't receiving an email, please check the spam folder in your email account.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup forgotpin">
						
						<h4>Forgot PIN number</h4>
						
						<p>The password you entered doesn't match our records.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/forgotpin/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}