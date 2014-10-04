<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Messages
</h4>

        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}customer/home#messages" method="get">
                <div class="recrow">
                        <div class="left2 b">Date From:</div>
                        <div class="right2"><input type="text" name="datefrom" value="{$datefrom}" class="date messagedates datefrom" /></div>
                        <div class="left2 b">Date To</div>
                        <div class="left"><input type="text" name="dateto" value="{$dateto}" class="date messagedates dateto" /></div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                        <div class="left2 b">Status:</div>
                        <div class="right2">
                            <select name="msg_status">
                                <option value="">Select</option>
                                <option value="UR" {if $msg_status=='UR'}selected{/if}>Unread</option>
                                <option value="RE" {if $msg_status=='RE'}selected{/if}>Read</option>
                                <option value="RR" {if $msg_status=='RR'}selected{/if}>Read & Responded</option>
                                <option value="AR" {if $msg_status=='AR'}selected{/if}>Archived</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="Search Messages" />
               </div>
        </form>
        </div>

        <div class="dtable">
            <div class="dhead">
                <div class="drow">
                    <div class="dcol" style="width:50px;">&nbsp;</div>
                    <div class="dcol" style="width:300px;">Subject</div>
                    <div class="dcol summarycol3">Status</div>
                    <div class="dcol col1">Date Recieved</div>
                </div>
            </div>
            <div class="dbody">
                {foreach from=$support_messages item=data}
                    <div class="drow drowalt">
                        <div class="dnormal">
                            <div class="dcol" onClick="toggleS('{$data.support_id}');">
                                <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.support_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                            </div>
                            <div class="dcol" style="width:300px;{if $data.msg_status=='UR'}font-weight:bold;{/if}">{$data.subject}</div>
                            <div class="dcol summarycol3">{$data.msg_status_desc}</div>
                            <div class="dcol summarycol2">{$data.date_added}</div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div id="{$data.support_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                            <div class="recrow"> 
                                {$data.message}
                            </div>
                    </div>
                    <div style="clear:both;"></div>

                {foreachelse}
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