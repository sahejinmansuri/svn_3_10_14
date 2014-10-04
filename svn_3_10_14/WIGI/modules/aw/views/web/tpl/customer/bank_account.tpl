<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Bank Account Approval
</h4>

<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol col1">Name</div>
            <div class="dcol col2">Email</div>
            <div class="dcol col3">Default cell phone / device</div>
            <div class="dcol col4">Driver's license number</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$bankaccounts key=k item=v name=bankaccounts_loop}
            <div class="drow{if $smarty.foreach.bankaccounts_loop.index%2} drowalt{/if}">
                <div class="dnormal">
                    <div class="dcol col1">
                        <strong>{$v.first_name} {$v.last_name}</strong>
                    </div>
                    <div class="dcol col2">
                        {$v.email}
                    </div>
                    <div class="dcol col3">
                        {$v.cellphone}
                    </div>
                    <div class="dcol col4">

                    </div>
                </div>
                <div class="dextend">
                    <div class="expandarrow"></div>
                    <div class="expandtype">
                        <p><strong>Bank Account Information</strong></li>
                        <ul>
                            <li>Name: {$v.first_name} {$v.last_name}</li>
                            <li>Email: {$v.email}</li>
                            <li>Default cell phone / device: {$v.cellphone}</li>
                            <li>Bank Account number: xxxx-{$v.last4}</li>
                            {if true == false}
                                <li>Driver's license number: {$v.drivers_license_no}</li>
                                <li>Driver's license expiration: {$v.expiration}</li>
                                <li>Driver's license state: {$v.state}</li>
                            {/if}
                            <li>User confirmed account: {if $v.conf_amt_cleared == 1}Yes{else}No{/if}</li>
                        </ul>
                        <ul class="rowactions">
                            <li><a href="{$formbase}customer/approvebankaccount/B/{$v.user_bank_account_id}">Approve</a></li>
                            <li><a href="{$formbase}customer/denybankaccount/B/{$v.user_bank_account_id}">Deny</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {foreachelse}
            <div class="drow">
                <div class="dcol"><em>There are no bank accounts.</em></div>
            </div>
            {/foreach}
        </div>
    </div>