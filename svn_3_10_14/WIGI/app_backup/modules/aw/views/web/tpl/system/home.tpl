{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
            
            {if $system_message}
                <div class="attention">
                    <h4><b>{$system_message}</b></h4>
                </div>
            {/if}
            
			<div class="information">
                <div id="profile" class="setup profile columnlayout">
                        <div class="tabfield">
                                <div class="tabnavigation">
                                    <ul>
                                        <li><a href="#clear_cache">Clear Zend Cache</a></li>
                                        <li><a href="#maintainence">Add Maintainence</a></li>
                                        <li><a href="#viewmaintainence">View Maintainence</a></li>
                                        <li><a href="#dbbackup">Add DB Backup</a></li>
                                        <li><a href="#viewdbbackup">View DB Backups</a></li>
                                    </ul>
                                </div>

                                <div class="tab setup clear_cache">
                                    <h4>Clear Zend Cache</h4>
                                    <ul class="actionlinks">
                                        <li><a href="{$formbase}system/clearzendcache">Clear Zend cache</a></li>
                                    <!--<li><a href="{$formbase}system/clearsvnfiles">Clear SVN files</a></li> -->
                                    </ul>
                                </div>

                                <div class="tab setup maintainence">
                                    <h4>Scheduled Maintainence</h4>
                                    {include file='system/system_maintainence.tpl'}
                                </div>

                                <div class="tab setup viewmaintainence">
                                    <h4>View Maintainence</h4>
                                    {include file='system/view_system_maintainence.tpl'}
                                </div>

                                <div class="tab setup dbbackup">
                                    <h4>Database Backup</h4>
                                    {include file='system/db_backup.tpl'}
                                </div>

                                <div class="tab setup viewdbbackup">
                                    <h4>View Database Backup</h4>
                                    {include file='system/view_db_backup.tpl'}
                                </div>

                        </div>
               
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
