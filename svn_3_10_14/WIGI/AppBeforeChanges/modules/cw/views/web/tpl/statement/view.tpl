<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
{if $logged_in == 1}
<meta name="robots" content="noindex, nofollow">
{/if}
<title>InCashMe&#8482; - Consumer Web Access</title>
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
				<h1><a href="http://incashme.in/">InCashMe&#8482;<img src="{$csspath}/images/logo.png" alt="InCashMe&#8482;" /></a></h1>
			</div>
		</div>
	</div>
	<div id="content">
		
		<div class="title">
			<p>Statement for</p>
			<h1><strong>{$datefull}</strong> {$datefrom} - {$dateto}</h1>
		</div>
		
		<div class="accountinfo">
			<p>Account: <span>{$email}</span></p>
			
			<h2>Account Summary</h2>
			<div class="summary">
				<ul>
					<li>Total ending balance <strong>US${number_format({$totalending}, 2, '.', ',')}</strong></li>
					<li>Total transaction amount <strong>US${number_format({$totaltransactions}, 2, '.', ',')}</strong></li>
				</ul>
			</div>
		</div>
		
		{foreach from=$statement key=k item=v}
			<h2>{$countrycode}{App_DataUtils::fmtPhone($k)} - History</h2>
			
			<ul class="cellsummary">
				<li>Credit card funding <strong>US${number_format({$v.cc_fund}, 2, '.', ',')}</strong></li>
				<li>Bank account funding <strong>US${number_format({$v.ba_fund}, 2, '.', ',')}</strong></li>
				<li>Bank account withdaws <strong>US${number_format({$v.ba_withdraw}, 2, '.', ',')}</strong></li>
				<li class="clear">Total money sent (includes gifts) <strong>US${number_format({$v.send_money}, 2, '.', ',')}</strong></li>
				<li>Total money received (includes gifts) <strong>US${number_format({$v.recv_money}, 2, '.', ',')}</strong></li>
				<li>InCashMe&#8482; Scan and Buy <strong>US${number_format({$v.scanandbuy}, 2, '.', ',')}</strong></li>
				<li>InCashMe&#8482; Scan and Pay <strong>US${number_format({$v.scanandpay}, 2, '.', ',')}</strong></li>
				<li>Total WPC pending <strong>US${number_format({$v.wigi_pending}, 2, '.', ',')}</strong></li>
				<li>Total WPC redeemed <strong>US${number_format({$v.wigi_redeemed}, 2, '.', ',')}</strong></li>
			</ul>
			
			<div class="celldetails">
				<div class="dtable">
					<div class="dhead">
						<div class="drow">
							<div class="dcol col1">Date</div>
							<div class="dcol col2">Cell phone</div>
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
								<div class="dcol col4">US${number_format({$t.amount}, 2, '.', ',')}</div>
								<div class="dcol col5">{if is_numeric($t.balance)}US${number_format({$t.balance}, 2, '.', ',')}{else}N/A{/if}</div>
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