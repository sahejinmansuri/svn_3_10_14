<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Merchant Special Billing
</h4>

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