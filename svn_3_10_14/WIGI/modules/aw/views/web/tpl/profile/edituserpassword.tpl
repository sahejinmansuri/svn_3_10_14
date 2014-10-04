{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpassword formlayout subformlayout">
						
						<h4>Change POS user password</h4>
						
						<p>You may change the InCashMe&#8482; Web Account password of the selected user on this page.</p>
						
						<form action="{$formbase}profile/edituserpassword" method="post" autocomplete="off">
							
							<div class="stepbox">
																
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
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="hidden" name="userid" value="{$userid}" />
								<input type="submit" value="Change" />
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpassword">
						
						<h4>Change POS user password</h4>
						
						<p>The user's password has been changed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedpassword">
						
						<h4>Change POS user password</h4>
						
						<p>The user's password cannot be changed.</p>
						<p>Make sure you entered the user's passwords correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/edituserpassword/ITEM/{$ITEM}/userid/{$userid}">Try again</a></li>
							<li><a href="{$formbase}customer/mercdetail?MID={$userid}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}