{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			<div id="login" class="formlayout">
				
				<div id="step1">
					
					<form action="{$formbase}login/auth" method="post" autocomplete="off">
						
						<div class="stepbox">
						
							<div class="notes">
								<h3>Admin Web Access</h3>
								<p>Please enter your Web Login ID and Password</p>
							</div>
							
							<div class="prompt adminusername">
								<label for="email">Web Login ID</label>
								<input type="text" name="LOGIN" id="email" maxlength="60" value="" />
								<p class="tip">Enter your username</p>
							</div>
							<div class="prompt password">
								<label for="password">Password</label>
								<input type="password" name="PASSWD" id="password" maxlength="30" value="" />
								<p class="tip">Enter your password</p>
							</div>
							
							<div class="tinyprompt">
								<input type="checkbox" name="remember" id="remember" value="1" />
								<label for="remember">Remember Login ID</label>
							</div>
						
						</div>
							
						<div class="submit">
							
							<div class="notes">
								<input type="hidden" name="MSGTYPE" id="msgtype" value="sms" />
								<input type="submit" value="Log in" id="login" />
								<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
							</div>
							
						</div>
						
						<div class="notes morelinks">
							
							<p>
								<a href="{$formbase}login/forgotpasswd">Forgot your password?</a>
							</p>
							
						</div>
						
					</form>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
