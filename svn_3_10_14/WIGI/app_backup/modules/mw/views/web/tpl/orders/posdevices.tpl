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
							<li><a href="{$formbase}orders/payments">Payments</a></li>
							<li class="selected"><a href="{$formbase}orders/posdevices">POS devices</a></li>
						</ul>
						
					</div>
					
					<div class="setup posorders">
						
						<h4>POS devices</h4>
						
						<form action="{$formbase}orders/posdevices" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="PDF" value="{$PDF}" class="date posdevicesdate datefrom" /></li>
										<li>To <input type="text" name="PDT" value="{$PDT}" class="date posdevicesdate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="PAF" value="{$PAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="PAT" value="{$PAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Customer phone number</strong></p>
									<ul class="prompt phone">
										<li><input type="text" name="PC" value="{$PC}" maxlength="10" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Device</strong></p>
									<ul>
										<li>
											<select name="PD">
												<option{if $PD == null} selected="selected"{/if} value="">All</option>
												{foreach from=$cellphones key=k item=v}
													<option value="{$v.mobile_id}"{if $PD == $v.mobile_id} selected="selected"{/if}>{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
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
								var dates = $(".posdevicesdate").datepicker({
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
									<div class="dcol col3">Type</div>
									<div class="dcol col4">Message</div>
									<div class="dcol col5">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['pos']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['pos']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['pos']['orders'][loop].first_name} {$orders['pos']['orders'][loop].last_name}</strong></div>
											<div class="dcol col3">{$orders['pos']['orders'][loop].payment_method}</div>
											<div class="dcol col4">{$orders['pos']['orders'][loop].description}</div>
											<div class="dcol col5">₹{number_format({$orders['pos']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div>
													<p><strong>POS Transaction Information</strong></p>
													<ul>
														<li>Order #: {$orders['pos']['orders'][loop].order_id}</li>
														<li>
															Customer name: {$orders['pos']['orders'][loop].first_name} {$orders['pos']['orders'][loop].last_name}
															<ul>
																<li>Customer address: {$orders['pos']['orders'][loop].addr_line1}{if $orders['pos']['orders'][loop].addr_line2 != null} {$orders['pos']['orders'][loop].addr_line2}{/if}, {$orders['pos']['orders'][loop].city}, {$orders['pos']['orders'][loop].state} {$orders['pos']['orders'][loop].zip}</li>
																<li>Customer email: {$orders['pos']['orders'][loop].consumer_email}</li>
																<li>Customer phone: {$orders['pos']['orders'][loop].cellphone}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Payment Code: {$orders['pos']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['pos']['orders'][loop].price}</li>
														<li>Payment status: {$orders['pos']['orders'][loop].status}</li>
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
						
						{if $orders['pos']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['pos']['pages']}
									{if $orders['pos']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['pos']['page'] > 4)}
											<li{if $orders['pos']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/posdevices/?PDF={$PDF}&amp;PDT={$PDT}&amp;PAF={$PAF}&amp;PAT={$PAT}&amp;PC={$PC}&amp;PD={$PD}&amp;PP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
										{if (($orders['pos']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['pos']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['pos']['pages'])}
											<li{if $orders['pos']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/posdevices/?PDF={$PDF}&amp;PDT={$PDT}&amp;PAF={$PAF}&amp;PAT={$PAT}&amp;PC={$PC}&amp;PD={$PD}&amp;PP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['pos']['pages']-2) and ($orders['pos']['page'] < $orders['pos']['pages']-6)}
											<li{if $orders['pos']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/posdevices/?PDF={$PDF}&amp;PDT={$PDT}&amp;PAF={$PAF}&amp;PAT={$PAT}&amp;PC={$PC}&amp;PD={$PD}&amp;PP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['pos']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/posdevices/?PDF={$PDF}&amp;PDT={$PDT}&amp;PAF={$PAF}&amp;PAT={$PAT}&amp;PC={$PC}&amp;PD={$PD}&amp;PP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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