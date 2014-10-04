                <div class="dtable">

                    <div class="dhead">
                        <div class="drow">
                            <div class="dcol width200">Transaction Type</div>
                            <div class="dcol width80">Last 24 Hours</div>
                            <div class="dcol width80">7 Days</div>
                            <div class="dcol width80">30 Days</div>
                            <div class="dcol width80">365 Days</div>
                        </div>
                    </div>
                    <div class="dbody">

			{foreach from=$financeDashboard item=data}

                       <div class="drow">
                            <div class="dnormal">
                                <div class="dcol width200">
                                    <strong>{$data.label}</strong>
                                </div>
                                <div class="dcol width80"> ₹{$data.ONE} </div>
                                <div class="dcol width80"> ₹{$data.WEEK} </div>
                                <div class="dcol width80"> ₹{$data.MONTH} </div>
                                <div class="dcol width80"> ₹{$data.YEAR} </div>
                            </div>
                        </div>

			{/foreach}

                    </div>
                </div>