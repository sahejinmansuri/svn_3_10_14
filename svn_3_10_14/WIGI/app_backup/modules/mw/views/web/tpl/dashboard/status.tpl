<div class="status">
	
	<ul>
		<li class="balance">Total Balance{if $balance != $tbalance}*{/if} <strong>{$balance}</strong></li>
		<li>Available Balance <strong>{$tbalance}</strong></li>
		<li>Merchant ID <strong>{$merchantid}</strong></li>
	</ul>
	
</div>

<div class="businessinfo">
	<p>
		<strong>{$merchantname}</strong> {if $merchantdbaname != null}{$merchantdbaname}{/if}
	</p>
</div>