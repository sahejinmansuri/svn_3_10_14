{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
    {include file='sidebar.tpl'}
    <div id="page">
        <div class="information">
            <div id="profile" class="setup usersearch">

                <h4>Search Results - Consumers</h4>

                <div class="dtable">
                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol" style="width:20px;">&nbsp;</div>
                            <div class="dcol usearch_col1">First Name</div>
                            <div class="dcol usearch_col4">Last Name</div>
                            <div class="dcol usearch_col4">City</div>
                            <div class="dcol usearch_col4">Status</div>
                        </div>
                    </div>

                    <div class="dbody">
                        {foreach from=$usrs item=data}

                            <div class="drow drowalt">
                                <div class="dnormal">
                                    <div class="dcol" onClick="toggleS('{$data.mobile_id}');">
                                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.mobile_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                                    </div>
                                    <div class="dcol usearch_col1">{$data.first_name}</div>
                                    <div class="dcol usearch_col4">{$data.last_name}</div>
                                    <div class="dcol usearch_col4">{$data.city}</div>
                                    <div class="dcol usearch_col4">{$data.status}</div>
                                </div>
                            </div>

                                <div style="clear:both;"></div>
                                <div id="{$data.mobile_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">

                                    <div class="recrow"> 
                                        <div class="left2 b">Email Address:</div>
                                        <div class="right2">{$data.email}</div>
                                    </div>
                                    <div style="clear:both;"></div>

                                    <div class="recrow"> 
                                        <div class="left2 b">Cell Phone:</div>
                                        <div class="right2">{$data.cellphone}</div>
                                    </div>
                                    <div style="clear:both;"></div>


                                    <form action="{$formbase}customer/userdetail" method="get">
                                        <input type="hidden" name="UID" value="{$data.user_id}"/>
                                        <div style="clear:both;"></div>
                                        <div class="recrow ctr">
                                            <input class="adminBtn" type="submit" value="View {$data.first_name}" />
                                        </div>
                                    </form>

                                </div>
                                <div style="clear:both;"></div>

                        {foreachelse}
                            <div class="drow">
                                <div class="dcol"><em>There are no matching users.</em></div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
            <ul class="actionlinks">
                <li><a href="{$formbase}customer/home#consumer_search">Back</a></li>
            </ul>
        </div>
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

{include file='footer.tpl'}
