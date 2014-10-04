<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Credit Cards
</h4>
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol summarycol">Card Description</div>
            <div class="dcol width150">Name on Card</div>
            <div class="dcol summarycol3">Status</div>
            <div class="dcol summarycol3">Card Number</div>
            <div class="dcol col1">Expiration Date</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$consumers_credit_card_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.user_credit_card_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.user_credit_card_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol summarycol">{$data.description}</div>
                    <div class="dcol width150">{$data.name_on_card}</div>
                    <div class="dcol summarycol3">{$data.status}</div>
                    <div class="dcol summarycol3">**{$data.last4}</div>
                    <div class="dcol summarycol2">{$data.expire_month}/{$data.expire_year}</div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="{$data.user_credit_card_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">

                    <table>
                    <tr style="background:none;">
                    <td width="95%">
                        <ul class="resultul">
                            <li><div class="width100 left">Date Added</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                            <li><div class="width100 left">Date Updated</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                            <li><div class="width100 left">Card Type </div>: {$data.card_type}</li>
                            <li><div class="width100 left">Conf Amount?</div>: {$data.conf_amt}</li>
                            <li><div class="width100 left">Key Version</div>: {$data.key_version}</li>
                        </ul>
                    </td>
                    </tr>
                    </table>
            </div>
            <div style="clear:both;"></div>

        {foreachelse}
        {/foreach}

   </div>
</div>


<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Bank Accounts
</h4>
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol summarycol">Description</div>
            <div class="dcol summarycol3">Bank Type</div>
            <div class="dcol summarycol3">Status</div>
            <div class="dcol summarycol3">Card Number</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$consumers_bank_account_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.user_bank_account_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.user_bank_account_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol summarycol">{$data.description}</div>
                    <div class="dcol summarycol3">{$data.bank_type}</div>
                    <div class="dcol summarycol3">{$data.status}</div>
                    <div class="dcol summarycol3">**{$data.last4}</div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="{$data.user_bank_account_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                    <table>
                    <tr style="background:none;">
                    <td width="95%">
                        <ul class="resultul">
                            <li><div class="width100 left">Date Added</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                            <li><div class="width100 left">Date Updated</div>: {date("M j, Y", strtotime($data.date_added))}</li>
                            <li><div class="width100 left">Lock Count </div>: {$data.lock_count}</li>
                            <li><div class="width100 left">Conf Amount2?</div>: {$data.conf_amt2}</li>
                            <li><div class="width100 left">Key Version</div>: {$data.key_version}</li>
                            <li><div class="width100 left">Admin Cleared</div>: {$data.admin_cleared}</li>
                        </ul>
                    </td>
                    </tr>
                    </table>

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


{if $user->getStatus() != 'deleted'}
<ul class="actionlinks">
    {if (count($consumers_credit_card_data)+count($consumers_bank_account_data)) < 2}
        <li><a href="{$formbase}profile/addmoney">Add new</a></li>
    {else}
        <li><a href="#">Can't add more than 2 Active Accounts</a></li>
    {/if}
    {if true == false}
        {if (count($consumers_credit_card_data)+count($consumers_bank_account_data) > 0)}
            <li><a href="{$formbase}profile/linkcell">Link to cell phone</a></li>
        {/if}
    {/if}
</ul>
{/if}