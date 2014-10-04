                <div class="dtable">

                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol summarycol">Type</div>
                            <div class="dcol width80">Last 1 Day</div>
                            <div class="dcol width80">Last 7 Days</div>
                            <div class="dcol width80">Last 30 Days</div>
                            <div class="dcol width80">Last 365 Days</div>
                            <div class="dcol width80">Total</div>
                        </div>
                    </div>
                    <div class="dbody">

			{foreach from=$userSummaryData item=data}

                       <div class="drow">
                            <div class="dnormal">
                                <div class="dcol summarycol">
                                    <strong>{$data.label}</strong>
                                </div>
                                <div class="dcol summarycol">
                                    {$data.last1}
                                </div>
                                <div class="dcol width80">
                                    {$data.last7}
                                </div>
                                <div class="dcol width80">
                                    {$data.last30}
                                </div>
                                <div class="dcol width80">
                                    {$data.last365}
                                </div>
                                <div class="dcol width80">
                                    {$data.last365}
                                </div>
                            </div>
                        </div>

			{/foreach}

                    </div>
                </div>