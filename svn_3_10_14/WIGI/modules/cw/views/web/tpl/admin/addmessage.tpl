{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	{include file='content_header.tpl'}
	
	<div class="box_wide box_withsidebar">
		<div id="page">		
<div class="information">
	<div class="setup adduser formlayout subformlayout">
		<h4>Add Message</h4>
		<form autocomplete="off" method="post" action="{$formbase}admin/addmessage">
			<div class="stepbox">
				<div class="prompt firstname">
					<label for="subject">Subject</label>
					<input type="text" value="" maxlength="30" id="subject" name="SUBJECT" class="">
					<p class="tip">What is the new message subject?</p>
				</div>
				<div class="prompt message">
					<label for="message">Message</label>
					<textarea name="MESSAGE" id="message"></textarea>
					<p class="tip">What is the new message?</p>
				</div>
			</div>
			<div class="submit">
				<div class="notes">
					<input type="hidden" value="add" name="doaction">
					<input type="submit" value="Add">
				</div>
			</div>
		</form>
	</div>
</div>
	</div>
</div>



{include file='footer.tpl'}