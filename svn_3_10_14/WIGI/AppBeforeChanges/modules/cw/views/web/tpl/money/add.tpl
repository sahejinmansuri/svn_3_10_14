{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
				
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup addedfunds">
					
					<h4>Add money to your cell phone</h4>
					
					{if !isset($error)}
						<p>Money has been added to your cell phone.</p>
						<p>Funds may take several days to appear in your Available Balance.</p>
					{else}
						<p>Money has not been added to your cell phone.</p>
					{/if}
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}