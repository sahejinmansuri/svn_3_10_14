{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div class="lastlogin">
					<p>Last login: {$lastlogin}<br />IP address: {$lastip}</p>
				</div>
				
				<div class="setup tools">
					
					<h4>Tools</h4>
					
					<ul>
						<li class="action1"><a href="{$formbase}money/showadd">Add Funds</a></li>
						<li class="action2"><a href="{$formbase}money/showwithdraw">Withdraw</a></li>
						<li class="action3"><a href="{$formbase}history/home">History</a></li>
						<li class="action4"><a href="{$formbase}statement/home">Statements</a></li>
						<li class="action5"><a href="{$formbase}profile/home">Profile</a></li>
					</ul>
					
				</div>
				
				<div class="setup transactions table">
					
					<h4>Recent account transactions</h4>
					
					<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Date</div>
								<div class="dcol col2">Cell phone</div>
								<div class="dcol col3">Description</div>
								<div class="dcol col4">Amount</div>
							</div>
						</div>
						<div class="dbody">
							{section name=transaction_loop loop=$trans max=5}
								<div id="{$trans[transaction_loop].transaction_id}" class="drow{if $smarty.section.transaction_loop.index%2} drowalt{/if}">
									<div class="dnormal{if $trans[transaction_loop].viewed == 0} dunread{/if}">
										<div class="dcol col1">{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</div>
										<div class="dcol col2"><strong>{$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["last_name"]}</strong> {$trans[transaction_loop].from_description}</div>
										<div class="dcol col3">{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</div>
										<div class="dcol col4">US${number_format({$trans[transaction_loop].amount}, 2, '.', ',')}</div>
									</div>
								</div>
							{sectionelse}
								<div class="drow">
	                        		<div class="dcol"><em>There are no transactions.</em></div>
	                        	</div>
	                        {/section}
						</div>
					</div>
					
					<p class="more">
						<a href="{$formbase}history/home">See all transactions &rsaquo;</a>
					</p>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
