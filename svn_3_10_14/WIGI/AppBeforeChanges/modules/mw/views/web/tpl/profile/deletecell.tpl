{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deleteposdevice formlayout subformlayout">
						
						<h4>Delete device</h4>
						
						<p>Are you sure you want to delete your device?</p>
						
						<form action="{$formbase}profile/deletecell" method="post">
							
							<div class="stepbox">
								
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your password</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedposdevice">
						
						<h4>Delete device</h4>
						
						<p>Your device has been deleted.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup deletedposdevice">
						
						<h4>Delete device</h4>
						
						<p>Your device cannot be deleted.</p>
						<p>Make sure that it's not a virtual device, and make sure you entered your PIN and password correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/deletecell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}