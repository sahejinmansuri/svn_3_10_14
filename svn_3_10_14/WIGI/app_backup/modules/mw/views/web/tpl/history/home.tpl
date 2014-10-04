{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup transactions">
					
					<h4>Account history</h4>
					
					<p>You can review your most recent transactions in the History listing. By default we show all transactions in your InCashMe&#8482; Merchant Account. 
                    You can also select a particular device to review those transactions only.<br />You simply click on a particular transaction to see additional details, click again to collapse the display.</p>
					
					<form action="{$formbase}history/home" method="get">
						<ul class="filter">
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
											<option value="101"{if $selectedtype == 101} selected="selected"{/if}>Received Money</option>
											<option value="205"{if $selectedtype == 205} selected="selected"{/if}>Scan &amp; Buy</option>
											<option value="206"{if $selectedtype == 206} selected="selected"{/if}>Scan &amp; Pay</option>
											<option value="209"{if $selectedtype == 209} selected="selected"{/if}>eCommerce</option>
											<option value="208"{if $selectedtype == 208} selected="selected"{/if}>Received WPC</option>
											{if $businessusertype == 5}<option value="103"{if $selectedtype == 103} selected="selected"{/if}>Received Donations</option>{/if}
											<option value="302"{if $selectedtype == 302} selected="selected"{/if}>Fund From Bank Account</option>
											<option value="303"{if $selectedtype == 303} selected="selected"{/if}>Withdraw to Bank Account</option>
											<option value="300"{if $selectedtype == 300} selected="selected"{/if}>Fund from Credit Card</option>
											<option value="200"{if $selectedtype == 200} selected="selected"{/if}>WPC Created</option>
											<option value="201"{if $selectedtype == 201} selected="selected"{/if}>WPC Expired</option>
											<option value="202"{if $selectedtype == 202} selected="selected"{/if}>WPC Redeemed</option>
											<option value="204"{if $selectedtype == 204} selected="selected"{/if}>WPC Deleted</option>
											<option value="211"{if $selectedtype == 211} selected="selected"{/if}>WPC Pending</option>
											<option value="212"{if $selectedtype == 212} selected="selected"{/if}>WPC Refunded</option>
											<option value="400"{if $selectedtype == 400} selected="selected"{/if}>Cash sale</option>
											<option value="401"{if $selectedtype == 401} selected="selected"{/if}>Credit Card sale</option>
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
									<li>From <input type="text" name="AF" value="{$selectedamountfrom}" class="amount" maxlength="8" /></li>
									<li>To <input type="text" name="AT" value="{$selectedamountto}" class="amount" maxlength="8" /></li>
								</ul>
							</li>
							<li>
								<p><strong>Device</strong></p>
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
						</ul>
					</form>
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
					
					<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Date</div>
								<div class="dcol col2">Device</div>
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
					</div>
					
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