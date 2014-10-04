{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="setup statements table">
					
					<h4>Statements</h4>
					
					<table>
						<tbody>
							{foreach from=$dates key=k item=i}
								<tr>
									<th colspan="2">Statements from {$k}</th>
								</tr>
								{foreach from=$i key=s item=v}
									<tr>
										<td class="col1">
											<strong>{date("F (n), Y", $v.timestamp)}</strong>
											<ul class="rowactions">
												<li><a href="{$formbase}statement/view/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}" target="_blank">View / Print</a></li>
												{if $datescount[$k][$s] > 0}<li><a href="{$formbase}statement/download/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}/InCashMe-Statement-{$v.year}-{$v.month}.csv" target="_blank">Download</a></li>{/if}
											</ul>
										</td>
									</tr>
								{/foreach}
							{foreachelse}
								<tr>
									<th>Statements</th>
								</tr>
								<tr>
	                        		<td><em>There are no statements available on your account yet. Please wait until the end of this month.</em></td>
	                        	</tr>
							{/foreach}
						</tbody>
					</table>
					
				</div>
								
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}