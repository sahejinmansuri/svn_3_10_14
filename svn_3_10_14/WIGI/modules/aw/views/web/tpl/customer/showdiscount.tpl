{include file='header.tpl'}
{include file='error.tpl'}

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
                    </ul>
                </div>

                    <div class="tab setup discounts">
                        <strong>Set Special Billing | Step 1</strong>
                        <form action="{$formbase}customer/discountstep2" method="post" id="usrsearch">

                            <ul class="filter">
                                <li>
                                    <p><strong>Select a Month</strong></p>
                                    <p>
                                        <select name="month">
                                            <option value="{$curr_month} {$curr_year}">{$curr_month} {$curr_year}</option>
                                            <option value="{$month_plus1} {$curr_year}">{$month_plus1} {$curr_year}</option>
                                            <option value="{$month_plus2} {$curr_year}">{$month_plus2} {$curr_year}</option>
                                            <option value="{$month_plus3} {$curr_year}">{$month_plus3} {$curr_year}</option>
                                        </select>
                                    </p>
                                </li>

                                <li class="submit">
                                    <input type="submit" value="Select" name="">
                                </li>
                            </ul>
                            <input type="hidden" name="MID" value="{$mid}">
                        </form>
                    </div>




                </div>

            </div>
        </div>
    </div>

{include file='footer.tpl'}