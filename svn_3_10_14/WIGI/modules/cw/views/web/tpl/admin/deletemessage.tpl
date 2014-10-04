{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	{include file='content_header.tpl'}

	<div class="box_wide box_withsidebar">
		<div id="page">	
<div class="information">
	<div class="setup adduser formlayout subformlayout">
		<h4>Edit Message</h4>
		<form autocomplete="off" method="post" action="{$formbase}admin/deletemessage/MSGID/{$message_id}">
			<div class="stepbox">
				<div class="prompt message">
					<label for="message">Are you sure to delete a message? </label>
				</div>
			</div>
			<div class="submit">
				<div class="notes">
					<input type="hidden" value="add" name="doaction">
					<input type="submit" value="Delete">
				</div>
			</div>
		</form>
	</div>
</div>

	</div>
</div>

{include file='footer.tpl'}