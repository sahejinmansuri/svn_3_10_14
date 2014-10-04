{include file='header.tpl'}

        <div class="box_wide box_withsidebar">

                {include file='sidebar.tpl'}

                <div id="page">

                        {include file='dashboard/status.tpl'}

                        <div class="information">

                                {include file='money/error.tpl'}

                                <div id="withdraw" class="setup withdraw formlayout subformlayout">

                                        <h4>Withdraw money from your InCashMe&#8482; Merchant Account</h4>

                                        <p>You can use this feature to move funds from your InCashMe&#8482; Merchant Account to one of <a href="{$formbase}profile/home#moneysources" style="text-decoration:underline;">your pre-existing Money Sources</a>, more specifically, a Bank Account. These funds may take several days to appear in your Bank Account depending on the Bank settlement times. We charge a small fee for this transaction.</p>

                                        <form action="{$formbase}money/withdraw" method="post">

                                                <div class="stepbox">

                                                        <div class="prompt amount">
                                                                <label for="amount">Amount ₹</label>
                                                                <input type="text" id="amount" name="amount" class="formfield" maxlength="7" value="0.00" />
                                                                <p class="tip">The amount you would like to withdraw</p>
                                                        </div>

                                                        <div class="prompt account_list">
                                                                <label for="account_list">To</label>
                                                                <select id="account_list" name="account_list">
                                                                        <option value="">Choose...</option>
                                                                        {foreach from=$bank_accounts key=k item=v}
                                                                                <option value="{$v.id},{$v.type}">{$v.description}</option>
                                                                        {/foreach}
                                                                </select>
                                                                <p class="tip">Choose an account</p>
                                                        </div>

                                                </div>

                                                <div class="submit">
                                                        <input type="submit" value="Withdraw" />
                                                </div>

                                        </form>

                                        <ul class="actionlinks">
						 <li><a href="{$formbase}dashboard/home">Cancel</a></li>
                                        </ul>

                                </div>

                        </div>

                </div>

        </div>

{include file='footer.tpl'}
                                                          