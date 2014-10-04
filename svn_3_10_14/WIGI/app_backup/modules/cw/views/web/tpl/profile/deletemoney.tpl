{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletemoneysource formlayout subformlayout">
						
						<h4>Delete money source</h4>
						
						<form action="{$formbase}profile/deletemoney" method="post">
							
							<div class="notes">
								<p>Are you sure you want to delete your money source?</p>
								<input type="hidden" name="ITEM" value="{$ITEM}" />
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedmoney">
						
						<h4>Delete money source</h4>
						
						<p>Your money source has been deleted.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}