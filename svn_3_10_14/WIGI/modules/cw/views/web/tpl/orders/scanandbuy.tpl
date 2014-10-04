{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Order</i> <span class="separator"></span> <li>Scan And Buy</i></li>
		
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
                <h1>Scan And Buy</h1>
            </div>
        </div>


	<div class="box_wide box_withsidebar box-info">	
		<div id="page">
				
			<!--{include file='dashboard/status.tpl'}-->
						
			<div class="information">
				
				<!--<h4>Orders</h4>-->
				
				<div class="tabfield">
					
					<!--<div class="tabnavigation">
						
						<tr>
							<td class="selected"><a href="{$formbase}orders/scanandpay"><input type="button" class="btn btn-info" value="Scan &amp; Pay"/></a></td>
							<td><a href="{$formbase}orders/scanandbuy"><input type="button" class="btn btn-info" value="Scan &amp; Buy"/></a></td>
							<td><a href="{$formbase}orders/ecommerce"><input type="button" class="btn btn-info" value="eCommerce"/></a></td>
							<td><a href="{$formbase}orders/donations"><input type="button" class="btn btn-info" value="Donations"/></a></td>
							<td><a href="{$formbase}orders/payments"><input type="button" class="btn btn-info" value="Payments"/></a></td>
						</tr>
					</div>-->
					
					<div class="setup scanandbuy">
						
						<h4 class="widgettitle">Search Scan &amp; Buy</h4>
						<div class="widgetcontent" >	
						<form action="{$formbase}orders/scanandbuy" method="get" class="stdform">
								<p>
									<label>Date range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="SBDF" value="{$SBDF}" class="date scanandbuydate datefrom" /></span>
										<span class="to_date">To <input type="text" name="SBDT" value="{$SBDT}" class="date scanandbuydate dateto" /></span>
									</span>
								</p>
								<p>
									<label>Amount range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="SBAF" value="{$SBAF}" class="amount" maxlength="8" /></span>
										<span class="to_date"> To <input type="text" name="SBAT" value="{$SBAT}" class="amount" maxlength="8" /></span>
									</span>
								</p>
								<p>
									<label>Merchant / DBA name</label>
									<span class="field">
										<select name="SBM"><option value="">All</option>{foreach from=$merchantnames item=m}<option value="{$m}"{if $m == $SBM} selected="selected"{/if}>{$m}</option>{/foreach}</select>
									</span>
								</p>
								<p>
									<label>Status</label>
									<span class="field">
										<select name="SBS">
												<option{if $SBS == null} selected="selected"{/if} value="">All</option>
												<option{if $SBS == "pending"} selected="selected"{/if} value="pending">Pending</option>
												<option{if $SBS == "completed"} selected="selected"{/if} value="completed">Completed</option>
												<option{if $SBS == "cancelled"} selected="selected"{/if} value="cancelled">Cancelled</option>
											</select>
									</span>
								</p>
							
								<p class="submit">
									<input type="submit" name="" class="btn btn-info" value="Update" />
								</p>
						</form>
						</div>
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
						
						<h4 class="widgettitle" style="background-color:#333;" >
						<span id="scan_detail1">Transaction date</span>
						<span id="scan_detail2">Merchant name</span>
						<span id="scan_detail3">Status</span>
						<span id="scan_detail4">Invoice #</span>
						<span id="scan_detail6">Amount</span>
					</h4>
					
						<div class="accordion accordion-info">
						{section name=loop loop=$orders['buy']['orders']}
						
						<h3><a href="">
						
							<span id="scan_detail1">{App_DataUtils::date2human($orders['buy']['orders'][loop].stamp,$tzpref)}</span>
							<span id="scan_detail2"><strong>{$orders['buy']['orders'][loop].business_name}</strong></span>
							<span id="scan_detail3">{$orders['buy']['orders'][loop].status}</span>
							<span id="scan_detail4">{$orders['buy']['orders'][loop].sku}</span>
							<span id="scan_detail6">₹{number_format({$orders['buy']['orders'][loop].price}, 2, '.', ',')}</span>
						
						</a></h3>
						<div>
							<p><strong>Scan &amp; Buy Information</strong></p>
													<ul>
														<li>Order #: {$orders['buy']['orders'][loop].order_id}</li>
														<li>
															Merchant name: {$orders['buy']['orders'][loop].business_name}
															<ul>
																<li>Merchant phone: {$orders['buy']['orders'][loop].business_phone}</li>
																<li>Merchant URL: {$orders['buy']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['buy']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['buy']['orders'][loop].price}</li>
														<li>Payment status: {$orders['buy']['orders'][loop].status}</li>
														<li>Customer account number: {$orders['buy']['orders'][loop].status}</li>
														<li>Invoice number: {if $orders['buy']['orders'][loop].sku != null}{$orders['buy']['orders'][loop].sku}{else}N/A{/if}</li>
													</ul>
													{if $orders['buy']['orders'][loop].status == "pending"}
														<ul class="rowactions">
															<li><a href="{$formbase}orders/deleteorder/T/scanandbuy/ITEM/{$orders['buy']['orders'][loop].order_id}">Cancel order</a></li>
														</ul>
													{/if}
						</div>
						{sectionelse}
									<div class="drow">
		                        		<div class="dcol"><em>There are no orders.</em></div>
		                        	</div>
		                        {/section}
						</div>
						<!--
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Transaction<br />date</div>
									<div class="dcol col2">Merchant name</div>
									<div class="dcol col3">Status</div>
									<div class="dcol col4">Invoice #</div>
									<div class="dcol col5">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['buy']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['buy']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2"><strong>{$orders['buy']['orders'][loop].business_name}</strong></div>
											<div class="dcol col3">{$orders['buy']['orders'][loop].status}</div>
											<div class="dcol col4">{$orders['buy']['orders'][loop].sku}</div>
											<div class="dcol col5">₹{number_format({$orders['buy']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype sbordersbox">
												<div>
													<p><strong>Scan &amp; Buy Information</strong></p>
													<ul>
														<li>Order #: {$orders['buy']['orders'][loop].order_id}</li>
														<li>
															Merchant name: {$orders['buy']['orders'][loop].business_name}
															<ul>
																<li>Merchant phone: {$orders['buy']['orders'][loop].business_phone}</li>
																<li>Merchant URL: {$orders['buy']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['buy']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['buy']['orders'][loop].price}</li>
														<li>Payment status: {$orders['buy']['orders'][loop].status}</li>
														<li>Customer account number: {$orders['buy']['orders'][loop].status}</li>
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
						</div>  -->
						
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