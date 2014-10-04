{include file='header.tpl'}
{include file='error.tpl'}
<!--{include file='sidebar.tpl'}-->
<!--	{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Login <span class="separator"></span> <li>Forgot Password</li></li>
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
                <h1>Forgot Password</h1>
            </div>
        </div>
	<div class="box_wide box-info">
		<div id="page">
			
			{if $showcontent == "form"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div id="step1" class="loginstep  box-info ">
						
						<form action="{$formbase}login/forgotpasswd" method="post" class="stdform" autocomplete="off">
							
							<div class="stepbox">
							
								<div class="notes">
									
								</div>
								<h4 class="widgettitle">Forgot your password?</h4>
								<div class="widgetcontent"> 
								<div class="prompt email">
									<label for="email">Web Login ID</label>
									<input type="text" name="LOGIN" id="email" maxlength="60" />
									<p class="tip">Enter your email address</p>
									<p class="valid">Valid email</p>
									<p class="errormsg invalid">Your email address does not seem to be valid</p>
									<p class="errormsg taken">This email has already been registered</p>
									<p class="errormsg noempty">Your email address is required</p>
								</div>
								<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="forgot" />
									<input type="submit" class="btn btn-info" value="Verify" />
								</div>
								
							</div>
								</div>
							</div>
								
							
							
						</form>
						
					</div>
					
				</div>
				
			{elseif $showcontent == "form2"}
				
				<div id="forgotpasswd" class="formlayout">
						
					<div id="step2" class="loginstep  box-info ">
						
						<form action="{$formbase}login/forgotpasswd" method="post" class="stdform" autocomplete="off">
								
								<div class="notes">
									<!--<h3>Forgot your password?</h3>-->
								</div>
								<h4 class="widgettitle">Forgot your password?</h4>
							<div class="widgetcontent"> 
								<div class="notes">
									<p>Please answer your following security question</p>
								</div>
								
								<div class="prompt question">
									<label for="question">Security Question</label>
									<input type="text" name="QUESTION" id="question" value="{$question}" readonly="readonly" />
									<p class="tip">Your security question</p>
								</div>
								<div class="prompt answer">
									<label for="answer">Security Answer</label>
									<input type="text" name="ANSWER" id="answer" maxlength="15" />
									<p class="tip">Enter security answer</p>
									<p class="errormsg invalid">Please choose another security answer</p>
									<p class="errormsg noempty">Please enter a security answer</p>
									<p class="errormsg noshort">Your security answer has to be min. 5 characters</p>
								</div>
							</div>
					</div>
								
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="LOGIN" value="{$LOGIN}" />
									<input type="hidden" name="doaction" value="forgot" />
									<input type="submit" value="Verify" id="reminder" />
								</div>
								
							</div>
							
						</form>
						
					</div>
					
				</div>
				
			{elseif $showcontent == "success"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div class="setup editedquestions">
						
						<div class="notes">
							
						</div>
						<h4 class="widgettitle">Forgot your password?</h4>
						<div class="widgetcontent"> 
						<p>We have sent you a new password to your email address.</p>
						<p>Note: If you aren't receiving an email, please check the spam folder in your email account.</p>
						
						<p><a href="{$formbase}login/home">Back</a></p>
						</div>
					</div>
					
				</div>
				
			{elseif $showcontent == "error"}
				
				<div id="forgotpasswd" class="formlayout">
					
					<div class="setup editedquestions">
						
						<div class="notes">
						<!--	<h3>Forgot your password?</h3>-->
						</div>
						<h4 class="widgettitle">Forgot your password?</h4>
						<div class="widgetcontent"> 
						<p>The information you have entered is invalid, or your account is not active. Please try again.</p>
						
						<p><a href="{$formbase}login/forgotpasswd"><input type="button" class="btn btn-info" value="Back"/></a></p>
						</div>
					</div>
					
				</div>
				
			{/if}
			
		</div>
		
	</div>
	
{include file='footer.tpl'}