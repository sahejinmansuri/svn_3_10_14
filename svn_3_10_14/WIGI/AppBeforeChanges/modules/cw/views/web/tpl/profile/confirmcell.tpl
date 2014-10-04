{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup confirmcell formlayout subformlayout">
						
						<h4>Confirm cell phone</h4>
						
						<form action="{$formbase}profile/confirmcell" method="post">
							
							<div class="stepbox">
																
								<div class="prompt safepasscode">
									<label for="safepasscode">Activation Code</label>
									<input type="text" name="CONFIRMCODE" id="safepasscode" value="" />
									<p class="tip">You should have received this on addition</p>
								</div>
							
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup confirmedcell">
						
						<h4>Confirm cell phone</h4>
						
						<p>Your cell phone has been confirmed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup confirmedcell">
						
						<h4>Confirm cell phone</h4>
						
						<p>We're sorry, but that's not the correct activation code.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/confirmcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}