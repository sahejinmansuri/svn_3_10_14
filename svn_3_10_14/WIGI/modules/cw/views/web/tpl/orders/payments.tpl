{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<!--<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-page-demo.css" />-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Order</i> <span class="separator"></span> <li>Payments</i></li>
		
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
                <h1>Payments</h1>
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
					
					<div class="setup payments" >
						
						<h4 class="widgettitle">Payments sent</h4>
						<div class="widgetcontent" >	
						
						<form action="{$formbase}orders/payments" method="get" class="stdform">
								<p>
									<label>Date range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="PSDF" value="{$PSDF}" class="date paymentsdate datefrom" /></span>
										<span class="to_date">To <input type="text" name="PSDT" value="{$PSDT}" class="date paymentsdate dateto" /></span>
									</span>
								</p>
								<p>
									<label>Amount range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="PSAF" value="{$PSAF}" class="amount" maxlength="8" /></span>
										<span class="to_date">To <input type="text" name="PSAT" value="{$PSAT}" class="amount" maxlength="8" /></span>
									</span>
								</p>
								<p>
									<label>Merchant name</label>
									<span class="field">
										<select name="PSM">
												<option{if $PSM == null} selected="selected"{/if} value="">All</option>
												{foreach from=$orders['payment']['autofilters']["M"] key=k item=v}
													<option value="{$k}"{if $RM == $v} selected="selected"{/if}>{$v}</option>
												{/foreach}
											</select>
									</span>
								</p>
								<p class="submit">
									<input type="submit" class="btn btn-info" name="" value="Update" />
								</p>
							
						</form>
						</div>
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
						
							
						<h4 class="widgettitle" style="background-color:#333;" >
						<span id="donation_detail1">Transaction date</span>
						<span id="donation_detail2">From</span>
						<span id="donation_detail3">Reason</span>
						<span id="donation_detail4">Amount</span>
						</h4>
					
						<div class="accordion accordion-info">
						{section name=loop loop=$orders['payment']['orders']}
						<h3><a href="">
						
							<span id="donation_detail1">{App_DataUtils::date2human($orders['payment']['orders'][loop].stamp,$tzpref)}</span>
							<span id="donation_detail2">{$orders['payment']['orders'][loop].business_name}</span>
							<span id="donation_detail3">{$orders['payment']['orders'][loop].description}</span>
							<span id="donation_detail4">₹{number_format({$orders['payment']['orders'][loop].price}, 2, '.', ',')}</span>
						
						</a></h3>
						<div>
						<div class="setup transactions box-info">
													
													<h4 class="widgettitle box-info" >Payments Transaction Information</h4>
													
													<div class="widgetcontent form-horizontal form_transaction">
												<div class="form-group">
													<label class="col-md-6 control-label">Order #:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].order_id}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Merchant name:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].business_name}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">InCashMe&#8482; Money Payment Code:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].wigi_code}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment amount:</label>
													<div class="col-md-6">
														  <span class="profile_detail">₹{$orders['payment']['orders'][loop].price}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment status:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].status}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Message:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].message}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Reason:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].description}</span>
													 </div>
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
						
						
						<!--
						<div class="dtable">
							<div class="dhead">
								<div class="drow" style="background-color: #333 !important;">
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
											<div class="dcol col4">₹{number_format({$orders['payment']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div class="setup transactions box-info">
													
													<h4 class="widgettitle box-info" >Payments Transaction Information</h4>
													
													<div class="widgetcontent form-horizontal form_transaction">
												<div class="form-group">
													<label class="col-md-6 control-label">Order #:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].order_id}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Merchant name:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].business_name}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">InCashMe&#8482; Money Payment Code:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].wigi_code}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment amount:</label>
													<div class="col-md-6">
														  <span class="profile_detail">₹{$orders['payment']['orders'][loop].price}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment status:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].status}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Message:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].message}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Reason:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['payment']['orders'][loop].description}</span>
													 </div>
												</div>
													</div>
													
													
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