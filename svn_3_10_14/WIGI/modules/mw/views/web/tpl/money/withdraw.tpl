{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
				
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showpage == "confirm"}
					
					<div class="setup withdrawfunds formlayout subformlayout">
						
						<h4>Withdraw money from your InCashMe&#8482; Merchant Account</h4>
						
						<form action="{$formbase}money/withdraw" method="post">
							
							<div class="stepbox">
								
								<p>Are you sure you would like to withdraw ₹{number_format($amount, 2, '.', ',')} to your account?</p>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="amount" value="{$amount}" />
								<input type="hidden" name="account_list" value="{$account_list}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}money/showwithdraw">Cancel</a></li>
						</ul>
						
					</div>
					
				{else}
					
					<div class="setup withdrawnfunds">
						
						<h4>Withdraw money from your InCashMe&#8482; Merchant Account</h4>
						
						{if !isset($error)}
							<p>Money has been withdrawn from your InCashMe&#8482; Merchant Account.</p>
						{else}
							<p>Money has not been withdrawn from your InCashMe&#8482; Merchant Account.</p>
						{/if}
						
						<ul class="actionlinks">
							<li><a href="{$formbase}dashboard/home">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}