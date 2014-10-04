{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
						
			<div class="information">
				
				<h4>Orders</h4>
				
				<div class="tabfield">
					
					<div class="tabnavigation">
						
						<ul>
							<li class="selected"><a href="{$formbase}orders/scanandpay">Scan &amp; Pay</a></li>
							<li><a href="{$formbase}orders/scanandbuy">Scan &amp; Buy</a></li>
							<li><a href="{$formbase}orders/ecommerce">eCommerce</a></li>
							<li><a href="{$formbase}orders/donations">Donations</a></li>
							<li><a href="{$formbase}orders/payments">Payments</a></li>
						</ul>
						
					</div>
					
					<div class="setup scanandpay">
						
						<h4>Scan &amp; Pay</h4>
						
						<form action="{$formbase}orders/scanandpay" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="SPDF" value="{$SPDF}" class="date scanandpaydate datefrom" /></li>
										<li>To <input type="text" name="SPDT" value="{$SPDT}" class="date scanandpaydate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="SPAF" value="{$SPAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="SPAT" value="{$SPAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Merchant / DBA name</strong></p>
									<ul>
										<li><select name="SPM"><option value="">All</option>{foreach from=$merchantnames item=m}<option value="{$m}"{if $m == $SPM} selected="selected"{/if}>{$m}</option>{/foreach}</select></li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Update" />
								</li>
							</ul>
						</form>
						<script type="text/javascript">
							$(document).ready(function() {
								var dates = $(".scanandpaydate").datepicker({
									onSelect: function(selectedDate) {
										var option = (this.className.indexOf("datefrom") != -1) ? "minDate" : "maxDate",
										instance = $(this).data("datepicker"),
										date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
										dates.not(this).datepicker("option", option, date);
									}
								});
							});
						</script>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Transaction<br />date</div>
									<div class="dcol col2">Merchant name</div>
									<div class="dcol col3">Status</div>
									<div class="dcol col4">Invoice #</div>
									<div class="dcol col5">Due date</div>
									<div class="dcol col6">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['pay']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['pay']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['pay']['orders'][loop].business_name}</strong></div>
											<div class="dcol col3">{$orders['pay']['orders'][loop].status}</div>
											<div class="dcol col4">{$orders['pay']['orders'][loop].sku}</div>
											<div class="dcol col5">{App_DataUtils::date2human($orders['pay']['orders'][loop].due_date,$tzpref,true)}</div>
											<div class="dcol col6">US${number_format({$orders['pay']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype sbordersbox">
												<div>
													<p><strong>Scan &amp; Pay Information</strong></p>
													<ul>
														<li>Order #: {$orders['pay']['orders'][loop].order_id}</li>
														<li>
															Payer name: {$orders['pay']['orders'][loop].business_name}
															<ul>
																<li>Payer phone: {$orders['pay']['orders'][loop].business_phone}</li>
																<li>Merchant URL: {$orders['pay']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['pay']['orders'][loop].wigi_code}</li>
														<li>Payment amount: US${$orders['pay']['orders'][loop].price}</li>
														<li>Payment status: {$orders['pay']['orders'][loop].status}</li>
														<li>Customer account number: {$orders['pay']['orders'][loop].user_acct_no}</li>
														<li>Invoice number: {if $orders['pay']['orders'][loop].sku != null}{$orders['pay']['orders'][loop].sku}{else}N/A{/if}</li>
														<li>Due date: {App_DataUtils::date2human($orders['pay']['orders'][loop].due_date,$tzpref,true)}</li>
													</ul>
													{if $orders['pay']['orders'][loop].status == "scheduled"}
														<ul class="rowactions">
															<li><a href="{$formbase}orders/deleteorder/T/scanandpay/ITEM/{$orders['pay']['orders'][loop].order_id}">Cancel payment</a></li>
														</ul>
													{/if}
												</div>
											</div>
										</div>
									</div>
								{sectionelse}
									<div class="drow">
		                        		<div class="dcol"><em>There are no orders.</em></div>
		                        	</div>
		                        {/section}
							</div>
						</div>
						
						{if $orders['pay']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['pay']['pages']}
									{if $orders['pay']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['pay']['page'] > 4)}
											<li{if $orders['pay']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandpay/?SPDF={$SPDF}&amp;SPDT={$SPDT}&amp;SPAF={$SPAF}&amp;SPAT={$SPAT}&amp;SPC={$SPC}&amp;SPP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
										{if (($orders['pay']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['pay']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['pay']['pages'])}
											<li{if $orders['pay']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandpay/?SPDF={$SPDF}&amp;SPDT={$SPDT}&amp;SPAF={$SPAF}&amp;SPAT={$SPAT}&amp;SPC={$SPC}&amp;SPP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['pay']['pages']-2) and ($orders['pay']['page'] < $orders['pay']['pages']-6)}
											<li{if $orders['pay']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandpay/?SPDF={$SPDF}&amp;SPDT={$SPDT}&amp;SPAF={$SPAF}&amp;SPAT={$SPAT}&amp;SPC={$SPC}&amp;SPP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['pay']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandpay/?SPDF={$SPDF}&amp;SPDT={$SPDT}&amp;SPAF={$SPAF}&amp;SPAT={$SPAT}&amp;SPC={$SPC}&amp;SPP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
									{/if}
								{/section}
							</ul>
						{/if}
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}