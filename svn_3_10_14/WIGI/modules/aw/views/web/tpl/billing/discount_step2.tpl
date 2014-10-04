
                    <div class="tab setup discounts" id="discounts2_block">

                        <strong>Set Special Billing</strong>
			<br/>
			{if $rec_found}
				<p id="errormsg">
					Wigi Special Billing setting found from Start date: {$rec_datefrom} to {$rec_dateto}.<br/>
					Please update the record below OR, insert a new Special Billing for Different Date Range.
				</p>
			{/if}

                            <ul class="filter">
                                <li><p>Selected Date From: <strong>{$sb_datefrom}</strong></p></li>
                                <li><p>Selected Date To: <strong>{$sb_dateto}</strong></p></li>
                             </ul>


                        <form action="{$formbase}billing/savediscount" method="get" id="usrsearch">

                            <div class="dtable">

                                <div class="dhead">
                                    <div class="drow">
                                        <div class="dcol summarycol2">Transaction Type</div>
                                        <div class="dcol summarycol3">Code</div>
                                        <div class="dcol summarycol2">Free</div>
                                        <div class="dcol summarycol2">Discount (%)</div>
                                    </div>
                                </div>
                            
                              <div class="dbody">

                                    {foreach from=$wigi_special_billing key=k item=v}
                                        <div class="drow">
                                            <div class="dnormal">
                                                <div class="dcol summarycol2">
                                                    <strong>{$v.desc}</strong>
                                                </div>
                                                <div class="dcol summarycol3">
                                                    <strong>{$v.code}</strong>
                                                </div>
                                                <div class="dcol summarycol2">
                                                     <INPUT type="radio" name="{$v.code}_free" value="Y" onClick="javascript:fn2({$v.code},'Y');" {if $v.free=='Y'}checked{/if}>Yes
                                                     <INPUT type="radio" name="{$v.code}_free" value="N" onClick="javascript:fn2({$v.code},'N');" {if $v.free=='N'}checked{/if}>No
                                                </div>
                                                <div class="dcol summarycol2">
                                                    <input type="text" id="{$v.code}_value" name="{$v.code}_value" value="{$v.value}" maxlength="2" style="width:40px;" {if $v.free=='Y'}disabled{/if}/>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}                        
                              </div>

                                <br/>
                                <input type="hidden" value="{$rec_datefrom}" name="sb_datefrom">
                                <input type="hidden" value="{$rec_dateto}" name="sb_dateto">
                                <div class="recrow ctr">
                                    <input class="adminBtn" type="submit" value="Save Special Billing" />
                               </div>
                           </div>
                        </form>

                    </div>

{literal}
<script>
document.getElementById('discounts2_block').style.display = 'block';
function fn2(id, action)
{
    var div2 = '#'+id+'_value';
    if(action == 'Y')
    {
        $(div2).val(100);
        $(div2).prop('disabled',true);
    }else
    {
        $(div2).val('');
        $(div2).prop('disabled',false);
    }
}
</script>
{/literal}