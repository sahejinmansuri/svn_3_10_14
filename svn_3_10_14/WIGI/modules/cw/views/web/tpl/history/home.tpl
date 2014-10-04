{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>History</li>
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
                <h1>Account History</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar">	
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			
			
			<div class="information">
				
				<div class="setup transactions box-info ">
					
					<!--<h4>Account history</h4>-->
					
					<p>You can review your most recent transactions in the History listing. By default, we show transactions from all the cell phones activated in your InCashMe&#8482; Account. You can also select a particular cell phone to review those transactions only.<br />You simply click on a particular transaction to see additional details, click again to collapse the display.</p>
					
					{if true == false}
					<ul class="pagination">
						<li{if $selectedcell == null} class="selected"{/if}><a href="{$formbase}history/home">All</a></li>
						{foreach from=$cellphones key=k item=v}
							<li{if $selectedcell == $v.mobile_id} class="selected"{/if}><a href="{$formbase}history/home/M/{$v.mobile_id}">{$v.cellphone}{if $v.is_default == 1} (Default){/if}</a></li>
						{/foreach}
					</ul>
					{/if}
					<h4 class="widgettitle">Search</h4>
					<div class="widgetcontent" >
						<form action="{$formbase}history/home" method="get" class="stdform">
							
								<p>
									<label>Date range</label>
									<span class="field">
										From
										<input type="text" name="DF" value="{$selecteddatefrom}" class="date datefrom" /> 
										<p>To
										<input type="text" name="DT" value="{$selecteddateto}" class="date dateto" /></p>
										
									</span>

								</p>
								<p>
									<label>Transaction type</label>
									<span class="field">
										<select name="T">
												<option value="">All</option>
												<option value="100"{if $selectedtype == 100} selected="selected"{/if}>Sent Money</option>
												<option value="101"{if $selectedtype == 101} selected="selected"{/if}>Received Money</option>
												<option value="107"{if $selectedtype == 107} selected="selected"{/if}>Received Payment</option>
												<option value="205"{if $selectedtype == 205} selected="selected"{/if}>Scan &amp; Buy</option>
												<option value="206"{if $selectedtype == 206} selected="selected"{/if}>Scan &amp; Pay</option>
												<option value="210"{if $selectedtype == 210} selected="selected"{/if}>eCommerce</option>
												<option value="102"{if $selectedtype == 102} selected="selected"{/if}>Sent Donation</option>
												<option value="302"{if $selectedtype == 302} selected="selected"{/if}>Fund from Bank Account</option>
												<option value="303"{if $selectedtype == 303} selected="selected"{/if}>Withdraw to Bank Account</option>
												<option value="300"{if $selectedtype == 300} selected="selected"{/if}>Fund from Credit Card</option>
												<option value="200"{if $selectedtype == 200} selected="selected"{/if}>IMPC Created</option>
												<option value="201"{if $selectedtype == 201} selected="selected"{/if}>IMPC Expired</option>
												<option value="203"{if $selectedtype == 203} selected="selected"{/if}>IMPC Redeemed</option>
												<option value="204"{if $selectedtype == 204} selected="selected"{/if}>IMPC Deleted</option>
												<option value="211"{if $selectedtype == 211} selected="selected"{/if}>IMPC Pending</option>
												<option value="212"{if $selectedtype == 212} selected="selected"{/if}>IMPC Refunded</option>
												<option value="CREDIT"{if $selectedtype == "CREDIT"} selected="selected"{/if}>Credits</option>
												<option value="DEBIT"{if $selectedtype == "DEBIT"} selected="selected"{/if}>Debits</option>
												<option value="INFO"{if $selectedtype == "INFO"} selected="selected"{/if}>Informational</option>
											</select>
									</span>
								</p>
								<p>
									<label>Amount range</label>
									<span class="field">
										From <input type="text" name="AF" value="{$selectedamountfrom}" /> To <input type="text" name="AT" value="{$selectedamountto}" />
									</span>
								</p>
								<p>
									<label>Cell phone</label>
									<span class="field">
										<select name="M">
												<option{if $selectedcell == null} selected="selected"{/if} value="">All</option>
												{foreach from=$cellphones key=k item=v}
													<option value="{$v.mobile_id}"{if $selectedcell == $v.mobile_id} selected="selected"{/if}>{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
												{/foreach}
											</select>
									</span>
								</p>
								<p><input type="submit" name="" value="Update" class="btn btn-info" /></p>
							
							<!--<ul class="filter">
								<li>
									<p><strong>Date range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="DF" value="{$selecteddatefrom}" class="date datefrom" /></li>
										<li>To <input type="text" name="DT" value="{$selecteddateto}" class="date dateto" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Transaction type</strong></p>
									<ul>
										<li>
											<select name="T">
												<option value="">All</option>
												<option value="100"{if $selectedtype == 100} selected="selected"{/if}>Sent Money</option>
												<option value="101"{if $selectedtype == 101} selected="selected"{/if}>Received Money</option>
												<option value="107"{if $selectedtype == 107} selected="selected"{/if}>Received Payment</option>
												<option value="205"{if $selectedtype == 205} selected="selected"{/if}>Scan &amp; Buy</option>
												<option value="206"{if $selectedtype == 206} selected="selected"{/if}>Scan &amp; Pay</option>
												<option value="210"{if $selectedtype == 210} selected="selected"{/if}>eCommerce</option>
												<option value="102"{if $selectedtype == 102} selected="selected"{/if}>Sent Donation</option>
												<option value="302"{if $selectedtype == 302} selected="selected"{/if}>Fund from Bank Account</option>
												<option value="303"{if $selectedtype == 303} selected="selected"{/if}>Withdraw to Bank Account</option>
												<option value="300"{if $selectedtype == 300} selected="selected"{/if}>Fund from Credit Card</option>
												<option value="200"{if $selectedtype == 200} selected="selected"{/if}>IMPC Created</option>
												<option value="201"{if $selectedtype == 201} selected="selected"{/if}>IMPC Expired</option>
												<option value="203"{if $selectedtype == 203} selected="selected"{/if}>IMPC Redeemed</option>
												<option value="204"{if $selectedtype == 204} selected="selected"{/if}>IMPC Deleted</option>
												<option value="211"{if $selectedtype == 211} selected="selected"{/if}>IMPC Pending</option>
												<option value="212"{if $selectedtype == 212} selected="selected"{/if}>IMPC Refunded</option>
												<option value="CREDIT"{if $selectedtype == "CREDIT"} selected="selected"{/if}>Credits</option>
												<option value="DEBIT"{if $selectedtype == "DEBIT"} selected="selected"{/if}>Debits</option>
												<option value="INFO"{if $selectedtype == "INFO"} selected="selected"{/if}>Informational</option>
											</select>
										</li>
									</ul>
								</li>
								<li>
									<p><strong>Amount range</strong></p>
									<ul class="withlabels">
										<li>From <input type="text" name="AF" value="{$selectedamountfrom}" /></li>
										<li>To <input type="text" name="AT" value="{$selectedamountto}" /></li>
									</ul>
								</li>
								<li>
									<p><strong>Cell phone</strong></p>
									<ul>
										<li>
											<select name="M">
												<option{if $selectedcell == null} selected="selected"{/if} value="">All</option>
												{foreach from=$cellphones key=k item=v}
													<option value="{$v.mobile_id}"{if $selectedcell == $v.mobile_id} selected="selected"{/if}>{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
												{/foreach}
											</select>
										</li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Update" />
								</li>
							</ul>-->
						</form>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							var dates = $(".date").datepicker({
								onSelect: function(selectedDate) {
									var option = (this.className.indexOf("datefrom") != -1) ? "minDate" : "maxDate",
									instance = $(this).data("datepicker"),
									date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
									dates.not(this).datepicker("option", option, date);
								}
							});
						});
					</script>
					<h4 class="widgettitle">
						<span id="history_deyail1">Date</span>
						<span id="history_deyail2">Cell phone</span>
						<span id="history_deyail3">Description</span>
						<span id="history_deyail4">Amount</span>
					</h4>
					<div class="accordion accordion-info">
						{section name=transaction_loop loop=$trans}
						<h3><a href="#">
							<span id="history_deyail1">{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</span>
							<span id="history_deyail2"><strong>{$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["last_name"]}</strong> {$trans[transaction_loop].from_description}</span>
							<span id="history_deyail3">{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</span>
							<span id="history_deyail4">₹{number_format({$trans[transaction_loop].amount}, 2, '.', ',')}</span>
						</a></h3>
						<div>
							<div class="widgetbox login-information">
								<h4 class="widgettitle">Transaction Information</h4>
									<div class="widgetcontent form-horizontal form_transaction">
										{foreach name=transaction_info_loop from=$transinfo[$trans[transaction_loop].transaction_id] key=j item=k}
											<div class="form-group">
												<label class="col-md-2 control-label">{$j}:</label>
															  <div class="col-md-10">
															  <span class="profile_detail">{$k}</span>
															  </div>
											</div>
										{/foreach}
												<!--<ul>
													{foreach name=transaction_info_loop from=$transinfo[$trans[transaction_loop].transaction_id] key=j item=k}
														<li>{$j}: {$k}</li>
													{/foreach}
												</ul>-->
								</div>
							</div>
						</div>
						{sectionelse}
							<div class="drow">
	                       		<div class="dcol"><em>There are no transactions.</em></div>
	                       	</div>
	                    {/section}
						
					</div>
					
					
					<!--<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Date</div>
								<div class="dcol col2">Cell phone</div>
								<div class="dcol col3">Description</div>
								<div class="dcol col4">Amount</div>
							</div>
						</div>
						<div class="dbody">
							{section name=transaction_loop loop=$trans}
								<div id="{$trans[transaction_loop].transaction_id}" class="drow{if $smarty.section.transaction_loop.index%2} drowalt{/if}">
									<div class="dnormal{if $trans[transaction_loop].viewed == 0} dunread{/if}">
										<div class="dcol col1">{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</div>
										<div class="dcol col2"><strong>{$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["last_name"]}</strong> {$trans[transaction_loop].from_description}</div>
										<div class="dcol col3">{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</div>
										<div class="dcol col4">₹{number_format({$trans[transaction_loop].amount}, 2, '.', ',')}</div>
									</div>
									<div class="dextend">
										<div class="expandarrow"></div>
										<div class="expandtype transactionbox">
											<div>
												<p><strong>Transaction Information</strong></p>
												<ul>
													{foreach name=transaction_info_loop from=$transinfo[$trans[transaction_loop].transaction_id] key=j item=k}
														<li>{$j}: {$k}</li>
													{/foreach}
												</ul>
											</div>
										</div>
									</div>
								</div>
							{sectionelse}
								<div class="drow">
	                        		<div class="dcol"><em>There are no transactions.</em></div>
	                        	</div>
	                        {/section}
						</div>
					</div>-->
					
					{if $pages > 1}
						<ul class="pagination">
							{section name=pageid start=0 loop=$pages}
								{if $pages > 10}
									{if ($smarty.section.pageid.index == 1) and ($page > 4)}
										<li{if $page == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}history/home/?DF={$selecteddatefrom}&amp;DT={$selecteddateto}&amp;T={$selectedtype}&amp;AF={$selectedamountfrom}&amp;AT={$selectedamountto}&amp;M={$selectedcell}&amp;P={($smarty.section.pageid.index + 1)}">...</a></li>
									{/if}
									{if (($page - 2) <= ($smarty.section.pageid.index+1) and ($page+5) >= ($smarty.section.pageid.index+1)) or ($smarty.section.pageid.index == 0) or (($smarty.section.pageid.index+1) == $pages)}
										<li{if $page == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}history/home/?DF={$selecteddatefrom}&amp;DT={$selecteddateto}&amp;T={$selectedtype}&amp;AF={$selectedamountfrom}&amp;AT={$selectedamountto}&amp;M={$selectedcell}&amp;P={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
									{/if}
									{if ($smarty.section.pageid.index == $pages-2) and ($page < $pages-6)}
										<li{if $page == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}history/home/?DF={$selecteddatefrom}&amp;DT={$selecteddateto}&amp;T={$selectedtype}&amp;AF={$selectedamountfrom}&amp;AT={$selectedamountto}&amp;M={$selectedcell}&amp;P={($smarty.section.pageid.index + 1)}">...</a></li>
									{/if}
								{else}
									<li{if $page == ($smarty.section.pageid.index + 1)} class="selected"{/if}><a href="{$formbase}history/home/?DF={$selecteddatefrom}&amp;DT={$selecteddateto}&amp;T={$selectedtype}&amp;AF={$selectedamountfrom}&amp;AT={$selectedamountto}&amp;M={$selectedcell}&amp;P={($smarty.section.pageid.index + 1)}">{if $smarty.section.pageid.index == 0}Page {/if}{($smarty.section.pageid.index + 1)}</a></li>
								{/if}
							{/section}
						</ul>
					{/if}
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}