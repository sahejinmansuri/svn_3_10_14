{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
				
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup movedfunds">
					
					<h4>Move funds</h4>
					
					{if !isset($error)}
						<p>Money has been moved to your default cell phone.</p>
					{else}
						<p>Money has not been moved to your default cell phone.</p>
					{/if}
					
					<ul class="actionlinks">
						<li><a href="{$formbase}advanced/home#movefunds">Back</a></li>
					</ul>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}