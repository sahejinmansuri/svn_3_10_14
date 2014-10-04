{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletedocument formlayout subformlayout">
						
						<h4>Delete document</h4>
						
						<p>Are you sure you want to delete your document?</p>
						
						<form action="{$formbase}advanced/mydocumentsdelete" method="post">
							
							<div class="submit">
								<input type="hidden" name="C" value="{$cellid}" />
								<input type="hidden" name="D" value="{$docid}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deleteddocument">
						
						<h4>Delete document</h4>
						
						<p>Your document has been deleted.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}