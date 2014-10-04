{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpreferences formlayout subformlayout">
						
						<h4>Edit preferences</h4>
						
						<p>These preferences apply to your whole account, not the individual cell phones.</p>
						
						<form action="{$formbase}profile/editprefs" method="post">
							
							<h5>General preferences</h5>
							<div class="stepbox">
								
								<div class="prompt acceptcash">
									<label for="acceptcash">Accept POS cash payments</label>
									<select name="ACCEPTCASH" id="acceptcash"><option value="true"{if $preferences['accept']['cash'] == "true"} selected="selected"{/if}>Yes</option><option value="false"{if $preferences['accept']['cash'] == "false"} selected="false"{/if}>No</option></select>
									<p class="tip">Do you accept cash payments?</p>
								</div>
								<div class="prompt acceptcreditcard">
									<label for="acceptcreditcard">Accept POS credit card payments</label>
									<select name="ACCEPTCREDITCARD" id="acceptcreditcard"><option value="true"{if $preferences['accept']['creditcard'] == "true"} selected="selected"{/if}>Yes</option><option value="false"{if $preferences['accept']['creditcard'] == "false"} selected="selected"{/if}>No</option></select>
									<p class="tip">Do you accept credit card payments?</p>
								</div>
								<div class="prompt acceptscanandpay">
									<label for="acceptscanandpay">Accept Scan &amp; Pay payments</label>
									<select name="ACCEPTSCANANDPAY" id="acceptscanandpay"><option value="true"{if $preferences['accept']['scanandpay'] == "true"} selected="selected"{/if}>Yes</option><option value="false"{if $preferences['accept']['scanandpay'] == "false"} selected="selected"{/if}>No</option></select>
									<p class="tip">Do you accept Scan &amp; Pay payments?</p>
								</div>
								<div class="prompt acceptscanandbuy">
									<label for="acceptscanandbuy">Accept Scan &amp; Buy payments</label>
									<select name="ACCEPTSCANANDBUY" id="acceptscanandbuy"><option value="true"{if $preferences['accept']['scanandbuy'] == "true"} selected="selected"{/if}>Yes</option><option value="false"{if $preferences['accept']['scanandbuy'] == "false"} selected="selected"{/if}>No</option></select>
									<p class="tip">Do you accept Scan &amp; Buy payments?</p>
								</div>
								<div class="prompt acceptecommerce">
									<label for="acceptecommerce">Accept eCommerce payments</label>
									<select name="ACCEPTECOMMERCE" id="acceptecommerce"><option value="true"{if $preferences['accept']['ecommerce'] == "true"} selected="selected"{/if}>Yes</option><option value="false"{if $preferences['accept']['ecommerce'] == "false"} selected="selected"{/if}>No</option></select>
									<p class="tip">Do you accept eCommerce payments?</p>
								</div>
								{if true == false}
								<div class="prompt acceptpos">
									<label for="acceptpos">Accept POS payments</label>
									<select name="ACCEPTPOS" id="acceptpos"><option value="true"{if $preferences['accept']['pos'] == "true"} selected="selected"{/if}>Yes</option></select>
									<p class="tip">Do you accept POS payments?</p>
								</div>
								{/if}
								<div class="prompt possecret">
									<label for="possecret">POS secret</label>
									<input type="text" name="POSSECRET" id="possecret" value="{$preferences['possecret']}" />
									<p class="tip">Password used to enable POS users</p>
								</div>
								<div class="prompt salestax">
									<label for="salestax">Sales tax</label>
									<input type="text" name="SALESTAX" id="salestax" value="{$preferences['salestax']}" />
									<p class="tip">Set tax on sales</p>
								</div>
								<div class="prompt tips">
									<label for="tips">Tips ₹</label>
									<input type="text" name="TIPS" id="tips" value="{$preferences['tips']}" />
									<p class="tip">Set tips</p>
								</div>
								<div class="prompt timezone">
									<label for="timezone">Timezone</label>
									<select name="TIMEZONE" id="timezone">{foreach from=$timezones key=gmt item=gmtname}<option value="{$gmt}"{if $gmt == $preferences['system']['timezone']} selected="selected"{/if}>{$gmtname}</option>{/foreach}</select>
									<p class="tip">Set your timezone</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="doaction" value="edit" />
									<input type="submit" value="Update" />
								</div>
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#preferences">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpreferences">
						
						<h4>Edit preferences</h4>
						
						<p>Your preferences have been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#preferences">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}