<!--  to show any validation errors -->
{if isset($error)}
	{foreach from=$error item=k}
	<p>{$k}</p>
	{/foreach}
{/if}