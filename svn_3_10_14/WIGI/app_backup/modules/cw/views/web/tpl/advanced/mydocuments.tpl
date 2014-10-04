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
					
					<div class="tab setup mydocuments">
						
						<h4>My documents</h4>
						
						<p>Documents saved for {if $selectedcellalias != null}{$selectedcellalias}, {App_DataUtils::fmtphone($selectedcellphone)}{else}{App_DataUtils::fmtphone($selectedcellphone)}{/if}.</p>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Description</div>
									<div class="dcol col2">Number</div>
									<div class="dcol col3">Type</div>
									<div class="dcol col4">Expiration</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$docs item=v name=docs_loop}
									<div id="{$v.doc_id}" class="drow{if $smarty.foreach.docs_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.description}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/mydocumentsview/C/{$item}/D/{$v.doc_id}" target="_blank">View image</a></li>
													<li><a href="{$formbase}advanced/mydocumentsedit/C/{$item}/D/{$v.doc_id}">Edit info</a></li>
													<li><a href="{$formbase}advanced/mydocumentsdelete/C/{$item}/D/{$v.doc_id}">Delete</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{$v.number}
											</div>
											<div class="dcol col3">
												{$v.type}
											</div>
											<div class="dcol col4">
												{$v.expiration}
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no documents associated with this cell phone.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}