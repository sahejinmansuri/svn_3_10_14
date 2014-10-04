{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->
			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>My documents</li>
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
                <h1>My documents</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar">
		<div id="page">		
			<div class="information">
		<div id="profile" class="setup profile columnlayout box-info">		
			<!--	<h4>Advanced Features</h4>-->
			<div class="tabbedwidget tab-info">
			
				<!--<div class="">-->
					
					
					
					<div class="tab setup mydocuments cellphones" id="mydocuments" >
						
						<h4 class="widgettitle" >My documents</h4>
						<div class="widgetcontent" >
						
						<p>Please select a cell phone to view your documents on.</p>
						
						<h4 class="widgettitle" >
						<span id="history_deyail2">Phone number</span>
						<span id="history_deyail3">Display name</span>
						<span id="history_deyail4">Documents</span>
						</h4>
					
						<div class="accordion accordion-info">
						{foreach from=$cellphones key=k item=v name=cellphones_loop}
						<h3><a href="">
						
							<span id="history_deyail2"><strong>{$v.cellphone}</strong></span>
							<span id="history_deyail3">{if $v.alias != null}{$v.alias} {$v.last_name}{else}N/A{/if}</span>
							<span id="history_deyail4">{$extcellphones[$k]} document{if $extcellphones[$k] != 1}s{/if}</span>
						
						</a></h3>
						
						
						<div>
						<div class="formlayout subformlayout">
													
												<h4 class="widgettitle">Enter PIN number</h4>
													
													<div class="widgetcontent">
													
													
													<form action="{$formbase}advanced/mydocuments#mydocuments" method="post" class="stdform" autocomplete="off">
							<p>
								<label>PIN</label>
								<span class="field">
									<input type="password" name="PIN" maxlength="7" />
								</span>
								<small class="desc">Enter your PIN number</small>
							</p>
														
														<input type="hidden" class="" name="ITEM" value="{$v.mobile_id}" />
														<input type="submit" class="btn btn-info" value="Submit" />
														<a href="{$formbase}advanced/documents"><input type="button" class="btn btn-info" value="Cancel" /></a>
														
														
													
													</form>
													
													
													
												</div>
												</div>
						</div>
						{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no cell phones associated with your account.</em></div>
		                        	</div>
								{/foreach}
						</div>
					
						<!--
						<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col2">Phone number</div>
									<div class="dcol col3">Display name</div>
									<div class="dcol col4">Documents</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$cellphones key=k item=v name=cellphones_loop}
									<div class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
										<div class="dnormal">
											<div class="dcol col2">
												<strong>{$v.cellphone}</strong>
											</div>
											<div class="dcol col3">
												{if $v.alias != null}{$v.alias}{else}N/A{/if}
											</div>
											<div class="dcol col4">
												{$extcellphones[$k]} document{if $extcellphones[$k] != 1}s{/if}
											</div>
										</div>
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<div class="formlayout subformlayout">
													
													<h4>Enter PIN number</h4>
													
													<form action="{$formbase}advanced/mydocuments#mydocuments" method="post" autocomplete="off">
														
														<div class="stepbox">
															
															<div class="prompt pin">
																<label>PIN</label>
																<input type="password" name="PIN" maxlength="7" />
																<p class="tip">Enter your PIN number</p>
															</div>
															
														</div>
														
														<div class="submit">
															
															<input type="hidden" name="ITEM" value="{$v.mobile_id}" />
															<input type="submit" value="Submit" />
															
														</div>
													
													</form>
													
													<ul class="actionlinks">
														<li><a href="{$formbase}advanced/home">Cancel</a></li>
													</ul>
													
												</div>
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