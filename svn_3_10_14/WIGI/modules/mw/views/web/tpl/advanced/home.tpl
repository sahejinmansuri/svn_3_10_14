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
							{if true == false}
							<li><a href="#summary">Summary</a></li>
							<li><a href="#oscommerce">osCommerce</a></li>
							{/if}
							<li><a href="#sendpayments">Send payments</a></li>
						</ul>
						
					</div>
					
					{if true == false}
					
					<div class="tab setup summary">
						
						<h4>Summary</h4>
						
						<p>Coming Soon...</p>
						
					</div>
					
					<div class="tab setup oscommerce">
						
						<h4>osCommerce</h4>
						
						<div class="setup oscommercetoken formlayout subformlayout">
							
							<p>This field is used to enable integration with the osCommerce shopping cart.</p>
						
							{if $enabled == true}
								
								<div class="stepbox">
									
									<div class="prompt oscommercetoken">
										<label for="oscommercetoken">Token</label>
										<input type="text" name="TOKEN" id="oscommercetoken" value="{$token}" readonly="readonly" />
									</div>
									
								</div>
								
								<div class="submit">
									
									<input type="button" value="Enabled" disabled="disabled" />
									
									<p>osCommerce integration is already enabled.</p>
									
								</div>
								
							{else}
							
								<form action="{$formbase}advanced/home#oscommerce" method="post">
									
									<div class="stepbox">
										
										<div class="prompt oscommercetoken">
											<label for="oscommercetoken">Token</label>
											<input type="text" name="TOKEN" id="oscommercetoken" value="" readonly="readonly" />
										</div>
										
									</div>
									
									<div class="submit">
										
										<input type="submit" value="Enable" />
										
									</div>
									
								</form>
							
							{/if}
							
						</div>
						
					</div>
					
					{/if}
					
					<div class="tab setup sendpayments">
						
						<h4>Send payments</h4>
						<p>You can use this functionality to pay bills, make donations, pay employees, make refunds to customers etc.</p>
                            
						<div class="sendpaymentsform formlayout subformlayout">
							
							<form action="{$formbase}advanced/sendpayment" method="post">
								
								<div class="stepbox">
									
									<div class="prompt paymenttype">
										<label for="paymenttype">Send payment to</label>
										<select name="PAYMENT_TYPE" id="paymenttype"><option value="CONSUMER">Consumer</option><option value="MERCHANT">Merchant</option></select>
									</div>
									
									<div class="prompt merchantname ismw">
										<label for="merchantname">Merchant name</label>
										<input type="text" name="MERCHANT_NAME" id="merchantname" autocomplete="off" />
										<p class="tip">Recipient merchant's name</p>
									</div>
									
									<div class="prompt merchantnumber ismw">
										<label for="merchantnumber">Merchant number</label>
										<input type="text" name="MERCHANT_NUMBER" id="merchantnumber" readonly="readonly" />
										<p class="tip">Recipient merchant's number</p>
									</div>
									
									<div class="prompt cellphone iscw">
										<label for="countrycode">Cell phone</label>
										<select name="COUNTRYCODE" id="countrycode"><option value="1">91 (India)</option></select>
										<input type="text" name="CELLPHONE" id="cellphone" value="" maxlength="16" />
										<p class="tip">The 10-digit smartphone cell phone number you are sending payment to</p>
									</div>
									
									<div class="prompt firstname">
										<label for="firstname">First name</label>
										<input type="text" name="FIRST_NAME" id="firstname" readonly="readonly" />
										<p class="tip">Recipient's first name</p>
									</div>
									
									<div class="prompt lastname">
										<label for="lastname">Last name</label>
										<input type="text" name="LAST_NAME" id="lastname" readonly="readonly" />
										<p class="tip">Recipient's last name</p>
									</div>
									
									<div class="prompt city">
										<label for="city">City</label>
										<input type="text" name="CITY" id="city" readonly="readonly" />
										<p class="tip">Receipient's city</p>
									</div>
									
									<div class="prompt state">
										<label for="state">State</label>
										<input type="text" name="STATE" id="state" readonly="readonly" />
										<p class="tip">Receipient's state</p>
									</div>
									
									<div class="prompt amount">
										<label for="amount">Amount ₹</label>
										<input type="text" id="amount" name="AMOUNT" class="formfield" maxlength="7" value="0.00" />
										<p class="tip">The amount you would like to send</p>
									</div>
									
									<div class="prompt reasonmerchant ismw">
										<label for="reasonmerchant">Reason</label>
										<select name="REASON" id="reasonmerchant">
											<option value="">Choose...</option>
											<option value="Payment of invoices for products and services">Payment of invoices for products and services</option>
											<option value="Donations to qualified non-profits">Donations to qualified non-profits</option>
											<option value="Other">Other</option>
										</select>
										<p class="tip">What is the reason for your payment?</p>
									</div>
									
									<div class="prompt reasonconsumer iscw">
										<label for="reasonconsumer">Reason</label>
										<select name="REASON" id="reasonconsumer">
											<option value="">Choose...</option>
											<option value="Refund for past orders">Refund for past orders</option>
											<option value="Incentives and promotions">Incentives and promotions</option>
											<option value="Payment disbursement to employees">Payment disbursement to employees</option>
											<option value="Other">Other</option>
										</select>
										<p class="tip">What is the reason for your payment?</p>
									</div>
									
									<div class="prompt documentnumber ismw">
										<label for="documentnumber">Document number</label>
										<input type="text" name="DOCUMENT_NUMBER" id="documentnumber" />
										<p class="tip">You can enter an optional document number (PO, Invoice, etc.)</p>
									</div>
									
									<div class="prompt message">
										<label for="message">Message</label>
										<textarea name="MESSAGE" id="message"></textarea>
										<p class="tip">You can enter an optional message for the payment (max. 50 chars)</p>
									</div>
									
								</div>
								
								<div class="submit">
									<input type="submit" value="Send Payment" />
								</div>
								
							</form>
							
							<ul class="actionlinks">
								<li><a href="{$formbase}advanced/home/{time()}/#sendpayments">Cancel</a></li>
							</ul>
							
							<script type="text/javascript">
								$(document).ready(function() {
									$("#paymenttype").change(function() {
										if ($(this).val() == "CONSUMER") {
											$(this).parents("form").find(".iscw").stop().slideDown();
											$(this).parents("form").find(".ismw").stop().slideUp();
										}
										if ($(this).val() == "MERCHANT") {
											$(this).parents("form").find(".iscw").stop().slideUp();
											$(this).parents("form").find(".ismw").stop().slideDown();
											//$(".merchantname").slideUp();
											//$(".merchantnumber").slideUp();
										}
										$(".firstname").hide();
										$(".lastname").hide();
										$(".city").hide();
										$(".state").hide();
									}).trigger("change");
									$(".tabnavigation").find("a[href$='#sendpayments']").click(function() {
										$("#paymenttype").trigger("change");
									});
									$("#cellphone").blur(function() {
										if ($(this).val().length == 10) {
											var url = "{$formbase}advanced/getconsumername";
											var cval = $(this).val();
											var ccval = $("#countrycode").val();
											$.post(url, {
												CELLPHONE: cval,
												COUNTRYCODE: ccval
											}, function(data) {
												var consumer = data;
												if (consumer != "") {
													consumer = $.parseJSON(consumer);
													var fname = consumer.fname;
													var lname = consumer.lname;
													var city = consumer.city;
													var state = consumer.state;
													var actions = new Array();
													actions["senduseryes close"] = "Yes";
													actions["senduserno close"] = "No";
													$.wigialert("Is this the user you are sending payment to? <strong>"+fname+" "+lname+"</strong> ("+city+", "+state+")", actions);
													$(".firstname").find("input").val(fname);
													$(".lastname").find("input").val(lname);
													$(".city").find("input").val(city);
													$(".state").find("input").val(state);
												} else {
													$.wigialert("This phone is not a registered InCashMe&trade; user.");
													$(".firstname, .lastname, .city, .state").slideUp();
												}
											});
										} else {
											$("#cellphone").val("");
											$(".firstname, .lastname, .city, .state").slideUp();
										}
									});
									$(".senduseryes").live("click", function() {
										$(".firstname, .lastname, .city, .state").slideDown();
									});
									$(".senduserno").live("click", function() {
										$(".firstname").find("input").val("");
										$(".firstname, .lastname, .city, .state").slideUp();
									});
									var limitmessage = function() {
										var message = $(".message").find("textarea");
										if (message.val().length > 50) {
											message.val(message.val().substr(0, 50));
										}
										
									}
									$(".message").find("textarea").change(limitmessage);
									$(".message").find("textarea").keyup(limitmessage);
								});
							</script>
							
							<script type="text/javascript">
								$(document).ready(function() {
									$("#merchantname").each(function() {
										var merchantname = $(this);
										var merchantnumber = $("#merchantnumber");
										$.autosuggest(merchantname, "{$formbase}advanced/getmerchants", "NAME", merchantnumber);
										merchantnumber.live("change", function() {
											if ($(this).val().length > 0) {
												var suggestions = $.autosuggest();
												var business_id = $(this).val();
												suggestions = suggestions["data"];
												for (s in suggestions) {
													if (suggestions[s]["id"] == business_id) {
														var businessname = suggestions[s]["business_name"];
														var city = suggestions[s]["city"];
														var state = suggestions[s]["state"];
														var actions = new Array();
														actions["sendmerchantyes close"] = "Yes";
														actions["sendmerchantno close"] = "No";
														$.wigialert("Is this the merchant you are sending payment to? <strong>"+businessname+"</strong> ("+city+", "+state+")", actions);
														$(".city").find("input").val(city);
														$(".state").find("input").val(state);
													}
												}
											}
										});
									});
									$(".sendmerchantyes").live("click", function() {
										$(".city, .state").slideDown();
									});
									$(".sendmerchantno").live("click", function() {
										$(".merchantnumber, .city, .state").find("input").val("");
										$(".city, .state").slideUp();
									});
								});
							</script>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}