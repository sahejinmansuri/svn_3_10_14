{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			{if $showcontent == "form"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div id="step1">
						
						<form action="{$formbase}login/forgotloginid" method="post" autocomplete="off">
							
							<div class="stepbox">
							
								<div class="notes">
									<h3>Forgot your Login ID?</h3>
								</div>
								
								<div class="prompt businesssearch">
									<label for="businesssearch">Please enter SSN/EIN</label>
									<input type="text" name="EIN" id="ein" maxlength="12" />
									<p class="tip">SSN/EIN of your company</p>
								</div>

								<div class="prompt businesssearch">
									<label for="businesssearch">Business name</label>
									<input type="text" name="BSEARCH" id="businesssearch" maxlength="60" />
									<p class="tip">The name of your business</p>
								</div>
                                
							</div>
								
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="forgot" />
									<input type="submit" value="Search" />
								</div>
								
							</div>
							
						</form>
						
					</div>
					
				</div>
				
			{elseif $showcontent == "form2"}
				
				<div id="forgotpasswd" class="formlayout">
						
					<div id="step2">
						
						<form action="{$formbase}login/home" method="post" autocomplete="off">
								
								<div class="notes">
									<h3>Forgot your Login ID?</h3>
								</div>
								
                                <div class="notes">
                                    {if $login_id}
                                        <p>Your login id is: {$login_id}</p>
                                    {else}
                                        <p>No Businesses Found.</p>
                                    {/if}
                                </div>
															
							</div>
								
							<div class="submit">
								<div class="notes">
									<input type="submit" value="Login {if $login_id}Now{/if}" id="reminder" />
								</div>
							</div>
							
						</form>
						
					</div>
					
				</div>
				
			{elseif $showcontent == "success"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div class="setup editedquestions">
						
						<div class="notes">
							<h3>Forgot your Login ID?</h3>
						</div>
						
						<p>Your email address on file will be emailed to notify you which email address you registered with.</p>
						
						<p><a href="{$formbase}login/home">Back</a></p>
						
					</div>
					
				</div>
				
			{elseif $showcontent == "error"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div class="setup editedquestions">
						
						<div class="notes">
							<h3>Forgot your Login ID?</h3>
						</div>
						
						<p>The information you have entered is invalid. Please try again.</p>
						
						<p><a href="{$formbase}login/forgotloginid">Back</a></p>
						
					</div>
					
				</div>
				
			{/if}
			
		</div>
		
	</div>
	
{include file='footer.tpl'}