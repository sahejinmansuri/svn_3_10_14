{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
    {include file='sidebar.tpl'}
    <div id="page">
        <div class="information">
            <div id="profile" class="setup usersearch">

                <h4>Customer Support - Search Results</h4>
                <div class="dtable">
                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol usearch_col1">Business Name</div>
                            <div class="dcol usearch_col2">Status</div>
                            <!--<div class="dcol usearch_col3">First Name</div>
                            <div class="dcol usearch_col4">Last Name</div>-->
                            <div class="dcol usearch_col7">City</div>
                            <div class="dcol usearch_col1">Business Phone</div>
                            <div class="dcol usearch_col8">View Details</div>
                        </div>
                    </div>
                    <div class="dbody" >
                        {foreach from=$mercs item=cur_merc name=merc_loop}
                            <div class="drow{if $smarty.foreach.merc_loop.index%2} drowalt{/if}">
                                <div class="dnormal">
                                    <div class="dcol usearch_col1">{$cur_merc["name"]}</div>
                                    <div class="dcol usearch_col2">{$cur_merc["status"]}</div>
                                    <!--<div class="dcol usearch_col4">{$cur_merc["first_name"]}</div>
                                    <div class="dcol usearch_col5">{$cur_merc["last_name"]}</div>-->
                                    <div class="dcol usearch_col7">{$cur_merc["city"]}</div>
                                    <div class="dcol usearch_col1">{$cur_merc["business_phone"]}</div>
                                    <div class="dcol usearch_col8">
                                        <form action="{$formbase}customer/mercdetail" method="get" id="mercdetail">
                                            <input type="hidden" name="MID" value="{$cur_merc['user_id']}"/>
                                            <div class="recrow ctr">
                                                <input class="adminBtn" type="submit" value="View" />
                                           </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {foreachelse}
                            <div class="drow">
                                <div class="dcol"><em>There are no matching users.</em></div>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
                <div class="recrow ctr">
                    <a class="adminBtn" style="color:white;" href="{$formbase}customer/home#merchants_search">Back</a>
               </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
