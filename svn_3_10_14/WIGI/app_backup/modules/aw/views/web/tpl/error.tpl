<!--  to show any validation errors -->
{if isset($error)}
	{foreach from=$error item=k}
	<p id="errormsg">Warning: {$k}</p>
	{/foreach}
{/if}