{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>My Documents</li>
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
                <h1>My Documents</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar box-info">
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
						
			<div class="information">
					
					<div class="tab setup mydocuments" style="display:block">
						
						<h4 class="widgettitle">My documents</h4>
						<div class="widgetcontent" >
						<p>Documents saved for {if $selectedcellalias != null}{$selectedcellalias}, {App_DataUtils::fmtphone($selectedcellphone)}{else}{App_DataUtils::fmtphone($selectedcellphone)}{/if}.</p>
						
						<table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th class="head1">Description</th>
                                    <th class="head0">Number</th>
                                    <th class="head1">Type</th>
                                    <th class="head0">Expiration</th>
                                    <th class="head1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
								{foreach from=$docs item=v name=docs_loop}
									<tr>
										<td>{$v.description}</td>
										<td>{$v.number}</td>
										<td>{$v.type}</td>
										<td class="center">{$v.expiration}</td>
										<td class="center">
											<a href="{$formbase}advanced/mydocumentsview/C/{$item}/D/{$v.doc_id}" target="_blank"><input type="button"  class="btn btn-info" value="View Image"/></a>
											{if $v.editable == 1}
											<a href="{$formbase}advanced/mydocumentsedit/C/{$item}/D/{$v.doc_id}"><input type="button"  class="btn btn-info" value="Edit info"/></a>
											<a href="{$formbase}advanced/mydocumentsdelete/C/{$item}/D/{$v.doc_id}"><input type="button"  class="btn btn-info" value="Delete"/></a>
											{/if}
										</td>
									</tr>
									
									<!--<div id="{$v.doc_id}" class="drow{if $smarty.foreach.docs_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.description}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/mydocumentsview/C/{$item}/D/{$v.doc_id}" target="_blank">View image</a></li>
													<li><a href="{$formbase}advanced/mydocumentsedit/C/{$item}/D/{$v.doc_id}">Edit info</a></li>
													<li><a href="{$formbase}advanced/mydocumentsdelete/C/{$item}/D/{$v.doc_id}">Delete</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{$v.number}
											</div>
											<div class="dcol col3">
												{$v.type}
											</div>
											<div class="dcol col4">
												{$v.expiration}
											</div>
										</div>
									</div>-->
								{foreachelse}
		                        	<tr>
										<td colspan="5"><em>There are no documents associated with this cell phone.</em></td>
		                        	</tr>
								{/foreach}
                            </tbody>
                        </table>
						
						<!--<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Description</div>
									<div class="dcol col2">Number</div>
									<div class="dcol col3">Type</div>
									<div class="dcol col4">Expiration</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$docs item=v name=docs_loop}
									<div id="{$v.doc_id}" class="drow{if $smarty.foreach.docs_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col1">
												<strong>{$v.description}</strong>
												<ul class="rowactions">
													<li><a href="{$formbase}advanced/mydocumentsview/C/{$item}/D/{$v.doc_id}" target="_blank">View image</a></li>
													<li><a href="{$formbase}advanced/mydocumentsedit/C/{$item}/D/{$v.doc_id}">Edit info</a></li>
													<li><a href="{$formbase}advanced/mydocumentsdelete/C/{$item}/D/{$v.doc_id}">Delete</a></li>
												</ul>
											</div>
											<div class="dcol col2">
												{$v.number}
											</div>
											<div class="dcol col3">
												{$v.type}
											</div>
											<div class="dcol col4">
												{$v.expiration}
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no documents associated with this cell phone.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>-->
						
					</div>
				</div>
			</div>
		</div>
	</div>
{include file='footer.tpl'}