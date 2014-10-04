<div id="sidebar">
	<div class="welcome">
		<h3>Welcome, <span>{$first_name} {$last_name}</span></h3>
        <p>Last login: {$last_login_date}<br />IP address: {$last_login_ip}</p>
	</div>
	<div class="navigation">
		<ul>
			{if $DASHBOARD_INDEX}
				<li class="dashboard{if $pageid == 'dashboard'} current{/if}"><a href="{$formbase}dashboard/home">Dashboard</a></li>
			{else}
				<li class="dashboard disabled"><a>Dashboard</a></li>
			{/if}
			
			
			{if $DASHBOARD_INDEX}
				<li class="dashboard{if $pageid == 'statement'} current{/if}"><a href="{$formbase}statement/home">Statement</a></li>
			{else}
				<li class="dashboard disabled"><a>Statement</a></li>
			{/if}
			
			
			{if $CUSTOMER_SUPPORT_INDEX} 
				<li class="dashboard{if $pageid == 'customer'} current{/if}"><a href="{$formbase}customer/home">Customer Support</a></li>
			{else}
				<li class="dashboard disabled"><a>Customer Support</a></li>
			{/if}

			<!--<li class="dashboard{if $pageid == 'partnercustomer'} current{/if}"><a href="{$formbase}partnercustomer/home">Partner Customer Support</a></li>
			<li class="dashboard{if $pageid == 'secondlevel'} current{/if}"><a href="{$formbase}secondlevel/home">Second Level Support</a></li>
			{if $SECURITY_INDEX}
				<li class="dashboard{if $pageid == 'security'} current{/if}"><a href="{$formbase}security/home">Security</a></li>
			{else}
				<li class="dashboard disabled"><a>Security</a></li>
			{/if}-->
			
			{if $BILLING_INDEX}
				<li class="dashboard{if $pageid == 'billing'} current{/if}"><a href="{$formbase}billing/home">Billing</a></li>
			{else}
				<li class="dashboard disabled"><a>Billing</a></li>
			{/if}

			<li class="dashboard{if $pageid == 'system'} current{/if}"><a href="{$formbase}system/home">System</a></li>

			{if $SECURITY_INDEX}
		                <li class="dashboard{if $pageid == 'admin'} current{/if}"><a href="{$formbase}admin/home">Admin</a></li>
		        {else}
		                <li class="dashboard disabled"><a>Admin</a></li>
 		        {/if}
		</ul>
	</div>
</div>