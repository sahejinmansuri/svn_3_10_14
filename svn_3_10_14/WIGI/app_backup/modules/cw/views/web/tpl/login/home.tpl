{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			<div id="login" class="formlayout">
				
				<div id="step1" class="loginstep">
					
					<form action="{$formbase}login/sendtoken" method="post" autocomplete="off">
						
						<div class="stepbox">
						
							<div class="notes">
								<h3>Web Access</h3>
								<p>Before you start, you should have your registered cell phone handy and on<br />An SMS/TXT Authentication Code will be sent to your default cell phone/email address</p>
								<p>Please enter your Web Login ID and Password</p>
							</div>
							
							<div class="prompt email">
								<label for="email">Web Login ID</label>
								<input type="text" name="LOGIN" id="email" maxlength="60" value="" />
								<p class="tip">Enter your email address</p>
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
						
						<div class="stepbox">Send Authentication code by : 
							<select id="mtype" name="mtype" onchange="mayurMind()">
								<option value="email">Email</option>
								<option value="sms">SMS</option>
							</select>
						</div>
						<div class="submit">
							
							<div class="notes">
								<input type="hidden" name="MSGTYPE" id="msgtype" value="email" />
								<input type="submit" value="Send Authentication Code to your default Email Address" id="login1" class="nosubmit" />
								<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
							</div>
							
						</div>
						
						<div class="notes morelinks">
							
							<p>
								<a href="{$formbase}registration/home">Create a InCashMe&#8482; Account</a><br />
								<a href="{$formbase}login/forgotpasswd">Forgot your password?</a><br />
								<a href="{$formbase}login/lostcell">Default cell phone not handy or Locked?</a>
							</p>
							
						</div>
						
					</form>
					
				</div>
				
				<div id="step2" class="confirmation">
					
					<form action="{$formbase}login/auth" method="post">
						
						<div class="stepbox">
							
							<div class="notes">
								<h3>Web Access</h3>
								<p>Your Authentication Code is being delivered<br />via a text message/email to your cell phone/email address...</p>
							</div>
							
							<div class="prompt safepasscode">
								<label for="safepasscode">Authentication Code</label>
								<input type="text" name="CODE" id="safepasscode" />
								<p class="tip">You should receive this shortly</p>
							</div>
							
						</div>
						
						<div class="confirm">
							
							<div class="notes">
								<input type="submit" value="Confirm" id="confirm" class="nosubmit" />
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
	<script>
		function mayurMind() {
			var op = document.getElementById("mtype");
			var sel = op.options[op.selectedIndex].value;
			document.getElementById("msgtype").value=sel;
                        if(sel=='sms') {
                            document.getElementById("login1").value="Send Authentication Code to your default Cell Phone";
			} else {
                            document.getElementById("login1").value="Send Authentication Code to your default Email Address";
                        }
                }
	</script>
	
{include file='footer.tpl'}