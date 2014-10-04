{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Statements</li>
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
                <h1>Statements</h1>
            </div>
        </div>
		</div>
	<div class="box_wide box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				<div class="setup statements table">
					
				<!--	<h4>Statements</h4> -->
				<h4 class="widgettitle" >
				{foreach from=$dates key=k item=i}
				
						<span id="">Statements from {$k}</span>
						
						</h4>
					<div class="widgetcontent form-horizontal">
						<table class="table table-bordered table-infinite">
						<thead>
							<tr>
								<th class="head0">Date</th>
								<th class="head0">View/Print</th>
								<th class="head0">Download</th>
							</tr>
						</thead>
						<tbody>
						{foreach from=$i key=s item=v}
						<tr>
							<td>{date("F (n), Y", $v.timestamp)}</td>
							<td><a href="{$formbase}statement/view/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}" target="_blank"><input type="button" class="btn btn-info" value="View / Print"/></td>
							<td>{if $datescount[$k][$s] > 0}<a href="{$formbase}statement/download/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}" target="_blank"><input type="button" class="btn btn-info" value="Download"/></a>{/if}</td>
						</tr>
						
						{/foreach}
						{foreachelse}
								<tr>
									<th>Statements</th>
								</tr>
								<tr>
	                        		<td><em>There are no statements available on your account yet. Please wait until the end of this month.</em></td>
	                        	</tr>
				{/foreach}	
						</tbody>
								
						</table>
						
						
						
						
						
						
						
						
				
					<!--
					<table>
						<tbody>
							{foreach from=$dates key=k item=i}
								<tr>
									<th colspan="2">Statements from {$k}</th>
								</tr>
								{foreach from=$i key=s item=v}
									<tr>
										<td class="col1">
											<strong>{date("F (n), Y", $v.timestamp)}</strong>
											<tr class="rowactions">
												<td><a href="{$formbase}statement/view/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}" target="_blank"><input type="button" class="btn btn-info" value="View / Print"/></a></td>
												{if $datescount[$k][$s] > 0}<td><a href="{$formbase}statement/download/from/{$v.year}-{$v.month}-1/to/{$v.year}-{$v.month}-{$v.day}/InCashMe-Statement-{$v.year}-{$v.month}.csv" target="_blank"><input type="button" class="btn btn-info" value="Download"/></a></td>{/if}
											</tr>
										</td>
									</tr>
								{/foreach}
							{foreachelse}
								<tr>
									<th>Statements</th>
								</tr>
								<tr>
	                        		<td><em>There are no statements available on your account yet. Please wait until the end of this month.</em></td>
	                        	</tr>
							{/foreach}
						</tbody>
					</table> -->
					
				</div>
				</div>
								
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}