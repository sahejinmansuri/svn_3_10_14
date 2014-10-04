<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;POS Users
</h4>
<p>You can add to your InCashMe&#8482; Merchant Account up to ten (10) POS users. Before you add POS users, you need to have the POS secret defined in preferences.</p>


{if (count($merchants_pos_user_data)) > 0}
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol summarycol">ID</div>
            <div class="dcol width150">Username</div>
            <div class="dcol width150">Name</div>
            <div class="dcol summarycol3">Status</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$merchants_pos_user_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.user_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.user_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol summarycol">{$data.user_id}</div>
                    <div class="dcol width150">{$data.email}</div>
                    <div class="dcol width150">{$data.first_name}&nbsp;{$data.last_name}</div>
                    <div class="dcol summarycol3">{$data.status}</div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="{$data.user_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">

                    <table>
                    <tr style="background:none;">
                    <td width="95%">
                        <ul class="resultul">
                            <li><div class="width100 left">Date Added</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                            <li><div class="width100 left">Date Updated</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                        </ul>
                    </td>
                    </tr>
                    <tr>
                    <td>
                       <div class="recrow ctr">
                        <a href="{$formbase}profile/edituser/ITEM/{$data.user_id}/userid/{$merchant_id}"><div class="adminBtn">Edit</div></a>
                        <a href="{$formbase}profile/deleteuser/ITEM/{$data.user_id}/userid/{$merchant_id}"><div class="adminBtn">Delete</div></a>
                        <a href="{$formbase}profile/edituserpassword/ITEM/{$data.user_id}/userid/{$merchant_id}"><div class="adminBtn">Change password</div></a>
                        {if $data.status == "active" or $data.status == "locked"}
                            <a href="{$formbase}profile/edituserstatus/ITEM/{$data.user_id}/userid/{$merchant_id}"><div class="adminBtn">Change Status</div></a>
                        {else}
                            <a href="#" onclick="$.wigialert('You can only change status for active and locked users.');return false;"><div class="adminBtn">Change Status</div></a>
                        {/if}
                       </div>
                    </td>
                    </tr>
                    </table>
            </div>
            <div style="clear:both;"></div>

        {foreachelse}
            <div class="dnormal">
                <em>There are no users associated with your account.</em>
            </div>
        {/foreach}
   </div>
</div>
{else}
    <div class="dnormal">
        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span class="ui-icon-alert ui-icon ugreen"></span></span></span>
        &nbsp;<em>There are no users associated with your account.</em>
    </div>
{/if}


<ul class="actionlinks">
    {if $preferences['possecret'] == null}
        <li><a href="{$formbase}profile/editprefs">You need to define a POS secret to add new POS users</a></li>
    {elseif (count($users)) < 10}
        <li><a href="{$formbase}profile/adduser?userid={$merchant_id}">Add new</a></li>
    {else}
        <li><a href="#">Can't add more than 10 POS users</a></li>
    {/if}
</ul>

<div style="clear:both;"></div>
<br/>
