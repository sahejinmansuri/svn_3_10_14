{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<script type="text/javascript">

</script>
<style type="text/css">


</style>
<!--{include file='content_header.tpl'}-->
<!--<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-page-demo.css" />-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Order</i> <span class="separator"></span> <li>Donation</i></li>
		
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
                <h1>Donation</h1>
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
					
					<div class="setup donations box-info">
					
					<h4 class="widgettitle">Search Donations</h4>
					<div class="widgetcontent" >	
						<form action="{$formbase}orders/donations" method="get"  class="stdform">
								<p>
									<label>Date range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="DDF" value="{$DDF}" class="date donationsdate datefrom" /></span>
										<span class="to_date">To <input type="text" name="DDT" value="{$DDT}" class="date donationsdate dateto" /></span>
									</span>
								</p>
								<p>
									<label>Amount range</label>
									<span class="field">
										<span class="from_date">From <input type="text" name="DAF" value="{$DAF}" class="amount" maxlength="8" /></span>
										<span class="to_date">To <input type="text" name="DAT" value="{$DAT}" class="amount" maxlength="8" /></span>
									</span>
								</p>
								<p>
									<label>Donor phone number</label>
									<span class="field">
										<input type="text" name="DC" value="{$DC}" maxlength="10" />
									</span>
								</p>
								<p class="submit">
									<input type="submit" name="" class="btn btn-info" value="Update" />
									<input type="submit" name="DDR" class="btn btn-info" value="Download" />
								</p>
						</form>
						
						</div>
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
						
						
					<!--	<h4 class="widgettitle" style="background-color:#333;" >
						<span id="donation_detail1">Transaction date</span>
						<span id="donation_detail2">Non-proft name</span>
						<span id="donation_detail3" border="1">Message</span>
						<span id="donation_detail4">Amount</span>
						</h4> -->
						
						<h4 class="widgettitle" style="background-color:#333;" >
						<span id="">Transaction date</span>
						<span id="">Non-proft name</span>
						<span id="" border="1">Message</span>
						<span id="">Amount</span>
						</h4>
						<div class="accordion accordion-info">
						{section name=loop loop=$orders['donate']['orders']}
						
						<h3><a href="">
						
							<span id="donation_detail1">{App_DataUtils::date2human($orders['donate']['orders'][loop].stamp,$tzpref)}	</span>
							<span id="donation_detail2">{$orders['donate']['orders'][loop].business_name}</span>
							<span id="donation_detail3">{$orders['donate']['orders'][loop].description}</span>
							<span id="">₹{number_format({$orders['donate']['orders'][loop].price}, 2, '.', ',')}</span>
						
						</a></h3>
						
						<div>
							<div class="setup transactions box-info">
												
													<h4 class="widgettitle box-info" style="margin-bottom:0px" >Donation Transaction Information</h4>
													<div class="widgetcontent form-horizontal form_transaction">
												<div class="form-group">
													<label class="col-md-6 control-label">Order #:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].order_id}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit name:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_name}</span>
														  
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit phone:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_phone}</span>
														  
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit URL:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_url}</span>
														  
													 </div>
												</div>
												
												<div class="form-group">
													<label class="col-md-6 control-label">InCashMe&#8482; Money Payment Code:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].wigi_code}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment amount:</label>
													<div class="col-md-6">
														  <span class="profile_detail">₹{$orders['donate']['orders'][loop].price}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment status:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].status}</span>
													 </div>
												</div>
												
													</div>
													<!--<ul>
														<li>Order #: {$orders['donate']['orders'][loop].order_id}</li>
														<li>
															Non-profit name: {$orders['donate']['orders'][loop].business_name}
															<ul>
																<li>Non-profit phone: {$orders['donate']['orders'][loop].business_phone}</li>
																<li>Non-profit URL: {$orders['donate']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['donate']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['donate']['orders'][loop].price}</li>
														<li>Payment status: {$orders['donate']['orders'][loop].status}</li>
													</ul> -->
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
									<div class="dcol col2">Non-proft name</div>
									<div class="dcol col3">Message</div>
									<div class="dcol col4">Amount</div>
								</div>
							</div>
							<div class="dbody">
								{section name=loop loop=$orders['donate']['orders']}
									<div class="drow{if $smarty.section.loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">{App_DataUtils::date2human($orders['donate']['orders'][loop].stamp,$tzpref)}</div>
											<div class="dcol col2 "><strong>{$orders['donate']['orders'][loop].business_name}</strong></div>
											<div class="dcol col3">{$orders['donate']['orders'][loop].description}</div>
											<div class="dcol col4">₹{number_format({$orders['donate']['orders'][loop].price}, 2, '.', ',')}</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div class="setup transactions box-info">
												
													<h4 class="widgettitle box-info" >Donation Transaction Information</h4>
													<div class="widgetcontent form-horizontal form_transaction">
												<div class="form-group">
													<label class="col-md-6 control-label">Order #:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].order_id}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit name:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_name}</span>
														  
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit phone:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_phone}</span>
														  
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Non-profit URL:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].business_url}</span>
														  
													 </div>
												</div>
												
												<div class="form-group">
													<label class="col-md-6 control-label">InCashMe&#8482; Money Payment Code:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].wigi_code}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment amount:</label>
													<div class="col-md-6">
														  <span class="profile_detail">₹{$orders['donate']['orders'][loop].price}</span>
													 </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Payment status:</label>
													<div class="col-md-6">
														  <span class="profile_detail">{$orders['donate']['orders'][loop].status}</span>
													 </div>
												</div>
												
													</div>
													<!--<ul>
														<li>Order #: {$orders['donate']['orders'][loop].order_id}</li>
														<li>
															Non-profit name: {$orders['donate']['orders'][loop].business_name}
															<ul>
																<li>Non-profit phone: {$orders['donate']['orders'][loop].business_phone}</li>
																<li>Non-profit URL: {$orders['donate']['orders'][loop].business_url}</li>
															</ul>
														</li>
														<li>InCashMe&#8482; Money Payment Code: {$orders['donate']['orders'][loop].wigi_code}</li>
														<li>Payment amount: ₹{$orders['donate']['orders'][loop].price}</li>
														<li>Payment status: {$orders['donate']['orders'][loop].status}</li>
													</ul> -->
											<!--	</div>
											</div>
										</div>
									</div>
								{sectionelse}
									<div class="drow">
		                        		<div class="dcol"><em>There are no orders.</em></div>
		                        	</div>
		                        {/section}
							</div>
						</div>-->
						
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