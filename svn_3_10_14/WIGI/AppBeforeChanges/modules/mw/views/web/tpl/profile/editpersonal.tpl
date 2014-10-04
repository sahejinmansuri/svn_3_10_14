{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div id="profile" class="setup editpersonal formlayout subformlayout">
						
						<h4>Edit merchant information</h4>
						
						<form action="{$formbase}profile/editpersonal" method="post" enctype="multipart/form-data">
							
							<div class="stepbox">
								
								<div class="prompt companylogo">
									<label for="companylogo">Company logo</label>
									<input type="button" name="COMPANYLOGO" id="companylogo" value="Select a file..." class="fileupload" />
									<p class="tip">You may upload a new company logo</p>
								</div>
								<div class="prompt businessname">
									<label for="businessname">Official business name</label>
									<input type="text" name="BUSINESS_NAME" id="businessname" maxlength="50" value="{$BUSINESS_NAME}" />
									<p class="tip">What is the official name of the business?</p>
								</div>
								<div class="prompt dbaname">
									<label for="dbaname">DBA name</label>
									<input type="text" name="DBANAME" id="dbaname" maxlength="30" value="{$DBANAME}" />
									<p class="tip">Doing business as?</p>
								</div>
								<div class="prompt contactfirstname">
									<label for="contactfirstname">Contact first name</label>
									<input type="text" name="FIRST_NAME" id="contactfirstname" maxlength="30" value="{$FIRST_NAME}" />
									<p class="tip">What is the first name of the contact?</p>
								</div>
								<div class="prompt contactlastname">
									<label for="contactlastname">Contact last name</label>
									<input type="text" name="LAST_NAME" id="contactlastname" maxlength="30" value="{$LAST_NAME}" />
									<p class="tip">What is the last name of the contact?</p>
								</div>
								<div class="prompt businessphone phone">
									<label for="countrycode">Business phone</label>
									<select id="countrycode" name="COUNTRY_CODE"><option value="1">1 (US)</option></select>
									<input type="text" name="BUSINESS_PHONE" id="businessphone" size="12" maxlength="16" value="{$BUSINESS_PHONE}" />
									<p class="tip">What is the 10-digit phone number of the business?</p>
								</div>
								<div class="prompt businesstype">
									<label for="businesstype">Business type</label>
									<input type="text" name="BUSINESS_TYPE" id="businesstype" maxlength="30" value="{$business_types[$BUSINESS_TYPE]}" readonly="readonly" />
									<p class="tip">What type is the business?</p>
								</div>
								<div class="prompt businesstaxid">
									<label for="businesstaxid">Business Tax ID or SSN</label>
									<input type="text" name="BUSINESS_TAX_ID" id="businesstaxid" maxlength="30" value="{$BUSINESS_TAX_ID}" readonly="readonly" />
									<p class="tip">What is the business tax ID or individual SSN?</p>
								</div>
								{if $B501C != null}
									<div class="prompt businessregistrationnumber">
										<label for="businessregistrationnumber">501(c)(3) Registration</label>
										<input type="text" name="501C" id="businessregistrationnumber" value="{$B501C}" readonly="readonly" />
										<p class="tip">What is the 501(c)(3) registration number?</p>
									</div>
								{/if}
								{if $STATE_OF_INC != null}
									<div class="prompt businessstateofinc">
										<label for="businessstateofinc">State of Incorporation</label>
										<input type="text" name="STATE_OF_INC" id="businessstateofinc" value="{$STATE_OF_INC}" readonly="readonly" />
										<p class="tip">What is the state of incorporation?</p>
									</div>
								{/if}
								<div class="prompt businessurl">
									<label for="businessurl">Business URL</label>
									<input type="text" name="BUSINESS_URL" id="businessurl" maxlength="30" value="{$BUSINESS_URL}" />
									<p class="tip">What is the URL address for your business?</p>
								</div>
								<div class="prompt email">
									<label for="email">Your email/User ID</label>
									<input type="text" name="EMAIL" id="email" maxlength="60" value="{$EMAIL}" readonly="readonly" />
									<p class="tip">Enter your email address</p>
								</div>
								<div class="prompt altemail">
									<label for="altemail">Alternate email</label>
									<input type="text" name="ALTEMAIL" id="altemail" maxlength="60" value="{$ALTEMAIL}" />
									<p class="tip">Enter an alternate email address</p>
								</div>
								<div class="prompt altphone">
									<label for="countrycode">Alternate phone</label>
									<select id="countrycode" name="COUNTRYCODE"><option value="US">1 (United States of America)</option></select>
									<input type="text" name="ALTPHONE" id="altphone" size="12" value="" maxlength="16" />
									<p class="tip">Your alternate 10-digit phone number (home, work, etc.)</p>
								</div>
								<div class="prompt zip">
									<label for="zip">Zip code</label>
									<input type="text" name="ZIP" id="zip" maxlength="5" value="{$ZIP}" />
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
									<select name="STATE" id="state"><option value=""></option>{foreach from=$states key=si item=st}<option value="{$st}"{if $STATE == $st} selected="selected"{/if}>{$st}</option>{/foreach}</select>
									<p class="tip">Select your state</p>
								</div>
								<div class="prompt country">
									<label for="country">Country</label>
									<input type="text" name="COUNTRY" id="country" value="United States of America" readonly="readonly" />
									<p class="tip">Select your country</p>
								</div>
							
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#merchantinfo">Cancel</a></li>
						</ul>
						
					</div>
					
					<script type="text/javascript">
						$(".fileupload").each(function() {
							var field = $(this);
							var fname = $(this).attr("name");
							var furl = "{$formbase}profile/addlogo";
							var successmsg = "<p>Your logo was successfully uploaded!</p>";
							$(this).upload({
								name: fname,
								action: furl,
								enctype: 'multipart/form-data',
								params: {},
								autoSubmit: true,
								onSubmit: function() {
									field.val(this.filename());
								},
								onComplete: function() {
									$.wigialert("Your logo has been successfully uploaded.");
								}
							});
						});
					</script>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpersonal">
						
						<h4>Edit merchant information</h4>
						
						<p>Your merchant information has been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#merchantinfo">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}