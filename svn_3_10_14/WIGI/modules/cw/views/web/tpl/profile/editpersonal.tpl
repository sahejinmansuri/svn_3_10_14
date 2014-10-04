{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
{include file='content_header.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div id="profile" class="setup editpersonal formlayout subformlayout">
						
						<h4>Edit personal information</h4>
						
						<form action="{$formbase}profile/editpersonal" method="post">
							
							<div class="stepbox">
								
								<div class="prompt firstname">
									<label for="firstname">Legal first name</label>
									<input type="text" name="FIRST_NAME" id="firstname" maxlength="30" value="{$FIRST_NAME}" />
									<p class="tip">What is your first name?</p>
								</div>
								<div class="prompt lastname">
									<label for="lastname">Legal last name</label>
									<input type="text" name="LAST_NAME" id="lastname" maxlength="30" value="{$LAST_NAME}" />
									<p class="tip">What is your last name?</p>
								</div>
								<div class="prompt email">
									<label for="email">Your email</label>
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
									<select id="countrycode" name="COUNTRYCODE"><option value="IN">91 (India)</option></select>
									<input type="text" name="ALTPHONE" id="altphone" size="12" value="" maxlength="16" />
									<p class="tip">Your alternate 10-digit phone number (home, work, etc.)</p>
								</div>
								<div class="prompt birthdate">
									<label for="birth_month">Date of birth</label>
									<select name="BIRTH_MONTH" id="birth_month" class="datemonth">{section name=birth_month_loop loop=$birthdatemonths start=0}<option value="{($smarty.section.birth_month_loop.index + 1)}"{if ($smarty.section.birth_month_loop.index + 1) == $birthdate_month} selected="selected"{/if}>{$birthdatemonths[$smarty.section.birth_month_loop.index + 1]}</option>{/section}</select>
									<select name="BIRTH_DAY" id="birth_day" class="dateday">{section name=birth_day_loop loop=$birthdatedays start=0}<option value="{($smarty.section.birth_day_loop.index + 1)}"{if ($smarty.section.birth_day_loop.index + 1) == $birthdate_day} selected="selected"{/if}>{($smarty.section.birth_day_loop.index + 1)}</option>{/section}</select>
									<select name="BIRTH_YEAR" id="birth_year" class="dateyear">{section name=birth_year_loop loop=$birthdateyears start=1909}<option value="{($smarty.section.birth_year_loop.index + 1)}"{if ($smarty.section.birth_year_loop.index + 1) == $birthdate_year} selected="selected"{/if}>{($smarty.section.birth_year_loop.index + 1)}</option>{/section}</select>
									<p class="tip">Your date of birth for security reasons</p>
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
									<input type="text" name="COUNTRY" id="country" value="India" readonly="readonly" />
									<p class="tip">Select your country</p>
								</div>
							
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#personalinfo">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpersonal">
						
						<h4>Edit personal information</h4>
						
						<p>Your personal information has been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#personalinfo">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}