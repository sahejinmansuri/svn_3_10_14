<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Login History
</h4>

{if (count($login_history_data)) > 0}
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol width150">Date & Time</div>
            <div class="dcol width150">IP</div>
            <div class="dcol txsearch_col7">Application</div>
            <div class="dcol width150">Client</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$login_history_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol width150">{$data.stamp}</div>
                    <div class="dcol width150">{$data.ip}</div>
                    <div class="dcol txsearch_col7">{$data.application}</div>
                    <div class="dcol width150">{$data.client_type}</div>
                </div>
            </div>
            <div style="clear:both;"></div>
        {foreachelse}
            <div class="dnormal">
                <em>No Login History Records Found.</em>
            </div>
        {/foreach}
   </div>
</div>
{else}
    <div class="dnormal">
        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span class="ui-icon-alert ui-icon ugreen"></span></span></span>
        &nbsp;<em>No Login History Records Found.</em>
    </div>
{/if}

<div style="clear:both;"></div>
<br/>
