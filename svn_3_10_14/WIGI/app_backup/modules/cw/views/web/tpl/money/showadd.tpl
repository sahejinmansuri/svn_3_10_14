{include file='header.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{include file='money/error.tpl'}
				
				<div id="addmoney" class="setup addfunds formlayout subformlayout">
					
					<h4>Add money to your cell phone account</h4>
					
					<p>You can add funds to a specific Cell Phone sub-account (that belongs to your InCashMe&#8482; Account) from one of <a href="{$formbase}profile/home#moneysources">your pre-existing Money Sources</a>. Credit Card and Banking transfers may take up to 3-5 business banking days. Pending transfers will be reflected in your total balance and once settled (deposited) into your account your Available balance will be adjusted. We will send you an email as soon as the funds settle.</p>
					
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
									{foreach from=$credit_cards key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
									{/foreach}
								</select>
								<p class="tip">Choose an account</p>
							</div>
							
							<div class="prompt cellphone_list">
								<label for="cellphone_list">To</label>
								<select id="cellphone_list" name="cellphone_list">
									<option value="">Choose...</option>
									{foreach from=$cellphones key=k item=v}
										<option value="{$v.mobile_id}">{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
									{/foreach}
								</select>
								<p class="tip">Choose a cell phone</p>
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