<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;General Account Preferences
</h4>
    <div class="columnbox">

        <div style="padding:10px;background:#E4F5C8;padding:4px;">
        <h5>General preferences</h5>
            <table>
            <tr style="background:none;">
            <td width="95%">
                <ul class="resultul">
                    {if true == false}
                        <li><div class="width250 left"><strong>Minimum balance</strong></div>: ₹{number_format($preferences['wigi']['minbal'], 2, '.', ',')} </li>
                    {/if}
                    <li><div class="width250 left"><strong>Mobile app timeout</strong></div>: {$preferences['system']['timeout']} seconds</li>
                    <li><div class="width250 left"><strong>International transfers</strong></div>: {if $preferences["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</li>
                    <li><div class="width250 left"><strong>Alerts</strong></div>: via {$preferences["notification"]["alert"]}</li>
                    {if true == false}
                        <li><div class="width250 left"><strong>Statement method</strong></div>: by {$preferences["notification"]["statement"]}</li>
                    {/if}
                    <li><div class="width250 left"><strong>Timezone</strong></div>: GMT {$preferences['system']['timezone']}</li>
                    <li><div class="width250 left"><strong>BBBB</strong></div>: AAAA</li>
                </ul>
            </td>
            </tr>
            </table>
        </div>



        <div style="padding:10px;background:#E4F5C8;padding:4px;">
        <h5>InCashMe&#8482; Money Payment Code preferences</h5>
            <table>
            <tr style="background:none;">
            <td width="95%">
                <ul class="resultul">
                    <li><div class="width250 left"><strong>Maximum amount per transaction</strong></div>: ₹{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}</li>
                    <li><div class="width250 left"><strong>Maximum number of transactions per day</strong></div>: {$preferences['wigi']['max_per_day']} transactions</li>
                    <li><div class="width250 left"><strong>InCashMe&#8482; Money Payment Code timeout</strong></div>: {$preferences["wigi"]["timeout"]} minutes</li>
                </ul>
            </td>
            </tr>
            </table>
        </div>



        <div style="padding:10px;background:#E4F5C8;padding:4px;">
        <h5>Send money/gift preferences</h5>
            <table>
            <tr style="background:none;">
            <td width="95%">
                <ul class="resultul">
                    <li><div class="width250 left"><strong>Maximum amount per transaction</strong></div>: ₹{number_format($preferences["gift"]["max_per_trans"], 2, '.', ',')}</li>
                    <li><div class="width250 left"><strong>Maximum number of transactions per day</strong></div>: {$preferences["gift"]["max_per_day"]} gifts</li>
                </ul>
            </td>
            </tr>
            </table>
        </div>

		<div style="padding:10px;background:#E4F5C8;padding:4px;">
        <h5>Scan Payment System preferences</h5>
            <table>
            <tr style="background:none;">
            <td width="95%">
                <ul class="resultul">
                    <li><div class="width250 left"><strong>Maximum amount per scan</strong></div>: ₹{number_format($preferences['scan']['max_per_trans'], 2, '.', ',')}</li>
                    <li><div class="width250 left"><strong>Maximum number of scan per day</strong></div>: {$preferences["scan"]["max_per_day"]} scans</li>
                </ul>
            </td>
            </tr>
            </table>
        </div>

        <div style="padding:10px;background:#E4F5C8;padding:4px;">
        <h5>Funding preferences</h5>
            <table>
            <tr style="background:none;">
            <td width="95%">
                <ul class="resultul">
                    <li><div class="width250 left"><strong>Maximum amount per funding</strong></div>: ₹{number_format($preferences['funding']['max_per_trans'], 2, '.', ',')}</li>
                    <li><div class="width250 left"><strong>Maximum number of fundings per day</strong></div>: {$preferences["funding"]["max_per_day"]} transactions</li>
                </ul>
            </td>
            </tr>
            </table>
        </div>

        {if $user->getStatus() != 'deleted'}
        <ul class="actionlinks">
            <li><a class="edit-info" title="Edit Preferences" href="{$formbase}update/showuser?UID={$uid}&section=preferences">Edit Preferences</a></li>
            <!--<li><a href="{$formbase}profile/lockaccount">Lock account</a></li>
            <li><a href="{$formbase}profile/deleteaccount">Delete account</a></li>-->
        </ul>
        {/if}

    </div>