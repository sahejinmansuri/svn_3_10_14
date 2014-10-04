<!--  to show any validation errors -->
{if isset($error)}
	{foreach from=$error item=k}
	<p style="background:#f00;color:#fff;padding:10px;margin-bottom:30px;">{$k}</p>
	{/foreach}
{/if}