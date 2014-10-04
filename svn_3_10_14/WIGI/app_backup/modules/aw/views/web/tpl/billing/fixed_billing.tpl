
                    <!-- Fixed rate div start -->
                    <div class="tab setup fixed">
                        <strong>Set Fixed Rate Billing</strong>
                        <form action="{$formbase}billing/savefixed" method="get">

                            <div class="dtable">

                                <div class="dhead">
                                    <div class="drow">
                                        <div class="dcol summarycol2">Transaction Type</div>
                                        <div class="dcol summarycol">Transaction Code</div>
                                        <div class="dcol summarycol">Minimum</div>
                                        <div class="dcol summarycol">Default</div>
                                        <div class="dcol summarycol">Maximum</div>
                                    </div>
                                </div>
                            
                              <div class="dbody">

                                    {foreach from=$wigi_fixed_billing key=k item=v}
                                        <div class="drow">
                                            <div class="dnormal">
                                                <div class="dcol summarycol2">
                                                    <strong>{$v.desc}</strong>
                                                </div>
                                                <div class="dcol summarycol">
                                                    <strong>{$v.code}</strong>
                                                </div>
                                                <div class="dcol summarycol">
                                                    ₹<input type="text" name="{$v.code}_min" value="{$v.min}" maxlength="10" style="width:40px;"/>
                                                </div>
                                                <div class="dcol summarycol">
                                                    ₹<input type="text" name="{$v.code}_def" value="{$v.def}" maxlength="10" style="width:40px;"/>
                                                </div>
                                                <div class="dcol summarycol">
                                                    ₹<input type="text" name="{$v.code}_max" value="{$v.max}" maxlength="10" style="width:40px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}                        
                              </div>
                                <br/>
                                <div class="recrow ctr">
                                    <input class="adminBtn" type="submit" value="Save Fixed Rate Billing" />
                               </div>
                           </div>
                        </form>
                    </div> 
                    <!-- Fixed rate div end -->
