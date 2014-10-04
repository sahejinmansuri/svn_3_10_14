        <strong>Search Transactions</strong>
        <div style="background:#E4F5C8;padding:4px;">
        <form action="{$formbase}customer/txsearch" method="get" id="txsearch">
                <div class="recrow">
                        <div class="left2 b">Transaction ID:</div>
                        <div class="right2"><input type="text" name="transaction_id" /></div>
                        <div class="left2 b">Processor TX ID</div>
                        <div class="left"><input type="text" name="tprocessor_transaction_id" /></div>
                        <div style="clear:both;"></div>
                </div>
                <div class="recrow">
                        <div class="left2 b">Viewed:</div>
                        <div class="right2"><input type="text" name="tviewed" /></div>
                        <div class="left2 b">IP Addr</div>
                        <div class="left"><input type="text" name="tip_address" /></div>
                        <div style="clear:both;"></div>
                </div>
                <div class="recrow">
                        <div class="left2 b">POS Name:</div>
                        <div class="right2"><input type="text" name="tpos_name" /></div>
                        <div class="left2 b">Amount</div>
                        <div class="left"><input type="text" name="tamount" /></div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                        <div class="left2 b">From:</div>
                        <div class="right2"><input type="text" name="tfrom" /></div>
                        <div class="left2 b">From Descr</div>
                        <div class="left"><input type="text" name="tfrom_description" /></div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                        <div class="left2 b">To:</div>
                        <div class="right2"><input type="text" name="tto" /></div>
                        <div class="left2 b">To Descr</div>
                        <div class="left"><input type="text" name="tto_description" /></div>
                        <div style="clear:both;"></div>
                </div>
                <div class="recrow">
                        <div class="left2 b">Transaction Direction</div>
                        <div class="left">
                            <select name="tdirection">
                                <option value="CREDIT">CREDIT</option>
                                <option value="DEBIT">DEBIT</option>
                                <option value="INFO">INFO</option>
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div class="recrow">
                        <div class="left2 b">Transaction Type:</div>
                        <div class="right2">
                            <select name="ttype">
                                <option name="">Select</option>
                                {foreach from=$transaction_types key=k item=v}
                                    <option name="{$k}">{$v} ({$k}) </option>
                                {/foreach}
                            </select>
                        </div>
                        <div style="clear:both;"></div>
                </div>

                <div style="clear:both;"></div>
                <div class="recrow ctr">
                    <input class="adminBtn" type="submit" value="Search Transactions" />
               </div>
        </form>
        </div>