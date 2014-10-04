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
							<li class="selected"><a href="{$formbase}orders/donations">Donations</a></li>
							<li><a href="{$formbase}orders/receive">Receive</a></li>
							<li><a href="{$formbase}orders/payments">Payments</a></li>
							<li><a href="{$formbase}orders/posdevices">POS devices</a></li>
						</ul>
						
					</div>
					
					<div class="setup donations">
						
						<h4>Donations</h4>
						
						<form action="{$formbase}orders/donations" method="get">
							<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="DDF" value="{$DDF}" class="date donationsdate datefrom" /></li>
										<li>To <input type="text" name="DDT" value="{$DDT}" class="date donationsdate dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="DAF" value="{$DAF}" class="amount" maxlength="8" /></li>
										<li>To <input type="text" name="DAT" value="{$DAT}" class="amount" maxlength="8" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Donor phone number</strong></p>
									<ul>
										<li><input type="text" name="DC" value="{$DC}" maxlength="10" /></li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Update" />
									<input type="submit" name="DDR" value="Download" />
								</li>
							</ul>
						</form>
						<script type="text/javascript">
							$(document).ready(function() {
								var dates = $(".donationsdate").datepicker({
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
									<div class="dcol col2">Donor name</div>
									<div class="dcol col3">Message</div>
									<div class="dcol col4">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['donate']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['donate']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['donate']['orders'][loop].first_name} {$orders['donate']['orders'][loop].last_name}</strong></div>
											<div class="dcol col3">{$orders['donate']['orders'][loop].description}</div>
											<div class="dcol col4">₹{number_format({$orders['donate']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div>
													<p><strong>Donation Transaction Information</strong></p>
													<ul>
														<li>Order #: {$orders['donate']['orders'][loop].order_id}</li>
														<li>
															Donor name: {$orders['donate']['orders'][loop].first_name} {$orders['donate']['orders'][loop].last_name}
															<ul>
																<li>Donor address: {$orders['donate']['orders'][loop].addr_line1}{if $orders['donate']['orders'][loop].addr_line2 != null} {$orders['donate']['orders'][loop].addr_line2}{/if}, {$orders['donate']['orders'][loop].city}, {$orders['donate']['orders'][loop].state} {$orders['donate']['orders'][loop].zip}</li>
																<li>Donor email: {$orders['donate']['orders'][loop].consumer_email}</li>
																<li>Donor phone: {$orders['donate']['orders'][loop].cellphone}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Payment Code: {$orders['donate']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['donate']['orders'][loop].price}</li>
														<li>Payment status: {$orders['donate']['orders'][loop].status}</li>
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
						
						{if $orders['donate']['pages'] > 1}
							<ul class="pagination">
								{section name=pageid start=0 loop=$orders['donate']['pages']}
									{if $orders['donate']['pages'] > 10}
										{if ($smarty.section.pageid.index == 1) and ($orders['donate']['page'] > 4)}
											<li{if $orders['donate']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/donations/?DDF={$DDF}&amp;DDT={$DDT}&amp;DAF={$DAF}&amp;DAT={$DAT}&amp;DC={$DC}&amp;DP={($smarty.section.pageid.index + 1)}">...</a></a></li>
										{/if}
										{if (($orders['donate']['page'] - 2) <= ($smarty.section.pageid.index+1) and ($orders['donate']['page']+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $orders['donate']['pages'])}
											<li{if $orders['donate']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/donations/?DDF={$DDF}&amp;DDT={$DDT}&amp;DAF={$DAF}&amp;DAT={$DAT}&amp;DC={$DC}&amp;DP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
										{/if}
										{if ($smarty.section.pageid.index == $orders['donate']['pages']-2) and ($orders['donate']['page'] < $orders['donate']['pages']-6)}
											<li{if $orders['donate']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/donations/?DDF={$DDF}&amp;DDT={$DDT}&amp;DAF={$DAF}&amp;DAT={$DAT}&amp;DC={$DC}&amp;DP={($smarty.section.pageid.index + 1)}">...</a></li>
										{/if}
									{else}
										<li{if $orders['donate']['page'] == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}orders/donations/?DDF={$DDF}&amp;DDT={$DDT}&amp;DAF={$DAF}&amp;DAT={$DAT}&amp;DC={$DC}&amp;DP={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
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