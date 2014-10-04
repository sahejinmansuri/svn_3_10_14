{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="lastlogin">
					<p>Last login: {$lastlogin}<br />IP address: {$lastip}</p>
				</div>
				
				<div class="setup dashboardinfo">
					
					<h4>Merchant info</h4>
					
					{if $haslogo == true}
						<img src="{$formbase}profile/viewlogo" alt="{$businessname}" class="merchantlogo" />
					{/if}
                                        {if $is_npo == true}
                                        <a href="{$formbase}advanced/merchantidqrcode" target="_blank"><img src="{$formbase}advanced/merchantidqrcode" alt="QR Code" class="merchantlogo" /></a>
                                        {/if}
					
				</div>
				
				{if true == false}
				<div class="setup posdevices table">
					
					<h4>Devices</h4>
					
					<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Type</div>
								<div class="dcol col2">Name</div>
								<div class="dcol col5">Daily grand total</div>
								<div class="dcol col6">Daily total charge</div>
								<div class="dcol col7">Daily total tax</div>
								<div class="dcol col8">Daily total tip</div>
							</div>
						</div>
						<div class="dbody">
							{foreach from=$cellphones item=v name=cellphones_loop}
								<div id="{$v.mobile_id}" class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
									<div class="dnormal">
										<div class="dcol col1">
											{if $v.phone_brand == "iPhone"}
												<img src="{$csspath}/images/deviceiphone.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
											{elseif $v.phone_brand == "Android"}
												<img src="{$csspath}/images/deviceandroid.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
											{else}
												<img src="{$csspath}/images/deviceunknown.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
											{/if}
										</div>
										<div class="dcol col2">
											<strong>{$v.alias}</strong>
										</div>
										<div class="dcol col5">
											₹{number_format({$postotals[$v.mobile_id]['grand_total']}, 2, '.', ',')}
										</div>
										<div class="dcol col6">
											₹{number_format({$postotals[$v.mobile_id]['charge_total']}, 2, '.', ',')}
										</div>
										<div class="dcol col7">
											₹{number_format({$postotals[$v.mobile_id]['tax_total']}, 2, '.', ',')}
										</div>
										<div class="dcol col8">
											₹{number_format({$postotals[$v.mobile_id]['tip_total']}, 2, '.', ',')}
										</div>
									</div>
								</div>
							{foreachelse}
								<div class="drow">
	                        		<div class="dcol"><em>There are no devices associated with your account.</em></div>
	                        	</div>
	                        {/foreach}
						</div>
					</div>
					
					<p class="more">
						<a href="{$formbase}profile/home#posdevices">See device information &rsaquo;</a>
					</p>
					
				</div>
				{/if}
				
				<div class="setup transactions table">
					
					<h4>Recent account transactions</h4>
					
					<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Date</div>
								<div class="dcol col2">Device</div>
								<div class="dcol col3">Description</div>
								<div class="dcol col4">Amount</div>
							</div>
						</div>
						<div class="dbody">
							{section name=transaction_loop loop=$trans max=5}
								<div id="{$trans[transaction_loop].transaction_id}" class="drow{if $smarty.section.transaction_loop.index%2} drowalt{/if}">
									<div class="dnormal{if $trans[transaction_loop].viewed == 0} dunread{/if}">
										<div class="dcol col1">{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</div>
										<div class="dcol col2"><strong>{$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["last_name"]}</strong> {$trans[transaction_loop].from_description}</div>
										<div class="dcol col3">{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</div>
										<div class="dcol col4">₹{number_format({$trans[transaction_loop].amount}, 2, '.', ',')}</div>
									</div>
								</div>
							{sectionelse}
								<div class="drow">
	                        		<div class="dcol"><em>There are no transactions.</em></div>
	                        	</div>
	                        {/section}
						</div>
					</div>
					
					<p class="more">
						<a href="{$formbase}history/home">See all transactions &rsaquo;</a>
					</p>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
