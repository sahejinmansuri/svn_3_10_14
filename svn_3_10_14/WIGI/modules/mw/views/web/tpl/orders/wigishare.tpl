<div class="status">
	<ul>
		<li class="balance">Total Balance{if $balance != $tbalance}*{/if} <strong>{$balance}</strong></li>
		<li>Available Balance <strong>{$tbalance}</strong></li>
		<li>Merchant ID <strong>{$merchantid}</strong></li>
	</ul>
</div>

<div style="padding:10px;font-size:12px;">
    F: Fixed & P: Percentage<br/>
    Global Settings (Fixed): <strong>{$wigi_fixed_billing}</strong><br/>
    Global Settings (Percentage): <strong>{$wigi_percentage_billing}</strong><br/>
    Global Default: <strong>{$wigi_default_billing}</strong><br/>
    <br/>
    User Billing Settings: <strong>{$wigi_merchant_billing}</strong><br/>
</div>
