<div id="sidebar">
	<div class="welcome">
		<h3>Welcome, <span>{$mw_first_name} {$mw_last_name}</span></h3>
		<p>Account: {$usertype}, {$status}</p>
		<p>Merchant ID: {$merchantid}</p>
	</div>
	<div class="navigation">
		<!--ul>
			{if $DASHBOARD_INDEX}<li class="dashboard{if $pageid == 'dashboard'} current{/if}"><a href="{$formbase}dashboard/home">Dashboard</a></li>{/if}
			{if $ADD_FUNDS_INDEX}<li class="addfunds{if $pageid == 'addfunds'} current{/if}"><a href="{$formbase}money/showadd">Add Funds</a></li>{/if}
			{if $WITHDRAW_FUNDS_INDEX}<li class="withdraw{if $pageid == 'withdraw'} current{/if}"><a href="{$formbase}money/showwithdraw">Withdraw Funds</a></li>{/if}
			{if $VIEW_ORDERS_INDEX}<li class="orders{if $pageid == 'orders'} current{/if}"><a href="{$formbase}orders/scanandpay">Orders</a></li>{/if}
			{if $VIEW_HISTORY_INDEX}<li class="history{if $pageid == 'history'} current{/if}"><a href="{$formbase}history/home">History</a></li>{/if}
			{if $VIEW_REPORTS_INDEX}<li class="report{if $pageid == 'report'} current{/if}"><a href="{$formbase}report/home">Download Transactions</a></li>{/if}
			{if $VIEW_STATEMENTS_INDEX}<li class="statements{if $pageid == 'statements'} current{/if}"><a href="{$formbase}statement/home">Statements</a></li>{/if}
			{if $VIEW_PROFILE_INDEX}<li class="profile{if $pageid == 'profile'} current{/if}"><a href="{$formbase}profile/home">Profile</a></li>{/if}
			{if $VIEW_ADVANCED_FEATURES_INDEX}<li class="dashboard advanced{if $pageid == 'advanced'} current{/if}"><a href="{$formbase}advanced/home">Advanced Features</a></li>{/if}
			{if $systemadmin}
				<li class="orders{if $pageid == 'admin'} current{/if}"><a href="{$formbase}admin/home">Admin</a></li>
			{/if}
			<li class="statements{if $pageid == 'howitworks'} current{/if}"><a href="{$formbase}how-it-works/">How It Works</a></li>
		</ul-->
<ul>
			<li class="dashboard{if $pageid == 'dashboard'} current{/if}"><a href="{$formbase}dashboard/home">Dashboard</a></li>
			<li class="addfunds{if $pageid == 'addfunds'} current{/if}"><a href="{$formbase}money/showadd">Add Funds</a></li>
			<li class="withdraw{if $pageid == 'withdraw'} current{/if}"><a href="{$formbase}money/showwithdraw">Withdraw Funds</a></li>
			<li class="orders{if $pageid == 'orders'} current{/if}"><a href="{$formbase}orders/scanandpay">Orders</a></li>
			<li class="history{if $pageid == 'history'} current{/if}"><a href="{$formbase}history/home">History</a></li>
			<li class="report{if $pageid == 'report'} current{/if}"><a href="{$formbase}report/home">Download Transactions</a></li>
			<li class="statements{if $pageid == 'statements'} current{/if}"><a href="{$formbase}statement/home">Statements</a></li>
			<li class="profile{if $pageid == 'profile'} current{/if}"><a href="{$formbase}profile/home">Profile</a></li>
			<li class="dashboard advanced{if $pageid == 'advanced'} current{/if}"><a href="{$formbase}advanced/home">Advanced Features</a></li>
			
				<li class="orders{if $pageid == 'admin'} current{/if}"><a href="{$formbase}admin/home">Admin</a></li>
			
			<li class="statements{if $pageid == 'howitworks'} current{/if}"><a href="{$formbase}how-it-works/">How It Works</a></li>
		</ul>
	</div>
	<div class="version">
		<p>[Web {$web_version}] [BE {$be_version}]</p>
	</div>
</div>