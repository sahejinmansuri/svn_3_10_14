{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Messages</li>
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
                <h1>Messages</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar">
		<div id="page">		
			<div class="information">
		<div id="profile" class="setup profile columnlayout box-info">		
			<!--	<h4>Advanced Features</h4>-->
			<div class="tabbedwidget tab-info">
			
					
					
					
					
					<div class="tab setup messages messagescellphones" id="messages">
						
						<h4 class="widgettitle">Messages</h4>
						<div class="widgetcontent" >
						
						<p>Please select a cell phone to view messages on.</p>
						
						
						<table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th class="head1">Phone number</th>
                                    <th class="head0">Display name</th>
                                    <th class="head1">View</th>
                                </tr>
                            </thead>
                            <tbody>
								{foreach from=$cellphones item=v name=cellphones_loop}
									<tr>
										<td>{$v.cellphone}</td>
										<td>{if $v.alias != null}{$v.alias} {$v.last_name}{else}N/A{/if}</td>
										<td>
										
										<a href="{$formbase}advanced/messages/ITEM/{$v.mobile_id}#messages" >
											<input type="button" value="View" class="btn btn-info">
										</a></td>
									</tr>
									
									
								{foreachelse}
		                        	<tr>
										<td colspan="5"><em>There are no cell phones associated with your account.</em></td>
		                        	</tr>
								{/foreach}
                            </tbody>
                        </table>
						
						<!--
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Phone number</div>
									<div class="dcol col2">Display name</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$cellphones item=v name=cellphones_loop}
									<div class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.cellphone}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/messages/ITEM/{$v.mobile_id}#messages">View</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{if $v.alias != null}{$v.alias}{else}N/A{/if}
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div> -->
						
					</div>
					</div>
					
				<!--</div>-->
			</div>
		</div>		
			</div>
				</div>
				
			</div>
			
	
{include file='footer.tpl'}