{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Move Funds</li>
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
                <h1>Move Funds</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar">
		<div id="page">		
			<div class="information">
		<div id="profile" class="setup profile columnlayout box-info">		
			<!--	<h4>Advanced Features</h4>-->
			<div class="tabbedwidget tab-info">
			
				<!--<div class="">-->
					<h4 class="widgettitle">Move funds</h4>
						
						
						<div class="widgetcontent" >
					<div class="tab setup movefunds formlayout subformlayout" id="movefunds">
						<p>You can move funds from your cell phone sub-accounts (that belongs to your InCashMe&#8482; Account) to your default cell phone. Only use this feature when your secondary phones are not available; otherwise, you need to use the send money feature.</p>
						
						<form action="{$formbase}advanced/movefunds" class="stdform" method="post">
							
						<p>
                            <label>Amount</label>
                            <span class="field">
								<input type="text" id="amount" name="amount" maxlength="7" value="0.00" />
							</span>
                            <small class="desc">The amount you would like to add</small>
                        </p>
						<p>
                            <label>From</label>
                            <span class="field">
								<select id="cellphone_list" name="cellphone_list">
										<option value="">Choose...</option>
										{foreach from=$cellphones key=k item=v}
											{if $v.is_default != 1}<option value="{$v.mobile_id}">{$v.cellphone}</option>{/if}
										{/foreach}
									</select>
                            </span>
							<small class="desc">Choose a cell phone</small>
                        </p>
						<p>
                            <label>To</label>
                            <span class="field">
							<input type="text" name="default_cellphone" value="{foreach from=$cellphones key=k item=v}{if $v.is_default == 1}{$v.cellphone} (Default){/if}{/foreach}" readonly="readonly" />
							</span>
                            <small class="desc">Your default cell phone</small>
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
					</div>
					
				<!--</div>-->
			</div>
		</div>		
			</div>
				
			</div>
			
	
{include file='footer.tpl'}