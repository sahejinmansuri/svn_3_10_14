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
							<li class="selected"><a href="{$formbase}orders/ecommerce">eCommerce</a></li>
							<li><a href="{$formbase}orders/donations">Donations</a></li>
							<li><a href="{$formbase}orders/payments">Payments</a></li>
						</ul>
						
					</div>
					
					<div class="setup ecommerce">
						
						<h4>eCommerce</h4>
						
						<form action="{$formbase}orders/ecommerce" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="EDF" value="{$EDF}" class="date ecommercedate datefrom" /></li>
										<li>To <input type="text" name="EDT" value="{$EDT}" class="date ecommercedate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="EAF" value="{$EAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="EAT" value="{$EAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Merchant / DBA name</strong></p>
									<ul>
										<li><select name="EM"><option value="">All</option>{foreach from=$merchantnames item=m}<option value="{$m}"{if $m == $EM} selected="selected"{/if}>{$m}</option>{/foreach}</select></li>
									</ul>
								</li>
								<li>
									<p><strong>Status</strong></p>
									<ul>
										<li>
											<select name="ES">
												<option{if $ES == null} selected="selected"{/if} value="">All</option>
												<option{if $ES == "pending"} selected="selected"{/if} value="pending">Pending</option>
												<option{if $ES == "completed"} selected="selected"{/if} value="completed">Completed</option>
												<option{if $ES == "cancelled"} selected="selected"{/if} value="cancelled">Cancelled</option>
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
								var dates = $(".ecommercedate").datepicker({
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
									<div class="dcol col4">Order #</div>
									<div class="dcol col5">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['ecommerce']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['ecommerce']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['ecommerce']['orders'][loop].business_name}</strong></div>
											<div class="dcol col3">{$orders['ecommerce']['orders'][loop].status}</div>
											<div class="dcol col4">{$orders['ecommerce']['orders'][loop].order_id}</div>
											<div class="dcol col5">US${number_format({$orders['ecommerce']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div>
													<p><strong>eCommerce Transaction Information</strong></p>
													<ul>
														<li>Order #: {$orders['ecommerce']['orders'][loop].order_id}</li>
														<li>
															Merchant name: {$orders['ecommerce']['orders'][loop].business_name}
															<ul>
																<li>Merchant phone: {$orders['ecommerce']['orders'][loop].business_phone}</li>
																<li>Merchant URL: {$orders['ecommerce']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['ecommerce']['orders'][loop].wigi_code}</li>
														<li>Payment amount: US${$orders['ecommerce']['orders'][loop].price}</li>
														<li>Payment status: {$orders['ecommerce']['orders'][loop].status}</li>
													</ul>
													{if $orders['ecommerce']['orders'][loop].status == "pending"}
														<ul class="rowactions">
															<li><a href="{$formbase}orders/deleteorder/T/ecommerce/ITEM/{$orders['ecommerce']['orders'][loop].order_id}">Cancel order</a></li>
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
						
						{if $orders['ecommerce']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['ecommerce']['pages']}
									{if $orders['ecommerce']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['ecommerce']['page'] > 4)}
											<li{if $orders['ecommerce']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/ecommerce/?EDF={$EDF}&amp;EDT={$EDT}&amp;EAF={$EAF}&amp;EAT={$EAT}&amp;EC={$EC}&amp;EP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
										{if (($orders['ecommerce']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['ecommerce']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['ecommerce']['pages'])}
											<li{if $orders['ecommerce']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/ecommerce/?EDF={$EDF}&amp;EDT={$EDT}&amp;EAF={$EAF}&amp;EAT={$EAT}&amp;EC={$EC}&amp;EP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['ecommerce']['pages']-2) and ($orders['ecommerce']['page'] < $orders['ecommerce']['pages']-6)}
											<li{if $orders['ecommerce']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/ecommerce/?EDF={$EDF}&amp;EDT={$EDT}&amp;EAF={$EAF}&amp;EAT={$EAT}&amp;EC={$EC}&amp;EP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['ecommerce']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/ecommerce/?EDF={$EDF}&amp;EDT={$EDT}&amp;EAF={$EAF}&amp;EAT={$EAT}&amp;EC={$EC}&amp;EP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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