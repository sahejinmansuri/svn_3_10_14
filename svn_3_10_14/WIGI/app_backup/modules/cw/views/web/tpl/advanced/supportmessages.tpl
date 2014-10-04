{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
						
			<div class="information">
				
				<h4>Advanced Features</h4>
				
				<div class="tabfield">
					
					<div class="tabnavigation">
						
						<ul>
							<li><a href="{$formbase}advanced/home#mydocuments">My documents</a></li>
							<li><a href="{$formbase}advanced/home#messages">Messages</a></li>
							{if true == false}
							<li><a href="#promocodes">Promo codes</a></li>
							{/if}
							<li><a href="{$formbase}advanced/home#supportmessages">Support messages</a></li>
							<li{if count($cellphones) <= 1} class="disabled"{/if}><a href="{$formbase}advanced/home#movefunds"{if count($cellphones) <= 1} onmouseover="$.wigialert('Only use this feature when you have multiple cell phones.');return false;"{/if}>Move funds</a></li>
						</ul>
						
					</div>
					
					<div class="tab setup supportmessages">
						
						<h4>Support Messages</h4>
						
						<p>Support messages for {if $selectedcellalias != null}{$selectedcellalias}, {App_DataUtils::fmtphone($selectedcellphone)}{else}{App_DataUtils::fmtphone($selectedcellphone)}{/if}.</p>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Subject</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$msgs item=v name=msgs_loop}
									<div id="{$v.id}" class="drow{if $smarty.foreach.msgs_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.subject}</strong>
											</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<h4>{$v.subject}</h4>
												<p>{$v.message}</p>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/supportmessagesdelete/C/{$item}/M/{$v.id}">Delete</a></li>
												</ul>
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no support messages associated with this cell phone.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>
						
						{if count($msgs) > 0}
							<ul class="rowactions">
								<li><a href="{$formbase}advanced/supportmessagesdelete/C/{$item}/M/all">Delete all</a></li>
							</ul>
						{/if}
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}