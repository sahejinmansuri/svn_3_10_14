{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup unlockcellphone formlayout subformlayout">
						
						<h4>Unlock cell phone: {$selectedcellphone}</h4>
						
						<form action="{$formbase}profile/unlockcell" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your password</p>
								</div>
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="unlock" />
								<input type="submit" value="Unlock" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup unlockedcellphone">
						
						<h4>Unlock cell phone</h4>
						
						<p>Your cell phone has been unlocked.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup lockedcellphone">
						
						<h4>Unlock cell phone</h4>
						
						<p>Your cell phone cannot be unlocked.</p>
						<p>Make sure you entered your password and PIN number correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/unlockcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}