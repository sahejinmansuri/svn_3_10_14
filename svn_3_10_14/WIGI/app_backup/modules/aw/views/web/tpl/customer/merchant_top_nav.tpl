    <ul>
        {if $CUSTOMER_SPECIAL_BILLING_SETTINGS}<li><a href="#showdiscount">Special Billing</a></li>{/if}
        <li><a href="#merchantinfo">Merchant info</a></li>
        <li><a href="#moneysources">Money sources</a></li>
        <li><a href="#preferences">Preferences</a></li>
        {if true == false}<li><a href="#posdevices">Devices</a></li>{/if}
        <li><a href="#pos_users">POS users</a></li>
        {if $CUSTOMER_BILLING_SETTINGS}<li><a href="#billing">Billing</a></li>{/if}
        <div style="clear:both;"></div><br/>
        <li style="border-bottom:5px solid #82B038;"><a href="#transactions">Transactions</a></li>
        <li style="border-bottom:5px solid #82B038;"><a href="#login_history">Login History</a></li>
    </ul>