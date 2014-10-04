{include file='header.tpl'}
{include file='error.tpl'}

	<div class="innerDiv">
	
		<div class="title_box_wide">
			InCashMe Personal user - Withdraw
		</div>
		
		<div class="box_wide">
			
			<div id="withdraw" class="formlayout">
				
				<div class="account">
				
					<p>Account Balance <strong>&#x20b9; 0.00</strong></p>
					<p>Effective Balance <strong>&#x20b9; 0.00</strong></p>
					
				</div>
			
				<h3>Withdraw Money from Your Cell Phone</h3>
				
				<form action="{$formbase}money/withdraw" method="post">
					
					<div class="stepbox">
						
						<div class="prompt amount">
							<label for="amount">Amount &#x20b9;</label>
							<input type="text" id="amount" size="4" class="formfield" value="0.00" />
							<p class="tip">The amount in INR</p>
							<p class"valid">Valid amount</p>
							<p class="errormsg invalid">Please enter a valid amount</p>
							<p class="errormsg noempty">This field is required</p>
						</div>
						
						<div class="prompt">
							<label for="cellphone_list">From</label>
							<select id="cellphone_list" name="cellphone_list">
								<option>N/A</option>
							</select>
							<p class="tip">Choose a cell phone</p>
						</div>
						
						<div class="prompt">
							<label for="account_list">To</label>
							<select id="account_list" name="account_list">
								<option>N/A</option>
							</select>
							<p class="tip">Choose an account</p>
						</div>
						
					</div>
					
					<div class="submit">
						<input type="submit" value="Withdraw" />
					</div>
					
				</form>
				
				<br class="clear" />
				
			</div>
		
		</div>
		
	</div>

{include file='footer.tpl'}
