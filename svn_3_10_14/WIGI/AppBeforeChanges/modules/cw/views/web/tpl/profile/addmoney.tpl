{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup addmoneysource formlayout subformlayout">
						
						<h4>Add money source</h4>
						
						<form action="{$formbase}profile/addmoney" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt moneytype">
									<label for="type">Source type</label>
									<select name="TYPE" id="type">{if $credit_cards < 2}<option value="CreditCard">Credit Card / Prepaid Card</option>{/if}{if $bank_accounts < 1}<option value="BankAccount">Bank Account</option>{/if}</select>
									<p class="tip">Type of money source</p>
								</div>
								<div class="prompt iscard carddesc">
									<label for="carddesc">Display name</label>
									<input type="text" name="CARDDESC" id="carddesc" maxlength="30" />
									<p class="tip">This will be the name you see for this card</p>
								</div>
								<div class="prompt iscard cardtype">
									<label for="cardtype">Credit card type</label>
									<select name="CARDTYPE" id="cardtype"><option value="VISA">Visa</option><option value="MAST">MasterCard</option>{if true == false}<option value="AMER">American Express</option>{/if}<option value="DISC">Discover</option></select>
									<p class="tip">The type of credit card</p>
								</div>
								<div class="prompt iscard cardnumber">
									<label for="cardnumber">Credit card number</label>
									<input type="text" name="CARDNUMBER" id="cardnumber" maxlength="30" />
									<p class="tip">Your credit card number</p>
								</div>
								<div class="prompt iscard cardholdername">
									<label for="cardholdername">Name on card</label>
									<input type="text" name="CARDHOLDERNAME" id="cardholdername" maxlength="30" />
									<p class="tip">The name printed on your credit card</p>
								</div>
								<div class="prompt iscard cvv2">
									<label for="cvv2">CVV2 code</label>
									<input type="text" name="CVV2" id="cvv2" maxlength="4" />
									<p class="tip">The 3 or 4 digit security code on your card</p>
								</div>
								<div class="prompt iscard cardexpiration">
									<label for="cardexpiration_month">Card expiration date</label>
									<select name="CARDEXPIRATION_MONTH" id="cardexpiration_month" class="datemonth"><option value="1">January (1)</option><option value="2">February (2)</option><option value="3">March (3)</option><option value="4">April (4)</option><option value="5">May (5)</option><option value="6">June (6)</option><option value="7">July (7)</option><option value="8">August (8)</option><option value="9">September (9)</option><option value="10">October (10)</option><option value="11">November (11)</option><option value="12">December (12)</option></select>
									<select name="CARDEXPIRATION_YEAR" id="cardexpiration_year" class="dateyear"><option value="11">2011</option><option value="12">2012</option><option value="13">2013</option><option value="14">2014</option><option value="15">2015</option></select>
									<p class="tip">Expiration date on your credit card</p>
								</div>
								<div class="prompt isbank bankdesc">
									<label for="bankdesc">Display name</label>
									<input type="text" name="BANKDESC" id="bankdesc" maxlength="30" />
									<p class="tip">This is the name you see for this account</p>
								</div>
								<div class="prompt isbank banktype">
									<label for="banktype">Bank account type</label>
									<select name="BANKTYPE" id="banktype"><option value="c">Checking</option><option value="s">Savings</option></select>
									<p class="tip">The type of bank account</p>
								</div>
								<div class="notes isbank">
									<p><img src="{$csspath}/images/checkinfo.png" alt="" style="width:280px;" /></p>
								</div>
								<div class="prompt isbank bankaccount">
									<label for="bankaccount">Account number</label>
									<input type="text" name="BANKACCOUNT" id="bankaccount" maxlength="30" />
									<p class="tip">Your bank account number</p>
								</div>
								<div class="prompt isbank bankaccount_confirm">
									<label for="bankaccount_confirm">Account number (confirm)</label>
									<input type="text" name="BANKACCOUNT_CONFIRM" id="bankaccount_confirm" maxlength="30" />
									<p class="tip">Repeat your bank account number</p>
								</div>
								<div class="prompt isbank bankroute">
									<label for="bankroute">Bank routing number</label>
									<input type="text" name="BANKROUTE" id="bankroute" maxlength="30" />
									<p class="tip">The routing number to your bank?</p>
								</div>
								<div class="prompt isbank driverslicensenumber">
									<label for="driverslicensenumber">Driver's license number</label>
									<input type="text" name="DRIVERS_LICENSE_NUMBER" id="driverslicensenumber" maxlength="30" />
									<p class="tip">Your driving license number</p>
								</div>
								<div class="prompt isbank driverslicensestate">
									<label for="driverslicensestate">Driver's license state</label>
									<select name="DRIVERS_LICENSE_STATE" id="driverslicensestate"><option value="">Choose...</option>{foreach from=$states key=si item=st}<option value="{$st}">{$st}</option>{/foreach}</select>
									<p class="tip">State on your driver license</p>
								</div>
								<div class="prompt isbank driverslicenseexpiration">
									<label for="driverslicenseexpiration_month">Driver license expiration</label>
									<select name="DRIVERS_LICENSE_EXPIRATION_MONTH" id="driverslicenseexpiration_month" class="datemonth"><option value="1">January (1)</option><option value="2">February (2)</option><option value="3">March (3)</option><option value="4">April (4)</option><option value="5">May (5)</option><option value="6">June (6)</option><option value="7">July (7)</option><option value="8">August (8)</option><option value="9">September (9)</option><option value="10">October (10)</option><option value="11">November (11)</option><option value="12">December (12)</option></select>
									<select name="DRIVERS_LICENSE_EXPIRATION_YEAR" id="driverslicenseexpiration_year" class="dateyear"><option value="11">2011</option><option value="12">2012</option><option value="13">2013</option><option value="14">2014</option><option value="15">2015</option><option value="16">2016</option><option value="17">2017</option><option value="18">2018</option><option value="19">2019</option><option value="20">2020</option></select>
									<p class="tip">Your driving license's expiration date</p>
								</div>
								
							</div>
							<div class="isbank bankroutecheck"></div>
							
							<div class="notes">
								<p>Debit Authorization</p>
								<p>I hereby authorize InCashMe&#8482; to process electronic debits that I initiate to my account listed above to fund my InCashMe&#8482; account.</p>
								<p>I understand this authorization will remain in effect until this particular financial institution account is removed from my InCashMe&#8482; list of Money Sources.</p>
							</div>
							
							<script type="text/javascript">
								$(document).ready(function() {
									$("#type").change(function() {
										if ($(this).val() == "CreditCard") {
											$(this).parents("form").find(".iscard").stop().slideDown();
											$(this).parents("form").find(".isbank").stop().slideUp();
										}
										if ($(this).val() == "BankAccount") {
											$(this).parents("form").find(".iscard").stop().slideUp();
											$(this).parents("form").find(".isbank").stop().slideDown();
										}
									}).trigger("change");
									$("#cardtype").change(function() {
										var type = $(this).val();
										if (type == "AMER") {
											$("#cvv2").attr("maxlength", 4);
										} else {
											if ($("#cvv2").val().length > 3) {
												$("#cvv2").val($("#cvv2").val().substr(0, 3));
											}
											$("#cvv2").attr("maxlength", 3);
										}
									}).trigger("change");
									$("#bankroute").blur(function() {
										if ($(this).val().length == 9) {
											var url = "{$formbase}profile/getroutingnumber";
											var rval = $(this).val();
											$.post(url, {
												ROUTING: rval
											}, function(data) {
												var bankname = data;
												if (bankname != "") {
													var actions = new Array();
													actions["mybankyes close"] = "Yes";
													actions["mybankno close"] = "No";
													$.wigialert("Is this your bank? <strong>"+bankname+"</strong>", actions);
												} else {
													$(".bankroutecheck").html("");
												}
											});
										} else {
											$(".bankroutecheck").html("");
										}
									});
									$(".mybankyes").live("click", function() {
										var bankname = $(this).parents(".popup").find("p strong").html();
										$(".bankroutecheck").html("<p>Your bank is <strong>"+bankname+"</strong>.</p>");
									});
									$(".mybankno").live("click", function() {
										$(".bankroute").find("input").val("").blur();
										$(".bankroutecheck").html("");
									});
								});
							</script>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="add" />
									<input type="submit" value="Add" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addedmoney">
						
						<h4>Add money source</h4>
						
						<p>Your new account has been added.</p>
						
						{if $moneytype == "bankaccount"}
						<p>You now need to <a href="{$formbase}profile/confirmmoney/ITEM/{$ITEM}">confirm your account</a>. We have deposited two small random amounts to the bank account you provided. You will need to check your bank account statement (online or paper) to see the amounts and confirm them. After confirmation, these amounts will automatically appear on your InCashMe&#8482; account.</p>
						{/if}
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}