                        <strong>Admin InCashMe&trade; Users</strong>

                        {include file='admin/search_users.tpl'}

                        <div class="dtable">
                        <strong>Existing Admin InCashMe&trade; Users:</strong>
                            
                            <div class="dhead">
                                <div class="drow">
                                    <div class="dcol">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                    <div class="dcol summarycol2">Login ID</div>
                                    <div class="dcol summarycol">First Name</div>
                                    <div class="dcol summarycol">Last Name</div>
                                    <div class="dcol summarycol3">Active</div>
                                    <div class="dcol summarycol3">Admin</div>
                                </div>
                            </div>

                                <div class="dbody">
                                {foreach from=$adminusers item=data}
                                    <div class="drow drowalt">
                                        <div class="dnormal">
                                            <div class="dcol" onClick="toggleS('{$data.adminuser_id}');">
											<span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.adminuser_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
<!--{if $data.admin}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/if}
                                                {if !$data.admin}--><!--{/if}-->
                                            </div>
                                            <div class="dcol summarycol2">{$data.login_id}</div>
                                            <div class="dcol summarycol">{$data.first_name}</div>
                                            <div class="dcol summarycol">{$data.last_name}</div>
                                            <div class="dcol summarycol3">{if $data.suspended} No {else} Yes {/if}</div>
                                            <div class="dcol summarycol3">{if $data.admin} Yes {else} No {/if}</div>
                                        </div>
                                    </div>

                                    <!--{if !$data.admin}
                                    {/if}      -->
                                        <div id="{$data.adminuser_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                                            <form action="{$formbase}admin/edituser" method="post">
                                                <div class="recrow"> <div class="left2 b">{$data.login_id}</div> </div>
                                                <div style="clear:both;"></div>
                                                <div class="recrow">
                                                        <div class="left2 b">Current Status:</div>
                                                        <div class="right2">{if $data.suspended} Suspended {else} Active {/if}</div>
                                                        <div class="left2 b">{if $data.suspended} Make Active {else} Suspend User {/if}</div>
                                                        <div class="left2 ht2">
                                                            <input type="radio" name="suspend_user" value="Y">Yes
                                                            <input type="radio" name="suspend_user" value="N">No
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="recrow">
                                                        <div class="left2 b">Current Role:</div>
                                                        <div class="right2">{$data.permissions}</div>
                                                        <div class="left2 b">Change Role:</div>
                                                        <div class="left2 ht2">
                                                            <select name="rolename">
                                                            <option value="" selected="selected">Select</option>
                                                            {foreach from=$existing_roles item=data2}
                                                            <option value="{$data2.rolename}">{$data2.rolename}</option>
                                                            {/foreach}
                                                            </select>
                                                        </div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="recrow ctr">
                                                    <input class="adminBtn" type="submit" value="Update User: {$data.login_id}" />
                                               </div>
                                                <input type="hidden" name="adminuser_id" value="{$data.adminuser_id}">
                                            </form>
                                        </div>  

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
</script>
{/literal}