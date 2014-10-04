{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			<div id="login" class="formlayout">
				
				<div id="step1">
					
					<form action="{$formbase}login/sendtoken" method="post" autocomplete="off">
						
						<div class="stepbox">
						
							<div class="notes">
								<h3>Web Access</h3>
								<p>Have you lost, or locked your cell phone?</p>
								<p>Before you start, you should have access to your email account<br />An Authentication Code will be sent to your email address</p>
								<p>Please enter your Web Login ID and Password</p>
							</div>
							
							<div class="prompt email">
								<label for="email">Web Login ID</label>
								<input type="text" name="LOGIN" id="email" maxlength="60" value="" />
								<p class="tip">Enter your email address</p>
								<p class="valid">Valid email</p>
								<p class="errormsg invalid">Your email address does not seem to be valid</p>
								<p class="errormsg taken">This email has already been registered</p>
								<p class="errormsg noempty">Your email address is required</p>
							</div>
							<div class="prompt password">
								<label for="password">Password</label>
								<input type="password" name="PASSWD" id="password" maxlength="30" value="" />
								<p class="tip">Enter your password</p>
								<p class="valid">Valid password</p>
								<p class="errormsg invalid">Your password is invalid</p>
								<p class="errormsg noempty">Password is required</p>
							</div>
							
							<div class="tinyprompt">
								<input type="checkbox" name="remember" id="remember" value="1" />
								<label for="remember">Remember Login ID</label>
							</div>
						
						</div>
							
						<div class="submit">
							
							<div class="notes">
								<input type="hidden" name="MSGTYPE" id="msgtype" value="email" />
								<input type="submit" value="Send Authentication Code to your Email" id="login" />
								<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
							</div>
							
						</div>
						
					</form>
					
				</div>
				
				<div id="step2" class="confirmation">
					
					<form action="{$formbase}login/auth" method="post">
						
						<div class="stepbox">
							
							<div class="notes">
								<h3>Web Access</h3>
								<p>Your Authentication Code is being delivered<br />via an email...</p>
								<p>Note: If you aren't receiving an email, please check the spam folder in your email account</p>
							</div>
							
							<div class="prompt safepasscode">
								<label for="safepasscode">Authentication Code</label>
								<input type="text" name="CODE" id="safepasscode" />
								<p class="tip">You should receive this shortly</p>
								<p class="errormsg noempty">Please enter Authentication Code</p>
							</div>
							
						</div>
						
						<div class="confirm">
							
							<div class="notes">
								<input type="submit" value="Confirm" id="confirm" />
								<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
							</div>
							
						</div>
						
						<div class="notes morelinks">
							
							<p>
								<a href="#" class="return">Send a new Authentication Code</a>
							</p>
							
						</div>
						
					</form>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}