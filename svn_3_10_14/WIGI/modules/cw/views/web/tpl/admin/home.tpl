{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
	<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Admin</li>
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
                <h1>Admin</h1>
            </div>
        </div>
		</div>
	<div class="box_wide box_withsidebar">
		<div id="page">	

        <div class="information">
            <div id="profile" class="setup profile columnlayout">
               <!-- <h4>Admin</h4>-->
				
				<div class="tabbedwidget tab-info">
               
                            <div class="tabnavigation">
                                <ul>
                                    <li><a href="#addrole">Add Role</a></li>
                                    <li><a href="#editrole">Edit A Role</a></li>
                                </ul>
								
								
                            </div>

                            <div class="tab setup addrole" id="addrole">
                                <h4>Add Role</h4>
                                {include file='admin/addrole.tpl'}
                            </div>

                            <div class="tab setup editrole" id="editrole">
                                {include file='admin/viewroles.tpl'}
                            </div>					

                                      
                                    </div>
            </div>
				</div>
                                    </div>
                                </div>
{include file='footer.tpl'}
