{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editcellphone formlayout subformlayout">
						
						<h4>Edit cell phone</h4>
						
						<form action="{$formbase}profile/editcell" method="post">
							
							<div class="stepbox">
								
								<div class="prompt celldesc">
									<label for="celldesc">Display name</label>
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" value="{$CELLDESC}" />
									<p class="tip">This will be the name you see for this cell phone</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" />
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellphone">
						
						<h4>Edit cell phone</h4>
						
						<p>Your cell phone has been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}