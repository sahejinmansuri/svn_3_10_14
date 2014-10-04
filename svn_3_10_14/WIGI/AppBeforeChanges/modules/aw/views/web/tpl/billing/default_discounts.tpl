
                    <div class="tab setup discounts">

                        <strong>Set Discount Details</strong>
                        <form action="{$formbase}billing/savediscount" method="get" id="usrsearch">

                            <ul class="filter">
                                <li>
                                    <p><strong>Select a Month</strong></p>
                                    <ul class="withlabels">
                                        <select name="M">
                                            <option value="" selected="selected">All</option>
                                            <option value="01">January</option>
                                            <option value="02">Febuary</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </ul>
                                </li>

                                <li class="submit">
                                    <input type="submit" value="Update" name="">
                                </li>
                            </ul>
                            
                        <br/>

                            <div class="dtable">

                                <div class="dhead">
                                    <div class="drow">
                                        <div class="dcol summarycol2">Transaction Type</div>
                                        <div class="dcol summarycol3">Code</div>
                                        <div class="dcol summarycol">Free</div>
                                        <div class="dcol summarycol2">Discount Type</div>
                                        <div class="dcol summarycol3">Value</div>
                                    </div>
                                </div>
                            
                              <div class="dbody">

                                    {foreach from=$typelist key=k item=v}
                                        <div class="drow">
                                            <div class="dnormal">
                                                <div class="dcol summarycol2">
                                                    <strong>{$v}</strong>
                                                </div>
                                                <div class="dcol summarycol3">
                                                    <strong>{$k}</strong>
                                                </div>
                                                <div class="dcol summarycol">
                                                     <INPUT type="radio" name="{$k}_free" value="Y">Yes
                                                     <INPUT type="radio" name="{$k}_free" value="N">No
                                                </div>
                                                <div class="dcol summarycol2">
                                                     <INPUT type="radio" name="{$k}_rb" value="F">Fixed
                                                     <INPUT type="radio" name="{$k}_rb" value="P">Percentage
                                                </div>
                                                <div class="dcol summarycol3">
                                                    <input type="text" name="{$k}_value" value="" maxlength="10" style="width:40px;"/>
                                                </div>
                                            </div>
                                        </div>
                                    {/foreach}                        
                              </div>

                                <br/>
								<div class="submit">
									<input type="submit" name="" value="Save Discount" />
								</div>

                           </div>
                        </form>

                    </div>

