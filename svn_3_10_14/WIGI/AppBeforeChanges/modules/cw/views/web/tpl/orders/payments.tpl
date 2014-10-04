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
							<li><a href="{$formbase}orders/donations">Donations</a></li>
							<li class="selected"><a href="{$formbase}orders/payments">Payments</a></li>
						</ul>
						
					</div>
					
					<div class="setup payments">
						
						<h4>Payments sent</h4>
						
						<form action="{$formbase}orders/payments" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="PSDF" value="{$PSDF}" class="date paymentsdate datefrom" /></li>
										<li>To <input type="text" name="PSDT" value="{$PSDT}" class="date paymentsdate dateto" /></li>
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
									<p><strong>Merchant name</strong></p>
									<ul>
										<li>
											<select name="PSM">
												<option{if $PSM == null} selected="selected"{/if} value="">All</option>
												{foreach from=$orders['payment']['autofilters']["M"] key=k item=v}
													<option value="{$k}"{if $RM == $v} selected="selected"{/if}>{$v}</option>
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
								var dates = $(".paymentsdate").datepicker({
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
									<div class="dcol col3">Reason</div>
									<div class="dcol col4">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['payment']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['payment']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['payment']['orders'][loop].business_name}</strong></div>
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
														<li>Merchant name: {$orders['payment']['orders'][loop].business_name}</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['payment']['orders'][loop].wigi_code}</li>
														<li>Payment amount: US${$orders['payment']['orders'][loop].price}</li>
														<li>Payment status: {$orders['payment']['orders'][loop].status}</li>
														<li>Message: {$orders['payment']['orders'][loop].message}</li>
														<li>Reason: {$orders['payment']['orders'][loop].description}</li>
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
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">...</a></a></li>
										{/if}
										{if (($orders['payment']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['payment']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['payment']['pages'])}
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['payment']['pages']-2) and ($orders['payment']['page'] < $orders['payment']['pages']-6)}
											<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['payment']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/payments/?RDF={$RDT}&amp;RDT={$RDT}&amp;RAF={$RAF}&amp;RAT={$RAT}&amp;RC={$REC}&amp;RP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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