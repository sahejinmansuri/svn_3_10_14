{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editquestion formlayout subformlayout">
						
						<h4>Edit security question</h4>
						
						<p>The following security question have to be completed for your protection. Secret questions are specific to a cell phone.</p>
						
						<form action="{$formbase}profile/editquestion" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt question">
									<label for="question">Security question</label>
									<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}"{if $q == $selectedq} selected="selected"{/if}>{$q}</option>{/foreach}</select>
									<p class="tip">Choose a security question</p>
								</div>
								<div class="prompt answer">
									<label for="answer">Security answer</label>
									<input type="text" name="ANSWER" id="answer" maxlength="15" value="" />
									<p class="tip">Enter a security answer</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}.{$QUESTION_ID}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" />
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedquestion">
						
						<h4>Edit security question</h4>
						
						<p>Your cell phone security questions have been updated.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}