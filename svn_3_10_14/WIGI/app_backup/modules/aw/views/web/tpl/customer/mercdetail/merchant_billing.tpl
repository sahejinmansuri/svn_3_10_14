                    <!-- User Billing div start -->
    <div class="tab setup billing">
    <h4>
    <span class="icons2">
        <span class="ui-state-default2 bgrey ui-corner-all">
            <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
        </span>
    </span>&nbsp;Merchant Billing
    </h4>
    <form action="{$formbase}customer/msavebilling" method="get">

        <div class="dtable">

            <div class="dhead">
                <div class="drow">
                    <div class="dcol summarycol2">Transaction Type</div>
                    <div class="dcol summarycol">Transaction Code</div>
                    <div class="dcol summarycol">Charge Type</div>
                    <div class="dcol summarycol">Value</div>
                </div>
            </div>
        
          <div class="dbody">

                {foreach from=$wigi_merchant_billing key=k item=v}
                    <div class="drow">
                        <div class="dnormal">
                            <div class="dcol summarycol2">
                                <strong>{$v.desc}</strong>
                            </div>
                            <div class="dcol summarycol">
                                <strong>{$v.code}</strong>
                            </div>
                            <div class="dcol summarycol2">
                                 <INPUT type="radio" name="{$v.code}_type" value="F" {if $v.type == 'F'}checked{/if}>Fixed
                                 <INPUT type="radio" name="{$v.code}_type" value="P" {if $v.type == 'P'}checked{/if}>Percentage
                            </div>
                            <div class="dcol summarycol">
                                ₹<input type="text" name="{$v.code}_value" value="{$v.value}" maxlength="10" style="width:40px;"/>
                            </div>
                        </div>
                    </div>
                {/foreach}                        
          </div>
            <br/>
            <div class="recrow ctr">
                <input class="adminBtn" type="submit" name="" value="Save Billing" />
            </div>
       </div>
       <input type="hidden" name="MID" value="{$mid}">
    </form>
</div> 
<!-- User Billing div end -->
