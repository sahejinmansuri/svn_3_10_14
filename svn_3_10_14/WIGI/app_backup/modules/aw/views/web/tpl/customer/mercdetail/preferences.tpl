<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;General Account Preferences
</h4>
    <p>These preferences apply to your whole account, not the individual devices.</p>

    <div class="columnbox">

        <h5>General preferences</h5>

        <div class="row">
            <p><strong>Accept POS cash payments</strong></p>
            <p class="data">{if $preferences['accept']['cash'] == "true"}Yes{else}No{/if}</p>
        </div>

        <div class="row">
            <p><strong>Accept POS credit card payments</strong></p>
            <p class="data">{if $preferences['accept']['creditcard'] == "true"}Yes{else}No{/if}</p>
        </div>

        <div class="row">
            <p><strong>Accept Scan &amp; Pay</strong></p>
            <p class="data">{if $preferences['accept']['scanandpay'] == "true"}Yes{else}No{/if}</p>
        </div>

        <div class="row">
            <p><strong>Accept Scan &amp; Buy</strong></p>
            <p class="data">{if $preferences['accept']['scanandbuy'] == "true"}Yes{else}No{/if}</p>
        </div>

        <div class="row">
            <p><strong>Accept eCommerce</strong></p>
            <p class="data">{if $preferences['accept']['ecommerce'] == "true"}Yes{else}No{/if}</p>
        </div>

        {if true == false}
            <div class="row">
                <p><strong>Accept POS payments</strong></p>
                <p class="data">{if $preferences['accept']['pos'] == "true"}Yes{else}No{/if}</p>
            </div>
        {/if}

        <div class="row">
            <p><strong>POS secret</strong></p>
            <p class="data">{if $preferences['possecret'] != null}{$preferences['possecret']}{else}N/A{/if}</p>
        </div>

        <div class="row">
            <p><strong>Sales tax</strong></p>
            <p class="data">{$preferences['salestax']}</p>
        </div>

        <div class="row">
            <p><strong>Tips</strong></p>
            <p class="data">₹{number_format($preferences['tips'], 2, '.', ',')}</p>
        </div>

        <div class="row">
            <p><strong>Timezone</strong></p>
            <p class="data">GMT {$preferences['system']['timezone']}</p>
        </div>


    {if $cur_merc->getStatus() != 'deleted'}
        <ul class="actionlinks">
            <li><a class="edit-info" title="Edit Merchant Preferences" href="{$formbase}update/showmerchant?MID={$mid}&section=preferences">Edit Preferences</a></li>
            <!--<li><a href="{$formbase}profile/lockaccount">Lock account</a></li>
            <li><a href="{$formbase}profile/deleteaccount">Delete account</a></li>-->
        </ul>
    {/if}

    </div>