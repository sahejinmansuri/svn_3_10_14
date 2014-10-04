			<div class="leftpanel">
        
        <div class="leftmenu"> 
			{if $logged_in == 1}
			
				{assign var="fund_class" value=""}
				{assign var="account_class" value=""}
				{assign var="fund_display" value=""}
				
				<!--For fund-->
				{if $pageid == 'addfunds'}
					{assign var="fund_class" value="active"}
					{assign var="fund_display" value="style='display:block'"}
				{elseif $pageid == 'withdraw'}
					{assign var="fund_class" value="active"}
					{assign var="fund_display" value="style='display:block'"}
				{/if}
				
				<!--For Account-->
				{if $pageid == 'profile'}
					{assign var="account_class" value="active"}
					{assign var="account_display" value="style='display:block'"}
				{elseif $pageid == 'statements'}
					{assign var="account_class" value="active"}
					{assign var="account_display" value="style='display:block'"}
				{elseif $pageid == 'history'}
					{assign var="account_class" value="active"}
					{assign var="account_display" value="style='display:block'"}
				{/if}
				
					<ul class="nav nav-tabs nav-stacked">
						<li class="nav-header">Navigation</li>
						<li class="dashboard{if $pageid == 'dashboard'} active{/if}"><a href="{$formbase}dashboard/home"><span class="iconfa-dashboard"></span>Dashboard</a></li>
						<li class="dropdown {$fund_class}"><a href="#"><span class="iconfa-dashboard"></span>Funds</a>
							<ul {$fund_display}>
								<li class="addfunds{if $pageid == 'addfunds'} active{/if}"><a href="{$formbase}money/showadd"><span class="iconfa-dashboard"></span>Add Funds</a></li>
								<li class="withdraw{if $pageid == 'withdraw'} active{/if}"><a href="{$formbase}money/showwithdraw"><span class="iconfa-dashboard"></span>Withdraw Funds</a></li>
							</ul>
						</li>
						<li class="dropdown orders{if $pageid == 'orders'} active{/if}"><a href="#"><span class="iconfa-dashboard"></span>Orders</a>
							<ul {if $pageid == 'orders'} style="display:block" {/if}>
								<li class="{if $pageid_inner == 'scanandpay'} active{/if}"><a href="{$formbase}orders/scanandpay">Scan & Pay</a></li>
								<li class="{if $pageid_inner == 'scanandbuy'} active{/if}"><a href="{$formbase}orders/scanandbuy">Scan & Buy</a></li>
								<!--<li><a href="{$formbase}orders/scananddonate">Scan & Donate</a></li>
								<li><a href="{$formbase}orders/scanandgift">Scan & Gift</a></li>-->
								<li class="{if $pageid_inner == 'ecommerce'} active{/if}"><a href="{$formbase}orders/ecommerce">Ecommerce</a></li>
								<li class="{if $pageid_inner == 'donations'} active{/if}"><a href="{$formbase}orders/donations">Donations</a></li>
								<li class="{if $pageid_inner == 'payments'} active{/if}"><a href="{$formbase}orders/payments">Payments</a></li>
							</ul>
						</li>
						
						<li class="dropdown orders {$account_class}"><a href="#"><span class="iconfa-dashboard"></span>Account</a>
							<ul {$account_display}>
								<li class="{if $pageid == 'profile'} active{/if}"><a href="{$formbase}profile/home"><span class="iconfa-dashboard"></span>Profile</a></li>
								<li class="{if $pageid == 'messages'} active{/if}"><a href="{$formbase}advanced/message"><span class="iconfa-dashboard"></span>Messages</a></li>
								<li class="{if $pageid == 'documents'} active{/if}"><a href="{$formbase}advanced/documents"><span class="iconfa-dashboard"></span>Documents</a></li>
								<li class="{if $pageid == 'statements'} active{/if}"><a href="{$formbase}statement/home"><span class="iconfa-dashboard"></span>Statement</a></li>
								<li class="{if $pageid == 'history'} active{/if}"><a href="{$formbase}history/home"><span class="iconfa-dashboard"></span>History</a></li>
								<li class="{if $pageid == 'movefunds'} active{/if}"><a href="{$formbase}advanced/movefund"><span class="iconfa-dashboard"></span>Move Funds</a></li>
								
							</ul>
						</li>
						<!--<li class="history{if $pageid == 'history'} active{/if}"><a href="{$formbase}history/home"><span class="iconfa-dashboard"></span>History</a></li>
						<li class="statements{if $pageid == 'statements'} active{/if}"><a href="{$formbase}statement/home"><span class="iconfa-dashboard"></span>Statements</a></li>
						<li class="profile{if $pageid == 'profile'} active{/if}"><a href="{$formbase}profile/home"><span class="iconfa-dashboard"></span>Profile</a></li>
						<li class="dashboard advanced{if $pageid == 'advanced'} active{/if}"><a href="{$formbase}advanced/home"><span class="iconfa-dashboard"></span>Advanced Features</a></li>
						<!--<li class="dashboard admin{if $pageid == 'admin'} active{/if}"><a href="{$formbase}admin/home"><span class="iconfa-dashboard"></span>Admin</a></li>-->
            			<li class="statements{if $pageid == 'howitworks'} active{/if}"><a href="{$formbase}how-it-works/"><span class="iconfa-dashboard"></span>How It Works</a></li>
					</ul>
				{/if}
				</div>
			</div>