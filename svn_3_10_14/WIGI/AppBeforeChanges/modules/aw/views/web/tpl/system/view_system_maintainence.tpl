{if count($current_maintainence_data)>0}
<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Currently Active Maintainence
</h4>
<div class="attention">
    <h4> Current System Time is:   <b>{$curr_sys_time} CDT</b></h4>
</div>


<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:140px;">App Name</div>
            <div class="dcol" style="width:140px;">End Time</div>
            <div class="dcol" style="width:140px;">Take Action</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$current_maintainence_data item=data}
                <form action="{$formbase}system/editmaintainence?app={$data.app}" method="post">

                    <div class="drow drowalt">
                        <div class="dnormal">
                            <div class="dcol" style="width:140px;">{$data.app_desc}</div>
                            <div class="dcol" style="width:140px;">{$data.end_time}</div>
                            <div class="dcol" style="width:140px;">
                                    <select name="schedule_action"  style="width:150px;">
                                        <option value="BACK_UP">System Up Again</option>
                                        <option value="NO_NEW">No New Logins</option>
                                        <option value="ALL_OUT">Everyone Out</option>
                                    </select>
                            </div>
                            <div class="dcol" style="width:140px;text-align:right;">
                                    <input class="adminBtn" type="submit" value="Take Action" />
                            </div>

                        </div>
                    </div>

                 </form>
        {/foreach}

   </div>
</div>       
{/if}

<!-- Show Regular Maintainence Now-->

<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;View System Maintainence
</h4>


<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol" style="width:140px;">App Name</div>
            <div class="dcol" style="width:140px;">Start Time</div>
            <div class="dcol" style="width:140px;">End Time</div>
            <div class="dcol" style="width:80px;">User Added</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$system_maintainence_info item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.system_maintainence_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.system_maintainence_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol" style="width:140px;">{$data.app_desc}</div>
                    <div class="dcol" style="width:140px;">{$data.start_time}</div>
                    <div class="dcol" style="width:140px;">{$data.end_time}</div>
                    <div class="dcol" style="width:80px;">{$data.user_id}</div>
                </div>
            </div>

            <div style="clear:both;"></div>
            <div id="{$data.system_maintainence_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                    <table>
                    <tr style="background:none;">
                    <td width="95%">
                        <ul class="resultul">
                            <li><div class="width100 left">Notes</div>: {$data.notes}</li>
                            <li><div class="width100 left">User Message</div>: {$data.user_message}</li>
                            <li><div class="width100 left">Schedule Action</div>: {$data.schedule_action}</li>
                            <li><div class="width100 left">Schedule Now</div>: {$data.schedule_now}</li>
                        </ul>
                    </td>
                    </tr>
                    </table>
            </div>
            <div style="clear:both;"></div>
        
        {foreachelse}
            <p>No System Maintainence Records Found</p>
        {/foreach}

   </div>
</div>       

{literal}
<script>
function toggleS(div)
{
$('#'+div).toggle();
$('#c_'+div).toggleClass('ui-icon-minus');
}
</script>
{/literal}
