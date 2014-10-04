{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
       
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}

            {if $system_message}
            <div class="attention">
                        <div class="row">
                            <p><strong>{$system_message}</strong></p>
                        </div>
            </div>
            {/if}
                        
			<div class="information">
				
				<h4>InCashMe Admin: You can Add/Edit Roles and Add/Edit Users to manage InCashMe online account.</h4>
				
				<div class="tabfield">
					
					<div class="tabnavigation">
						<ul>
							<li><a href="#home">Admin Home</a></li>
							<li><a href="#adduser">Add User</a></li>
							<li><a href="#edituser">Edit User</a></li>
							<li><a href="#addrole">Add Role</a></li>
							<li><a href="#editrole">Edit A Role</a></li>
						</ul>
					</div>

					<div class="tab setup home">
						<h4>User Details</h4>
						{include file='admin/home_data.tpl'}
					</div>

					<div class="tab setup adduser">
						<h4>Add User</h4>
						{include file='admin/add_user.tpl'}
					</div>
					
					<div class="tab setup edituser">
						<h4>Edit User</h4>
						{include file='admin/view_users.tpl'}
					</div>

					<div class="tab setup addrole">
						<h4>Add Role</h4>
						{include file='admin/add_role.tpl'}
					</div>

					<div class="tab setup editrole">
						<h4>Edit A Role</h4>
						{include file='admin/view_roles.tpl'}
					</div>					
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}