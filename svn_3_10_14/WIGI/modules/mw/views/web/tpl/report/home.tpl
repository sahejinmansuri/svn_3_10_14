{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup tab download">
					
					<h4>Download transactions</h4>
					<p>Download your transactions to local computer for further use with Excel, Quickbooks or any Other external systems.</p>
					
					<form action="{$formbase}report/download" method="post">
						
						<ul class="filter">
							<li>
								<p><strong>Date range</strong></p>
								<ul class="withlabels">
									<li>From <input type="text" name="DF" value="" class="date datefrom" /></li>
									<li>To <input type="text" name="DT" value="" class="date dateto" /></li>
								</ul>
							</li>
							<li>
								<p><strong>Transaction type</strong></p>
								<ul>
									<li>
										<select name="T">
											<option value=""></option>
											<option value="205" selected="selected">Scan &amp; Buy</option>
											<option value="206" selected="selected">Scan &amp; Pay</option>
											<option value="103" selected="selected">Scan &amp; Donate</option>
										</select>
									</li>
								</ul>
							</li>
						</ul>
						<input type="hidden" name="AF" value="" />
						<input type="hidden" name="AT" value="" />
						<input type="hidden" name="M" value="" />
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
						
						<div class="formlayout subformlayout">
							
							<div class="stepbox">
								
								<div class="prompt selectedfields checkboxes">
									<label>Include the following fields</label>
									<ul>
										<li class="selected"><a href="#CDATE:yes">Date</a></li>
										<li class="selected"><a href="#CTYPE:yes">Transaction type</a></li>
										<li class="selected"><a href="#CNAME:yes">Name</a></li>
										<li class="selected"><a href="#CADDRESS:yes">Address</a></li>
										<li class="selected"><a href="#CPHONE:yes">Phone</a></li>
										<li class="selected"><a href="#CEMAIL:yes">Email</a></li>
										<li class="selected"><a href="#CAMOUNT:yes">Amount</a></li>
										<li class="selected"><a href="#CBILLINGAMOUNT:yes">Billing amount</a></li>
										<li class="selected"><a href="#CDESCRIPTION:yes">Description</a></li>
									</ul>
									<p class="tip">Select which fields you would like to include in the report</p>
								</div>
								
								<div class="prompt formatsettings">
									<label>Format settings</label>
									<select name="INCLUDE_HEADERS">
										<option value="no">Don't include headers</option>
										<option value="yes">Include headers</option>
									</select>
									<p class="tip">Would you like to include column headers?</p>
								</div>
								
								<div class="prompt summarytype">
									<label>Summary type</label>
									<select name="SUMMARY_TYPE">
										<option value="">None</option>
										<option value="topusers">Top Users</option>
									</select>
									<p class="tip">Select a summary type</p>
								</div>
								
								<script type="text/javascript">
									$(document).ready(function() {
										$(".checkboxes").last().after('<div class="checkbox_posts"></div>');
										$(".checkboxes").each(function() {
											var field = $(this);
											var selectClass = "selected";
											$(this).find("li a").each(function() {
												$(this).click(function() {
													$(this).parent().toggleClass(selectClass);
													var html = "";
													field.find("li." + selectClass + " a").each(function() {
														var data = $(this).attr("href").substring(1).split(":");
														var name = data[0];
														var value = data[1];
														html += "<input type=\"hidden\" name=\"" + name + "\" value=\"" + value + "\" />";
													});
													$(".checkbox_posts").html(html);
													return false;
												});
											}).last().trigger("click").trigger("click");
										});
										$(".download form").submit(function() {
											var result = true;
											$(this).find("input[name='DF'], input[name='DT'], input[name='T']").each(function() {
												if ($(this).val() == "") {
													result = false;
												}
											});
											if (result == false) {
												$.wigialert("Please select a date range and a transaction type.");
											}
											return result;
										});
									});
								</script>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="doaction" value="download" />
								<input type="submit" value="Download" />
								
							</div>
							
						</div>
						
					</form>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}