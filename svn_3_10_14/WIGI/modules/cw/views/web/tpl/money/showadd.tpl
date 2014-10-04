{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Add Funds</li>
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
                <h1>Add Funds</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar">	
		<div id="page">
				
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{include file='money/error.tpl'}
				
				<div id="addmoney" class="setup addfunds formlayout subformlayout box-info ">
					
					<!--<h4>Add money to your cell phone account</h4>-->
					
					<p>You can add funds to a specific Cell Phone sub-account (that belongs to your InCashMe&#8482; Account) from one of <a href="{$formbase}profile/home#moneysources">your pre-existing Money Sources</a>. Credit Card and Banking transfers may take up to 3-5 business banking days. Pending transfers will be reflected in your total balance and once settled (deposited) into your account your Available balance will be adjusted. We will send you an email as soon as the funds settle.</p>
					<h4 class="widgettitle">Add money to your cell phone account</h4>
					<div class="widgetcontent" >
					<form action="{$formbase}money/add" method="post" class="stdform">
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
									{foreach from=$bank_accounts key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
									{/foreach}
									{foreach from=$credit_cards key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
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
										<option value="{$v.mobile_id}">{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
									{/foreach}
                            </select>
							</span>
                            <small class="desc">Choose a cell phone</small>
                        </p>
							
						<div class="submit stdformbutton">
							<a href="{$formbase}dashboard/home" class="btn btn-info btn-rounded">Cancel</a>
							<input type="submit" value="Add Funds" class="btn btn-info btn-rounded" />
						</div>
						
						<!--<a class="btn btn-info btn-rounded" href=""><i class="iconfa-off"></i> Another Button</a>
						<div class="stepbox">
							<div class="prompt amount">
								<label for="amount">Amount ₹</label>
								<input type="text" id="amount" name="amount" class="formfield" maxlength="7" value="0.00" />
								<p class="tip">The amount you would like to add</p>
							</div>
							<div class="prompt account_list">
								<label for="account_list">From</label>
								<select id="account_list" name="account_list">
									<option value="">Choose...</option>
									{foreach from=$bank_accounts key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
									{/foreach}
									{foreach from=$credit_cards key=k item=v}
										<option value="{$v.id},{$v.type}">{$v.description}</option>
									{/foreach}
								</select>
								<p class="tip">Choose an account</p>
							</div>
							
							<div class="prompt cellphone_list">
								<label for="cellphone_list">To</label>
								<select id="cellphone_list" name="cellphone_list">
									<option value="">Choose...</option>
									{foreach from=$cellphones key=k item=v}
										<option value="{$v.mobile_id}">{$v.cellphone}{if $v.is_default == 1} (Default){/if}</option>
									{/foreach}
								</select>
								<p class="tip">Choose a cell phone</p>
							</div>
							
						</div>-->
						
						
					</form>
					</div>
					
					
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}