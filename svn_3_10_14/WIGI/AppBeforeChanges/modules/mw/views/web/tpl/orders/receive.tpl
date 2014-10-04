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
							<li><a href="{$formbase}orders/scanandpay">Scan &amp; Pay</a></li>
							<li><a href="{$formbase}orders/scanandbuy">Scan &amp; Buy</a></li>
							<li><a href="{$formbase}orders/ecommerce">eCommerce</a></li>
							<li{if $businessusertype != 5} class="disabled"{/if}><a href="{$formbase}orders/donations">Donations</a></li>
							<li class="selected"><a href="{$formbase}orders/receive">Receive</a></li>
							<li><a href="{$formbase}orders/payments">Payments</a></li>
							<li><a href="{$formbase}orders/posdevices">POS devices</a></li>
						</ul>
						
					</div>
					
					<div class="setup receive">
						
						<h4>Receive</h4>
						
						<form action="{$formbase}orders/receive" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="RDF" value="{$RDF}" class="date receivedate datefrom" /></li>
										<li>To <input type="text" name="RDT" value="{$RDT}" class="date receivedate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="RAF" value="{$RAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="RAT" value="{$RAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Customer phone number</strong></p>
									<ul class="prompt phone">
                                        <li><input type="text" name="RC" value="{$RC}" maxlength="10" /></li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Update" />
								</li>
							</ul>
						</form>
						<script type="text/javascript">
							$(document).ready(function() {
								var dates = $(".receivedate").datepicker({
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
									<div class="dcol col2">From</div>
									<div class="dcol col3">Message</div>
									<div class="dcol col4">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['receive']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['receive']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['receive']['orders'][loop].first_name} {$orders['receive']['orders'][loop].last_name}</strong></div>
											<div class="dcol col3">{$orders['receive']['orders'][loop].description}</div>
											<div class="dcol col4">US${number_format({$orders['receive']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div>
													<p><strong>Receive Transaction Information</strong></p>
													<ul>
														<li>Order #: {$orders['receive']['orders'][loop].order_id}</li>
														<li>
															Customer name: {$orders['receive']['orders'][loop].first_name} {$orders['receive']['orders'][loop].last_name}
															<ul>
																<li>Customer address: {$orders['receive']['orders'][loop].addr_line1}{if $orders['receive']['orders'][loop].addr_line2 != null} {$orders['receive']['orders'][loop].addr_line2}{/if}, {$orders['receive']['orders'][loop].city}, {$orders['receive']['orders'][loop].state} {$orders['receive']['orders'][loop].zip}</li>
																<li>Customer email: {$orders['receive']['orders'][loop].consumer_email}</li>
																<li>Customer phone: {$orders['receive']['orders'][loop].cellphone}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Payment Code: {$orders['receive']['orders'][loop].wigi_code}</li>
														<li>Payment amount: US${$orders['receive']['orders'][loop].price}</li>
														<li>Payment status: {$orders['receive']['orders'][loop].status}</li>
													</ul>
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
						
						{if $orders['receive']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['receive']['pages']}
									{if $orders['receive']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['receive']['page'] > 4)}
											<li{if $orders['receive']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/receive/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">...</a></a></li>
										{/if}
										{if (($orders['receive']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['receive']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['receive']['pages'])}
											<li{if $orders['receive']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/receive/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['receive']['pages']-2) and ($orders['receive']['page'] < $orders['receive']['pages']-6)}
											<li{if $orders['receive']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/receive/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['receive']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/receive/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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