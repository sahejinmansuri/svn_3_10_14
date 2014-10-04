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
							<li><a href="#mydocuments">My documents</a></li>
							<li><a href="#messages">Messages</a></li>
							{if true == false}
							<li><a href="#promocodes">Promo codes</a></li>
							{/if}
							<li><a href="#supportmessages">Support messages</a></li>
							<li{if count($cellphones) <= 1} class="disabled"{/if}><a href="#movefunds"{if count($cellphones) <= 1} onmouseover="$.wigialert('Only use this feature when you have multiple cell phones.');return false;"{/if}>Move funds</a></li>
						</ul>
						
					</div>
					
					<div class="tab setup mydocuments cellphones">
						
						<h4>My documents</h4>
						
						<p>Please select a cell phone to view your documents on.</p>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col2">Phone number</div>
									<div class="dcol col3">Display name</div>
									<div class="dcol col4">Documents</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$cellphones key=k item=v name=cellphones_loop}
									<div class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col2">
												<strong>{$v.cellphone}</strong>
											</div>
											<div class="dcol col3">
												{if $v.alias != null}{$v.alias}{else}N/A{/if}
											</div>
											<div class="dcol col4">
												{$extcellphones[$k]} document{if $extcellphones[$k] != 1}s{/if}
											</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div class="formlayout subformlayout">
													
													<h4>Enter PIN number</h4>
													
													<form action="{$formbase}advanced/mydocuments#mydocuments" method="post" autocomplete="off">
														
														<div class="stepbox">
															
															<div class="prompt pin">
																<label>PIN</label>
																<input type="password" name="PIN" maxlength="7" />
																<p class="tip">Enter your PIN number</p>
															</div>
															
														</div>
														
														<div class="submit">
															
															<input type="hidden" name="ITEM" value="{$v.mobile_id}" />
															<input type="submit" value="Submit" />
															
														</div>
													
													</form>
													
													<ul class="actionlinks">
														<li><a href="{$formbase}advanced/home">Cancel</a></li>
													</ul>
													
												</div>
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>
						
					</div>
					
					<div class="tab setup messages messagescellphones">
						
						<h4>Messages</h4>
						
						<p>Please select a cell phone to view messages on.</p>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Phone number</div>
									<div class="dcol col2">Display name</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$cellphones item=v name=cellphones_loop}
									<div class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.cellphone}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/messages/ITEM/{$v.mobile_id}#messages">View</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{if $v.alias != null}{$v.alias}{else}N/A{/if}
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>
						
					</div>
					
					<div class="tab setup promocodes">
						
						<h4>Promo codes</h4>
						
						<p>Coming Soon...</p>
						
					</div>
					
					<div class="tab setup supportmessages messagescellphones">
						
						<h4>Support messages</h4>
						
						<p>Please select a cell phone to view support messages on.</p>
						
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Phone number</div>
									<div class="dcol col2">Display name</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$cellphones item=v name=cellphones_loop}
									<div class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.cellphone}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/supportmessages/ITEM/{$v.mobile_id}#supportmessages">View</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{if $v.alias != null}{$v.alias}{else}N/A{/if}
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>
						
					</div>
					
					<div class="tab setup movefunds formlayout subformlayout">
						
						<h4>Move funds</h4>
						
						<p>You can move funds from your cell phone sub-accounts (that belongs to your InCashMe&#8482; Account) to your default cell phone. Only use this feature when your secondary phones are not available; otherwise, you need to use the send money feature.</p>
						
						<form action="{$formbase}advanced/movefunds" method="post">
							
							<div class="stepbox">
								
								<div class="prompt amount">
									<label for="amount">Amount ₹</label>
									<input type="text" id="amount" name="amount" maxlength="7" value="0.00" />
									<p class="tip">The amount you would like to add</p>
								</div>
								
								<div class="prompt cellphone_list">
									<label for="cellphone_list">From</label>
									<select id="cellphone_list" name="cellphone_list">
										<option value="">Choose...</option>
										{foreach from=$cellphones key=k item=v}
											{if $v.is_default != 1}<option value="{$v.mobile_id}">{$v.cellphone}</option>{/if}
										{/foreach}
									</select>
									<p class="tip">Choose a cell phone</p>
								</div>
								
								<div class="prompt default_cellphone">
									<label for="default_cellphone">To</label>
									<input type="text" name="default_cellphone" value="{foreach from=$cellphones key=k item=v}{if $v.is_default == 1}{$v.cellphone} (Default){/if}{/foreach}" readonly="readonly" />
									<p class="tip">Your default cell phone</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="doaction" value="move" />
								<input type="submit" value="Move Funds" />
							</div>
							
						</form>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}