                        <strong>Admin InCashMe&trade; Users</strong>

                        <div class="dtable">
                        <strong>Existing Users:</strong>
                            
                            <div class="dhead">
                                <div class="drow">
                                    <div class="dcol">&nbsp;&nbsp;</div>
                                    <div class="dcol width150">Name</div>
                                    <div class="dcol width80">Status</div>
                                    <!--<div class="dcol width80">Admin</div>-->
                                    <div class="dcol width200">Email</div>
                                    <div class="dcol width80">Role</div>
                                </div>
                            </div>

                                <div class="dbody">
                                {foreach from=$existing_users item=data}
                                    <div class="drow drowalt">
                                        <div class="dnormal">

                                            <div class="dcol" onClick="toggleS('{$data.users_id}');">
                                                <span class="icons2" {if $data.admin}style="visibility:hidden;"{/if}><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.users_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                                            </div>
                                            <div class="dcol width150">{$data.first_name}&nbsp;{$data.last_name}</div>
                                            <div class="dcol width80">
                                                {if $data.status == 'A'}Active{/if}
                                                {if $data.status == 'I'}Deleted{/if}
                                                {if $data.status == 'P'}Pending{/if}
                                                {if $data.status == 'L'}Locked{/if}
                                            </div>
                                            <!--<div class="dcol width80">{if $data.admin}<strong>Yes</strong>{else}No{/if}</div>-->
                                            <div class="dcol width200">{$data.email}</div>
                                            <div class="dcol width80">{if $data.admin}<strong>Yes</strong>{else}{$data.role}{/if}</div>
                                        </div>
                                    </div>

                                    {if !$data.admin}
                                        <div id="{$data.users_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                                            <form action="{$formbase}admin/edituser" method="post">
                                                <div class="recrow">
                                                        <div class="left2 b">Current Status:</div>
                                                        <div class="right2">
                                                            {if $data.status == 'A'}Active{/if}
                                                            {if $data.status == 'I'}Deleted{/if}
                                                            {if $data.status == 'P'}Pending{/if}
                                                            {if $data.status == 'L'}Locked{/if}
                                                        </div>
                                                        <div class="left2 b">
                                                                {if $data.status=='A'} Delete {/if}
                                                                {if $data.status=='I'} Activate{/if}
                                                        </div>
                                                        <div class="left2 ht2">
                                                                {if $data.status=='A'} <input type="checkbox" name="action_user" value="I"> {/if}
                                                                {if $data.status=='I'} <input type="checkbox" name="action_user" value="A"> {/if}
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="recrow">
                                                        <div class="left2 b">Current Role:</div>
                                                        <div class="right2">{$data.role}</div>
                                                        <div class="left2 b">Change Role:</div>
                                                        <div class="left2 ht2">
                                                                <select name="role">
                                                                <option value="" selected="selected">Select</option>
                                                                {foreach from=$existing_roles item=data2}
                                                                    <option value="{$data2.rolename}">{$data2.rolename}</option>
                                                                {/foreach}
                                                                </select>
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="recrow ctr">
                                                    <a class="adminBtn" style="color:white;" onClick="toggle_pwd({$data.users_id})">Change Pwd</a>
                                                    <input class="adminBtn" type="submit" value="Update User" />
                                               </div>
                                                <input type="hidden" name="users_id" value="{$data.users_id}">
                                                </form>

                                            <form action="{$formbase}admin/changeuserpwd" method="post">
                                                <div class="recrow" id="pwd_{$data.users_id}" style="display:none;">
                                                        <div class="left2 b"  style="width:80px;">Enter Pwd:</div>
                                                        <div class="right2"  style="width:110px;"><input type="password" name="passwd" style="width:90px;"></div>
                                                        <div class="left2 b"  style="width:100px;">Re-enter Pwd:</div>
                                                        <div class="right2"  style="width:110px;"><input type="password" name="passwd2" style="width:90px;"></div>
                                                        <div class="right2"  style="width:110px;">
                                                            <input class="adminBtn" type="submit" value="Change Pwd Now" />
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <input type="hidden" name="users_id" value="{$data.users_id}">
                                                <input type="hidden" name="email" value="{$data.email}">
                                                <input type="hidden" name="fname" value="{$data.first_name}">
                                            </form>

                                        
                                        </div>
                                    {/if}
        

                                {/foreach}
                                </div>
                           </div>

{literal}
<script>
function toggleS(div)
{
$('#'+div).toggle();
$('#c_'+div).toggleClass('ui-icon-minus');
}

function toggle_pwd(userid)
{
$('#pwd_'+userid).toggle();
}
</script>
{/literal}