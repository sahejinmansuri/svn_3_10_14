{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
				
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup withdrawn">
					
					<h4>Withdraw money from your cell phone</h4>
					
					{if !isset($error)}
						<p>Money has been withdrawn from your cell phone.</p>
						<p>Funds may take several days to appear in your Bank Account.</p>
					{else}
						<p>Money has not been withdrawn from your cell phone.</p>
					{/if}
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}