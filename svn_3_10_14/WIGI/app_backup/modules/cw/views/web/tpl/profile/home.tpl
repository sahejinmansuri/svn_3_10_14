{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div id="profile" class="setup profile columnlayout">
					
					<h4>Profile settings</h4>
					
					<div class="tabfield">
						
						<div class="tabnavigation">
							
							<ul>
								<li><a href="#personalinfo">Personal info</a></li>
								<li><a href="#moneysources">Money sources</a></li>
								<li><a href="#preferences">Preferences</a></li>
								<li><a href="#cellphones">Cell phones</a></li>
							</ul>
							
						</div>
						
						<div class="tab setup personalinfo">
							
							<h4>Personal info</h4>
							
							<div class="columnbox">
								
								<div class="row">
									<p><strong>Legal first name</strong></p>
									<p class="data">{$firstname}</p>
								</div>
								
								<div class="row">
									<p><strong>Legal last name</strong></p>
									<p class="data">{$lastname}</p>
								</div>
								
								<div class="row">
									<p><strong>Email</strong></p>
									<p class="data">{$email}</p>
								</div>
								
								<div class="row">
									<p><strong>Alternate email</strong></p>
									<p class="data">{if $altemail != null}{$altemail}{else}N/A{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Alternate phone</strong></p>
									<p class="data">{if $altphone != null}{$country_code}{App_DataUtils::fmtPhone($altphone)}{else}N/A{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Date of birth</strong></p>
									<p class="data">{$birthdate}</p>
								</div>
								
								<div class="row">
									<p><strong>Address</strong></p>
									<p class="data">{$address}{if $address2 != null}<br />{$address2}{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>City</strong></p>
									<p class="data">{$city}</p>
								</div>
								
								<div class="row">
									<p><strong>State</strong></p>
									<p class="data">{$state}</p>
								</div>
								
								<div class="row">
									<p><strong>Zip code</strong></p>
									<p class="data">{$zip}</p>
								</div>
								
								<div class="row">
									<p><strong>Country</strong></p>
									<p class="data">India</p>
								</div>
								
								<div class="row">
									<p><strong>Currency</strong></p>
									<p class="data">Indian Rupees (INR)</p>
								</div>
								
								<div class="row">
									<p><strong>InCashMe&#8482; Account created</strong></p>
									<p class="data">From {if $account_device != null}{$account_device}{else}Unknown Device{/if} on {$account_date}</p>
								</div>
								
								<ul class="actionlinks">
									<li><a href="{$formbase}profile/editpersonal">Edit</a></li>
									<li><a href="{$formbase}profile/editpassword">Change password</a></li>
								</ul>
								
							</div>
							
						</div>
						
						<div class="tab setup moneysources table">
							
							<h4>Money sources</h4>
							
							<p>To add funds to your InCashMe&#8482; Account or to move funds from your InCashMe&#8482; Account to a Bank Account, you need to define Money Sources. These can be Credit Cards/Prepaid Cards and/or Bank Accounts (Checking or Savings). We allow two credit cards, and one banking account.</p>
							<p>You can use a Credit Card as a source to add funds to your InCashMe&#8482; Account, just add it following the simple steps. You can also add a Bank Account, we will make two small withdrawals from your bank account that will be deposited back. You will have to verify these amounts (online with your bank or via paper statements) to confirm your account. Once the Bank Account has been confirmed, you can use it to add funds to your InCashMe&#8482; Account or to move funds from your InCashMe&#8482; Account to your Bank Account.</p>
							<p>Credit Card/Prepaid Card and Banking transfers may take up to 3-5 business banking days. Pending transfers will be reflected in your Total Balance and once settled (deposited) into your account your Available Balance will be adjusted.</p>
							
							<table>
								<thead>
									<tr>
										<th class="col1">Display name</th>
										<th class="col2">Status</th>
										<th class="col3">Type</th>
										<th class="col4">Account number</th>
										<th class="col5">Expiration date</th>
									</tr>
								</thead>
								<tbody>
									{foreach from=$bank_accounts item=v name=bank_accounts_loop}
									<tr{if $smarty.foreach.bank_accounts_loop.index%2} class="alt"{/if}>
										<td>
											<strong>{$v.description}</strong>{if $bank_accounts_r[$v.user_bank_account_id].description != null}<br />{$bank_accounts_r[$v.user_bank_account_id].description}{/if}
											<ul class="rowactions">
												{if $v.status == "unconfirmed"}
												<li><a href="{$formbase}profile/confirmmoney/ITEM/ba{$v.user_bank_account_id}">Confirm</a></li>
												{/if}
												{if $v.status == "active"}
												<li><a href="{$formbase}profile/linkcell/ITEM/ba{$v.user_bank_account_id}">Link to cell phone</a></li>
												{/if}
												<li><a href="{$formbase}profile/deletemoney/ITEM/ba{$v.user_bank_account_id}">Delete</a></li>
											</ul>
										</td>
										<td>{$v.status}</td>
										<td>{$v.bank_type}</td>
										<td>xxxx-{$v.last4}</td>
										<td></td>
									</tr>
									{foreachelse}
									<tr>
		                        		<td colspan="5"><em>There are no bank accounts associated with your account.</em></td>
		                        	</tr>
			                        {/foreach}
									{foreach from=$credit_cards item=v name=credit_cards_loop}
									<tr{if $smarty.foreach.credit_cards_loop.index%2} class="alt"{/if}>
										<td>
											<strong>{$v.description}</strong>
											<ul class="rowactions">
												{if $v.status == "active"}
												<li><a href="{$formbase}profile/linkcell/ITEM/cc{$v.user_credit_card_id}">Link to cell phone</a></li>
												{/if}
												<li><a href="{$formbase}profile/deletemoney/ITEM/cc{$v.user_credit_card_id}">Delete</a></li>
											</ul>
										</td>
										<td>{$v.status}</td>
										<td>{$v.card_type}</td>
										<td>xxxx-{$v.last4}</td>
										<td>{$v.expire_month}/{$v.expire_year}</td>
									</tr>
									{foreachelse}
									<tr>
		                        		<td colspan="5"><em>There are no credit cards associated with your account.</em></td>
		                        	</tr>
			                        {/foreach}
								</tbody>
							</table>
							
							<ul class="actionlinks">
								{if (count($bank_accounts)+count($credit_cards)) < 3}
									<li><a href="{$formbase}profile/addmoney">Add new</a></li>
								{else}
									<li><a href="#">Can't add more than 3 accounts</a></li>
								{/if}
								{if true == false}
									{if (count($bank_accounts)+count($credit_cards) > 0)}
										<li><a href="{$formbase}profile/linkcell">Link to cell phone</a></li>
									{/if}
								{/if}
							</ul>
							
						</div>
						
						<div class="tab setup preferences">
								
							<h4>General account preferences</h4>
							
							<p>These preferences apply to your whole account, not the individual cell phones.</p>
							
							<div class="columnbox">
								
								<h5>General preferences</h5>
								
								{if true == false}
								<div class="row">
									<p><strong>Minimum balance</strong></p>
									<p class="data">₹{number_format($preferences['wigi']['minbal'], 2, '.', ',')}</p>
								</div>
								{/if}
								
								<div class="row">
									<p><strong>Mobile app timeout</strong></p>
									<p class="data">{$preferences['system']['timeout']} seconds</p>
								</div>
								
								<div class="row">
									<p><strong>International transfers</strong></p>
									<p class="data">{if $preferences["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Alerts</strong></p>
									<p class="data">via {$preferences["notification"]["alert"]}</p>
								</div>
								
								{if true == false}
								<div class="row">
									<p><strong>Statement method</strong></p>
									<p class="data">by {$preferences["notification"]["statement"]}</p>
								</div>
								{/if}
								
								<div class="row">
									<p><strong>Timezone</strong></p>
									<p class="data">GMT {$preferences['system']['timezone']}</p>
								</div>
								
								<h5>InCashMe&#8482; Payment Code preferences</h5>
								
								<div class="row">
									<p><strong>Maximum amount per transaction</strong></p>
									<p class="data">₹{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}</p>
								</div>
								
								<div class="row">
									<p><strong>Maximum number of transactions per day</strong></p>
									<p class="data">{$preferences['wigi']['max_per_day']} transactions</p>
								</div>
								
								<div class="row">
									<p><strong>InCashMe&#8482; Payment Code timeout</strong></p>
									<p class="data">{$preferences["wigi"]["timeout"]} minutes</p>
								</div>
								
								<h5>Send money/gift preferences</h5>
								
								<div class="row">
									<p><strong>Maximum amount per transaction</strong></p>
									<p class="data">₹{number_format($preferences["gift"]["max_per_trans"], 2, '.', ',')}</p>
								</div>
								
								<div class="row">
									<p><strong>Maximum number of transactions per day</strong></p>
									<p class="data">{$preferences["gift"]["max_per_day"]} gifts</p>
								</div>
								
								<h5>Funding preferences</h5>
								
								<div class="row">
									<p><strong>Maximum amount per funding</strong></p>
									<p class="data">₹{number_format($preferences['funding']['max_per_trans'], 2, '.', ',')}</p>
								</div>
								
								<div class="row">
									<p><strong>Maximum number of fundings per day</strong></p>
									<p class="data">{$preferences["funding"]["max_per_day"]} transactions</p>
								</div>
								
								<ul class="actionlinks">
									<li><a href="{$formbase}profile/editprefs">Edit</a></li>
									<li><a href="{$formbase}profile/lockaccount">Lock account</a></li>
									<li><a href="{$formbase}profile/deleteaccount">Delete account</a></li>
								</ul>
								
							</div>
							
						</div>
						
						<div class="tab setup cellphones table">
								
							<h4>Cell phones</h4>
							
							<p>You can add to your InCashMe&#8482; Account up to four (4) Smart Cell phones (iPhones or Android). You need at least one (1) Smartphone active in your account at all times. These cell phones need a Data plan and SMS/TXT capabilities.</p>
							<p>If you have defined Money Sources, you can optionally link your Smartphones to some of the Money Sources so you can Add or Withdraw Funds directly from the Smartphone without going to a Web page.</p>
							
							<div class="dtable">
								<div class="dhead">
									<div class="drow">
										<div class="dcol col1">ID</div>
										<div class="dcol col2">Phone number</div>
										<div class="dcol col3">Display name</div>
										<div class="dcol col4">Status</div>
										<div class="dcol col5">Balance</div>
									</div>
								</div>
								<div class="dbody">
									{foreach from=$cellphones item=v name=cellphones_loop}
										<div id="{$v.mobile_id}" class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
											<div class="dnormal">
												<div class="dcol col1">
													{if $v.phone_brand == "iPhone"}
														<img src="{$csspath}/images/deviceiphone.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
													{elseif $v.phone_brand == "Android"}
														<img src="{$csspath}/images/deviceandroid.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
													{else}
														<img src="{$csspath}/images/deviceunknown.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
													{/if}
												</div>
												<div class="dcol col2">
													<strong>{$ccountry}{$v.cellphone}</strong>
												</div>
												<div class="dcol col3">
													{if $v.alias != null}{$v.alias}{else}N/A{/if}
												</div>
												<div class="dcol col4">
													{$v.status}{if $v.is_default != 0}/default{/if}
												</div>
												<div class="dcol col5">
													₹{number_format($v.balance, 2, '.', ',')}
												</div>
											</div>
											<div class="dextend">
												<div class="expandarrow"></div>
												<div class="expandtype transactionbox">
													<div>
														<div style="float:left;width:60px;">
															{if $v.phone_brand == "iPhone"}
																<img src="{$csspath}/images/deviceiphone.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
															{elseif $v.phone_brand == "Android"}
																<img src="{$csspath}/images/deviceandroid.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
															{else}
																<img src="{$csspath}/images/deviceunknown.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
															{/if}
														</div>
														<div style="float:left;">
															<div style="font-size:18px;font-weight:bold;margin:0;padding:8px 0 2px;">{if $v.alias != null}{$v.alias}{else}{$ccountry}{$v.cellphone}{/if}</div>
															<div style="padding:0 0 10px;overflow:hidden;width:530px;">
																<ul class="rowactions">
																	{if $v.status == "unconfirmed"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/confirmcell/ITEM/{$v.mobile_id}">Confirm</a></li>
																	{/if}
																	{if $v.is_default == 0 and $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a></li>
																	{/if}
																	{if $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}">Edit name</a></li>
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/viewquestion/ITEM/{$v.mobile_id}">Edit questions</a></li>
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}">Cell phone preferences</a></li>
																	{/if}
																	<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editpin/ITEM/{$v.mobile_id}">Change PIN</a></li>
																	<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/forgotpin/ITEM/{$v.mobile_id}">Forgot PIN?</a></li>
																	{if $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}">Lock</a></li>
																	{elseif $v.status == "locked"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}">Unlock</a></li>
																	{/if}
																	{if $v.is_default == 0}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}"{if (int)$v.balance>0} onclick="$.wigialert('Please withdraw your funds from this account before deleting.');return false;"{/if}>Delete</a></li>
																	{/if}
																</ul>
															</div>
															<div style="overflow:hidden;">
																<div style="float:left;overflow:hidden;width:240px;">
																	<div>
																		<p><strong>Info</strong></p>
																		<ul>
																			<li>Status: {$v.status}</li>
																			<li>Cell number: {$ccountry}{$v.cellphone}</li>
																			<li>Balance: ₹{number_format($v.balance, 2, '.', ',')}</li>
																		</ul>
																	</div>
																	<div>
																		<p><strong>More</strong></p>
																		<ul>
																			<li>Device: {if $v.phone_brand != null}{$v.phone_brand}{else}N/A{/if}</li>
																			<li>Date added: {date("M j, Y", strtotime($v.date_added))}</li>
																			<li>OS version: {if $v.os_version != null}{$v.os_version}{else}N/A{/if}</li>
																			<li>App version: {if $v.app_version != null}{$v.app_version}{else}N/A{/if}</li>
																			<li>Last login: {date("M j, Y", strtotime($v.last_login))}</li>
																		</ul>
																	</div>
																</div>
																<div style="float:left;overflow:hidden;width:260px;">
																	<div>
																		<p><strong>Links</strong></p>
																		{if count($celllinks[$v.mobile_id]["cc"]) > 0 || count($celllinks[$v.mobile_id]["ba"]) > 0}
																			<ul>
																				{if count($celllinks[$v.mobile_id]["cc"]) > 0}
																					<li>Credit cards
																						<ul>
																							{foreach from=$celllinks[$v.mobile_id]["cc"] item=cl name=celllinks_loop}
																								<li>{$cl["description"]}</li>
																							{/foreach}
																						</ul>
																					</li>
																				{/if}
																				{if count($celllinks[$v.mobile_id]["ba"]) > 0}
																					<li>Bank accounts</li>
																				{/if}
																			</ul>
																		{else}
																			<ul>
																				<li>There are no money source linked to this cell phone</li>
																			</ul>
																		{/if}
																	</div>
																	<div>
																		<p><strong>Cell phone preferences</strong></p>
																		<ul>
																			<li>Mobile app timeout: {$cellpreferences[$v.mobile_id]["system"]["timeout"]} second{if $cellpreferences[$v.mobile_id]["system"]["timeout"] > 0}s{/if}</li>
																			<li>International transfers: {if $cellpreferences[$v.mobile_id]["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</li>
																			<li>Alerts: via {$cellpreferences[$v.mobile_id]["notification"]["alert"]}</li>
																			<li>Maximum amount per transaction: ₹{$cellpreferences[$v.mobile_id]["wigi"]["max_per_trans"]}</li>
																			<li>Maximum number of transactions per day: {$cellpreferences[$v.mobile_id]["wigi"]["max_per_day"]}</li>
																			<li>InCashMe&#8482; Money Payment Code timeout: {$cellpreferences[$v.mobile_id]["wigi"]["timeout"]} minutes</li>
																			<li>Maximum amount per gifts: ₹{$cellpreferences[$v.mobile_id]["gift"]["max_per_trans"]}</li>
																			<li>Maximum number of gifts per day: {$cellpreferences[$v.mobile_id]["gift"]["max_per_day"]}</li>
																			<li>Maximum amount per funding: ₹{$cellpreferences[$v.mobile_id]["funding"]["max_per_trans"]}</li>
																			<li>Maximum number of funding per day: {$cellpreferences[$v.mobile_id]["funding"]["max_per_day"]}</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
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
							
							<ul class="actionlinks">
								{if (count($cellphones)) < 4}
									<li><a href="{$formbase}profile/addcell">Add new</a></li>
								{else}
									<li><a href="#">Can't add more than 4 cell phones</a></li>
								{/if}
							</ul>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}