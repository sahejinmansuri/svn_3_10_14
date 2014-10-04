<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
{if $logged_in == 1}
<meta name="robots" content="noindex, nofollow">
{/if}
<title>InCashMe&#8482; - Merchant Web Access</title>
<link rel="shortcut icon" type="image/x-icon" href="/templates/rt_affinity_j15/favicon.ico" />
<link rel="stylesheet" type="text/css" media="all" href="{$csspath}/style-statement.css" />
{if $logged_in == 1}
<script type="text/javascript" src="{$jspath}/scripts-home.js"></script>
<script type="text/javascript" src="{$jspath}/scripts-forms.js"></script>
{/if}

</head>

<div id="main">
	
	<div id="header">
		<div class="center">
			<div id="logo">
				<h1><a href="{$formroot}">InCashMe&#8482;<img src="{$csspath}/images/logo.png" alt="InCashMe&#8482;" /></a></h1>
			</div>
		</div>
	</div>
	<div id="content">
		
		<div class="title">
			<p>Statement for</p>
			<h1><strong>{$datefull}</strong> {$datefrom} - {$dateto}</h1>
			{if $haslogo == true}
				<img src="{$formbase}profile/viewlogo" alt="{$businessname}" class="logo" />
			{/if}
			<p class="logo">{$businessname}</p>
		</div>
		
		<div class="accountinfo">
			<p>Account: <span>{$email}</span></p>
			
			<h2>Account Summary</h2>
			<div class="summary">
				<ul>
					<li>Total ending balance <strong>₹{number_format({$totalending}, 2, '.', ',')}</strong></li>
					<li>Total transaction amount <strong>₹{number_format({$totaltransactions}, 2, '.', ',')}</strong></li>
				</ul>
			</div>
		</div>
		
		{foreach from=$statement key=k item=v}
			<h2>{$k} - History</h2>
			
			<ul class="cellsummary">
				<li>Bank account funding <strong>₹{number_format({$v.ba_fund}, 2, '.', ',')}</strong></li>
				<li>Bank account withdaws <strong>₹{number_format({$v.ba_withdraw}, 2, '.', ',')}</strong></li>
				<li>Payment disbursment <strong>₹{number_format({$v.send_money}, 2, '.', ',')}</strong></li>
				<li>Vendor payments <strong>₹{number_format({$v.send_money}, 2, '.', ',')}</strong></li>
				<li>Total cash received <strong>₹{number_format({$v.recv_money}, 2, '.', ',')}</strong></li>
				<li>Total WPC redeemed <strong>₹{number_format({$v.recv_money}, 2, '.', ',')}</strong></li>
				<li>Credit card swiped <strong>₹{number_format({$v.recv_money}, 2, '.', ',')}</strong></li>
			</ul>
			
			<div class="celldetails">
				<div class="dtable">
					<div class="dhead">
						<div class="drow">
							<div class="dcol col1">Date</div>
							<div class="dcol col2">Device</div>
							<div class="dcol col3">Description</div>
							<div class="dcol col4">Amount</div>
							
							<div class="dcol col5">Balance</div>
						</div>
					</div>
					<div class="dbody">
						{foreach from=$v.transactions item=t}
							<div class="drow">
								<div class="dcol col1">{App_DataUtils::date2human($t.stamp,$tzpref)}</div>
								<div class="dcol col2"><strong>{$allusers[$allcellphones[$t.from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$t.from]["user_id"]]["last_name"]}</strong> {$t.from_description}</div>
								<div class="dcol col3">{if $t.to == 0}Self{else}{$t.to_description}{/if} {$t.description}</div>
								<div class="dcol col4">₹{number_format({$t.amount}, 2, '.', ',')}</div>
								
								<div class="dcol col5">{if is_numeric($t.balance)}₹{number_format({$t.balance}, 2, '.', ',')}{else}N/A{/if}</div>
							</div>
						{foreachelse}
							<div class="drow">
				        		<div class="dcol"><em>There are no transactions.</em></div>
				        	</div>
						{/foreach}
					</div>
				</div>
			</div>
		{/foreach}
		
	</div>
	
</div>

</body>
</html>