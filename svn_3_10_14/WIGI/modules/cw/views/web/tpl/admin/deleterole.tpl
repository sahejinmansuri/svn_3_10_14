{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	{include file='content_header.tpl'}
	<div class="box_wide box_withsidebar">
		<div id="page">	
<div class="information">
			{if $showcontent == "success"}
					
					<div class="setup deletecellphone formlayout subformlayout">
						
						<h4>Delete Role</h4>
						
						<p>You have successfully delete a role</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}admin/home">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "failure"}
					
					<div class="setup deletecellphone formlayout subformlayout">
						
						<h4>Delete Role</h4>
						
						<p>Some users have assigned this role. So you can not delete this role.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}admin/home">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
</div>
</div>
</div>

{include file='footer.tpl'}