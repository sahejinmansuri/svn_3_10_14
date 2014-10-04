{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	{include file='content_header.tpl'}
	<div class="box_wide box_withsidebar">
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletesupportmessage formlayout subformlayout">
						
						{if $msgid == "all"}
							<h4>Delete support messages</h4>
							
							<p>Are you sure you want to delete all your messages?</p>
						{else}
							<h4>Delete support message</h4>
							
							<p>Are you sure you want to delete your message?</p>
						{/if}
						
						<form action="{$formbase}advanced/messagesdelete" method="post">
							
							<div class="submit">
								<input type="hidden" name="C" value="{$cellid}" />
								<input type="hidden" name="M" value="{$msgid}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}advanced/home#messages">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedsupportmessage">
						
						{if $msgid == "all"}
							<h4>Delete support messages</h4>
							
							<p>Your messages have been deleted.</p>
						{else}
							<h4>Delete support message</h4>
							
							<p>Your message has been deleted.</p>
						{/if}
						
						<ul class="actionlinks">
							<li><a href="{$formbase}advanced/home#messages">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}