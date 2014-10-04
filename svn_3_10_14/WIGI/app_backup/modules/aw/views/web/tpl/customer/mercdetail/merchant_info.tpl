<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Merchant Information
</h4>
    <div class="columnbox">
        <div class="row">
            <p><strong>Official Business name</strong></p>
            <p class="data">{$cur_merc->getBusinessName()}</p>
        </div>

        <div class="row">
            <p><strong>Contact first name</strong></p>
            <p class="data">{$cur_merc->getFirstName()}</p>
        </div>

        <div class="row">
            <p><strong>Contact last name</strong></p>
            <p class="data">{$cur_merc->getLastName()}</p>
        </div>

        <div class="row">
            <p><strong>Business phone</strong></p>
            <p class="data">{App_DataUtils::fmtPhone($cur_merc->getBusinessPhone())}</p>
        </div>

        <div class="row">
            <p><strong>Business tax ID or SSN</strong></p>
            <p class="data">{$cur_merc->getBusinessTaxId()}</p>
        </div>

        <div class="row">
            <p><strong>Email/User ID</strong></p>
            <p class="data">{$cur_merc->getEmail()}</p>
        </div>

        <div class="row">
            <p><strong>Account Status</strong></p>
            <p class="data">{$cur_merc->getStatus()}</p>
        </div>

        {if $cur_merc->getStatus() != 'deleted'}
            <ul class="actionlinks">
                <li><a class="edit-info" title="Edit Merchant Info" href="{$formbase}update/showmerchant?MID={$mid}&section=profile">Edit</a></li>
                <li><a class="edit-info" title="Change Password" href="{$formbase}update/showmerchant?MID={$mid}&section=password">Change password</a></li>
                <li><a class="edit-info" title="Edit Questions" href="{$formbase}update/showmerchant?MID={$mid}&section=questions">Edit questions</a></li>
                <li><a class="edit-info" title="Change PIN" href="{$formbase}update/showmerchant?MID={$mid}&section=pin">Change PIN</a></li>
                {if $cur_merc->getStatus() != 'locked'}
                    <li><a class="edit-info" title="Lock Account" href="{$formbase}update/showmerchant?MID={$mid}&section=lock">Lock Account</a></li>
                {/if}
                {if $cur_merc->getStatus() != 'deleted'}
                    <li><a class="edit-info" title="Delete Account" href="{$formbase}update/showmerchant?MID={$mid}&section=delete">Delete Account</a></li>
                {/if}
                {if $cur_merc->getStatus() != 'active'}
                <li><a class="edit-info" title="Activate Account" href="{$formbase}update/showmerchant?MID={$mid}&section=activate">Activate Account</a></li>
                {/if}
            </ul>
        {/if}

    </div>
