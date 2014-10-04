{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Profile</li>
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
                <h1>Profile</h1>
            </div>
        </div>
		
		<div class="box_wide box_withsidebar box-info">	
		<div id="page">
			
			
			<!--<div class="tabbedwidget tab-info">
                            <ul>
                                <li><a href="#personalinfo">Personal info</a></li>
								<li><a href="#moneysources">Money sources</a></li>
								<li><a href="#preferences">Preferences</a></li>
								<li><a href="#cellphones">Cell phones</a></li>
                            </ul>
                            <div id="f-1">
                                Your content goes here for tab 1
                            </div>
                            <div id="f-2">
                                Your content goes here for tab 2
                            </div>
                            <div id="f-3">
                                Your content goes here for tab 3 
                            </div>
                        </div>-->
						
						
			
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				<div id="profile" class="setup profile columnlayout">
					
					<!--<h4>Profile settings</h4>-->
					
					<div class="tabbedwidget tab-info">
						
						<div class="tabnavigation">
							
							<ul>
								<li><a href="#personalinfo">Personal info</a></li>
								<li><a href="#moneysources">Money sources</a></li>
								<!--<li><a href="#preferences">Preferences</a></li>-->
								<li><a href="#cellphones">Cell phones</a></li>
							</ul>
							
						</div>
						
						<div class="tab setup personalinfo" id="personalinfo">
							
							<div class="row">
                    	<div class="col-md-4 profile-left">
                        
                        <div class="widgetbox profile-photo">
                            <div class="headtitle">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                      <li><a href="{$formbase}profile/editpicture">Change Picture</a></li>
                                      <!--<li><a href="#">Remove Picture</a></li>-->
                                    </ul>
                                </div>
                                <h4 class="widgettitle">Profile Picture</h4>
                            </div>
                            <div class="widgetcontent">
                                <div class="profilethumb">
                                    <img class="img-polaroid" alt="" src="{$baseurl}/u/profile/{$image_path}" height="193" width="193">
                                </div><!--profilethumb-->
								<!--<a class="link" href="{$formbase}profile/editpassword">Change Picture</a>-->
                            </div>
                        </div>
                            
                            
                        <div class="widgetbox tags">
                                <h4 class="widgettitle">KYC Picture</h4>
								<div class="widgetcontent ">
                                <div class="profilethumb">
                                    <img class="img-polaroid" alt="" src="{$baseurl}/u/profile/{$image_path2}" height="193" width="193">
                                </div><!--profilethumb-->
                            </div>
                                
                        </div>
                            
                        </div><!--col-md-4-->
                        <div class="col-md-8">
									
                            <form method="post" class="editprofileform stdform" action="editprofile.html">
                                
                                <div class="widgetbox login-information">
                                    <h4 class="widgettitle">Login Information</h4>
                                    <div class="widgetcontent form-horizontal">
										<div class="form-group">
                                            <label class="col-md-4 control-label">Cellphone:</label>
														  <div class="col-md-8">
														  <span class="profile_detail">{$cellphone_default}</span>
														  </div>
                                        </div>
													
										<div class="form-group">
                                            <label class="col-md-4 control-label">Email:</label>
														  <div class="col-md-8">
														  <span class="profile_detail">{$email}</span>
														  </div>
                                        </div>
													
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Password:</label>
														  <div class="col-md-8">
															<div class="divider10">
															<a class="link" href="{$formbase}profile/editpassword"> <span class="profile_detail">Change Password</span></a></div>
														  </div>
                                        </div>
													 
                                    </div>
                                </div>
                                
                                
                                <div class="widgetbox personal-information">
                                    <h4 class="widgettitle">Personal Information</h4>
                                    <div class="widgetcontent form-horizontal">
													
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Firstname:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$firstname}
														  </div>
                                        </div>
													 
													 <div class="form-group">
                                            <label class="col-md-4 control-label">Lastname:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$lastname}
														  </div>
                                        </div>
													<div class="form-group">
                                            <label class="col-md-4 control-label">Nationality:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$nationality}
														  </div>
                                        </div>
													<div class="form-group">
                                            <label class="col-md-4 control-label">Mobile Phone Country Code:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$country_code}
														  </div>
                                        </div>			
													<div class="form-group">
                                            <label class="col-md-4 control-label">Your Cell #:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$altphone}
														  </div>
                                        </div>
														<div class="form-group">
                                            <label class="col-md-4 control-label">Your Email ID:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$email}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Birth Date:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$birthdate}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Gender:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$gender}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Marital Status:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$marital_status}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Spouse Name:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$spousename}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Occupation:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$occupation}
														  </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Legal Information</h4>
                                    <div class="widgetcontent form-horizontal">
                                       
									   <div class="form-group">
                                            <label class="col-md-4 control-label">Father's Name:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$fathersname}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Annual Income:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$annualincome}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Status:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$resident}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">PAN #:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$panno}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Aadhaar ID:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$aadharid}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Submitted ID Proof:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$submitedidproof}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Know Yout Client(KYC):</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$knowyourclient}
														  </div>
                                        </div>
										
										
									   
									   
                                    </div>
                                </div>
								 <div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Permenent Address</h4>
                                    <div class="widgetcontent form-horizontal">
                                       
									   <div class="form-group">
                                            <label class="col-md-4 control-label">Apt/Suit #:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$aptsuit}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Address 1:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$address}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Address 2:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$address2}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">City:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$city}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">State:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$state}
														  </div>
                                        </div><div class="form-group">
                                            <label class="col-md-4 control-label">Country:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$country}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Home Landline 1:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$landline1}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Home Landline 2:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$landline2}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Submitted Address Proof:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$submited_addres_proof}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Know Your Client:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$kyc}
														  </div>
                                        </div>
										
                                    </div>
                                </div>
								
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Shipping Address</h4>
                                    <div class="widgetcontent form-horizontal">
                                       
									    <div class="form-group">
                                            <label class="col-md-4 control-label">Apt/Suit #:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$aptsuit}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Address 1:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$address}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Address 2:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$address2}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">City:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$city}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">State:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$state}
														  </div>
                                        </div><div class="form-group">
                                            <label class="col-md-4 control-label">Country:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$country}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Home Landline 1:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$landline1}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Home Landline 2:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$landline2}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Submitted Address Proof:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$submited_addres_proof}
														  </div>
                                        </div>

                                    </div>
                                </div>
								
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Member Details</h4>
                                    <div class="widgetcontent form-horizontal">
                                       
									   <div class="form-group">
                                            <label class="col-md-4 control-label">Member ID:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$memberid}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-4 control-label">Mebmer Since:</label>
														  <div class="col-md-8">
															<span class="profile_detail">{$mebmersince}
														  </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <p>
                                	<!--<button class="btn btn-info" type="submit">Update Profile</button> &nbsp; -->
									<a class="btn btn-info" href="">Deactivate your account</a>
                                </p>
                                
                            </form>
                        </div><!--col-md-8-->
                    </div>
							
							<!--<h4>Personal info</h4>
							
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
								
							</div>-->
							
						</div>
						
						<div class="tab setup moneysources table" id="moneysources">
							
							<!--<h4>Money sources</h4>-->
							
							<p>To add funds to your InCashMe&#8482; Account or to move funds from your InCashMe&#8482; Account to a Bank Account, you need to define Money Sources. These can be Credit Cards/Prepaid Cards and/or Bank Accounts (Checking or Savings). We allow two credit cards, and one banking account.</p>
							<p>You can use a Credit Card as a source to add funds to your InCashMe&#8482; Account, just add it following the simple steps. You can also add a Bank Account, we will make two small withdrawals from your bank account that will be deposited back. You will have to verify these amounts (online with your bank or via paper statements) to confirm your account. Once the Bank Account has been confirmed, you can use it to add funds to your InCashMe&#8482; Account or to move funds from your InCashMe&#8482; Account to your Bank Account.</p>
							<p>Credit Card/Prepaid Card and Banking transfers may take up to 3-5 business banking days. Pending transfers will be reflected in your Total Balance and once settled (deposited) into your account your Available Balance will be adjusted.</p>
							
							<table class="table table-bordered table-infinite">
							
								<thead>
									<tr>
									<th class="head0 nosort">Display Name</th>
										
										<th class="head0">Status</th>
										<th class="head0">Type</th>
										<th class="head0">Account number</th>
										<th class="head0">Expiration date</th>
									</tr>
								</thead>
								<tbody>
									{foreach from=$bank_accounts item=v name=bank_accounts_loop}
									<tr{if $smarty.foreach.bank_accounts_loop.index%2} class="alt"{/if}>
										<td>
											<strong>{$v.description}</strong>{if $bank_accounts_r[$v.user_bank_account_id].description != null}<br />{$bank_accounts_r[$v.user_bank_account_id].description}{/if}
											<!--<ul class="rowactions">-->
											<p class="buttons_login">
												{if $v.status == "unconfirmed"}
												<a href="{$formbase}profile/confirmmoney/ITEM/ba{$v.user_bank_account_id}" class="btn btn-info">Confirm</a>
												{/if}
												{if $v.status == "active"}
												<a href="{$formbase}profile/linkcell/ITEM/ba{$v.user_bank_account_id}"><input type="button" class="btn btn-info" value="Link to cell phone"/></a>
												{/if} 
												<a href="{$formbase}profile/deletemoney/ITEM/ba{$v.user_bank_account_id}"><input type="button" class="btn btn-info" value="Delete"/></a>
											<!--</ul>-->
											</p>
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
									<tr {if $smarty.foreach.credit_cards_loop.index%2} class="alt"{/if} >
										<td>
											<strong>{$v.description}</strong>
											<!--<ul class="rowactions">-->
												{if $v.status == "active"}
												<a href="{$formbase}profile/linkcell/ITEM/cc{$v.user_credit_card_id}"><input type="button" class="btn btn-info" value="Link to cell phone"/></a>
												{/if}
												<a href="{$formbase}profile/deletemoney/ITEM/cc{$v.user_credit_card_id}"><input type="button" class="btn btn-info" value="Delete"/></a>
											<!--</ul>-->
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
							
							<tr class="actionlinks">
								{if (count($bank_accounts)+count($credit_cards)) < 3}
									<td><a href="{$formbase}profile/addmoney"><input type="button" class="btn btn-info" value="Add new"/></a></td>
								{else}
									<td><a href="#">Can't add more than 3 accounts</a></td>
								{/if}
								{if true == false}
									{if (count($bank_accounts)+count($credit_cards) > 0)}
										<td><a href="{$formbase}profile/linkcell">Link to cell phone</a></td>
									{/if}
								{/if}
							</tr>
							
						</div>
						
						<!--<div class="tab setup preferences" id="preferences">
								
							
							
							<p>These preferences apply to your whole account, not the individual cell phones.</p>
						<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">General preferences</h4>
									{if true == false}
                                    <div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">>Minimum balance:</label>
														  <div class="col-md-10">
															<span class="profile_detail">₹{number_format($preferences['wigi']['minbal'], 2, '.', ',')}
														  </div>
                                        </div>
										
                                    </div>
									{/if}
									<div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">Mobile app timeout:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences['system']['timeout']} seconds
														  </div>
                                        </div>
										
                                   
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">International transfers:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{if $preferences["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}
														  </div>
                                        </div>
										 <div class="form-group">
                                            <label class="col-md-2 control-label">Alerts:</label>
														  <div class="col-md-10">
															<span class="profile_detail">via {$preferences["notification"]["alert"]}
														  </div>
                                        </div>
										{if true == false}
										<div class="form-group">
                                            <label class="col-md-2 control-label">Statement method:</label>
														  <div class="col-md-10">
															<span class="profile_detail">by {$preferences["notification"]["statement"]}
														  </div>
                                        </div>
										{/if}
										<div class="form-group">
                                            <label class="col-md-2 control-label">Timezone:</label>
														  <div class="col-md-10">
															<span class="profile_detail">GMT {$preferences['system']['timezone']}
														  </div>
                                        </div>
										
                                    </div>
									
                                </div>
						
						
							
							<div class="columnbox">
						
								
								
								
		
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">InCashMe&#8482; Payment Code preferences</h4>
                                    <div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">Maximum amount per transaction:</label>
														  <div class="col-md-10">
															<span class="profile_detail">₹{number_format($preferences['wigi']['max_per_trans'], 2, '.', ',')}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Maximum number of transactions per day:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences['wigi']['max_per_day']} transactions
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">InCashMe&#8482; Payment Code timeout:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences["wigi"]["timeout"]} minutes
														  </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Send money/gift preferences</h4>
                                    <div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">Maximum amount per transaction:</label>
														  <div class="col-md-10">
															<span class="profile_detail">₹{number_format($preferences["gift"]["max_per_trans"], 2, '.', ',')}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Maximum number of transactions per day:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences["gift"]["max_per_day"]} gifts
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Alerts:</label>
														  <div class="col-md-10">
															<span class="profile_detail">via {$preferences["gift"]["alert"]}
														  </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Scan Payment System preferences</h4>
                                    <div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">Maximum amount per transaction:</label>
														  <div class="col-md-10">
															<span class="profile_detail">₹{number_format($preferences["scan"]["max_per_trans"], 2, '.', ',')}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Maximum number of transactions per day:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences["scan"]["max_per_day"]} gifts
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Alerts:</label>
														  <div class="col-md-10">
															<span class="profile_detail">via {$preferences["scan"]["alert"]}
														  </div>
                                        </div>
                                    </div>
                                </div>
								
								
								
								<div class="widgetbox profile-notifications">
                                    <h4 class="widgettitle">Funding preferences</h4>
                                    <div class="widgetcontent">
                                       
									   <div class="form-group">
                                            <label class="col-md-2 control-label">Maximum amount per funding:</label>
														  <div class="col-md-10">
															<span class="profile_detail">₹{number_format($preferences['funding']['max_per_trans'], 2, '.', ',')}
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Maximum number of fundings per day:</label>
														  <div class="col-md-10">
															<span class="profile_detail">{$preferences["funding"]["max_per_day"]} transactions
														  </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-2 control-label">Alerts:</label>
														  <div class="col-md-10">
															<span class="profile_detail">via {$preferences["funding"]["alert"]}
														  </div>
                                        </div>
                                    </div>
                                </div>
								
								<tr>
								<td class=""><a href="{$formbase}profile/editprefs"><input type="button" class="btn btn-info" value="Edit"/></a></td></tr>
								<tr><td><a href="{$formbase}profile/lockaccount"><input type="button" class="btn btn-info" value="Lock account"/></a></td></tr>
								<tr><td><a href="{$formbase}profile/deleteaccount"><input type="button" class="btn btn-info" value="Delete account"/></a></td>
								</tr>
							
							</div>
							
						</div>-->
						
					
						
						<div class="tab setup cellphones table" id="cellphones">
						<!--<h4>Cell phones</h4>-->
							
							<p>You can add to your InCashMe&#8482; Account up to four (4) Smart Cell phones (iPhones or Android). You need at least one (1) Smartphone active in your account at all times. These cell phones need a Data plan and SMS/TXT capabilities.</p>
							<p>If you have defined Money Sources, you can optionally link your Smartphones to some of the Money Sources so you can Add or Withdraw Funds directly from the Smartphone without going to a Web page.</p>
					
					<div class="col-md-12">

                        <div class="accordion accordion-info">
							{foreach from=$cellphones item=v name=cellphones_loop}
								<h3><a href="#">
									<span id="cellphone_detail1">{$ccountry}{$v.cellphone}</span>
									<span id="cellphone_detail2">{if $v.alias != null}{$v.alias} {$v.last_name}{else}N/A{/if}</span>
									<span id="cellphone_detail3">{$v.status}{if $v.is_default != 0}/default{/if}</span>
									<span id="cellphone_detail4">₹{number_format($v.balance, 2, '.', ',')}</span>
								</a></h3>
								<div >
															<div style="font-size:18px;font-weight:bold;margin:0;padding:8px 0 2px;">{if $v.alias != null}{$v.alias} {$v.last_name}{else}{$ccountry}{$v.cellphone}{/if}</div>
															<div  class="col-md-12">
															<p class="buttons_login">
															{if $v.status == "unconfirmed"}
																<a  class="btn btn-info" href="{$formbase}profile/confirmcell/ITEM/{$v.mobile_id}">Confirm</a>
															{/if}
															{if $v.is_default == 0 and $v.status == "active"}
																<a class="btn btn-info" href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a>
															{/if}
															{if $v.status == "active"}
																<a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit Cell"/></a>
																<a href="{$formbase}profile/viewquestion/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit questions"/></a>
																<a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Cell phone preferences"/></a>
															{/if}
																<a href="{$formbase}profile/editpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Change PIN"/></a>
																<a href="{$formbase}profile/forgotpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Forgot PIN?"/></a>
															{if $v.status == "active"}
																<a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Lock"/></a>
															{elseif $v.status == "locked"}
																<a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Unlock"/></a>
															{/if}
															{if $v.is_default == 0}
																<a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}"{if (int)$v.balance>0} onclick="$.wigialert('Please withdraw your funds from this account before deleting.');return false;"{/if}><input type="button" class="btn btn-info" value="Delete"/></a>
															{/if}
																<a href="{$formbase}profile/getrole/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Role"/></a>
															</p>
															<!--<table>
																<tr class="rowactions">
																	{if $v.status == "unconfirmed"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/confirmcell/ITEM/{$v.mobile_id}">Confirm</a></td>
																	{/if}
																	{if $v.is_default == 0 and $v.status == "active"}
																		<td style="margin:0 2px 0 0;">
																		<p class="buttons_login"><a class="btn btn-info" href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a></p></td>
																	{/if}
																	{if $v.status == "active"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit name"/></a></td>
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/viewquestion/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit questions"/></a></td>
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Cell phone preferences"/></a></td>
																	{/if}
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Change PIN"/></a></td>
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/forgotpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Forgot PIN?"/></a></td>
																	{if $v.status == "active"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Lock"/></a></td>
																	{elseif $v.status == "locked"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Unlock"/></a></td>
																	{/if}
																	{if $v.is_default == 0}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}"{if (int)$v.balance>0} onclick="$.wigialert('Please withdraw your funds from this account before deleting.');return false;"{/if}><input type="button" class="btn btn-info" value="Delete"/></a></td>
																	{/if}
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/getrole/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Role"/></a></td>
																</tr>
																</table>-->
															</div>
															<div class="widgetbox profile-notifications">
															<div style="overflow:hidden;">
																<div  class="col-md-4">
																
											
																
																	<div>
																	  <h4 class="widgettitle">Info</h4>
												
																		<div class="widgetcontent form-horizontal form_profile">
												<div class="form-group">
													<label class="col-md-4 control-label">Status :</label>
													  <div class="col-md-8">
														  <span class="profile_detail">{$v.status}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label">Cell number :</label>
													  <div class="col-md-8">
														  <span class="profile_detail">{$ccountry}{$v.cellphone}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label">Balance :</label>
													  <div class="col-md-8">
														  <span class="profile_detail">₹{number_format($v.balance, 2, '.', ',')}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label">Role :</label>
													  <div class="col-md-8">
														  <span class="profile_detail">{$v.role}</span>
													  </div>
												</div>
                                       
																			<!--<tr>
																			<td><strong>Status : </strong>{$v.status}</td> </br>
																			<td><strong>Cell number: </strong>{$ccountry}{$v.cellphone}</td></br>
																			<td><strong>Balance: </strong>₹{number_format($v.balance, 2, '.', ',')}</td>
																			<td><strong>Role: </strong>{$v.role}</td>
																		</tr>-->
										
																				</div>
																
																	</div>
																	
																	<div>
																	
																	<h4 class="widgettitle">More</h4>
																		<div class="widgetcontent form-horizontal form_profile">
												<div class="form-group">
													<label class="col-md-6 control-label">Device :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{if $v.phone_brand != null}{$v.phone_brand}{else}N/A{/if}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Date added :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{date("M j, Y", strtotime($v.date_added))}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">OS version :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{if $v.os_version != null}{$v.os_version}{else}N/A{/if}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">App version :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{if $v.app_version != null}{$v.app_version}{else}N/A{/if}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Last login :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{date("M j, Y", strtotime($v.last_login))}</span>
													  </div>
												</div>
                                       
																			<!--<tr>
																			<td><strong>Device: </strong>{if $v.phone_brand != null}{$v.phone_brand}{else}N/A{/if}</td>
																			
																			<td><strong>Date added: </strong>{date("M j, Y", strtotime($v.date_added))}</td>
																			
																			<td><strong>OS version: </strong>{if $v.os_version != null}{$v.os_version}{else}N/A{/if}</td>
																			
																			<td><strong>App version: </strong>{if $v.app_version != null}{$v.app_version}{else}N/A{/if}</td>
																			
																			<td><strong>Last login: </strong>{date("M j, Y", strtotime($v.last_login))}</td>
																		</tr>-->
										
																				</div>
																	
																		
																	</div>
																</div>
																
																<div  class="col-md-8"> 
																	<div>
														
																		 <h4 class="widgettitle">Links</h4>
																
																			<div class="widgetcontent">		
																		{if count($celllinks[$v.mobile_id]["cc"]) > 0 || count($celllinks[$v.mobile_id]["ba"]) > 0}
																			<tr>
																				{if count($celllinks[$v.mobile_id]["cc"]) > 0}
																					<td>Credit cards
																						<tr>
																							{foreach from=$celllinks[$v.mobile_id]["cc"] item=cl name=celllinks_loop}
																								<td>{$cl["description"]}</td>
																							{/foreach}
																						</tr>
																					</td>
																				{/if}
																				{if count($celllinks[$v.mobile_id]["ba"]) > 0}
																					<td>Bank accounts</td>
																				{/if}
																			</tr>
																		{else}
																			<tr>
																				<td>There are no money source linked to this cell phone</td>
																			</tr>
																		{/if}
																		</div>
																	</div>
																	<div>
																
																	<h4 class="widgettitle" >Cell phone preferences</h4>
											<div class="widgetcontent form-horizontal form_profile">
												{if true == false}
												<div class="form-group">
													<label class="col-md-6 control-label">Minimum balance ₹ :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{number_format($preferences['wigi']['minbal'], 2, '.', ',')}</span>
													  </div>
												</div>
												{/if}
												<div class="form-group">
													<label class="col-md-6 control-label">Mobile app timeout :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["system"]["timeout"]} second{if $cellpreferences[$v.mobile_id]["system"]["timeout"] > 0}s{/if}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">International transfers :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{if $cellpreferences[$v.mobile_id]["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-12 control-label-main">InCashMe&#8482; Money Payment Code preferences</label>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum amount per transaction :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">₹{$cellpreferences[$v.mobile_id]["wigi"]["max_per_trans"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum number of transactions per day :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["wigi"]["max_per_day"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Alerts :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["notification"]["alert"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">InCashMe&#8482; Money Payment Code timeout :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["wigi"]["timeout"]} minutes</span>
													  </div>
												</div>
												
												<div class="form-group">
													<label class="col-md-12 control-label-main">Send money/gift preferences</label>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum amount per gifts :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">₹{$cellpreferences[$v.mobile_id]["gift"]["max_per_trans"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum number of gifts per day :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["gift"]["max_per_day"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Alerts :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["gift"]["alert"]}</span>
													  </div>
												</div>
												
												<div class="form-group">
													<label class="col-md-12 control-label-main">Scan Payment System preferences</label>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum amount per transaction :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">₹{$cellpreferences[$v.mobile_id]["scan"]["max_per_trans"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum number of transactions per day :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["scan"]["max_per_day"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Alerts :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["scan"]["alert"]}</span>
													  </div>
												</div>
												
												<div class="form-group">
													<label class="col-md-12 control-label-main">Funding preferences</label>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum amount per funding :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">₹{$cellpreferences[$v.mobile_id]["funding"]["max_per_trans"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Maximum number of funding per day :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">₹{$cellpreferences[$v.mobile_id]["funding"]["max_per_day"]}</span>
													  </div>
												</div>
												<div class="form-group">
													<label class="col-md-6 control-label">Alerts :</label>
													  <div class="col-md-6">
														  <span class="profile_detail">{$cellpreferences[$v.mobile_id]["funding"]["alert"]}</span>
													  </div>
												</div>
                                       
																			<!--<tr>
																			<td><strong>Mobile app timeout: </strong>{$cellpreferences[$v.mobile_id]["system"]["timeout"]} second{if $cellpreferences[$v.mobile_id]["system"]["timeout"] > 0}s{/if}</td>
																			
																			<td><strong>International transfers: </strong>{if $cellpreferences[$v.mobile_id]["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</td>
																			
																			<td><strong>Alerts: </strong>via {$cellpreferences[$v.mobile_id]["notification"]["alert"]}</td>
																			
																			<td><strong>Maximum amount per transaction:</strong> ₹{$cellpreferences[$v.mobile_id]["wigi"]["max_per_trans"]}</td>
																			
																			<td><strong>Maximum number of transactions per day: </strong>{$cellpreferences[$v.mobile_id]["wigi"]["max_per_day"]}</td>
																			
																			<td><strong>InCashMe&#8482; Money Payment Code timeout: </strong>{$cellpreferences[$v.mobile_id]["wigi"]["timeout"]} minutes</td>
																			
																			<td><strong>Maximum amount per gifts: </strong>₹{$cellpreferences[$v.mobile_id]["gift"]["max_per_trans"]}</td>
																			
																			<td><strong>Maximum number of gifts per day: </strong>{$cellpreferences[$v.mobile_id]["gift"]["max_per_day"]}</td>
																			
																			<td><strong>Maximum amount per funding: </strong>₹{$cellpreferences[$v.mobile_id]["funding"]["max_per_trans"]}</td>
																			
																			<td><strong>Maximum number of funding per day: </strong>{$cellpreferences[$v.mobile_id]["funding"]["max_per_day"]}</td>
																		</tr>-->
										
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
                        <!--<div class="accordion accordion-info">
							<div class="dtable">
								
								<div class="dbody">
									{foreach from=$cellphones item=v name=cellphones_loop}
										<div id="{$v.mobile_id}" class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}" style="height:30px">
											<span class="dnormal">
												
												<span class="dcol col2">
													<strong>{$ccountry}{$v.cellphone}</strong>
												</span> &nbsp;&nbsp;&nbsp;
												<span class="dcol col3">
													{if $v.alias != null}{$v.alias}{else}N/A{/if}
												</span>&nbsp;&nbsp;&nbsp;
												<span class="dcol col4">
													{$v.status}{if $v.is_default != 0}/default{/if}
												</span>&nbsp;&nbsp;&nbsp;
												<span class="dcol col5">
													₹{number_format($v.balance, 2, '.', ',')}
												</span>
											</span>
											<div class="dextend">
												<div class="expandarrow"></div>
												<div class="expandtype transactionbox">
													<div style="float:left;">
															<div style="font-size:18px;font-weight:bold;margin:0;padding:8px 0 2px;">{if $v.alias != null}{$v.alias}{else}{$ccountry}{$v.cellphone}{/if}</div>
															<div style="padding:0 0 10px;overflow:hidden;width:930px;">
															<table>
																<tr class="rowactions">
																	{if $v.status == "unconfirmed"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/confirmcell/ITEM/{$v.mobile_id}">Confirm</a></td>
																	{/if}
																	{if $v.is_default == 0 and $v.status == "active"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a></td>
																	{/if}
																	{if $v.status == "active"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit name"/></a></td>
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/viewquestion/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Edit questions"/></a></td>
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Cell phone preferences"/></a></td>
																	{/if}
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/editpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Change PIN"/></a></td>
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/forgotpin/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Forgot PIN?"/></a></td>
																	{if $v.status == "active"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Lock"/></a></td>
																	{elseif $v.status == "locked"}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Unlock"/></a></td>
																	{/if}
																	{if $v.is_default == 0}
																		<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}"{if (int)$v.balance>0} onclick="$.wigialert('Please withdraw your funds from this account before deleting.');return false;"{/if}><input type="button" class="btn btn-info" value="Delete"/></a></td>
																	{/if}
																	<td style="margin:0 2px 0 0;"><a href="{$formbase}profile/getrole/ITEM/{$v.mobile_id}"><input type="button" class="btn btn-info" value="Role"/></a></td>
																</tr>
																</table>
															</div>
															<div class="widgetbox profile-notifications">
															<div style="overflow:hidden;">
																<div style="float:left;overflow:hidden;width:240px;">
																
											
																
																	<div>
																	  <h4 class="widgettitle">Info</h4>
																		<div class="widgetcontent">
                                       
																			<tr>
																			<td>Status : {$v.status}</td> </br>
																			<td>Cell number: {$ccountry}{$v.cellphone}</td></br>
																			<td>Balance: ₹{number_format($v.balance, 2, '.', ',')}</td>
																			<td>Role: {$v.role}</td>
																		</tr>
										
																				</div>
																
																	</div>
																	
																	<div>
																	
																	<h4 class="widgettitle">More</h4>
																		<div class="widgetcontent">
                                       
																			<tr>
																			<td>Device: {if $v.phone_brand != null}{$v.phone_brand}{else}N/A{/if}</td>
																			<td>Date added: {date("M j, Y", strtotime($v.date_added))}</td>
																			<td>OS version: {if $v.os_version != null}{$v.os_version}{else}N/A{/if}</td>
																			<td>App version: {if $v.app_version != null}{$v.app_version}{else}N/A{/if}</td>
																			<td>Last login: {date("M j, Y", strtotime($v.last_login))}</td>
																		</tr>
										
																				</div>
																	
																		
																	</div>
																</div>
																
																<div style="float:left;overflow:hidden;width:260px; margin-left:50px;">
																	<div>
														
																		 <h4 class="widgettitle">Links</h4>
																
																			<div class="widgetcontent">		
																		{if count($celllinks[$v.mobile_id]["cc"]) > 0 || count($celllinks[$v.mobile_id]["ba"]) > 0}
																			<tr>
																				{if count($celllinks[$v.mobile_id]["cc"]) > 0}
																					<td>Credit cards
																						<tr>
																							{foreach from=$celllinks[$v.mobile_id]["cc"] item=cl name=celllinks_loop}
																								<td>{$cl["description"]}</td>
																							{/foreach}
																						</tr>
																					</td>
																				{/if}
																				{if count($celllinks[$v.mobile_id]["ba"]) > 0}
																					<td>Bank accounts</td>
																				{/if}
																			</tr>
																		{else}
																			<tr>
																				<td>There are no money source linked to this cell phone</td>
																			</tr>
																		{/if}
																		</div>
																	</div>
																	<div>
																
																	<h4 class="widgettitle" >Cell phone preferences</h4>
																		<div class="widgetcontent">
                                       
																			<tr>
																			<td>Mobile app timeout: {$cellpreferences[$v.mobile_id]["system"]["timeout"]} second{if $cellpreferences[$v.mobile_id]["system"]["timeout"] > 0}s{/if}</td>
																			<td>International transfers: {if $cellpreferences[$v.mobile_id]["wigi"]["international_trans"] == "true"}Allowed{else}Denied{/if}</td>
																			<td>Alerts: via {$cellpreferences[$v.mobile_id]["notification"]["alert"]}</td>
																			<td>Maximum amount per transaction: ₹{$cellpreferences[$v.mobile_id]["wigi"]["max_per_trans"]}</td>
																			<td>Maximum number of transactions per day: {$cellpreferences[$v.mobile_id]["wigi"]["max_per_day"]}</td>
																			<td>InCashMe&#8482; Money Payment Code timeout: {$cellpreferences[$v.mobile_id]["wigi"]["timeout"]} minutes</td>
																			<td>Maximum amount per gifts: ₹{$cellpreferences[$v.mobile_id]["gift"]["max_per_trans"]}</td>
																			<td>Maximum number of gifts per day: {$cellpreferences[$v.mobile_id]["gift"]["max_per_day"]}</td>
																			<td>Maximum amount per funding: ₹{$cellpreferences[$v.mobile_id]["funding"]["max_per_trans"]}</td>
																			<td>Maximum number of funding per day: {$cellpreferences[$v.mobile_id]["funding"]["max_per_day"]}</td>
																		</tr>
										
																				</div>
																		
																		
																		
																	</div>
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
							</div>-->
							
					</div>
							</br>
							<tr class="actionlinks">
								{if (count($cellphones)) < 5}
									<td><a href="{$formbase}profile/addcell"><input type="button" class="btn btn-info" value="Add new cellphone"/></a></td>
								{else}
									<td><a href="#">Can't add more than 4 cell phones</a></td>
								{/if}
							</tr>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}