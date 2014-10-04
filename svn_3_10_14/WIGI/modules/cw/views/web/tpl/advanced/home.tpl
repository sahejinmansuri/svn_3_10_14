{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Advance Features</li>
		{if $logged_in == 1}
		<li class="right">
			Last login: {$lastlogin}<br />IP address: {$lastip}
		</li>
		
		{/if}
	</ul> 
	<div class="maincontent">
        <div class="maincontentinner">
			<div class="row">
				<div id="dashboard-left" class="col-md-12">
		<div class="pageheader">
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Advance Features</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar">
		<div id="page">		
			<div class="information">
		<div id="profile" class="setup profile columnlayout box-info">		
			<!--	<h4>Advanced Features</h4>-->
			<div class="tabbedwidget tab-info">
			
				<!--<div class="">-->
					
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
					
					<div class="tab setup mydocuments cellphones" id="mydocuments" >
						
						<h4>My documents</h4>
						
						<p>Please select a cell phone to view your documents on.</p>
						
						<h4 class="widgettitle" >
						<span id="history_deyail2">Phone number</span>
						<span id="history_deyail3">Display name</span>
						<span id="history_deyail4">Documents</span>
						<h4>
					
						<div class="accordion accordion-info">
						{foreach from=$cellphones key=k item=v name=cellphones_loop}
						<h3><a href="">
						
							<span id="history_deyail2"><strong>{$v.cellphone}</strong></span>
							<span id="history_deyail3">{if $v.alias != null}{$v.alias}{else}N/A{/if}</span>
							<span id="history_deyail4">{$extcellphones[$k]} document{if $extcellphones[$k] != 1}s{/if}</span>
						
						</a></h3>
						
						
						<div>
						<div class="formlayout subformlayout">
													
												<h4 class="widgettitle">Enter PIN number</h4>
													
													<div class="widgetcontent">
													
													
													<form action="{$formbase}advanced/mydocuments#mydocuments" method="post" class="stdform" autocomplete="off">
							<p>
								<label>PIN</label>
								<span class="field">
									<input type="password" name="PIN" maxlength="7" />
								</span>
								<small class="desc">Enter your PIN number</small>
							</p>
														
														<input type="hidden" class="" name="ITEM" value="{$v.mobile_id}" />
														<input type="submit" class="btn btn-info" value="Submit" />
														<a href="{$formbase}advanced/home"><input type="button" class="btn btn-info" value="Cancel" /></a>
														
														
													
													</form>
													
													
													
												</div>
												</div>
						</div>
						{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
						</div>
					
						<!--
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
						</div> -->
						
					</div>
					
					<div class="tab setup messages messagescellphones" id="messages">
						
						<!--<h4>Messages</h4>-->
						
						<p>Please select a cell phone to view messages on.</p>
						
						
						
						<h4 class="widgettitle" >
						<span id="history_deyail2">Phone number</span>
						<span id="history_deyail3">Display name</span>
						<span id="history_deyail4">View</span>
						<h4>
						<div class="accordion accordion-info">
						{foreach from=$cellphones item=v name=cellphones_loop}
						
						<h3><a href="">
						
							<span id="history_deyail2"><strong>{$v.cellphone}</strong></span>
							<span id="history_deyail3">{if $v.alias != null}{$v.alias}{else}N/A{/if}</span>
							<span id="history_deyail4">View</span>
							
						
						</a></h3>
						
						<div>
						<a href="{$formbase}advanced/messages/ITEM/{$v.mobile_id}#messages">View</a>
						</div>
						{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
						</div>
						<!--
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
						</div> -->
						
					</div>
					{if true == false}
					<div class="tab setup promocodes" id="promocodes">
						
						<h4>Promo codes</h4>
						
						<p>Coming Soon...</p>
						
					</div>
					{/if}
					
					<div class="tab setup supportmessages messagescellphones" id="supportmessages">
						
						<h4>Support messages</h4>
						
						<p>Please select a cell phone to view support messages on.</p>
						<h4 class="widgettitle" >
						<span id="">Phone number</span>
						<span id="">Display name</span>
						<h4>
						<div class="accordion accordion-info">
						{foreach from=$cellphones item=v name=cellphones_loop}
						
						<h3><a href="">
						
							<span id=""><strong>{$v.cellphone}</strong></span>
							<span id="">{if $v.alias != null}{$v.alias}{else}N/A{/if}</span>
						</a></h3>
						
						<div>
							<a href="{$formbase}advanced/supportmessages/ITEM/{$v.mobile_id}#supportmessages">View</a>
						</div>
						{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
						</div>
						<!--
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
						</div> -->
						
					</div>
					
					<div class="tab setup movefunds formlayout subformlayout" id="movefunds">
						<p>You can move funds from your cell phone sub-accounts (that belongs to your InCashMe&#8482; Account) to your default cell phone. Only use this feature when your secondary phones are not available; otherwise, you need to use the send money feature.</p>
						<h4 class="widgettitle">Move funds</h4>
						
						
						<div class="widgetcontent" >
						<form action="{$formbase}advanced/movefunds" class="stdform" method="post">
							
							<p>
                            <label>Amount</label>
                            <span class="field"><input type="text" id="amount" name="amount" class="formfield" maxlength="7" value="0.00" />
								</span>
                            <small class="desc">The amount you would like to add</small>
                        </p>
						<p>
                            <label>From</label>
                            <span class="field">
                            <select class="uniformselect" name="account_list" id="account_list">
								<option value="">Choose...</option>
									{foreach from=$cellphones key=k item=v}
										{if $v.is_default != 1}
											<option value="{$v.mobile_id}">{$v.cellphone}</option>
										{/if}
									{/foreach}
                            </select>
                            </span>
							<small class="desc">Choose an account</small>
                        </p>
						<p>
                            <label>To</label>
                            <span class="field">
							<select class="uniformselect" name="cellphone_list" id="cellphone_list">
								<option value="">Choose...</option>
									{foreach from=$cellphones key=k item=v}
											{if $v.is_default != 1}<option value="{$v.mobile_id}">{$v.cellphone}</option>{/if}
										{/foreach}
                            </select>
							</span>
                            <small class="desc">Choose a cell phone</small>
                        </p>	
						<!--	<div class="stepbox">
								
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
								
							</div> -->
							
							<div class="submit">
								<input type="hidden" name="doaction" value="move" />
								<input type="submit" class="btn btn-info"  value="Move Funds" />
							</div>
							
						</form>
					</div>
						
					</div>
					
				<!--</div>-->
			</div>
		</div>		
			</div>
				</div>
				
			</div>
			
	
{include file='footer.tpl'}