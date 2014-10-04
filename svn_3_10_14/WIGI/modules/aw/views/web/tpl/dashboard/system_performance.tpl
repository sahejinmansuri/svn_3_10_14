                <div class="dtable">
                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol summarycol">Module Name</div>
                            <div class="dcol summarycol">Total Requests</div>
                            <div class="dcol summarycol">Average Request Time</div>
                            <div class="dcol summarycol">Longest Request Time</div>
                            <div class="dcol summarycol">Longest Event Time</div>
                        </div>
                    </div>
                    <div class="dbody">
                        {foreach from=$stat_results item=cur_res name=stat_loop}
                            <div class="drow{if $smarty.foreach.stat_loop.index%2} drowalt{/if}">
                                <div class="dnormal">
                                    <div class="dcol summarycol">{$cur_res['module_name']}</div>
                                    <div class="dcol summarycol">{$cur_res['total_requests']}</div>
                                    <div class="dcol summarycol">{$cur_res['avg_request_time']}</div>
                                    <div class="dcol summarycol">{$cur_res["longest_request_time"]}</div>
                                    <div class="dcol summarycol">{$cur_res["longest_event_time"]}</div>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                </div>
