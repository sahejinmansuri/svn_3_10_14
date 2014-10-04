{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup editquestion table">
					
					<h4>Security questions</h4>
					
					<table>
						<thead>
							<tr>
								<th>Question</th>
								<th>Answer</th>
							</tr>
						</thead>
						<tbody>
							{foreach name=questions_loop from=$questions item=k}
							<tr>
								<td>
									<strong>{if $k['question'] != ""}{$k['question']}{else}(None){/if}</strong>
									<ul class="rowactions">
										{if $k['question'] == ""}<li><a href="{$formbase}profile/addquestion">Add</a></li>{/if}
										{if $k['question'] != ""}<li><a href="{$formbase}profile/editquestion/ITEM/{$k['question_id']}">Edit</a></li>{/if}
									</ul>
								</td>
								<td>- Answer on file -</td>
							<tr/>
							{/foreach}
						</tbody>
					</table>
					
					<ul class="actionlinks">
						<li><a href="{$formbase}profile/home#merchantinfo">Cancel</a></li>
					</ul>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}