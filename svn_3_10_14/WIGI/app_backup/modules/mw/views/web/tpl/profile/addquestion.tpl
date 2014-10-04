{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup addquestions formlayout subformlayout">
						
						<h4>Add security question</h4>
						
						<p>The following security question have to be completed for your protection. Secret questions are specific to your whole account.</p>
						
						<form action="{$formbase}profile/addquestion" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt question">
									<label for="question">Security question</label>
									<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
									<p class="tip">Choose a security question</p>
								</div>
								<div class="prompt answer">
									<label for="answer">Security answer</label>
									<input type="text" name="ANSWER" id="answer" maxlength="15" value="" />
									<p class="tip">Enter a security answer</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="add" />
								<input type="submit" value="Add" />
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup addedquestions">
						
						<h4>Add security question</h4>
						
						<p>Your security question have been added.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}