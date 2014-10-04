{literal}
<script src="//cdn.ckeditor.com/4.4.2/full/ckeditor.js"></script>
{/literal}
{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
{include file='sidebar.tpl'}
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
			{literal}
			<script type="text/javascript">
				CKEDITOR.replace( 'MESSAGE' );
			</script>
			{/literal}
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
{literal}
<style type="text/css">
	#page .subformlayout .stepbox {
	  background: none repeat scroll 0 0 #e4f5c8;
	  margin: 0 0 16px;
	  padding: 20px;
	  width: 620px;
	}
</style>
{/literal}
{include file='footer.tpl'}