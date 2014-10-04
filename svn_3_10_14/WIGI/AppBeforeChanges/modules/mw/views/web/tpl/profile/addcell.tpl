{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup addposdevice formlayout subformlayout">
						
						<h4>Add device</h4>
						
						<p>You will need to install the Wigime&#8482; App on your device and verify your device by activating it with the activation code that you will receive from us. Android and iPhone are supported.</p>
						
						<form action="{$formbase}profile/addcell" method="post">
							
							<div class="stepbox">
								
								<div class="prompt celldesc">
									<label for="celldesc">Display name</label>
									<input type="text" name="CELLDESC" id="celldesc" maxlength="30" />
									<p class="tip">This will be the name you see for this device</p>
								</div>
								<div class="prompt cellphone">
									<label for="countrycode">Device</label>
									<select id="countrycode" name="COUNTRYCODE"><option value="US">1 (United States of America)</option></select>
									<input type="text" name="CELLPHONE" id="cellphone" size="12" value="" maxlength="16" />
									<p class="tip">Your device number</p>
								</div>
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" maxlength="7" />
									<p class="tip">Enter new PIN number (7 digits, unordered)</p>
								</div>
								<div class="prompt pin_confirm">
									<label for="pin_confirm">PIN (confirm)</label>
									<input type="password" name="PIN_CONFIRM" id="pin_confirm" maxlength="7" />
									<p class="tip">Repeat PIN number</p>
								</div>
								<div class="prompt question">
									<label for="question">Security question</label>
									<select name="QUESTION" id="question">{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
									<p class="tip">Choose a security question</p>
								</div>
								<div class="prompt answer">
									<label for="answer">Security answer</label>
									<input type="text" name="ANSWER" id="answer" maxlength="15" />
									<p class="tip">Enter a security answer</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="add" />
									<input type="submit" value="Add" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addedposdevice">
						
						<h4>Add device</h4>
						
						<p>Your new device has been added.</p>
						
						<p>Now, all you need to do is install the InCashMe&#8482; App on your device. Android and iPhone are supported.</p>
						<p>You also need to verify your device by activating it with the activation code that you will receive from us.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup addedposdevice">
						
						<h4>Add device</h4>
						
						<p>Your device cannot be added.</p>
						<p>It's already in use in a different InCashMe&#8482; account.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#posdevices">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}