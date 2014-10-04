{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
						
			<div class="information">
				
				<h4>Advanced Features</h4>
				
				<div class="tabfield">
					
					<div class="tabnavigation">
						
						<ul>
							<li><a href="{$formbase}advanced/home#summary">Summary</a></li>
							<li><a href="{$formbase}advanced/home#oscommerce">osCommerce</a></li>
							<li><a href="{$formbase}advanced/home#sendpayments">Send payments</a></li>
						</ul>
						
					</div>
					
					<div class="tab setup messages">
						
						<h4>Send payments</h4>
						
						<p>Your payment was successfully sent.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}advanced/home#sendpayments">Back</a></li>
						</ul>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}