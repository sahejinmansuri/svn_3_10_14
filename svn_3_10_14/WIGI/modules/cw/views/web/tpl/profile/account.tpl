{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Account</li>
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
                <h1>Account</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			<ul class="shortcuts">
                            <li class="events">
                                <a href="{$formbase}profile/home">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label">Profile</span>
                                </a>
                            </li>
                            <li class="products">
                                <a href="{$formbase}advanced/message">
                                    <span class="shortcuts-icon iconsi-cart"></span>
                                    <span class="shortcuts-label">Messages</span>
                                </a>
                            </li>
                            <li class="archive">
                                <a href="{$formbase}advanced/documents">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label">Documents</span>
                                </a>
                            </li>
							<li class="help">
                                <a href="{$formbase}statement/home">
                                    <span class="shortcuts-icon iconsi-help"></span>
                                    <span class="shortcuts-label">Statement</span>
                                </a>
                            </li>
                            <li class="help">
                                <a href="{$formbase}history/home">
                                    <span class="shortcuts-icon iconsi-help"></span>
                                    <span class="shortcuts-label">Hisrtory</span>
                                </a>
                            </li>
							<li class="help">
                                <a href="{$formbase}advanced/movefund">
                                    <span class="shortcuts-icon iconsi-help"></span>
                                    <span class="shortcuts-label">Move Funds</span>
                                </a>
                            </li>
                        </ul>
			<div class="information">
				
			
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}