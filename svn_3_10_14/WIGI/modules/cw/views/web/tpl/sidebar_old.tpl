			<div id="sidebar">
				<div class="welcome">
					<h3>Welcome, <span>{$name}</span></h3>
					<p>Account: {$usertype}, {$status}</p>
				</div>
				<div class="navigation">
					<ul class="nav nav-tabs nav-stacked">
						<li class="dashboard{if $pageid == 'dashboard'} current{/if}"><a href="{$formbase}dashboard/home"><span class="iconfa-dashboard"></span>Dashboard</a></li>
						<li class="addfunds{if $pageid == 'addfunds'} current{/if}"><a href="{$formbase}money/showadd"><span class="iconfa-dashboard"></span>Add Funds</a></li>
						<li class="withdraw{if $pageid == 'withdraw'} current{/if}"><a href="{$formbase}money/showwithdraw"><span class="iconfa-dashboard"></span>Withdraw Funds</a></li>
						<li class="orders{if $pageid == 'orders'} current{/if}"><a href="{$formbase}orders/scanandpay"><span class="iconfa-dashboard"></span>Orders</a></li>
						<li class="history{if $pageid == 'history'} current{/if}"><a href="{$formbase}history/home"><span class="iconfa-dashboard"></span>History</a></li>
						<li class="statements{if $pageid == 'statements'} current{/if}"><a href="{$formbase}statement/home"><span class="iconfa-dashboard"></span>Statements</a></li>
						<li class="profile{if $pageid == 'profile'} current{/if}"><a href="{$formbase}profile/home"><span class="iconfa-dashboard"></span>Profile</a></li>
						<li class="dashboard advanced{if $pageid == 'advanced'} current{/if}"><a href="{$formbase}advanced/home"><span class="iconfa-dashboard"></span>Advanced Features</a></li>
						<li class="dashboard admin{if $pageid == 'admin'} current{/if}"><a href="{$formbase}admin/home"><span class="iconfa-dashboard"></span>Admin</a></li>
            			<li class="statements{if $pageid == 'howitworks'} current{/if}"><a href="{$formbase}how-it-works/"><span class="iconfa-dashboard"></span>How It Works</a></li>
					</ul>
				</div>
				<div class="version">
						<p>[Web {$web_version}] [BE {$be_version}]</p>
				</div>
			</div>