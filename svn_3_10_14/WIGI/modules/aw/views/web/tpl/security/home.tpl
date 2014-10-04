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
                            {if $SECURITY_ADMIN_USERS}<li><a href="#adminusers">Admin Users</a></li>{/if}
                            {if $SECURITY_ADMIN_ROLES}<li><a href="#adminroles">Admin Roles</a></li>{/if}
                            {if $SECURITY_ADMIN_PERMISSIONS}<li><a href="#adminpermissions">Admin Permissions</a></li>{/if}
                            {if $SECURITY_ADMIN_VIEWS}<li><a href="#adminviews">Admin Views</a></li>{/if}
                            {if $SECURITY_NATE_PERMISSION}<li><a href="#adminviews">Nate Permission</a></li>{/if}
                        </ul>
                    </div>

                    {if $SECURITY_ADMIN_USERS}
		    <div class="tab setup adminusers">
                        <strong>Admin Users</strong>
                        <div class="dtable">
                            <div class="dhead">
                                <div class="drow">
                                    <div class="dcol summarycol">Login ID</div>
                                    <div class="dcol summarycol">First Name</div>
                                    <div class="dcol summarycol">Last Name</div>
                                    <div class="dcol summarycol">Status</div>
                                    <div class="dcol summarycol">Email Address</div>
                                    <div class="dcol summarycol">Creation Date</div>
                                    <div class="dcol summarycol">Last Modified</div>
                                </div>
                            </div>
                            <div class="dbody">
                                {foreach from=$adminusers item=cur_admin name=admin_loop}
                                    <div class="drow{if $smarty.foreach.txs_loop.index%2} drowalt{/if}">
                                        <div class="dnormal">
                                            <div class="dcol summarycol">{$cur_admin->getLoginId()}</div>
                                            <div class="dcol summarycol">{$cur_admin->getFirstName()}</div>
                                            <div class="dcol summarycol">{$cur_admin->getLastName()}</div>
                                            <div class="dcol summarycol">{$cur_admin->IsDisabled()}</div>
                                            <div class="dcol summarycol">{$cur_admin->getEmailAddress()}</div>
                                            <div class="dcol summarycol">{$cur_admin->getDateAdded()}</div>
                                            <div class="dcol summarycol">{$cur_admin->getDateModified()}</div>
                                        </div>
                                    </div>
                                    {foreachelse}
                                        <div class="drow">
                                            <div class="dcol"><em>There are no matching users.</em></div>
                                        </div>
                                        {/foreach}
                                            <form action="{$formbase}security/createadmin" method="get" id="add_admin">
                                                <input value="First Name" type="text" name="fname"></input>
                                                <input value="Last Name" type="text" name="lname"></input>
                                                <input value="email@address.net" type="text" name="email"></input>
                                                <input value="password" type="text" name="passwd"></input>
                                                <input type="submit" name="submit" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
				{/if}

                                <!--END admin users -->

				{if $SECURITY_ADMIN_ROLES}
                                <div class="tab setup adminroles">
                                    <strong>Admin Roles</strong>
                                    <div class="dtable">
                                        <div class="dhead">
                                            <div class="drow">
                                                <div class="dcol summarycol">Role ID</div>
                                                <div class="dcol summarycol">Role Name</div>
                                                <div class="dcol summarycol">Description</div>
                                                <div class="dcol summarycol">Status</div>
                                                <div class="dcol summarycol">Creation Date</div>
                                                <div class="dcol summarycol">Last Modified</div>
                                            </div>
                                        </div>
                                        <div class="dbody">
                                            {foreach from=$adminroles item=cur_role name=role_loop}
                                                <div class="drow{if $smarty.foreach.txs_loop.index%2} drowalt{/if}">
                                                    <div class="dnormal">
                                                        <div class="dcol summarycol">{$cur_role->getRoleId()}</div>
                                                        <div class="dcol summarycol">{$cur_role->getRoleName()}</div>
                                                        <div class="dcol summarycol">{$cur_role->getRoleDescription()}</div>
                                                        <div class="dcol summarycol">{$cur_role->IsDisabled()}</div>
                                                        <div class="dcol summarycol">{$cur_role->getDateAdded()}</div>
                                                        <div class="dcol summarycol">{$cur_role->getDateModified()}</div>
                                                    </div>
                                                </div>
                                                {foreachelse}
                                                    <div class="drow">
                                                        <div class="dcol"><em>There are no matching roles.</em></div>
                                                    </div>
                                                    {/foreach}
                                                        <form action="{$formbase}security/createrole" method="get" id="add_role">
                                                            <input value="Role Name" type="text" name="rname"></input>
                                                            <input value="Role Description" type="text" name="desc"></input>
                                                            <input type="submit" name="submit" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> <!--END admin adminroles -->
					    {/if}

                                            {if $SECURITY_ADMIN_PERMISSIONS}
						    <div class="tab setup adminpermissions">
							<strong>Admin Permissions</strong>
						    </div>
                                            <!--END admin adminpermissions -->
					    {/if}

                                            {if $SECURITY_ADMIN_VIEWS}
						    <div class="tab setup adminviews">
							<strong>Admin Views</strong>
						    </div>
                                            <!--END admin adminviews -->
					    {/if}

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
