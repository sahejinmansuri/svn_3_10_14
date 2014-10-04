<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;View Database Backups
</h4>


<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:80px;">Db Name</div>
            <div class="dcol" style="width:80px;">Date Backed</div>
            <div class="dcol" style="width:80px;">View File</div>
            <div class="dcol" style="width:200px;">Notes</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$db_backup_info item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" style="width:80px;">{$data.dbname}</div>
                    <div class="dcol" style="width:80px;">{date("M j, Y", strtotime($data.backup_time))}</div>
                    <div class="dcol" style="width:80px;"><a href="/dbbackup/{$data.filename}" target="_blank">View</a></div>
                    <div class="dcol" style="width:200px;">{$data.notes}</div>
                </div>
            </div>
        {foreachelse}
            <p>No Backup Records Found</p>
        {/foreach}

   </div>
</div>       