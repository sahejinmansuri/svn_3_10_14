{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup defaultcellphone formlayout subformlayout">
						
						<h4>Set default cell phone</h4>
						
						<p>Every InCashMe&#4842; Account needs exactly one default cell phone for logging into the website. For added security, an activation code is sent to your default phone during login.</p>
						
						<form action="{$formbase}profile/setdefaultcell" method="post" autocomplete="off">
							
							<div class="stepbox">
																
								<div class="prompt code">
									<label for="code">Received Code</label>
									<input type="text" name="code" id="code" maxlength="7" />
									<p class="tip">Enter the code you have received to your cell phone</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="set" />
								<input type="submit" value="Set default" />
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup defaultedcellphone">
						
						<h4>Set default cell phone</h4>
						
						<p>Your cell phone has been set to default.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup defaultedcellphone">
						
						<h4>Set default cell phone</h4>
						
						<p>Your cell phone could not be set as default.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/setdefaultcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}