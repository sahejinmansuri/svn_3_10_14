{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup confirmmoney formlayout subformlayout">
						
						<h4>Confirm account</h4>
						
						<p>We have earlier withdrawn two small random amounts from your bank account as InCashMe Inc. Please enter those amounts in the fields below to confirm your account. You can enter the amounts in any order.</p>
						
						<form action="{$formbase}profile/confirmmoney" method="post">
							
							<div class="stepbox">
																
								<div class="prompt confirmamount">
									<label for="confirmamount">Confirm first amount ₹</label>
									<input type="text" name="CONFIRMAMOUNT" id="confirmamount" value="0.00" maxlength="4" />
								</div>
								<div class="prompt confirmamount2">
									<label for="confirmamount2">Confirm second amount ₹</label>
									<input type="text" name="CONFIRMAMOUNT2" id="confirmamount2" value="0.00" maxlength="4" />
								</div>
							
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="confirm" />
								<input type="submit" value="Confirm" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup confirmedmoney">
						
						<h4>Confirm account</h4>
						
						<p>Your account has been confirmed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup confirmedmoney">
						
						<h4>Confirm account</h4>
						
						<p>We're sorry, but that's not the correct amount.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/confirmmoney/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
