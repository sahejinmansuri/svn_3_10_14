<div class="status">
	
	<ul>
		<li class="balance">Total Account Balance <strong>{$balance}{if $balance != $tbalance}*{/if}</strong>{if $balance != $tbalance} <span style="display:block;font-size:10px;padding:10px 0 0;width:170px;">* Balances may differ due to pending transactions (ie. account transfers, and active InCashMe&#8482; Money Payment Codes).</span>{/if}</li>
		<li>Available Account Balance <strong>{$tbalance}</strong></li>
		<li class="cellphones">Cell Phones {foreach name=usercells_loop from=$usercells key=v item=k}<strong{if $v != 0} class="hidden"{/if}>{$k.cellphone}: ₹{$k.balance}</strong>{/foreach}</li>
	</ul>
	
</div>