{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Security questions</li>
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
                <h1>Security questions</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				<div class="setup editquestion table">
					<h4 class="widgettitle">Security questions</h4>
					<div class="widgetcontent" >
					<!--<h4>Security questions</h4>-->
					
					<table class="table table-bordered responsive">
                            <thead>
                                <tr>
                                    <th class="head1">Question</th>
                                    <th class="head0">Answer</th>
                                    <th class="head1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
								{foreach name=questions_loop from=$questions item=k}
								<tr>
									<td>
										<strong>{if $k['question'] != ""}{$k['question']}{else}(None){/if}</strong>
										{if $k['question'] == ""}<a href="{$formbase}profile/addquestion/ITEM/{$ITEM}" ><input type="button" value="Add" class=" btn btn-info"/></a>{/if}
										</ul>
									</td>
									<td>- Answer on file -</td>
									<td>{if $k['question'] != ""}<a href="{$formbase}profile/editquestion/ITEM/{$ITEM}.{$k['question_id']}"><input type="button" value="Edit" class=" btn btn-info"/></a>{/if}</td>
								</tr>
								{/foreach}
                            </tbody>
                        </table>
					
					<!--<table>
						<thead>
							<tr>
								<th>Question</th>
								<th>Answer</th>
							</tr>
						</thead>
						<tbody>
							{foreach name=questions_loop from=$questions item=k}
							<tr>
								<td>
									<strong>{if $k['question'] != ""}{$k['question']}{else}(None){/if}</strong>
									<ul class="rowactions">
										{if $k['question'] == ""}<li><a href="{$formbase}profile/addquestion/ITEM/{$ITEM}">Add</a></li>{/if}
										{if $k['question'] != ""}<li><a href="{$formbase}profile/editquestion/ITEM/{$ITEM}.{$k['question_id']}">Edit</a></li>{/if}
									</ul>
								</td>
								<td>- Answer on file -</td>
							<tr/>
							{/foreach}
						</tbody>
					</table>-->
					<a href="{$formbase}profile/home#cellphones" ><input type="button" value="Cancel" class="btn btn-info"/></a>
					
					<!--<ul class="actionlinks">
						<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
					</ul>-->
					
				</div>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}