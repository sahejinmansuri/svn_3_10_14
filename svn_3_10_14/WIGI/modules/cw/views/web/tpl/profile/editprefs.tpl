{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
{include file='content_header.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpreferences formlayout subformlayout">
						
						<h4>Edit preferences</h4>
						
						<p>These preferences apply to your whole account, not the individual cell phones.</p>
						
						<form action="{$formbase}profile/editprefs" method="post">
							
							<h5>General preferences</h5>
							<div class="stepbox">
								
								{if true == false}
								<div class="prompt minbalance">
									<label for="minbalance">Minimum balance ₹</label>
									<input type="text" name="MINBALANCE" id="minbalance" value="{number_format($preferences['wigi']['minbal'], 2, '.', ',')}" />
									<p class="tip">Minimum balance to keep on cell phone</p>
								</div>
								{/if}
								<div class="prompt apptimeout">
									<label for="apptimeout">Mobile app timeout</label>
									<select name="APPTIMEOUT" id="apptimeout">{section name=apptimeout_loop loop=6 start=1}<option value="{(($smarty.section.apptimeout_loop.index) * 60)}"{if ($smarty.section.apptimeout_loop.index * 60) == $preferences['system']['timeout']} selected="selected"{/if}>{($smarty.section.apptimeout_loop.index)} minute{if ($smarty.section.apptimeout_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Set an interval for the app timeout</p>
								</div>
								<div class="prompt internationaltrans">
									<label for="webaccesstimeout">International transactions</label>
									<select name="INTERNATIONALTRANS" id="internationaltrans" disabled="disabled"><option value="false"{if "false" == $preferences['wigi']['international_trans']} selected="selected"{/if}>Deny</option><option value="true"{if "true" == $preferences['wigi']['international_trans']} selected="selected"{/if}>Allow</option></select>
									<p class="tip">Allow or deny international transactions</p>
								</div>
								<div class="prompt receipttmethod">
									<label for="receiptmethod">Alerts</label>
									<select name="RECEIPTMETHOD" id="receiptmethod"><option value="Email"{if "Email" == $preferences['notification']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['notification']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['gift']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>
								{if true == false}
								<div class="prompt statementmethod">
									<label for="statementmethod">Statement method</label>
									<select name="STATEMENTMETHOD" id="statementmethod"><option value="Email"{if "Email" == $preferences['notification']['statement']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['notification']['statement']} selected="selected"{/if}>via SMS</option></select>
									<p class="tip">The way you would like to receive statements</p>
								</div>
								{/if}
								<div class="prompt timezone">
									<label for="timezone">Timezone</label>
									<select name="TIMEZONE" id="timezone">{foreach from=$timezones key=gmt item=gmtname}<option value="{$gmt}"{if $gmt == $preferences['system']['timezone']} selected="selected"{/if}>{$gmtname}</option>{/foreach}</select>
									<p class="tip">Set your timezone</p>
								</div>
								
							</div>
							
							<h5>InCashMe&#8482; Payment Code preferences</h5>
							<div class="stepbox">
								
								<div class="prompt maxamount amount">
									<label for="maxamount">Maximum amount per transaction ₹</label>
									<input type="text" name="MAXAMOUNT" id="maxamount" value="{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}" />
									<p class="tip">Maximum allowed amount per transaction</p>
								</div>
								<div class="prompt maxday">
									<label for="maxday">Maximum number of transactions per day</label>
									<select name="MAXDAY" id="maxday">{section name=maxday_loop loop=11 start=0}<option value="{($smarty.section.maxday_loop.index)}"{if $smarty.section.maxday_loop.index == $preferences['wigi']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxday_loop.index)} transaction{if ($smarty.section.maxday_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Maximum allowed number of transactions per day</p>
								</div>
								<div class="prompt wigitimeout">
									<label for="wigitimeout">InCashMe&#8482; Money Payment Code timeout</label>
									<select name="WIGITIMEOUT" id="wigitimeout">{section name=wigitimeout_loop loop=6 start=1}<option value="{($smarty.section.wigitimeout_loop.index)}"{if $smarty.section.wigitimeout_loop.index == $preferences['wigi']['timeout']} selected="selected"{/if}>{($smarty.section.wigitimeout_loop.index)} minute{if ($smarty.section.wigitimeout_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Set an interval for the InCashMe&#8482; Money Payment Code (IMPC™) timeout</p>
								</div>
								
							</div>
							
							<h5>Send money/gift preferences</h5>
							<div class="stepbox">
								
								<div class="prompt maxgiftamount amount">
									<label for="maxgiftamount">Maximum amount per transaction ₹</label>
									<input type="text" name="MAXGIFTAMOUNT" id="maxgiftamount" value="{number_format($preferences['gift']['max_per_trans'], 2, '.', ',')}" />
									<p class="tip">Maximum allowed amount per sent transaction</p>
								</div>
								<div class="prompt maxgiftday">
									<label for="maxgiftday">Maximum number of transactions per day</label>
									<select name="MAXGIFTDAY" id="maxgiftday">{section name=maxgiftday_loop loop=11 start=0}<option value="{($smarty.section.maxgiftday_loop.index)}"{if $smarty.section.maxgiftday_loop.index == $preferences['gift']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxgiftday_loop.index)} transaction{if ($smarty.section.maxgiftday_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Maximum allowed number of transactions sent per day</p>
								</div>
								<div class="prompt giftalert">
									<label for="giftalert">Alerts</label>
									<select name="GIFTALERT" id="giftalert"><option value="Email"{if "Email" == $preferences['gift']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['gift']['alert']} selected="selected"{/if}>via SMS</option>
									<option value="Both"{if "Both" == $preferences['gift']['alert']} selected="selected"{/if}>via Both</option>
									</select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>
								
							</div>
							
							<h5>Scan Payment System preferences</h5>
							<div class="stepbox">
								
								<div class="prompt maxscanamount amount">
									<label for="maxscanamount">Maximum amount per transaction ₹</label>
									<input type="text" name="MAXSCANAMOUNT" id="maxscanamount" value="{number_format($preferences['scan']['max_per_trans'], 2, '.', ',')}" />
									<p class="tip">Maximum allowed amount per sent transaction</p>
								</div>
								<div class="prompt maxscanday">
									<label for="maxscanday">Maximum number of transactions per day</label>
									<select name="MAXSCANDAY" id="maxscanday">{section name=maxgiftday_loop loop=11 start=0}<option value="{($smarty.section.maxgiftday_loop.index)}"{if $smarty.section.maxgiftday_loop.index == $preferences['scan']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxgiftday_loop.index)} transaction{if ($smarty.section.maxgiftday_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Maximum allowed number of transactions sent per day</p>
								</div>
								<div class="prompt scanalert">
									<label for="scanalert">Alerts</label>
									<select name="SCANALERT" id="scanalert"><option value="Email"{if "Email" == $preferences['scan']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['scan']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['scan']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>
								
							</div>
							
							<h5>Funding preferences</h5>
							<div class="stepbox">
								
								<div class="prompt maxfundamount amount">
									<label for="maxfundamount">Maximum amount per funding ₹</label>
									<input type="text" name="MAXFUNDAMOUNT" id="maxfundamount" value="{number_format($preferences['funding']['max_per_trans'], 2, '.', ',')}" />
									<p class="tip">Maximum allowed amount per funding</p>
								</div>
								<div class="prompt maxfundday">
									<label for="maxfundday">Maximum number of fundings per day</label>
									<select name="MAXFUNDDAY" id="maxfundday">{section name=maxfundday_loop loop=11 start=0}<option value="{($smarty.section.maxfundday_loop.index)}"{if $smarty.section.maxfundday_loop.index == $preferences['funding']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxfundday_loop.index)} transaction{if ($smarty.section.maxfundday_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Maximum allowed number of fundings per day</p>
								</div>
								<div class="prompt alertfund">
									<label for="alertfund">Alerts</label>
									<select name="ALERTFUND" id="alertfund"><option value="Email"{if "Email" == $preferences['funding']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['funding']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['gift']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
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