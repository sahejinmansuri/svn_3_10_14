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
							<li><a href="{$formbase}orders/receive">Receive</a></li>
							<li class="selected"><a href="{$formbase}orders/payments">Payments</a></li>
							<li><a href="{$formbase}orders/posdevices">POS devices</a></li>
						</ul>
						
					</div>
					
					<div class="setup payments">
						
						<h4>Payments sent</h4>
						
						<form action="{$formbase}orders/payments" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="PSDF" value="{$PSDF}" class="date paymentdate datefrom" /></li>
										<li>To <input type="text" name="PSDT" value="{$PSDT}" class="date paymentdate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="PSAF" value="{$PSAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="PSAT" value="{$PSAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Payment type, to</strong></p>
									<ul>
										<li><select name="PSPT" class="paymenttype"><option value=""{if $PSPT==""} selected="selected"{/if}>All</option><option value="consumer"{if $PSPT=="consumer"} selected="selected"{/if}>Consumer</option><option value="merchant"{if $PSPT=="merchant"} selected="selected"{/if}>Merchant</option></select></li>
									</ul>
									<script type="text/javascript">
										$(document).ready(function() {
											$(".paymenttype").change(function() {
												var show = $(this).val();
												$(".paymentcw").hide();
												$(".paymentmw").hide();
												if (show == "consumer") {
													$(".paymentcw").show();
												}
												if (show == "merchant") {
													$(".paymentmw").show();
												}
											}).trigger("change");
										});
									</script>
								</li>
								<li class="paymentcw">
									<p><strong>Consumer phone number</strong></p>
									<ul>
										<li>
											<select name="PSC">
												<option{if $PSC == null} selected="selected"{/if} value="">All</option>
												{foreach from=$orders['payment']['autofilters']["C"] key=k item=v}
													<option value="{$k}"{if $PSC == $v} selected="selected"{/if}>{$v}</option>
												{/foreach}
											</select>
										</li>
									</ul>
								</li>
								<li class="paymentmw">
									<p><strong>Merchant name</strong></p>
									<ul>
										<li>
											<select name="PSM">
												<option{if $PSM == null} selected="selected"{/if} value="">All</option>
												{foreach from=$orders['payment']['autofilters']["M"] key=k item=v}
													<option value="{$k}"{if $PSM == $v} selected="selected"{/if}>{$v}</option>
												{/foreach}
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
								var dates = $(".paymentdate").datepicker({
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
									<div class="dcol col2">To</div>
									<div class="dcol col3">Message</div>
									<div class="dcol col4">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['payment']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['payment']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['payment']['orders'][loop].first_name} {$orders['payment']['orders'][loop].last_name}</strong></div>
											<div class="dcol col3">{$orders['payment']['orders'][loop].description}</div>
											<div class="dcol col4">US${number_format({$orders['payment']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div>
													<p><strong>Payments Transaction Information</strong></p>
													<ul>
														<li>Order #: {$orders['payment']['orders'][loop].order_id}</li>
														<li>
															Consumer name: {$orders['payment']['orders'][loop].first_name} {$orders['payment']['orders'][loop].last_name}
															<ul>
																<li>Consumer address: {$orders['payment']['orders'][loop].addr_line1}{if $orders['payment']['orders'][loop].addr_line2 != null} {$orders['payment']['orders'][loop].addr_line2}{/if}, {$orders['payment']['orders'][loop].city}, {$orders['payment']['orders'][loop].state} {$orders['payment']['orders'][loop].zip}</li>
																<li>Consumer email: {$orders['payment']['orders'][loop].consumer_email}</li>
																<li>Consumer phone: {$orders['payment']['orders'][loop].cellphone}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Payment Code: {$orders['payment']['orders'][loop].wigi_code}</li>
														<li>Payment amount: US${$orders['payment']['orders'][loop].price}</li>
														<li>Payment status: {$orders['payment']['orders'][loop].status}</li>
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
						
						{if $orders['payment']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['payment']['pages']}
									{if $orders['payment']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['payment']['page'] > 4)}
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}#payments">...</a></a></li>
										{/if}
										{if (($orders['payment']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['payment']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['payment']['pages'])}
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}#payments">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['payment']['pages']-2) and ($orders['payment']['page'] < $orders['payment']['pages']-6)}
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}#payments">...</a></li>
										{/if}
									{else}
										<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}#payments">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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