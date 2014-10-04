<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Search Transactions
</h4>
        <strong>Search </strong>
        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}customer/txsearch" method="post" id="txsearch">

                <div class="recrow">
                        <div class="left2 b" style="width:150px;">Transaction Direction</div>
                        <div class="left">
                            <select name="direction" style="width:100px;">
                                <option value="">Select</option>
                                <option value="CREDIT">CREDIT</option>
                                <option value="DEBIT">DEBIT</option>
                                <option value="INFO">INFO</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                        <div class="left2 b" style="width:150px;">Transaction Type:</div>
                        <div class="right2">
                            <select name="type">
                                <option value="">Select</option>
                                {foreach from=$transaction_types key=k item=v}
                                    <option value="{$k}">{$v} ({$k}) </option>
                                {/foreach}
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                {include file='shared/dynamic_search_filters.tpl'}


                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="Search Transactions" />
               </div>
        </form>
        </div>