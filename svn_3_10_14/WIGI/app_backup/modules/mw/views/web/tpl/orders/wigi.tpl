{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">

        {include file='orders/wigishare.tpl'}

			<div class="information">
				
				<h4>Calculate Wigi Share</h4>
				
				<div class="tabfield">
					
					<div class="tab setup scanandpay">
												
                    {include file='orders/wigi_inputs.tpl'}

					
				</div>
				
			</div>
			
		</div>

	  </div>
		
	</div>
	
{include file='footer.tpl'}
