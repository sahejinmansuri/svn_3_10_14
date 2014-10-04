{include file='header.tpl'}
{include file='error.tpl'}
{literal}
<script>
function chooseOption(val)
{

    if(val=='F')
    {
        $("#sb_div").show();
        $("#sb_label").html('Enter Free Credits');
    }
    if(val=='B')
    {
        $("#sb_div").show();
        $("#sb_label").html('Enter Special Billing in Percentage');
    }
    if(val=='N')
    {
        $("#sb_div").hide();
        $("#sb_label").html('No Special Billing');
    }
}

function chooseOption2(val)
{
   if(val=='N')
    {
        $("#sb_div2").hide();
    }
   if(val=='Y')
    {
        $("#sb_div2").show();
    }

}
</script>
{/literal}

<div class="box_wide box_withsidebar">

    {include file='sidebar.tpl'}

    <div id="page">
        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                <h4>Profile settings</h4>

                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
                            <li><a href="{$formbase}customer/showdiscount?MID={$mid}">Special Billing</a></li>
                            <li><a href="{$formbase}customer/mercdetail?MID={$mid}#merchantinfo">Merchant info</a></li>
                            <li><a href="{$formbase}customer/mercdetail?MID={$mid}#moneysources">Money sources</a></li>
                            <li><a href="{$formbase}customer/mercdetail?MID={$mid}#preferences">Preferences</a></li>
                            {if true == false}<li><a href="{$formbase}customer/mercdetail?MID={$mid}#posdevices">Devices</a></li>{/if}
                            <li><a href="{$formbase}customer/mercdetail?MID={$mid}#users">POS users</a></li>
                            <li><a href="{$formbase}customer/mercdetail?MID={$mid}#billing">Billing</a></li>
                            <div style="clear:both;"></div><br/>
                            <li style="border-bottom:5px solid #82B038;"><a href="{$formbase}customer/mercdetail?MID={$mid}#transactions">Transactions</a></li>
                            <li style="border-bottom:5px solid #82B038;"><a href="{$formbase}customer/mercdetail?MID={$mid}#login_history">Login History</a></li>
                        </ul>
                    </div>

                    <div class="tab setup discounts">
                        <strong>Set Special Billing | For the month of {$month}.</strong><br/>
                        <form action="{$formbase}customer/msavediscount" method="post" id="usrsearch">

                            <br/><br/>
                            <strong>Special Billing One</strong>

                            <ul class="filter">
                                <li>
                                         <input type="radio" {if $special_billing_discount_one_code=='N'} checked {/if} onclick="javascript:chooseOption(this.value)" value="N" name="special_billing_discount_one_code">No Special Billing
                                </li>
                                <li>
                                         <input type="radio" {if $special_billing_discount_one_code=='F'} checked {/if} onclick="javascript:chooseOption(this.value)" value="F" name="special_billing_discount_one_code">Enter Free Credits
                                </li>
                                <li>
                                         <input type="radio" {if $special_billing_discount_one_code=='B'} checked {/if} onclick="javascript:chooseOption(this.value)" value="B" name="special_billing_discount_one_code">Add Special Billing
                                </li>
                            </ul>

                            <div id="sb_div" {if $spb1=='N'} style="display:none;" {/if}>
                                <ul class="filter">
                                    <li><label>
                                        <div id="sb_label">
                                        {if $special_billing_discount_one_code=='F'}Enter Free Credits{/if}
                                        {if $special_billing_discount_one_code=='B'}Enter Special Billing in Percentage{/if}
                                        </div>
                                        </label><input type="text" name="special_billing_discount_one" value={$special_billing_discount_one}></li>
                                    <input type="submit" name="submit">
                                </ul>
                            </div>
                                 <br/><br/>


                            <strong>Special Billing Two (Based on Total num of Transactions or Amount)</strong><br/>
                            <strong>Special Billing would apply to following Transactions: <br/></strong>
                                {foreach from=$special_tcodes key=k item=v}
                                    {$v.desc} ({$v.id})<br/>
                                {/foreach}
                                <br/>
                            <ul class="filter">
                                <li>
                                         <input type="radio" {if $special_billing_discount_two_code=='N'} checked {/if} onclick="javascript:chooseOption2(this.value)" value="N" name="special_billing_discount_two_code">No 
                                </li>
                                <li>
                                         <input type="radio" {if $special_billing_discount_two_code=='Y'} checked {/if} onclick="javascript:chooseOption2(this.value)" value="Y" name="special_billing_discount_two_code">Yes 
                                </li>
                            </ul>

                            <div id="sb_div2" {if $special_billing_discount_two_code=='N'} style="display:none;" {/if}>
                                <ul class="filter">
                                    <li>
                                        <label>Total Transaction Count Exceeds</label><input type="text" name="account_special_min_num_trans" value="{$account_special_min_num_trans}"> <br/><b>OR,</b> <br/><br/>
                                        <label>Total Transaction Amount Exceeds</label><input type="text" name="account_special_min_amount_trans" value="{$account_special_min_amount_trans}">
                                        <label>Special Billing Rate (%)</label><input type="text" name="special_billing_discount_two" value="{$special_billing_discount_two}">
                                    </li>
                                    <input type="submit" name="submit">
                                </ul>
                            </div>
                                <div style="border-bottom:dotted #eeeeee 1px;"></div>
                                 <br/><br/>


                            <input type="hidden" name="MID" value="{$mid}">
                            <input type="hidden" name="month" value="{$month}">
                            <input type="hidden" name="currentTotalNumTrans" value="{$currentTotalNumTrans}">
                            <input type="hidden" name="currentTotalTransAmt" value="{$currentTotalTransAmt}">
                        </form>
                    </div>




                </div>

            </div>
        </div>
    </div>

{include file='footer.tpl'}