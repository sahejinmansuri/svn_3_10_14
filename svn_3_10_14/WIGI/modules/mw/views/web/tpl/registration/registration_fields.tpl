			<div id="signup" class="formlayout">
				
				<form action="{$formbase}registration/register" method="post">
					
					<div class="notes">
						<p>Before you start, you need to be able to access your email account</p>
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Merchant Information</h3>
						</div>
						
						<div class="prompt businessname">
							<label for="businessname">Official Business Name</label>
							<input type="text" name="BUSINESS_NAME" id="businessname" maxlength="30" value="{$BUSINESS_NAME}" />
							<p class="tip">What is the official name of the business?</p>
						</div>
						<div class="prompt dbaname">
							<label for="dbaname">DBA Name</label>
							<input type="text" name="BUSINESS_DBA_NAME" id="dbaname" maxlength="30" value="{$BUSINESS_DBA_NAME}" />
							<p class="tip">Doing business as?</p>
						</div>
						<div class="prompt contactfirstname">
							<label for="contactfirstname">Contact First Name</label>
							<input type="text" name="FIRST_NAME" id="contactfirstname" maxlength="30" value="{$FIRST_NAME}" />
							<p class="tip">What is the first name of the contact?</p>
						</div>
						<div class="prompt contactlastname">
							<label for="contactlastname">Contact Last Name</label>
							<input type="text" name="LAST_NAME" id="contactlastname" maxlength="30" value="{$LAST_NAME}" />
							<p class="tip">What is the last name of the contact?</p>
						</div>
						<div class="prompt businessphone phone">
							<label for="countrycode">Business Phone</label>
							<select id="countrycode" name="COUNTRY_CODE"><option value="1">91 (IN)</option></select>
							<input type="text" name="BUSINESS_PHONE" id="businessphone" size="12" maxlength="16" value="{$BUSINESS_PHONE}" />
							<p class="tip">What is the phone number of the business?</p>
						</div>
						<div class="prompt businesstype">
							<label for="businesstype">Business Type</label>
							<select name="BUSINESS_TYPE" id="businesstype">
								<option value=""></option>{foreach from=$business_types key=k item=v}<option value="{$k}">{$v}</option>{/foreach}
							</select>
							<p class="tip">What type is the business?</p>
						</div>
						<div class="prompt businesstaxid">
							<label for="businessssn">Tax ID / SSN</label>
							<input type="text" name="BUSINESS_TAX_ID" id="businesstaxid" maxlength="30" value="{$BUSINESS_TAX_ID}" />
							<p class="tip">What is the tax ID, or individual SSN?</p>
						</div>
						<div class="prompt businessregistrationnumber">
							<label for="businessregistrationnumber">501(c)(3) Registration</label>
							<input type="text" name="501C" id="businessregistrationnumber" maxlength="30" value="{$501C}" />
							<p class="tip">What is the 501(c)(3) registration number?</p>
						</div>
						<div class="prompt businessstateofinc">
							<label for="businessstateofinc">State of Incorporation</label>
							<select name="STATE_OF_INC" id="businessstateofinc"><option value=""></option>{foreach from=$states key=si item=st}<option value="{$st}">{$st}</option>{/foreach}</select>
							<p class="tip">What is the state of incorporation?</p>
						</div>
						<div class="prompt businessurl">
							<label for="businessurl">Business URL</label>
							<input type="text" name="BUSINESS_URL" id="businessurl" maxlength="30" value="{$BUSINESS_URL}" />
							<p class="tip">What is the URL address for your business?</p>
						</div>
						
						<div class="notes">
							<p>Your business information will be validated</p>
						</div>
						
					</div>
					
					<script type="text/javascript">
						$(document).ready(function() {
							$("#businesstype").change(function() {
								/*if ($(this).val() == 1 || $(this).val() == 2) {
									$(".businessssn").stop().slideDown();
									$(".businesstaxid").stop().slideUp();
								} else {
									$(".businessssn").stop().slideUp();
									$(".businesstaxid").stop().slideDown();
								}*/
								if ($(this).val() == 3 || $(this).val() == 4 || $(this).val() == 5) {
									$(".businessstateofinc").stop().slideDown();
								} else {
									$(".businessstateofinc").stop().slideUp();
								}
								if ($(this).val() == 5) {
									$(".businessregistrationnumber").stop().slideDown();
								} else {
									$(".businessregistrationnumber").stop().slideUp();
								}
							}).trigger("change");
						});
					</script>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Address Information</h3>
						</div>
						
						<div class="prompt zip">
							<label for="zip">Zip Code</label>
							<input type="text" name="ZIP" id="zip" maxlength="6" value="{$ZIP}" />
							<p class="tip">What is your zip code?</p>
						</div>
						<div class="prompt address">
							<label for="address">Address 1</label>
							<input type="text" name="ADDRESS" id="address" maxlength="30" value="{$ADDRESS}" />
							<p class="tip">What is your address?</p>
						</div>
						<div class="prompt address2">
							<label for="address">Address 2</label>
							<input type="text" name="ADDRESS2" id="address2" maxlength="30" value="{$ADDRESS2}" />
							<p class="tip">Apartment, suite, etc.</p>
						</div>
						<div class="prompt city">
							<label for="city">City</label>
							<input type="text" name="CITY" id="city" maxlength="24" value="{$CITY}" />
							<p class="tip">Enter your city</p>
						</div>
						<div class="prompt state">
							<label for="state">State</label>
							{if true == false}<select name="STATE" id="state"><option value="">Choose...</option>{foreach from=$states key=si item=st}<option value="{$st}"{if $STATE == $st} selected="selected"{/if}>{$st}</option>{/foreach}</select>{/if}
							<input type="text" name="STATE" id="state" value="{$STATE}" />
							<p class="tip">Select your state</p>
						</div>
					
					</div>
					
					<div class="stepbox">
					
						<div class="notes">
							<h3>Web Access Setup</h3>
							<p>Your Web Login ID will be your email address</p>
						</div>
						
						<div class="prompt email">
							<label for="email">Web Login ID</label>
							<input type="text" name="EMAIL" id="email" maxlength="60" value="{$EMAIL}" />
							<p class="tip">Enter your email address</p>
						</div>
						<div class="prompt email_confirm">
							<label for="email_confirm">Web Login ID (confirm)</label>
							<input type="text" name="EMAIL_CONFIRM" id="email_confirm" maxlength="60" value="{$EMAIL}" />
							<p class="tip">Repeat your email address</p>
						</div>
						<div class="prompt password">
							<div class="password_strength"><div class="level"></div></div>
							<label for="password">Password</label>
							<input type="password" name="PASSWORD" id="password" maxlength="30" />
							<p class="tip">Enter your password (min. 8 characters)</p>
						</div>
						<div class="prompt password_confirm">
							<label for="password_confirm">Password (confirm)</label>
							<input type="password" name="PASSWORD_CONFIRM" id="password_confirm" maxlength="30" />
							<p class="tip">Repeat password</p>
						</div>
						<div class="prompt pin">
							<label for="pin">PIN</label>
							<input type="password" name="PIN" id="pin" maxlength="7" />
							<p class="tip">Enter PIN number (7 digits)</p>
						</div>
						<div class="prompt pin_confirm">
							<label for="pin_confirm">PIN (confirm)</label>
							<input type="password" name="PIN_CONFIRM" id="pin_confirm" maxlength="7" />
							<p class="tip">Repeat PIN number</p>
						</div>
					
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<h3>Security Questions</h3>
						</div>
						
						<div class="prompt question">
							<label for="question">Security Question</label>
							<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
							<p class="tip">Choose a security question</p>
						</div>
						<div class="prompt answer">
							<label for="answer">Security Answer</label>
							<input type="text" name="ANSWER" id="answer" maxlength="15" value="{$ANSWER}" />
							<p class="tip">Enter security answer</p>
						</div>
						
					</div>
					
					<div class="stepbox">
						
						<div class="notes">
							<p>The email you provided will be used to activate the account</p>
						</div>
						
					</div>
					
					<div class="submit">
						
						<div class="notes">
							<p>By clicking below, I certify that the information I have provided is correct,<br />and that I have read and agree to the <a href="http://wigime.com/termsandconditions.php" target="_blank">Terms and Conditions</a></p>
							<input type="hidden" name="NAME" value="" />
							<input type="hidden" name="OSID" value="" />
							<input type="hidden" name="CREATED_VIA" value="Web" />
							<input type="submit" value="Create Account" id="register" />
						</div>
						
					</div>
					
				</form>
				
			</div>