<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Search Merchants
</h4>

        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}customer/mercsearch" method="get" id="txsearch">

                <div class="recrow">
                        <div class="left2 b" style="width:150px;">Merchant Status</div>
                        <div class="left">
                            <select name="status" style="width:100px;">
                                <option value="">Select</option>
                                <option value="active">Active</option>
                                <option value="deleted">Deleted</option>
                                <option value="inactive">Inactive</option>
                                <option value="locked">Locked</option>
                                <option value="pending">Pending</option>
                                <option value="suspended">Suspended</option>
                                <option value="readonly">Readonly</option>
                                <option value="unconfirmed">Unconfirmed</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                {include file='shared/dynamic_search_filters.tpl'}


                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="Search Merchants" />
               </div>
        </form>
        </div>
