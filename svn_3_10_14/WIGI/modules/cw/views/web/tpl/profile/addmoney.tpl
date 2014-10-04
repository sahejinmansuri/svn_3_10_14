{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#moneysources">Money sources</a> <span class="separator"></span></li>
		<li>Add Money Source</li>
		{if $logged_in == 1}
		<li class="right">
			Last login: {$lastlogin}<br />IP address: {$lastip}
		</li>
		
		{/if}
	</ul>
	<div class="maincontent">
        <div class="maincontentinner">
			<div class="row">
				<div id="dashboard-left" class="col-md-12">
		<div class="pageheader">
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Add Money Source</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup addmoneysource formlayout subformlayout">
						<h4 class="widgettitle">Add money source</h4>
						<div class="widgetcontent" >
						<!--<h4>Add money source</h4>-->
						
						<form action="{$formbase}profile/addmoney" method="post" autocomplete="off" class="stdform">
							
							<p>
								<label>Source type</label>
								<span class="field">
									<select name="TYPE" id="type">{if $credit_cards < 2}<option value="CreditCard">Credit Card / Prepaid Card</option>{/if}{if $bank_accounts < 1}<option value="BankAccount">Bank Account</option>{/if}</select>
								</span>
								<small class="desc">Type of money source</small>
							</p>
							<p class="iscard">
								<label>Display name</label>
								<span class="field">
									<input type="text" name="CARDDESC" id="carddesc" maxlength="30" />
								</span>
								<small class="desc">This will be the name you see for this card</small>
							</p>
							<p class="iscard">
								<label>Credit card type</label>
								<span class="field">
									<select name="CARDTYPE" id="cardtype"><option value="VISA">Visa</option><option value="MAST">MasterCard</option>{if true == false}<option value="AMER">American Express</option>{/if}<option value="DISC">Discover</option></select>
								</span>
								<small class="desc">The type of credit card</small>
							</p>
							<p class="iscard">
								<label>Credit card number</label>
								<span class="field">
									<input type="text" name="CARDNUMBER" id="cardnumber" maxlength="30" />
								</span>
								<small class="desc">Your credit card number</small>
							</p>
							<p class="iscard">
								<label>Name on card</label>
								<span class="field">
									<input type="text" name="CARDHOLDERNAME" id="cardholdername" maxlength="30" />
								</span>
								<small class="desc">The name printed on your credit card</small>
							</p>
							<p class="iscard">
								<label>CVV2 code</label>
								<span class="field">
									<input type="text" name="CVV2" id="cvv2" maxlength="4" />
								</span>
								<small class="desc">The 3 or 4 digit security code on your card</small>
							</p>
							<p class="iscard">
								<label>Card expiration date</label>
								<span class="field">
									<select name="CARDEXPIRATION_MONTH" id="cardexpiration_month" class="datemonth"><option value="1">January (1)</option><option value="2">February (2)</option><option value="3">March (3)</option><option value="4">April (4)</option><option value="5">May (5)</option><option value="6">June (6)</option><option value="7">July (7)</option><option value="8">August (8)</option><option value="9">September (9)</option><option value="10">October (10)</option><option value="11">November (11)</option><option value="12">December (12)</option></select>
									<select name="CARDEXPIRATION_YEAR" id="cardexpiration_year" class="dateyear">
										<option value="11">2011</option>
										<option value="12">2012</option>
										<option value="13">2013</option>
										<option value="14">2014</option>
										<option value="15">2015</option>
										<option value="16">2016</option>
										<option value="17">2017</option>
										<option value="18">2018</option>
										<option value="19">2019</option>
										<option value="20">2020</option>
										<option value="21">2021</option>
										<option value="22">2022</option>
										<option value="23">2023</option>
										<option value="24">2024</option>
										<option value="25">2025</option>
										<option value="26">2026</option>
										<option value="27">2027</option>
										<option value="28">2028</option>
										<option value="29">2029</option>
										<option value="30">2030</option>
										<option value="31">2031</option>
										<option value="32">2032</option>
										<option value="33">2033</option>
										<option value="34">2034</option>
										<option value="35">2035</option>
										<option value="36">2036</option>
										<option value="37">2037</option>
										<option value="38">2038</option>
										<option value="39">2039</option>
										<option value="40">2040</option>
									</select>
								</span>
								<small class="desc">Expiration date on your credit card</small>
							</p>
							<p class="isbank">
								<label>Display name</label>
								<span class="field">
									<input type="text" name="BANKDESC" id="bankdesc" maxlength="30" />
								</span>
								<small class="desc">This is the name you see for this account</small>
							</p>
							<p class="isbank">
								<label>Bank account type</label>
								<span class="field">
									<select name="BANKTYPE" id="banktype"><option value="c">Checking</option><option value="s">Savings</option></select>
								</span>
								<small class="desc">The type of bank account</small>
							</p>
							<p class="isbank">
								<label>Bank account type</label>
								<span class="field">
									<img src="{$csspath}/images/checkinfo.png" alt="" style="width:280px;" />
								</span>
							</p>
							<p class="isbank">
								<label>Account number</label>
								<span class="field">
									<input type="text" name="BANKACCOUNT" id="bankaccount" maxlength="30" />
								</span>
								<small class="desc">Your bank account number</small>
							</p>
							<p class="isbank">
								<label>Account number (confirm)</label>
								<span class="field">
									<input type="text" name="BANKACCOUNT_CONFIRM" id="bankaccount_confirm" maxlength="30" />
								</span>
								<small class="desc">Repeat your bank account number</small>
							</p>
							<div class="notes">
								<p>Debit Authorization</p>
								<p>I hereby authorize InCashMe&#8482; to process electronic debits that I initiate to my account listed above to fund my InCashMe&#8482; account.</p>
								<p>I understand this authorization will remain in effect until this particular financial institution account is removed from my InCashMe&#8482; list of Money Sources.</p>
							</div>
							<!--<div class="stepbox">
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
									<select name="CARDEXPIRATION_YEAR" id="cardexpiration_year" class="dateyear">
										<option value="11">2011</option>
										<option value="12">2012</option>
										<option value="13">2013</option>
										<option value="14">2014</option>
										<option value="15">2015</option>
										<option value="16">2016</option>
										<option value="17">2017</option>
										<option value="18">2018</option>
										<option value="19">2019</option>
										<option value="20">2020</option>
										<option value="21">2021</option>
										<option value="22">2022</option>
										<option value="23">2023</option>
										<option value="24">2024</option>
										<option value="25">2025</option>
										<option value="26">2026</option>
										<option value="27">2027</option>
										<option value="28">2028</option>
										<option value="29">2029</option>
										<option value="30">2030</option>
										<option value="31">2031</option>
										<option value="32">2032</option>
										<option value="33">2033</option>
										<option value="34">2034</option>
										<option value="35">2035</option>
										<option value="36">2036</option>
										<option value="37">2037</option>
										<option value="38">2038</option>
										<option value="39">2039</option>
										<option value="40">2040</option>
									</select>
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
								
								
							</div>
							<div class="isbank bankroutecheck"></div>
							
							<div class="notes">
								<p>Debit Authorization</p>
								<p>I hereby authorize InCashMe&#8482; to process electronic debits that I initiate to my account listed above to fund my InCashMe&#8482; account.</p>
								<p>I understand this authorization will remain in effect until this particular financial institution account is removed from my InCashMe&#8482; list of Money Sources.</p>
							</div>-->
							
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
									<input type="submit" value="Add" class="btn btn-info" />
									<a href="{$formbase}profile/home#moneysources"><input type="button" value="Cancel" class="btn btn-info" /></a>
								</div>
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addedmoney">
						<h4 class="widgettitle">Add money source</h4>
						<div class="widgetcontent" >
						
						
						<p>Your new account has been added.</p>
						
						{if $moneytype == "bankaccount"}
						<p>You now need to <a href="{$formbase}profile/confirmmoney/ITEM/{$ITEM}">confirm your account</a>. We have deposited two small random amounts to the bank account you provided. You will need to check your bank account statement (online or paper) to see the amounts and confirm them. After confirmation, these amounts will automatically appear on your InCashMe&#8482; account.</p>
						{/if}
						<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}