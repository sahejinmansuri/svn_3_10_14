{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Edit cell preferences</li>
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
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Edit cellphone preferences</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editcellpreferences formlayout subformlayout">
						<h4 class="widgettitle">Edit cell phone preferences</h4>
						<div class="widgetcontent" >
						<!--<h4>Edit cell phone preferences</h4>-->
						
						<p>Each InCashMe&#8482; cell phone has its own set of preferences in addition to the account preferences. For added security, cell phone preferences can not be set higher than the account preferences. This ensures that shared accounts can be managed from the website and spending policies are enforced.</p>
						
						<form action="{$formbase}profile/editcellprefs" method="post" class="stdform">
							<h4 class="widgettitle">General preferences</h4>
							
							<div class="widgetcontent" >
								{if true == false}
								<p>
									<label>Minimum balance ₹</label>
									<span class="field">
										<input type="text" name="MINBALANCE" id="minbalance" value="{number_format($preferences['wigi']['minbal'], 2, '.', ',')}" />
									</span>
									<small class="desc">Minimum balance to keep on cell phone</small>
								</p>
								{/if}
								<p>
									<label>Mobile app timeout</label>
									<span class="field">
										<select name="APPTIMEOUT" id="apptimeout">{section name=apptimeout_loop loop=6 start=1}<option value="{(($smarty.section.apptimeout_loop.index) * 60)}"{if ($smarty.section.apptimeout_loop.index * 60) == $preferences['system']['timeout']} selected="selected"{/if}>{($smarty.section.apptimeout_loop.index)} minute{if ($smarty.section.apptimeout_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Set an interval for the app timeout</small>
								</p>
							
								<p>
									<label>International transactions</label>
									<span class="field">
										<select name="INTERNATIONALTRANS" id="internationaltrans" disabled="disabled"><option value="false"{if "false" == $preferences['wigi']['international_trans']} selected="selected"{/if}>Deny</option><option value="true"{if "true" == $preferences['wigi']['international_trans']} selected="selected"{/if}>Allow</option></select>
									</span>
									<small class="desc">Allow or deny international transactions</small>
								</p>
								{if true == false}
								<p>
									<label>Statement method</label>
									<span class="field">
										<select name="STATEMENTMETHOD" id="statementmethod"><option value="Email"{if "Email" == $preferences['notification']['statement']} selected="selected"{/if}>Email</option><option value="SMS"{if "SMS" == $preferences['notification']['statement']} selected="selected"{/if}>SMS</option></select>
									</span>
									<small class="desc">The way you would like to receive statements</small>
								</p>
								{/if}
								{if true == false}
								<p>
									<label>Timezone</label>
									<span class="field">
										<select name="TIMEZONE" id="timezone">{foreach from=$timezones key=gmt item=gmtname}<option value="{$gmt}"{if $gmt == $preferences['system']['timezone']} selected="selected"{/if}>{$gmtname}</option>{/foreach}</select>
									</span>
									<small class="desc">Set the cell phone's timezone</small>
								</p>
								{/if}
								
								<!--{if true == false}
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
								{if true == false}
								<div class="prompt statementmethod">
									<label for="statementmethod">Statement method</label>
									<select name="STATEMENTMETHOD" id="statementmethod"><option value="Email"{if "Email" == $preferences['notification']['statement']} selected="selected"{/if}>Email</option><option value="SMS"{if "SMS" == $preferences['notification']['statement']} selected="selected"{/if}>SMS</option></select>
									<p class="tip">The way you would like to receive statements</p>
								</div>
								{/if}
								{if true == false}
								<div class="prompt timezone">
									<label for="timezone">Timezone</label>
									<select name="TIMEZONE" id="timezone">{foreach from=$timezones key=gmt item=gmtname}<option value="{$gmt}"{if $gmt == $preferences['system']['timezone']} selected="selected"{/if}>{$gmtname}</option>{/foreach}</select>
									<p class="tip">Set the cell phone's timezone</p>
								</div>
								{/if}-->
								
							</div>
							<h4 class="widgettitle">InCashMe&#8482; Money Payment Code preferences</h4>
							<div class="widgetcontent" >
								<p>
									<label>Maximum amount per transaction ₹</label>
									<span class="field">
										<input type="text" name="MAXAMOUNT" id="maxamount" value="{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}" />
									</span>
									<small class="desc">Maximum allowed amount per transaction</small>
								</p>
								<p>
									<label>Maximum number of transactions per day</label>
									<span class="field">
										<select name="MAXDAY" id="maxday">{section name=maxday_loop loop=11 start=0}<option value="{($smarty.section.maxday_loop.index)}"{if $smarty.section.maxday_loop.index == $preferences['wigi']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxday_loop.index)} transaction{if ($smarty.section.maxday_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Maximum allowed number of transactions per day</small>
								</p>
								<p>
									<label>Alerts</label>
									<span class="field">
										<select name="RECEIPTMETHOD" id="receiptmethod"><option value="Email"{if "Email" == $preferences['notification']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['notification']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['notification']['alert']} selected="selected"{/if}>via Both</option></select>
									</span>
									<small class="desc">The way you would like to receive receipts</small>
								</p>
								<p>
									<label>InCashMe&#8482; Money Payment Code timeout</label>
									<span class="field">
										<select name="WIGITIMEOUT" id="wigitimeout">{section name=wigitimeout_loop loop=6 start=1}<option value="{($smarty.section.wigitimeout_loop.index)}"{if $smarty.section.wigitimeout_loop.index == $preferences['wigi']['timeout']} selected="selected"{/if}>{($smarty.section.wigitimeout_loop.index)} minute{if ($smarty.section.wigitimeout_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Set an interval for the InCashMe&#8482; Money Payment Code (IMPC™) timeout</small>
								</p>
								
								<!--<div class="prompt maxamount amount">
									<label for="maxamount">Maximum amount per transaction ₹</label>
									<input type="text" name="MAXAMOUNT" id="maxamount" value="{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}" />
									<p class="tip">Maximum allowed amount per transaction</p>
								</div>
								<div class="prompt maxday">
									<label for="maxday">Maximum number of transactions per day</label>
									<select name="MAXDAY" id="maxday">{section name=maxday_loop loop=11 start=0}<option value="{($smarty.section.maxday_loop.index)}"{if $smarty.section.maxday_loop.index == $preferences['wigi']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxday_loop.index)} transaction{if ($smarty.section.maxday_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Maximum allowed number of transactions per day</p>
								</div>
								<div class="prompt receiptmethod">
									<label for="receiptmethod">Alerts</label>
									<select name="RECEIPTMETHOD" id="receiptmethod"><option value="Email"{if "Email" == $preferences['notification']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['notification']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['notification']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>
								<div class="prompt wigitimeout">
									<label for="wigitimeout">InCashMe&#8482; Money Payment Code timeout</label>
									<select name="WIGITIMEOUT" id="wigitimeout">{section name=wigitimeout_loop loop=6 start=1}<option value="{($smarty.section.wigitimeout_loop.index)}"{if $smarty.section.wigitimeout_loop.index == $preferences['wigi']['timeout']} selected="selected"{/if}>{($smarty.section.wigitimeout_loop.index)} minute{if ($smarty.section.wigitimeout_loop.index) != 1}s{/if}</option>{/section}</select>
									<p class="tip">Set an interval for the InCashMe&#8482; Money Payment Code (IMPC™) timeout</p>
								</div>-->
							</div>
							
							<h4 class="widgettitle">Send money/gift preferences</h4>
							<div class="widgetcontent" >
								<p>
									<label>Maximum amount per transaction ₹</label>
									<span class="field">
										<input type="text" name="MAXGIFTAMOUNT" id="maxgiftamount" value="{number_format($preferences['gift']['max_per_trans'], 2, '.', ',')}" />
									</span>
									<small class="desc">Maximum allowed amount per sent transaction</small>
								</p>
								<p>
									<label>Maximum number of transactions per day</label>
									<span class="field">
										<select name="MAXGIFTDAY" id="maxgiftday">{section name=maxgiftday_loop loop=11 start=0}<option value="{($smarty.section.maxgiftday_loop.index)}"{if $smarty.section.maxgiftday_loop.index == $preferences['gift']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxgiftday_loop.index)} transaction{if ($smarty.section.maxgiftday_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Maximum allowed number of transactions sent per day</small>
								</p>
								<p>
									<label>Alerts</label>
									<span class="field">
										<select name="GIFTALERT" id="giftalert"><option value="Email"{if "Email" == $preferences['gift']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['gift']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['gift']['alert']} selected="selected"{/if}>via Both</option></select>
									</span>
									<small class="desc">The way you would like to receive receipts</small>
								</p>
								
								<!--<div class="prompt maxgiftamount amount">
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
									<select name="GIFTALERT" id="giftalert"><option value="Email"{if "Email" == $preferences['gift']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['gift']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['gift']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>-->
								
							</div>
							
							<h4 class="widgettitle">Scan Payment System preferences</h4>
							<div class="widgetcontent" >
								<p>
									<label>Maximum amount per transaction ₹</label>
									<span class="field">
										<input type="text" name="MAXSCANAMOUNT" id="maxscanamount" value="{number_format($preferences['scan']['max_per_trans'], 2, '.', ',')}" />
									</span>
									<small class="desc">Maximum allowed amount per sent transaction</small>
								</p>
								<p>
									<label>Maximum number of transactions per day</label>
									<span class="field">
										<select name="MAXSCANDAY" id="maxscanday">{section name=maxgiftday_loop loop=11 start=0}<option value="{($smarty.section.maxgiftday_loop.index)}"{if $smarty.section.maxgiftday_loop.index == $preferences['scan']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxgiftday_loop.index)} transaction{if ($smarty.section.maxgiftday_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Maximum allowed number of transactions sent per day</small>
								</p>
								<p>
									<label>Alerts</label>
									<span class="field">
										<select name="SCANALERT" id="scanalert"><option value="Email"{if "Email" == $preferences['scan']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['scan']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['scan']['alert']} selected="selected"{/if}>via Both</option></select>
									</span>
									<small class="desc">The way you would like to receive receipts</small>
								</p>
							
								
								<!--<div class="prompt maxscanamount amount">
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
								</div>-->
								
							</div>
							
							
							<h4 class="widgettitle">Funding preferences</h4>
							<div class="widgetcontent" >
								<p>
									<label>Maximum amount per funding ₹</label>
									<span class="field">
										<input type="text" name="MAXFUNDAMOUNT" id="maxfundamount" value="{number_format($preferences['funding']['max_per_trans'], 2, '.', ',')}" />
									</span>
									<small class="desc">Maximum allowed amount per funding</small>
								</p>
								<p>
									<label>Maximum number of fundings per day</label>
									<span class="field">
										<select name="MAXFUNDDAY" id="maxfundday">{section name=maxfundday_loop loop=11 start=0}<option value="{($smarty.section.maxfundday_loop.index)}"{if $smarty.section.maxfundday_loop.index == $preferences['funding']['max_per_day']} selected="selected"{/if}>{($smarty.section.maxfundday_loop.index)} transaction{if ($smarty.section.maxfundday_loop.index) != 1}s{/if}</option>{/section}</select>
									</span>
									<small class="desc">Maximum allowed number of fundings per day</small>
								</p>
								<p>
									<label>Alerts</label>
									<span class="field">
										<select name="ALERTFUND" id="alertfund"><option value="Email"{if "Email" == $preferences['funding']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['funding']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['funding']['alert']} selected="selected"{/if}>via Both</option></select>
									</span>
									<small class="desc">The way you would like to receive receipts</small>
								</p>
								
								<!--<div class="prompt maxfundamount amount">
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
									<select name="ALERTFUND" id="alertfund"><option value="Email"{if "Email" == $preferences['funding']['alert']} selected="selected"{/if}>via Email</option><option value="SMS"{if "SMS" == $preferences['funding']['alert']} selected="selected"{/if}>via SMS</option><option value="Both"{if "Both" == $preferences['funding']['alert']} selected="selected"{/if}>via Both</option></select>
									<p class="tip">The way you would like to receive receipts</p>
								</div>-->
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" class="btn btn-info" />
								<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Cancel</a>
								
							</div>
						
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedcellpreferences">
						
						<h4 class="widgettitle">Edit cell phone preferences</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone preferences have been updated.</p>
						
						<a href="{$formbase}profile/home#cellphones" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}