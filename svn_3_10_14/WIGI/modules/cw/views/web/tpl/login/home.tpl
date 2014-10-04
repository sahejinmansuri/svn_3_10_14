{include file='header.tpl'}
{include file='error.tpl'}
<!--{include file='sidebar.tpl'}-->
<!--{include file='content_header.tpl'}-->
<style type="text/css">

	  
		  /* forms */
		  #login1 { 
		  font-size: 13px;
		  white-space:normal;
		 }

</style>
<script type="text/javascript">

</script>
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Login</li>
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
			<!--<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>-->
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Web Access</h1>
            </div>
        </div>
	<div class="box_wide">
		<div id="page">
			
			<div id="login" class="formlayout">
				
				<div id="step1" class="loginstep  box-info ">
					
					<form action="{$formbase}login/sendtoken" method="post" autocomplete="off"  class="stdform">
						
						<div class="stepbox">
						
							<div class="notes">
								<!--<h3>Web Access</h3>-->
								<p>Before you start, you should have your registered cell phone handy and on<br />An SMS/TXT Authentication Code will be sent to your default cell phone/email address</p>
								<p>Please enter your Web Login ID and Password</p>
							</div>
							<h4 class="widgettitle">Web Access</h4>
							<div class="widgetcontent"> 
								<p>
									<label>Web Login ID</label>
									<span class="field">
										<input type="text" name="LOGIN" id="email" maxlength="60" value="" />
									</span>
									<small class="desc">Enter your email address</small>
								</p>
								<p>
									<label>Password</label>
									<span class="field">
										<input type="password" name="PASSWD" id="password" maxlength="30" value="" />
									</span>
									<small class="desc">Enter your password</small>
								</p>
								<div class="form-group">
									<div class="col-md-offset-2 col-md-10">
										<div class="checkbox">
											<!--<label>
												<div class="checker" id="uniform-undefined"><span>
													<input type="checkbox" name="remember" id="remember" value="1" />
												</span></div> 
												Remember Login ID
											</label>-->
											<label>
												<span class="login_remember">
													<input type="checkbox" name="remember" id="remember" value="1">
												</span>
												Remember Login ID
											</label>
										</div>
									</div>
								</div>
								<p>
									<label>Send Authentication code by : </label>
									<span class="field">
										<select id="mtype" name="mtype" onchange="mayurMind()">
											<option value="email">Email</option>
											<option value="sms">SMS</option>
										</select>
									</span>
								</p>
								<div class="submit">
									<div class="notes">
										<input type="hidden" name="MSGTYPE" id="msgtype" value="email" />
										<button class="btn btn-info" type="submit" id="login1" class="nosubmit" >Send Authentication Code to your default Email Address</button>
										<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
									</div>
									
								</div>
								<!--<div class="prompt email">
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
								</div>-->
							</div>
						</div>
						
						<!--<div class="stepbox">Send Authentication code by : 
							<select id="mtype" name="mtype" onchange="mayurMind()">
								<option value="email">Email</option>
								<option value="sms">SMS</option>
							</select>
						</div>-->
						
						
						<div class="notes morelinks">
							
							<p class="buttons_login">
								<!--<a href="{$formbase}registration/home">Create a InCashMe&#8482; Account</a><br />-->
								<a href="{$formbase}login/forgotpasswd" class="btn btn-info"><small>Forgot your password?</small></a>
								<a href="{$formbase}login/lostcell" class="btn btn-info"><small>Default cell phone not handy or Locked?</small></a>
							</p>
							
						</div>
						
					</form>
					
				</div>
				
				<div id="step2" class="confirmation  box-info">
					
					<form action="{$formbase}login/auth" method="post" class="stdform">
						<h4 class="widgettitle">Web Access</h4>
							<div class="widgetcontent"> 
						<div class="stepbox">
							
							<div class="notes">
								<p>Your Authentication Code is being delivered<br />via a text message/email to your cell phone/email address...</p>
							</div>
							
							
								<p>
									<label>Authentication Code</label>
									<span class="field">
										<input type="text" name="CODE" id="safepasscode" />
									</span>
									<small class="desc">You should receive this shortly</small>
								</p>
								
							<!--<div class="prompt safepasscode">
								<label for="safepasscode">Authentication Code</label>
								<input type="text" name="CODE" id="safepasscode" />
								<p class="tip">You should receive this shortly</p>
							</div>-->
							
						</div>
						
						<div class="confirm">
							
							<div class="notes">
								<input type="submit" value="Confirm" id="confirm" class="nosubmit btn-info" />
								<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
							</div>
							
						</div>
						
						<div class="notes morelinks">
							
							<p class="buttons_login">
								<a href="#" class="return btn btn-info"><small>Send a new Authentication Code</small></a>
							</p>
							
						</div>
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