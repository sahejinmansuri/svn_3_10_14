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
							<li class="selected"><a href="{$formbase}orders/scanandbuy">Scan &amp; Buy</a></li>
							<li><a href="{$formbase}orders/ecommerce">eCommerce</a></li>
							<li{if $businessusertype != 5} class="disabled"{/if}><a href="{$formbase}orders/donations">Donations</a></li>
							<li><a href="{$formbase}orders/receive">Receive</a></li>
							<li><a href="{$formbase}orders/payments">Payments</a></li>
							<li><a href="{$formbase}orders/posdevices">POS devices</a></li>
						</ul>
						
					</div>
					
					<div class="setup scanandbuy">
						
						<h4>Scan &amp; Buy</h4>
						
						<form action="{$formbase}orders/scanandbuy" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="SBDF" value="{$SBDF}" class="date scanandbuydate datefrom" /></li>
										<li>To <input type="text" name="SBDT" value="{$SBDT}" class="date scanandbuydate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="SBAF" value="{$SBAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="SBAT" value="{$SBAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Customer phone number</strong></p>
									<ul class="prompt phone">
										<li><input type="text" name="SBC" value="{$SBC}" maxlength="10" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Status</strong></p>
									<ul>
										<li>
											<select name="SBS">
												<option{if $SBS == null} selected="selected"{/if} value="">All</option>
												<option{if $SBS == "pending"} selected="selected"{/if} value="pending">Pending</option>
												<option{if $SBS == "completed"} selected="selected"{/if} value="completed">Completed</option>
												<option{if $SBS == "cancelled"} selected="selected"{/if} value="cancelled">Cancelled</option>
											</select>
										</li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Update" />
								</li>
							</ul>
						</form>
						<script type="text/javascript">
							$(document).ready(function() {
								var dates = $(".scanandbuydate").datepicker({
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
									<div class="dcol col2">Customer name</div>
									<div class="dcol col3">Customer account #</div>
									<div class="dcol col4">Invoice #</div>
									<div class="dcol col5">Status</div>
									<div class="dcol col6">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['buy']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['buy']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['buy']['orders'][loop].first_name} {$orders['buy']['orders'][loop].last_name}</strong></div>
											<div class="dcol col3">{$orders['buy']['orders'][loop].user_acct_no}</div>
											<div class="dcol col4">{$orders['buy']['orders'][loop].sku}</div>
											<div class="dcol col5">{$orders['buy']['orders'][loop].status}</div>
											<div class="dcol col6">₹{number_format({$orders['buy']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype sbordersbox">
												<div>
													<p><strong>Scan &amp; Buy Information</strong></p>
													<ul>
														<li>Order #: {$orders['buy']['orders'][loop].order_id}</li>
														<li>
															Buyer name: {$orders['buy']['orders'][loop].first_name} {$orders['buy']['orders'][loop].last_name}
															<ul>
																<li>Buyer address: {$orders['buy']['orders'][loop].addr_line1}{if $orders['buy']['orders'][loop].addr_line2 != null} {$orders['buy']['orders'][loop].addr_line2}{/if}, {$orders['buy']['orders'][loop].city}, {$orders['buy']['orders'][loop].state} {$orders['buy']['orders'][loop].zip}</li>
																<li>Buyer email: {$orders['buy']['orders'][loop].consumer_email}</li>
																<li>Buyer phone: {$orders['buy']['orders'][loop].cellphone}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['buy']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['buy']['orders'][loop].price}</li>
														<li>Payment status: {$orders['buy']['orders'][loop].status}</li>
														<li>Customer account number: {$orders['buy']['orders'][loop].user_acct_no}</li>
														<li>Invoice number: {if $orders['buy']['orders'][loop].sku != null}{$orders['buy']['orders'][loop].sku}{else}N/A{/if}</li>
													</ul>
													{if $orders['buy']['orders'][loop].status == "pending"}
														<ul class="rowactions">
															<li><a href="{$formbase}orders/deleteorder/T/scanandbuy/ITEM/{$orders['buy']['orders'][loop].order_id}">Cancel order</a></li>
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
						
						{if $orders['buy']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['buy']['pages']}
									{if $orders['buy']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['buy']['page'] > 4)}
											<li{if $orders['buy']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandbuy/?SBDF={$SBDF}&amp;SBDT={$SBDT}&amp;SBAF={$SBAF}&amp;SBAT={$SBAT}&amp;SBC={$SBC}&amp;SBP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
										{if (($orders['buy']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['buy']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['buy']['pages'])}
											<li{if $orders['buy']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandbuy/?SBDF={$SBDF}&amp;SBDT={$SBDT}&amp;SBAF={$SBAF}&amp;SBAT={$SBAT}&amp;SBC={$SBC}&amp;SBP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['buy']['pages']-2) and ($orders['buy']['page'] < $orders['buy']['pages']-6)}
											<li{if $orders['buy']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandbuy/?SBDF={$SBDF}&amp;SBDT={$SBDT}&amp;SBAF={$SBAF}&amp;SBAT={$SBAT}&amp;SBC={$SBC}&amp;SBP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['buy']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/scanandbuy/?SBDF={$SBDF}&amp;SBDT={$SBDT}&amp;SBAF={$SBAF}&amp;SBAT={$SBAT}&amp;SBC={$SBC}&amp;SBP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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