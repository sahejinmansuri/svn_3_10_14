{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup lockposdevice formlayout subformlayout">
						
						<h4>Lock device: {$selectedcellphone}</h4>
						
						<form action="{$formbase}profile/lockcell" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this device</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="lock" />
								<input type="submit" value="Lock" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup lockedposdevice">
						
						<h4>Lock device</h4>
						
						<p>Your device has been locked.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup lockedposdevice">
						
						<h4>Lock device</h4>
						
						<p>Your device cannot be unlocked.</p>
						<p>Make sure you entered your password and PIN number correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/lockcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
