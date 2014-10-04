{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
				
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showpage == "confirm"}
					
					<div class="setup addfunds formlayout subformlayout">
						
						<h4>Add money to your InCashMe&#8482; Merchant Account</h4>
						
						<form action="{$formbase}money/add" method="post">
							
							<div class="stepbox">
								
								<p>Are you sure you would like to add US${number_format($amount, 2, '.', ',')} to your account?</p>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="amount" value="{$amount}" />
								<input type="hidden" name="account_list" value="{$account_list}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}money/showadd">Cancel</a></li>
						</ul>
						
					</div>
					
				{else}
					
					<div class="setup addedfunds">
						
						<h4>Add money to your InCashMe&#8482; Merchant Account</h4>
						
						{if !isset($error)}
							<p>Money has been added to your InCashMe&#8482; Merchant Account.</p>
						{else}
							<p>Money has not been added to your InCashMe&#8482; Merchant Account.</p>
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