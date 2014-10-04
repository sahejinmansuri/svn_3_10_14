<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Transactions
</h4>
<div class="dtable">
    <div class="dhead">
        <div class="drow">
            <div class="dcol" style="width:20px;">&nbsp;</div>
            <div class="dcol" style="width:70px;">Date</div>
            <div class="dcol summarycol">Type</div>
            <div class="dcol summarycol3">Amount</div>
            <div class="dcol summarycol">From Phone#</div>
            <div class="dcol" style="width:180px;">Description</div>
        </div>
    </div>
    <div class="dbody">
        {foreach from=$consumers_transaction_data item=data}
            <div class="drow drowalt">
                <div class="dnormal">
                    <div class="dcol" onClick="toggleS('{$data.transaction_id}');">
                        <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.transaction_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                    </div>
                    <div class="dcol" style="width:70px;">{date("M j, Y", strtotime($data.stamp))}</div>
                    <div class="dcol summarycol">{$data.type_desc}</div>
                    <div class="dcol summarycol3">{$data.amount}</div>
                    <div class="dcol summarycol">{$data.from_description}</div>
                    <div class="dcol" style="width:180px;">{$data.description}</div>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="{$data.transaction_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">

                    <table>
                    <tr style="background:none;">
                    <td width="95%">
                        <ul class="resultul">
                            <li><div class="width150 left">Transaction Id</div>: {$data.transaction_id} </li>
                            <li><div class="width150 left">Transaction Type Id</div>: {$data.type} </li>
                            <li><div class="width150 left">Direction</div>: {$data.direction} </li>
                            <li><div class="width150 left">Description</div>: {$data.description} </li>
                            <li><div class="width150 left">From User Desc</div>: {$data.from_user_id_description} </li>
                            <li><div class="width150 left">To User Desc</div>: {$data.to_user_id_description} </li>
                            <li><div class="width150 left">Mobile Id</div>: {$data.from} </li>
                            <li><div class="width150 left">GPS Coordinates</div>: {$data.gps} </li>
                            <li><div class="width150 left">To Description</div>: {$data.to_description} </li>
                            <li><div class="width150 left">Device Model</div>: {$data.device_model} </li>
                            <li><div class="width150 left">Balance</div>: {$data.balance} </li>
                            <li><div class="width150 left">Temp Balance</div>: {$data.temp_balance} </li>
                            <li><div class="width150 left">Wigi Code Id</div>: {$data.wigi_code_id} </li>
                            <li><div class="width150 left">Order Id</div>: {$data.order_id} </li>
                            <li><div class="width150 left">Tax</div>: {$data.tax} </li>
                            <li><div class="width150 left">Settled</div>: {$data.settled} </li>
                        </ul>
                    </td>
                    </tr>
                    </table>
            </div>
            <div style="clear:both;"></div>

        {foreachelse}
        {/foreach}

   </div>
</div>