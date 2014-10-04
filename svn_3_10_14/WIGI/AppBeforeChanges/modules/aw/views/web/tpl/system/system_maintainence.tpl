{literal}
<style>
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
</style>

<script>
function toggleDateDiv(id)
{
    $('#datediv').show();
    if(id) {$('#datediv').hide(); }
}
</script>
{/literal}

<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Schedule Maintainence
</h4>

        <div class="attention">
            <h4> Current System Time is:   <b>{$curr_sys_time} CDT</b></h4>
            <b>Scheduling a maintainence NOW would bring the system down for 30 mins starting from now.</b>
        </div>
        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}system/addmaintainence" method="post">

                <div class="recrow">
                        <div class="left2 b">Select Application</div>
                        <div class="left">
                            <select name="app" style="width:200px;">
                                <option value="all">All Applications</option>
                                <option value="mw">Merchant Wigi</option>
                                <option value="cw">Consumer Wigi</option>
                                <option value="posws">Pos WS</option>
                                <option value="mobws">Mobile WS</option>
                                <option value="wsafe">Wigi Safe</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>


                <div class="recrow">
                        <div class="left2 b">Schedule NOW</div>
                        <div class="left">
                                <input type="radio" name="schedule_now" value="1" checked onClick="toggleDateDiv(1);">Yes
                                <input type="radio" name="schedule_now" value="0" onClick="toggleDateDiv(0);">No
                        </div>
                        <div style="clear:both;"></div>
                </div>


                <div id="datediv" style="display:none;">
                    <div class="recrow">
                                <div class="left2 b">Date From:</div>
                                <div class="right2"><input type="text" name="start_date" value="" class="date system_main start_date" /></div>
                                <div class="right2" style="width:100px;margin-right:10px;">
                                    <select name="start_hour"  style="width:100px;">
                                        {include file='system/hour_dd.tpl'}
                                    </select>
                                 </div>
                                <div class="right2" style="width:100px;">
                                    <select name="start_mins"  style="width:100px;">
                                        {include file='system/mins_dd.tpl'}
                                    </select>
                                 </div>
                                <div style="clear:both;"></div>
                    </div>

                    <div class="recrow">
                                <div class="left2 b">Date From:</div>
                                <div class="right2"><input type="text" name="end_date" value="" class="date system_main end_date" /></div>
                                <div class="right2" style="width:100px;margin-right:10px;">
                                    <select name="end_hour"  style="width:100px;">
                                        {include file='system/hour_dd.tpl'}
                                    </select>
                                 </div>
                                <div class="right2" style="width:100px;">
                                    <select name="end_mins"  style="width:100px;">
                                        {include file='system/mins_dd.tpl'}
                                    </select>
                                 </div>
                                <div style="clear:both;"></div>
                    </div>
                </div>

                <div class="recrow">
                        <div class="left2 b">Action</div>
                        <div class="left">
                                <select name="schedule_action"  style="width:150px;">
                                    <option value="NO_NEW">No New Logins</option>
                                    <option value="ALL_OUT">Everyone Out</option>
                                </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                            <div class="left2 b">User Message:</div>
                            <div><textarea rows="4" name="user_message" columns="250" style="width:450px;"></textarea></div>
                </div>

                <div class="recrow">
                            <div class="left2 b">Notes:</div>
                            <div><textarea rows="4" name="notes" columns="250" style="width:450px;"></textarea></div>
                </div>

                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="Insert" />
               </div>
        </form>
        </div>



	{literal}
	<script type="text/javascript">
		$(document).ready(function() {
			var dates = $(".system_main").datepicker({
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