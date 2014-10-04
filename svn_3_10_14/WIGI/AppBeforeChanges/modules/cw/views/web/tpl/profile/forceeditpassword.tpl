{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpassword formlayout subformlayout">
						
						<h4>Change password</h4>
						
						<p>You need to change your temporary password for your InCashMe&#8482; Web Account. Please complete the form below.</p>
						
						<form action="{$formbase}profile/forceeditpassword" method="post" autocomplete="off">
							
							<div class="stepbox">
																
								<div class="prompt oldpassword password">
									<label for="oldpassword">Old password</label>
									<input type="password" name="OLDPASSWORD" id="oldpassword" value="" />
									<p class="tip">Enter your old password</p>
								</div>
								<div class="prompt newpassword advpassword">
									<label for="newpassword">New password</label>
									<input type="password" name="NEWPASSWORD" id="newpassword" value="" />
									<p class="tip">Enter your password (min. 8 characters)</p>
								</div>
								<div class="prompt newpassword_confirm password">
									<label for="newpassword_confirm">New password (Confirm)</label>
									<input type="password" name="NEWPASSWORD_CONFIRM" id="newpassword_confirm" value="" />
									<p class="tip">Repeat your new password</p>
								</div>
															
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Change" />
								
							</div>
						
						</form>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpassword">
						
						<h4>Change password</h4>
						
						<p>Your password has been changed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}dashboard/home">Go to your Dashboard</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedpassword">
						
						<h4>Change password</h4>
						
						<p>Your password cannot be changed.</p>
						<p>Make sure you entered your passwords correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/forceeditpassword">Try again</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}