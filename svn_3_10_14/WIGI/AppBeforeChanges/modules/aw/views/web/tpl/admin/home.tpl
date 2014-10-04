{include file='header.tpl'}
{include file='error.tpl'}

<div class="box_wide box_withsidebar">

    {include file='sidebar.tpl'}

    <div id="page">

        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                <h4>Security</h4>
                <div class="tabfield">
                            <div class="tabnavigation">
                                <ul>
                                    <li><a href="#adminusers">View Users</a></li>
                                    <li><a href="#adduser">Add User</a></li>
                                    <li><a href="#addrole">Add Role</a></li>
                                    <li><a href="#editrole">Edit A Role</a></li>
                                </ul>
                            </div>

                            <div class="tab setup adminusers">
                                {include file='admin/admin_users.tpl'}
                            </div>

                            <div class="tab setup adduser">
                                <h4>Add User</h4>
                                {include file='admin/add_user.tpl'}
                            </div>

                            <div class="tab setup edituser">
                                <h4>Edit User</h4>
                            </div>

                            <div class="tab setup addrole">
                                <h4>Add Role</h4>
                                {include file='admin/add_role.tpl'}
                            </div>

                            <div class="tab setup editrole">
                                {include file='admin/view_roles.tpl'}
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
</div>

{include file='footer.tpl'}
