{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	{include file='content_header.tpl'}
	<div class="box_wide box_withsidebar">
		<div id="page">	
<div class="information">
	<div class="setup adduser formlayout subformlayout">
		<h4>Edit Message</h4>
		<form autocomplete="off" method="post" action="{$formbase}admin/editmessage/MSGID/{$message_id}">
			<div class="stepbox">
				<div class="prompt firstname">
					<label for="subject">Subject</label>
					<input type="text" value="{$subject_f}" maxlength="30" id="subject" name="SUBJECT" class="">
					<p class="tip">What is the new message subject?</p>
				</div>
				<div class="prompt message">
					<label for="message">Message</label>
					<textarea name="MESSAGE" id="message">{$message_f}</textarea>
					<p class="tip">What is the new message?</p>
				</div>
			</div>
			<div class="submit">
				<div class="notes">
					<input type="hidden" value="add" name="doaction">
					<input type="submit" value="Update">
				</div>
			</div>
		</form>
	</div>
</div>

	</div>
</div>

{include file='footer.tpl'}