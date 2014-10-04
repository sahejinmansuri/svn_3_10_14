{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Dashboard</li>
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
            <!--<form class="searchbar" method="post" action="results.html">
                <input type="text" placeholder="To search type and hit enter..." name="keyword">
            </form>-->
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5>All Features Summary</h5>
                <h1>Dashboard</h1>
            </div>
        </div>
			<!--{include file='dashboard/status.tpl'}-->
			
			
						<ul class="shortcuts">
                            <li class="events">
                                <a href="{$formbase}money/showadd">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label">Add Funds</span>
                                </a>
                            </li>
                            <li class="products">
                                <a href="{$formbase}money/showwithdraw">
                                    <span class="shortcuts-icon iconsi-cart"></span>
                                    <span class="shortcuts-label">Withdraw Funds</span>
                                </a>
                            </li>
                            <li class="archive">
                                <a href="{$formbase}orders/scanandpay">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label">Orders</span>
                                </a>
                            </li>
                            <li class="help">
                                <a href="{$formbase}history/home">
                                    <span class="shortcuts-icon iconsi-help"></span>
                                    <span class="shortcuts-label">Hisrtory</span>
                                </a>
                            </li>
                        </ul>
			
			
			
			<div class="information">
				
				<!--<div class="setup tools">
					
					<h4>Tools</h4>
					
					<ul>
						<li class="action1"><a href="{$formbase}money/showadd">Add Funds</a></li>
						<li class="action2"><a href="{$formbase}money/showwithdraw">Withdraw</a></li>
						<li class="action3"><a href="{$formbase}history/home">History</a></li>
						<li class="action4"><a href="{$formbase}statement/home">Statements</a></li>
						<li class="action5"><a href="{$formbase}profile/home">Profile</a></li>
					</ul>
					
				</div>-->
				
				<div class="setup transactions table">
					
					<h4 class="recent_transactions">Recent account transactions</h4>
						<table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th class="head1">Date</th>
                                    <th class="head0">Cellphones</th>
                                    <th class="head1">Description</th>
                                    <th class="head0">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
								{section name=transaction_loop loop=$trans max=5}
									<tr>
										<td>{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</td>
										<td>{$trans[transaction_loop].from_description}</td>
										<td>{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</td>
										<td>{number_format({$trans[transaction_loop].amount}, 2, '.', ',')}/-</td>
									</tr>
								{sectionelse}
									<tr>
										<td colspan="4"><em>There are no transactions.</em></td>
									</tr>
								{/section}
                            </tbody>
                        </table>
						
					<!--<div class="dtable">
						<div class="dhead">
							<div class="drow">
								<div class="dcol col1">Date</div>
								<div class="dcol col2">Cellphones</div>
								<div class="dcol col3">Description</div>
								<div class="dcol col4">Amount</div>
							</div>
						</div>
						<div class="dbody">
							{section name=transaction_loop loop=$trans max=5}
								<div id="{$trans[transaction_loop].transaction_id}" class="drow{if $smarty.section.transaction_loop.index%2} drowalt{/if}">
									<div class="dnormal{if $trans[transaction_loop].viewed == 0} dunread{/if}">
										<div class="dcol col1">{App_DataUtils::date2human($trans[transaction_loop].stamp,$tzpref)}</div>
										<div class="dcol col2"><strong>{$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$trans[transaction_loop].from]["user_id"]]["last_name"]}</strong> {$trans[transaction_loop].from_description}</div>
										<div class="dcol col3">{if $trans[transaction_loop].to == 0}Self{else}{$trans[transaction_loop].to_description}{/if} {$trans[transaction_loop].description}</div>
										<div class="dcol col4">₹{number_format({$trans[transaction_loop].amount}, 2, '.', ',')}</div>
									</div>
								</div>
							{sectionelse}
								<div class="drow">
	                        		<div class="dcol"><em>There are no transactions.</em></div>
	                        	</div>
	                        {/section}
						</div>
					</div>-->
					
					<p class="more">
						<a href="{$formbase}history/home">See all transactions &rsaquo;</a>
					</p>
					
				</div>
				
			</div>
		
{include file='footer.tpl'}
		
	
	
