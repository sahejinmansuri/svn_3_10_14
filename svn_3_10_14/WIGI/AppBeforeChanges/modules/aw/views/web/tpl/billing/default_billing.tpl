                    <div class="tab setup billing">
                        <strong>Set Default Billing</strong>
                        <form action="{$formbase}billing/savedefaults" method="get">

                            <div class="dtable">

                                <div class="dhead">
                                    <div class="drow">
                                        <div class="dcol summarycol2">Transaction Type</div>
                                        <div class="dcol summarycol">Transaction Code</div>
                                        <div class="dcol summarycol">Charge Type</div>
                                    </div>
                                </div>
                            
                              <div class="dbody">

                                    {foreach from=$wigi_default_billing key=k item=v}
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
                                            </div>
                                        </div>
                                    {/foreach}                        
                              </div>
                                <br/>
                                <div class="recrow ctr">
                                    <input class="adminBtn" type="submit" value="Save Default Billing" />
                               </div>
                           </div>
              


                        </form>
                    </div>
