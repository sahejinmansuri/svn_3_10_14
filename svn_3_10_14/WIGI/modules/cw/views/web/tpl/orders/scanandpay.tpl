{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Order</i> <span class="separator"></span> <li>Scan And Pay</i></li>
		
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
                <h1>Scan And Pay</h1>
            </div>
        </div>
		
		
	<div class="box_wide box_withsidebar box-info">	
		<div id="page">
				
			<!--{include file='dashboard/status.tpl'}-->
						
			<div class="information">
				
				<!--<h4>Orders</h4>-->
				
				<div class="tabfield">
				<!--	
					<div class="tabnavigation">
						
						<tr>
							<td class="selected"><a href="{$formbase}orders/scanandpay"><input type="button" class="btn btn-info" value="Scan &amp; Pay"/></a></td>
							<td><a href="{$formbase}orders/scanandbuy"><input type="button" class="btn btn-info" value="Scan &amp; Buy"/></a></td>
							<td><a href="{$formbase}orders/ecommerce"><input type="button" class="btn btn-info" value="eCommerce"/></a></td>
							<td><a href="{$formbase}orders/donations"><input type="button" class="btn btn-info" value="Donations"/></a></td>
							<td><a href="{$formbase}orders/payments"><input type="button" class="btn btn-info" value="Payments"/></a></td>
						</tr>
						
					</div> -->
					
					<div class="setup scanandpay">
						
						<h4 class="widgettitle">Scan &amp; Pay</h4>
						<div class="widgetcontent" >
						<form action="{$formbase}orders/scanandpay" method="get" class="stdform">
							<p>
									<label>Date range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="SPDF" value="{$SPDF}" class="date scanandpaydate datefrom" /></span>
										<span class="to_date">To <input type="text" name="SPDT" value="{$SPDT}" class="date scanandpaydate dateto" /></span>
									</span>
								</p>
								<p>
									<label>Amount range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="SPAF" value="{$SPAF}" class="amount" maxlength="8" /></span>
										<span class="to_date"> To <input type="text" name="SPAT" value="{$SPAT}" class="amount" maxlength="8" /></span>
									</span>
								</p>
								<p>
									<label>Merchant / DBA name</label>
									<span class="field">
										<select name="SPM"><option value="">All</option>{foreach from=$merchantnames item=m}<option value="{$m}"{if $m == $SPM} selected="selected"{/if}>{$m}</option>{/foreach}</select>
									</span>
								</p>
							<p class="submit">
									<input type="submit" name="" class="btn btn-info" value="Update" />
								</p>
							<!--<tr class="filter">
								<td>
									<p><strong>Date range</strong></p>
									<tr class="withlabels">
										<td>From <input type="text" name="SPDF" value="{$SPDF}" class="date scanandpaydate datefrom" /></td>
										<td>To <input type="text" name="SPDT" value="{$SPDT}" class="date scanandpaydate dateto" /></td>
									</tr>
								</td>
								<td>
									<p><strong>Amount range</strong></p>
									<tr class="withlabels">
										<td>From <input type="text" name="SPAF" value="{$SPAF}" class="amount" maxlength="8" /></td>
										<td>To <input type="text" name="SPAT" value="{$SPAT}" class="amount" maxlength="8" /></td>
									</tr>
								</td>
								<td>
									<p><strong>Merchant / DBA name</strong></p>
									<tr>
										<td><select name="SPM"><option value="">All</option>{foreach from=$merchantnames item=m}<option value="{$m}"{if $m == $SPM} selected="selected"{/if}>{$m}</option>{/foreach}</select></td>
									</tr>
								</td>
								</br>
								<td class="submit">
									<input type="submit" name="" class="btn btn-info" value="Update" />
								</td>
							</tr> -->
						</form>
						</div>
						</br>
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
						
						<h4 class="widgettitle" style="background-color:#333;" >
						<span id="donation_detail1">Transaction date</span>
						<span id="donation_detail2">Merchant name</span>
						<span id="donation_detail3">Status</span>
						<span id="donation_detail4">Invoice #</span>
						<span id="donation_detail5">Due date</span>
						<span id="donation_detail6">Amount</span>
						<h4>
					
						<div class="accordion accordion-info">
						{section name=loop loop=$orders['pay']['orders']}
						
						<h3><a href="">
						
							<span id="donation_detail1">{App_DataUtils::date2human($orders['pay']['orders'][loop].stamp,$tzpref)}</span>
							<span id="donation_detail2"><strong>{$orders['pay']['orders'][loop].business_name}</strong></span>
							<span id="donation_detail3">{$orders['pay']['orders'][loop].status}</span>
							<span id="donation_detail4">{$orders['pay']['orders'][loop].sku}</span>
							<span id="donation_detail4">{App_DataUtils::date2human($orders['pay']['orders'][loop].due_date,$tzpref,true)}</span>
							<span id="donation_detail4">₹{number_format({$orders['pay']['orders'][loop].price}, 2, '.', ',')}</span>
						
						</a></h3>
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
														<li>Payment amount: ₹{$orders['pay']['orders'][loop].price}</li>
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
											<div class="dcol col6">₹{number_format({$orders['pay']['orders'][loop].price}, 2, '.', ',')}</div>
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
														<li>Payment amount: ₹{$orders['pay']['orders'][loop].price}</li>
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
						</div> -->
						
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