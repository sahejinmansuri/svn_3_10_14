<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;501(c)(3) (Nonprofit) Approval
</h4>

    <div class="dtable">
        <div class="dhead">
            <div class="drow">
                <div class="dcol" style="width:20px;">&nbsp;</div>
                <div class="dcol" style="width:200px;">Nonprofit Name</div>
                <div class="dcol summarycol3">FEIN</div>
                <div class="dcol txsearch_col5">501 Reg Number</div>
                <div class="dcol txsearch_col5">Business phone</div>
            </div>
        </div>
        <div class="dbody">
            {foreach from=$unapproved_user item=data}
                <div class="drow drowalt">
                    <div class="dnormal">
                        <div class="dcol" onClick="toggleS('{$data.user_id}');">
                            <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.user_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                        </div>
                        <div class="dcol" style="width:200px;">{$data.name}</div>
                        <div class="dcol summarycol3">{$data.tax_id}</div>
                        <div class="dcol txsearch_col5">{$data.f501c}</div>
                        <div class="dcol txsearch_col5">{$data.business_phone}</div>
                    </div>
                </div>
                <div style="clear:both;"></div>
                <div id="{$data.user_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">

                    <div class="recrow"> 
                        <div class="left2 b">Contact:</div>
                        <div class="right2">{$data.first_name} {$data.last_name}</div>
                    </div>
                    <div style="clear:both;"></div>

                    <div class="recrow"> 
                        <div class="left2 b">Address:</div>
                        <div class="right2">
                            {if $data.addr_line1}{$data.addr_line1} <br/>{/if}
                            {if $data.addr_line2}{$data.addr_line2} <br/>{/if}
                            {$data.city}, {$data.state} {$data.zip}
                        </div>
                    </div>
                    <div style="clear:both;"></div>


                    <form action="{$formbase}customer/approvenonprofit" method="get" id="apprv501c">
                        <input type="hidden" name="UID" value="{$data.user_id}" />
                        <div style="clear:both;"></div>
                        <div class="recrow ctr">
                            <input class="adminBtn" type="submit" value="Check Approval" />
                        </div>
                    </form>

                </div>
                <div style="clear:both;"></div>

            {foreachelse}
                        <div class="recrow"> 
                            There are no pending approvals.
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