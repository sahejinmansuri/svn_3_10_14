
                    <div class="tab setup discounts">

                        <strong>Set Special Billing &nbsp;>>&nbsp Step 1</strong>
                        <form action="{$formbase}billing/discountstep2" method="post" id="usrsearch">
                                    <div style="background:#E4F5C8;padding:4px;">
                                            <div class="recrow">
                                                    <div class="left2 b">Date From:</div>
                                                    <div class="right2"><input type="text" name="sb_datefrom" value="" class="date specialbilling datefrom" /></div>
                                                    <div class="left2 b">Date To:</div>
                                                    <div class="left2"><input type="text" name="sb_dateto" value="" class="date specialbilling dateto" /></div>
                                           </div>       
                                            <div style="clear:both;"></div>
                                            <div class="recrow ctr">
                                                <input class="adminBtn" type="submit" value="Select Dates" />
                                           </div>
                                   </div>                            
                        </form>

                    </div>

	{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			var dates = $(".specialbilling").datepicker({
				minDate:0,
				dateFormat:'yy-mm-dd',
				onSelect: function(selectedDate) {
					var option = (this.className.indexOf("datefrom") != -1) ? "minDate" : "maxDate",
					instance = $(this).data("datepicker"),
					date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
					dates.not(this).datepicker("option", option, date);
				}
			});
		});
	</script>
	{/literal}