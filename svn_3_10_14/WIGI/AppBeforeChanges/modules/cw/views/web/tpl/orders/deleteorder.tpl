{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deleteorder formlayout subformlayout">
						
						<h4>Cancel order</h4>
						
						<form action="{$formbase}orders/deleteorder" method="post">
							
							<div class="notes">
								<p>Are you sure you want to cancel the order?</p>
								<input type="hidden" name="ITEM" value="{$ITEM}" />
							</div>
							
							<div class="submit">
								<input type="hidden" name="T" value="{$ordertype}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Yes" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}orders/home#{$ordertype}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedmoney">
						
						<h4>Cancel order</h4>
						
						<p>The order has been cancelled.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}orders/home#{$ordertype}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}