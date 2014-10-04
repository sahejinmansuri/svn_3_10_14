    <h4>Devices</h4>

    <p>You can add to your InCashMe&#8482; Merchant Account up to ten (10) devices. These devices need a Data plan (WiFi or Cellular) and ideally, SMS/TXT capabilities.</p>

    <div class="dtable">
        <div class="dhead">
            <div class="drow">
                <div class="dcol col1">ID</div>
                <div class="dcol col2">Display name</div>
                <div class="dcol col3">Serial number</div>
                <div class="dcol col4">Status</div>
            </div>
        </div>
        <div class="dbody">
            {foreach from=$cellphones item=v name=cellphones_loop}
                <div id="{$v.mobile_id}" class="drow{if $smarty.foreach.cellphones_loop.index%2} drowalt{/if}">
                    <div class="dnormal">
                        <div class="dcol col1">
                            {if $v.phone_brand == "iPhone"}
                                <img src="{$csspath}/images/deviceiphone.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
                            {elseif $v.phone_brand == "Android"}
                                <img src="{$csspath}/images/deviceandroid.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
                            {else}
                                <img src="{$csspath}/images/deviceunknown.png" alt="{$ccountry}{$v.cellphone}" style="width:30px;" />
                            {/if}
                        </div>
                        <div class="dcol col2">
                            <strong>{$v.alias}</strong>
                        </div>
                        <div class="dcol col3">
                            {$v.cellphone}
                        </div>
                        <div class="dcol col4">
                        {$v.status}{if $v.is_default != 0}/default{/if}
                    </div>
                </div>
                <div class="dextend">
                    <div class="expandarrow"></div>
                    <div class="expandtype transactionbox">
                        <div>
                            <div style="float:left;width:60px;">
                                {if $v.phone_brand == "iPhone"}
                                    <img src="{$csspath}/images/deviceiphone.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
                                {elseif $v.phone_brand == "Android"}
                                    <img src="{$csspath}/images/deviceandroid.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
                                {else}
                                    <img src="{$csspath}/images/deviceunknown.png" alt="{$ccountry}{$v.cellphone}" style="width:60px;" />
                                {/if}
                            </div>
                            <div style="float:left;">
                                <div style="font-size:18px;font-weight:bold;margin:0;padding:8px 0 2px;">{if $v.alias != null}{$v.alias}{else}{$ccountry}{$v.cellphone}{/if}</div>
                                <div style="padding:0 0 10px;overflow:hidden;width:530px;">
                                    <ul class="rowactions">
                                        {if true == false and $v.is_default == 0 and $v.status == "active"}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/setdefaultcell/ITEM/{$v.mobile_id}">Set default</a></li>
                                        {/if}
                                        {if $v.is_default == 0 and $v.status == "active"}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcell/ITEM/{$v.mobile_id}">Edit name</a></li>
                                        {/if}
                                        {if true == false}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/editcellprefs/ITEM/{$v.mobile_id}">Device preferences</a></li>
                                        {/if}
                                        {if $v.status == "active"}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/lockcell/ITEM/{$v.mobile_id}">Lock</a></li>
                                        {elseif $v.status == "locked"}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/unlockcell/ITEM/{$v.mobile_id}">Unlock</a></li>
                                        {/if}
                                        {if $v.is_default == 0}
                                            <li style="margin:0 2px 0 0;"><a href="{$formbase}profile/deletecell/ITEM/{$v.mobile_id}">Delete</a></li>
                                        {/if}
                                    </ul>
                                </div>
                                <div style="overflow:hidden;">
                                    <div style="float:left;overflow:hidden;width:240px;">
                                        <div>
                                            <p><strong>Info</strong></p>
                                            <ul>
                                                <li>Status: {$v.status}</li>
                                                <li>Serial number: {$v.cellphone}</li>
                                                <li>Last user: {if $v.last_user == null}N/A{else}{$v.last_user}{/if}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="float:left;overflow:hidden;width:260px;">
                                        <div>
                                            <p><strong>More</strong></p>
                                            <ul>
                                                <li>Device: {if $v.phone_brand != null}{$v.phone_brand}{else}N/A{/if}</li>
                                                <li>Date added: {date("M j, Y", strtotime($v.date_added))}</li>
                                                <li>OS version: {if $v.os_version != null}{$v.os_version}{else}N/A{/if}</li>
                                                <li>App version: {if $v.app_version != null}{$v.app_version}{else}N/A{/if}</li>
                                                <li>Last login: {date("M j, Y", strtotime($v.last_login))}</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <p><strong>Device preferences</strong></p>
                                            <ul>
                                                <li>Sales tax: {$cellpreferences[$v.mobile_id]["salestax"]}</li>
                                                <li>Tips: ₹{$cellpreferences[$v.mobile_id]["tips"]}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {foreachelse}
                <div class="drow">
                    <div class="dcol"><em>There are no devices associated with your account.</em></div>
                </div>
                {/foreach}
                </div>
            </div>
