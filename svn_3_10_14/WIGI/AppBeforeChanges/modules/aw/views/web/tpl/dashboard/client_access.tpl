                <div class="dtable">
                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol summarycol">Module Name</div>
                            <div class="dcol summarycol">IP Address</div>
                            <div class="dcol summarycol">Count</div>
                        </div>
                    </div>
                    <div class="dbody">
                        {foreach from=$stat_results item=cur_res name=ip_stat_loop}
                            {foreach from=$cur_res key=k item=cur_res name=local_stat_loop}
                                <div class="drow{if $smarty.foreach.local_stat_loop.index%2} drowalt{/if}">
                                    <div class="dnormal">
                                        <div class="dcol summarycol">{$cur_res['label']}</div>
                                        <div class="dcol summarycol">{$k} test</div>
                                        <div class="dcol summarycol">{$item}</div>
                                    </div>
                                </div>
                            {/foreach}
                        {/foreach}
                    </div>
                </div>
