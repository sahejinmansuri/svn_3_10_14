<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Personal info
</h4>
    <div class="columnbox">
        <div class="row">
            <p><strong>Legal first name</strong></p>
            <p class="data">{$user->getFirstName()}</p>
        </div>

        <div class="row">
            <p><strong>Legal last name</strong></p>
            <p class="data">{$user->getLastName()}</p>
        </div>

        <div class="row">
            <p><strong>Email</strong></p>
            <p class="data">{$user->getEmail()}</p>
        </div>

        <div class="row">
            <p><strong>Status</strong></p>
            <p class="data">{$user->getStatus()}</p>
        </div>

        
       <div class="row">
            <p><strong>Address</strong></p>
            <p class="data">{$useraddr['addr_line1']}{if $useraddr['addr_line2'] != null}<br />{$useraddr['addr_line2']}{/if}</p>
        </div>

        <div class="row">
            <p><strong>City</strong></p>
            <p class="data">{$useraddr['city']}</p>
        </div>

        <div class="row">
            <p><strong>State</strong></p>
            <p class="data">{$useraddr['state']}</p>
        </div>

        <div class="row">
            <p><strong>Zip code</strong></p>
            <p class="data">{$useraddr['zip']}</p>
        </div>

        <div class="row">
            <p><strong>Country</strong></p>
            <p class="data">United States of America</p>
        </div>

        <div class="row">
            <p><strong>Currency</strong></p>
            <p class="data">US Dollar</p>
        </div>

        <div class="row">
            <p><strong>InCashMe&#8482; Account created</strong></p>
            <p class="data">From {if $userext['created_via'] != null}{$userext['created_via']}{else}Unknown Device{/if} on {$userext['date_added']}</p>
        </div>

        {if $user->getStatus() != 'deleted'}
            <ul class="actionlinks">
                <li><a class="edit-info" title="Edit Consumer Information" href="{$formbase}update/showuser?UID={$uid}&section=profile">Edit</a></li>
                <li><a class="edit-info" title="Change Password" href="{$formbase}update/showuser?UID={$uid}&section=password">Change password</a></li>

                {if $user->getStatus() != 'locked'}
                    <li><a class="edit-info" title="Lock Account" href="{$formbase}update/showuser?UID={$uid}&section=lock">Lock Account</a></li>
                {/if}
                {if $user->getStatus() != 'deleted'}
                    <li><a class="edit-info" title="Delete Account" href="{$formbase}update/showuser?UID={$uid}&section=delete">Delete Account</a></li>
                {/if}
                {if $user->getStatus() != 'active'}
                <li><a class="edit-info" title="Activate Account" href="{$formbase}update/showuser?UID={$uid}&section=activate">Activate Account</a></li>
                {/if}
            </ul>
        {/if}

    </div>
