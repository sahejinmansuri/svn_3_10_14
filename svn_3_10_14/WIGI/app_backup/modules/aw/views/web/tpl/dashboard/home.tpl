{include file='header.tpl'}
{include file='error.tpl'}

<div class="box_wide box_withsidebar">

    {include file='sidebar.tpl'}

    <div id="page">

        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                                <div class="tabfield">
                                            <div class="tabnavigation">
                                                <ul>
                                                    <li><a href="#finance_dashboard">Finance Dashboard</a></li>
                                                    <li><a href="#user_summary">New Users Summary</a></li>
                                                    <li><a href="#trans_summary">New Transaction Summary</a></li>
                                                    <li><a href="#system_performance">System Performance</a></li>
                                                    <!--<li><a href="#client_access">Client Access</a></li>-->
                                                </ul>
                                            </div>

                                            <div class="tab setup finance_dashboard">
                                                <h4>Finance Dashboard</h4>
                                                {include file='dashboard/finance_dashboard.tpl'}
                                            </div>

                                            <div class="tab setup user_summary">
                                                <h4>User Summary</h4>
                                                {include file='dashboard/user_summary.tpl'}
                                            </div>

                                            <div class="tab setup trans_summary">
                                                <h4>Transaction Summary</h4>
                                                {include file='dashboard/trans_summary.tpl'}
                                            </div>

                                            <div class="tab setup system_performance">
                                                <h4>System Performance Statistics</h4>
                                                {include file='dashboard/system_performance.tpl'}
                                            </div>

                                            <!--<div class="tab setup client_access">
                                                <h4>Client Access Statistics</h4>
                                                {include file='dashboard/client_access.tpl'}
                                            </div>-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div> 
    </div>
</div>

{include file='footer.tpl'}
