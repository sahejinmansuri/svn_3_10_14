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
								<li><a href="#merchantinfo">Merchant info</a></li>
								{if $systemadmin}<li><a href="#moneysources">Money sources</a></li>{/if}
								<li><a href="#preferences">Preferences</a></li>
								{if true == false}<li><a href="#posdevices">Devices</a></li>{/if}
								{if $systemadmin}<li><a href="#users">POS users</a></li>{/if}
							</ul>
							
						</div>
						
						<div class="tab setup merchantinfo">
							
							<h4>Merchant info</h4>
							
							{if $haslogo == true}
								<img src="{$formbase}profile/viewlogo" alt="{$BUSINESS_NAME}" class="merchantlogo" />
							{/if}
							
							<div class="columnbox">
								
								{if true == false}
								<div class="row">
									<img src="" alt="{$business_name}" />
								</div>
								{/if}
								
								<div class="row">
									<p><strong>Official Business name</strong></p>
									<p class="data">{$business_name}</p>
								</div>
								
								<div class="row">
									<p><strong>DBA Name<br />(Doing Business As)</strong></p>
									<p class="data">{if $dba != null}{$dba}{else}N/A{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Contact first name</strong></p>
									<p class="data">{$firstname}</p>
								</div>
								
								<div class="row">
									<p><strong>Contact last name</strong></p>
									<p class="data">{$lastname}</p>
								</div>
								
								<div class="row">
									<p><strong>Business type</strong></p>
									<p class="data">{$business_type}</p>
								</div>
								
								<div class="row">
									<p><strong>Business phone</strong></p>
									<p class="data">+{$country_code} {App_DataUtils::fmtPhone($business_phone)}</p>
								</div>
								
								<div class="row">
									<p><strong>Business tax ID or SSN</strong></p>
									<p class="data">{$business_tax_id}</p>
								</div>
								
								{if $business_501c != null}
									<div class="row">
										<p><strong>501(c)(3) Registration</strong></p>
										<p class="data">{$business_501c}</p>
									</div>
								{/if}
								
								{if $business_stateofinc != null}
									<div class="row">
										<p><strong>State of incorporation</strong></p>
										<p class="data">{$business_stateofinc}</p>
									</div>
								{/if}
								
								<div class="row">
									<p><strong>Business URL</strong></p>
									<p class="data">{$business_url}</p>
								</div>
								
								<div class="row">
									<p><strong>Email/User ID</strong></p>
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
									<p><strong>InCashMe&#8482; Merchant Account created</strong></p>
									<p class="data">From {if $account_device != null}{$account_device}{else}Unknown Device{/if} on {$account_date}</p>
								</div>
								
								<ul class="actionlinks">
									<li><a href="{$formbase}profile/editpersonal">Edit</a></li>
									{if $systemadmin}
                                        <li><a href="{$formbase}profile/editpassword">Change password</a></li>
                                        <li><a href="{$formbase}profile/viewquestion">Edit Security questions</a></li>
                                        <li><a href="{$formbase}profile/editpin">Change PIN</a></li>
                                        <li><a href="{$formbase}profile/forgotpin">Forgot PIN?</a></li>
                                    {/if}
								</ul>
								
							</div>
							
						</div>
						
						<div class="tab setup moneysources table">
							
							<h4>Money sources</h4>
							
							<p>To add funds to your InCashMe&#8482; Merchant Account or to move funds from your InCashMe&#8482; Merchant Account to a Bank Account, you need to define Money Sources. These can be Bank Accounts (Checking or Savings). We allow one banking account.</p>
							<p>You can use a Bank Account as a source to add funds to your InCashMe&#8482; Account, just add it following these simple steps. We will make two small withdrawals from your bank account that will be deposited back. You will have to verify these amounts (online with your bank or via paper statements) to confirm your account. Once the Bank Account has been confirmed, you can use it to add funds to your InCashMe&#8482; Merchant Account or to move funds from your InCashMe&#8482; Merchant Account to your Bank Account.</p>
							<p>Banking transfers may take up to 3-5 business banking days. Pending transfers will be reflected in your Total Balance and once settled (deposited) into your account your Available Balance will be adjusted.</p>
							
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
			                        {if true == false}
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
			                        {/if}
								</tbody>
							</table>
							
							<ul class="actionlinks">
								{if count($bank_accounts) < 1}
									<li><a href="{$formbase}profile/addmoney">Add new</a></li>
								{else}
									<li><a href="#">Can't add more than 1 account</a></li>
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
							
							<p>These preferences apply to your whole account, not the individual devices.</p>
							
							<div class="columnbox">
								
								<h5>General preferences</h5>
								
								<div class="row">
									<p><strong>Accept POS cash payments</strong></p>
									<p class="data">{if $preferences['accept']['cash'] == "true"}Yes{else}No{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Accept POS credit card payments</strong></p>
									<p class="data">{if $preferences['accept']['creditcard'] == "true"}Yes{else}No{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Accept Scan &amp; Pay</strong></p>
									<p class="data">{if $preferences['accept']['scanandpay'] == "true"}Yes{else}No{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Accept Scan &amp; Buy</strong></p>
									<p class="data">{if $preferences['accept']['scanandbuy'] == "true"}Yes{else}No{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Accept eCommerce</strong></p>
									<p class="data">{if $preferences['accept']['ecommerce'] == "true"}Yes{else}No{/if}</p>
								</div>
								
								{if true == false}
								<div class="row">
									<p><strong>Accept POS payments</strong></p>
									<p class="data">{if $preferences['accept']['pos'] == "true"}Yes{else}No{/if}</p>
								</div>
								{/if}
								
								<div class="row">
									<p><strong>POS secret</strong></p>
									<p class="data">{if $preferences['possecret'] != null}{$preferences['possecret']}{else}N/A{/if}</p>
								</div>
								
								<div class="row">
									<p><strong>Sales tax</strong></p>
									<p class="data">{$preferences['salestax']}</p>
								</div>
								
								<div class="row">
									<p><strong>Tips</strong></p>
									<p class="data">₹{number_format($preferences['tips'], 2, '.', ',')}</p>
								</div>
								
								<div class="row">
									<p><strong>Timezone</strong></p>
									<p class="data">GMT {$preferences['system']['timezone']}</p>
								</div>
								
								<ul class="actionlinks">
									<li><a href="{$formbase}profile/editprefs">Edit</a></li>
									{if $systemadmin}<li><a href="{$formbase}profile/lockaccount">Lock account</a></li>
									<li><a href="{$formbase}profile/deleteaccount">Delete account</a></li>{/if}
								</ul>
								
							</div>
							
						</div>
						
						<div class="tab setup posdevices table">
								
							<h4>Devices</h4>
							
							<p>You can add to your InCashMe&#8482; Merchant Account up to ten (10) devices. These devices need a Data plan (WiFi or Cellular) and ideally, SMS/TXT capabilities.</p>
							
							<div class="dtable">
								<div class="dhead">
									<div class="drow">
										<div class="dcol col1">ID</div>
										<div class="dcol col2">Display name</div>
										<div class="dcol col3">Serial number</div>
										<div class="dcol col4">Status</div>
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
													<strong>{$v.alias}</strong>
												</div>
												<div class="dcol col3">
													{$v.cellphone}
												</div>
												<div class="dcol col4">
													{$v.status}{if $v.is_default != 0}/default{/if}
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
																	{if true == false and $v.is_default == 0 and $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a></li>
																	{/if}
																	{if $v.is_default == 0 and $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}">Edit name</a></li>
																	{/if}
																	{if true == false}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}">Device preferences</a></li>
																	{/if}
																	{if $v.status == "active"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}">Lock</a></li>
																	{elseif $v.status == "locked"}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}">Unlock</a></li>
																	{/if}
																	{if $v.is_default == 0}
																		<li style="margin:0 2px 0 0;"><a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}">Delete</a></li>
																	{/if}
																</ul>
															</div>
															<div style="overflow:hidden;">
																<div style="float:left;overflow:hidden;width:240px;">
																	<div>
																		<p><strong>Info</strong></p>
																		<ul>
																			<li>Status: {$v.status}</li>
																			<li>Serial number: {$v.cellphone}</li>
																			<li>Last user: {if $v.last_user == null}N/A{else}{$v.last_user}{/if}</li>
																		</ul>
																	</div>
																</div>
																<div style="float:left;overflow:hidden;width:260px;">
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
																	<div>
																		<p><strong>Device preferences</strong></p>
																		<ul>
																			<li>Sales tax: {$cellpreferences[$v.mobile_id]["salestax"]}</li>
																			<li>Tips: ₹{$cellpreferences[$v.mobile_id]["tips"]}</li>
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
			                        		<div class="dcol"><em>There are no devices associated with your account.</em></div>
			                        	</div>
									{/foreach}
								</div>
							</div>
							
						</div>
						
						<div class="tab setup users table">
								
							<h4>POS users</h4>
							
							<p>You can add to your InCashMe&#8482; Merchant Account up to ten (10) POS users. Before you add POS users, you need to have the POS secret defined in preferences.</p>
							
							<div class="dtable">
								<div class="dhead">
									<div class="drow">
										<div class="dcol col1">ID</div>
										<div class="dcol col2">Username</div>
										<div class="dcol col3">Name</div>
										<div class="dcol col4">Status</div>
									</div>
								</div>
								<div class="dbody">
									{foreach from=$users item=v name=users_loop}
										<div id="{$v.user_id}" class="drow{if $smarty.foreach.users_loop.index%2} drowalt{/if}">
											<div class="dnormal">
												<div class="dcol col1">
													{$v.user_id}
												</div>
												<div class="dcol col2">
													<strong>{$v.email}</strong>
													<ul class="rowactions">
														<li><a href="{$formbase}profile/edituser/ITEM/{$v.user_id}">Edit</a></li>
														<li><a href="{$formbase}profile/deleteuser/ITEM/{$v.user_id}">Delete</a></li>
														<li><a href="{$formbase}profile/edituserpassword/ITEM/{$v.user_id}">Change password</a></li>
														{if $v.status == "active" or $v.status == "locked"}
															<li><a href="{$formbase}profile/edituserstatus/ITEM/{$v.user_id}">Change status</a></li>
														{else}
															<li><a href="#" onclick="$.wigialert('You can only change status for active and locked users.');return false;">Change status</a></li>
														{/if}
													</ul>
												</div>
												<div class="dcol col3">
													{$v.first_name} {$v.last_name}
												</div>
												<div class="dcol col4">
													{$v.status}
													{if $v.status == "active"}
														{if count($userdevices[$v.user_id]) > 0}
															on device:
															{foreach from=$userdevices[$v.user_id] item=udid}
																<br />{$udid['os_id']}
															{/foreach}
														{/if}
													{/if}
												</div>
											</div>
										</div>
									{foreachelse}
			                        	<div class="drow">
			                        		<div class="dcol"><em>There are no users associated with your account.</em></div>
			                        	</div>
									{/foreach}
								</div>
							</div>
							
							
							<ul class="actionlinks">
								{if $preferences['possecret'] == null}
									<li><a href="{$formbase}profile/editprefs">You need to define a POS secret to add new POS users</a></li>
								{elseif (count($users)) < 10}
									<li><a href="{$formbase}profile/adduser">Add new</a></li>
								{else}
									<li><a href="#">Can't add more than 10 POS users</a></li>
								{/if}
							</ul>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}