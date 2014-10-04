{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			{if isset($error)}
				
				{include file='registration/registration_fields.tpl'}
				
			{else}
				
				{include file='registration/registration_success.tpl'}
				
			{/if}
			
		</div>
		
	</div>
	
{include file='footer.tpl'}