{include file='header.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{include file='money/error.tpl'}
				
				<div id="addmoney" class="setup addfunds formlayout subformlayout">
					
					<h4>Add money to your InCashMe&#8482; Merchant Account</h4>
					
					<p>You can add funds to your InCashMe&#8482; Merchant Account from one of <a href="{$formbase}profile/home#moneysources" style="text-decoration:underline;">your pre-existing Money Sources</a>. These funds may take several days to appear in your Available balance, depending on the bank settlement times. We will send you an email as soon as the funds settle.</p>
					
					<form action="{$formbase}money/add" method="post">
						
						<div class="stepbox">
							
							<div class="prompt amount">
								<label for="amount">Amount ₹</label>
								<input type="text" id="amount" name="amount" class="formfield" maxlength="7" value="0.00" />
								<p class="tip">The amount you would like to add</p>
							</div>
							
							<div class="prompt account_list">
								<label for="account_list">From</label>
								<select id="account_list" name="account_list">
									<option value="">Choose...</option>
									{foreach from=$bank_accounts key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
									{/foreach}
								</select>
								<p class="tip">Choose an account</p>
							</div>
							
						</div>
						
						<div class="submit">
							<input type="submit" value="Add Funds" />
						</div>
						
					</form>
					
					<ul class="actionlinks">
						<li><a href="{$formbase}dashboard/home">Cancel</a></li>
					</ul>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}