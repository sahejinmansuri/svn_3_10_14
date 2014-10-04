{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editcellpreferences formlayout subformlayout">
						
						<h4>Edit device preferences</h4>
						
						<form action="{$formbase}profile/editcellprefs" method="post">
							
							<h5>General preferences</h5>
							<div class="stepbox">
								
								<div class="prompt salestax">
									<label for="salestax">Sales tax</label>
									<input type="text" name="SALESTAX" id="salestax" value="{$preferences['salestax']}" />
									<p class="tip">Set tax on sales</p>
								</div>
								<div class="prompt tips">
									<label for="tips">Tips ₹</label>
									<input type="text" name="TIPS" id="tips" value="{$preferences['tips']}" />
									<p class="tip">Set tips</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" />
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellpreferences">
						
						<h4>Edit device preferences</h4>
						
						<p>Your device preferences have been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}
