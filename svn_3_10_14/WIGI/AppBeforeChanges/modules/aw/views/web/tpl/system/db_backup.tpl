<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Database Backups
</h4>
        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}system/dbbackup" method="post">

                <div class="recrow">
                        <div class="left2 b">Select Database</div>
                        <div class="left">
                            <select name="dbname" style="width:200px;">
                                <option value="all">All Databases</option>
                                <option value="wigidb">Wigi</option>
                                <option value="wlogdb">Wigi Log</option>
                                <option value="wsafedb">Wigi Safe</option>
                                <option value="sesssb">Wigi Session</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                    <div class="left2 b">Notes:</div>
                    <div><textarea rows="4" name="notes" columns="250" style="width:450px;"></textarea></div>
                </div>

                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="BackUp Db" />
               </div>
        </form>
        </div>
