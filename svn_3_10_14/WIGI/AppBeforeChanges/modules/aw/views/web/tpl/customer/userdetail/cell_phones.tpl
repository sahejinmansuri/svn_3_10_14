<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Cell Phones
</h4>
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol summarycol4">ID</div>
            <div class="dcol summarycol">Phone Number</div>
            <div class="dcol summarycol">Display Name</div>
            <div class="dcol summarycol3">Status</div>
            <div class="dcol summarycol3">Balance</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$consumers_mobile_info_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.mobile_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.mobile_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol summarycol4">{$data.mobile_id}</div>
                    <div class="dcol summarycol">{$data.cellphone}</div>
                    <div class="dcol summarycol">{$data.alias}</div>
                    <div class="dcol summarycol3">{$data.status}</div>
                    <div class="dcol summarycol3">US${number_format($data.balance, 2, '.', ',')}</div>
                </div>
            </div>
            <div style="clear:both;"></div>

            <div id="{$data.mobile_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                        <table>
                        <tr style="background:none;">
                        <td width="45%">
                            <p><strong>Information</strong></p>
                            <ul class="resultul">
                                <li><div class="width100 left">Date Added</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                                <li><div class="width100 left">Date Updated</div>: {date("M j, Y", strtotime($data.date_changed))}</li>
                                <li><div class="width100 left">OS Version </div>: {$data.os_version}</li>
                                <li><div class="width100 left">App Version</div>: {$data.app_version}</li>
                                <li><div class="width100 left">Last Login</div>: {$data.last_login}</li>
                                <li><div class="width100 left">Device</div>: {$data.phone_brand}</li>
                            </ul>
                        </td>

                        <td width="54%">
                            <p><strong>Cell phone preferences</strong></p>
                            <ul class="resultul">
                                <li><div class="width200 left">Mobile app timeout</div>: {$data.preferences['system'].timeout}</li>
                                <li><div class="width200 left">International transfers</div>: {$data.preferences['wigi'].international_trans}</li>
                                <li><div class="width200 left">Alerts (via)</div>: {$data.preferences['notification'].alert}</li>
                                <li><div class="width200 left">Maximum amount per transaction</div>: {$data.preferences['wigi'].max_per_trans}</li>
                                <li><div class="width200 left">Maximum # of transactions per day</div>: {$data.preferences['wigi'].max_per_day}</li>
                                <li><div class="width200 left">InCashMe&#8482; Money Payment Code timeout</div>: {$data.preferences['wigi'].timeout} minutes</li>
                                <li><div class="width200 left">Maximum amount per gifts</div>: US${$data.preferences['gift'].max_per_trans}</li>
                                <li><div class="width200 left">Maximum # of gifts per day</div>: {$data.preferences['gift'].max_per_day}</li>
                                <li><div class="width200 left">Maximum amount per funding</div>: US${$data.preferences['funding'].max_per_trans}</li>
                                <li><div class="width200 left">Maximum # of funding per day</div>: {$data.preferences['funding'].max_per_day}</li>
                            </ul>
                        </td>
                       </tr>
                       <tr>
                           <div class="recrow ctr">
                            {if $data.status == "unconfirmed"}
                                <a class="edit-info" title="Edit Preferences" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=activate"><div class="adminBtn">Confirm</div></a>
                            {/if}
                            {if $data.is_default == 0 and $data.status == "active"}
                                <a class="edit-info" title="Set default" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=tobe"><div class="adminBtn">Set default</div></a>
                            {/if}
                            {if $data.status == "active"}
                                <a class="edit-info" title="Edit Name" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=name"><div class="adminBtn">Edit Name</div></a>
                                <a class="edit-info" title="Edit Questions" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=questions"><div class="adminBtn">Edit Questions</div></a>
                                <a class="edit-info" title="Preferences" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=preferences"><div class="adminBtn">Preferences</div></a>
                                <a class="edit-info" title="Change PIN" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=error"><div class="adminBtn">Change PIN??</div></a>
                                <a class="edit-info" title="Lock Cell" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=lock"><div class="adminBtn">Lock Cell</div></a>
                                <a class="edit-info" title="Delete Cell" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=delete" {if (int)$data.balance>0} onclick="$.wigialert('Please withdraw this funds from this account before deleting.');return false;"{/if}><div class="adminBtn">Delete Cell</div></a>
                            {elseif $data.status == "locked"}
                                <a class="edit-info" title="Unlock Cell" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=unlock"><div class="adminBtn">Unlock Cell</div></a>
                            {/if}
                            {if $data.is_default == 0}
                                <a class="edit-info" title="Delete Cell" href="{$formbase}update/showmobile?UID={$uid}&recid={$data.mobile_id}&section=delete" {if (int)$data.balance>0} onclick="$.wigialert('Please withdraw this funds from this account before deleting.');return false;"{/if}><div class="adminBtn">Delete Cell</div></a>
                                <!--<a href="{$formbase}profile/deletecell/ITEM/{$data.mobile_id}"{if (int)$data.balance>0} onclick="$.wigialert('Please withdraw this funds from this account before deleting.');return false;"{/if}><div class="adminBtn">Delete</div></a>-->
                            {/if}

                           </div>
                       </tr>
                       </table>
            
            </div>

            <div style="clear:both;"></div>

        {foreachelse}
            <em>There are no cell phones associated with this account.</em>
        {/foreach}


        {if $user->getStatus() != 'deleted'}
        <ul class="actionlinks">
            {if (count($consumers_mobile_info_data)) < 4}
                <li><a href="{$formbase}profile/addcell">Add new</a></li>
            {else}
                <li><a href="#">Can't add more than 4 cell phones</a></li>
            {/if}
        </ul>
        {/if}

   </div>
</div>