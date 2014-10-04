{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
    {include file='sidebar.tpl'}
    <div id="page">
        <div class="information">
            <!-- 501c Approval begin -->
            <div class="setup usersummary">
                <form action="{$formbase}customer/nonprofitapproved" method="get" id="answers501">
                    <input type="hidden" name="UID" value="{$user_id}" />
                    <input type="hidden" name="AID" value="{$approval_id}" />
                    <h4>501c Approval</h4>
                    <div class="dtable">
                        <div class="dhead">
                            <div class="drow">
                                <div class="dcol colwidth350">Question</div>
                                <div class="dcol summarycol3">Answer</div>
                                <div class="dcol txsearch_col5">Comment</div>
                            </div>
                        </div>
                        <div class="dbody">
                            {foreach from=$questions key=field item=question name=question_loop}
                                <div class="drow">
                                    <div class="dnormal">
                                        <div class="dcol colwidth350">
                                            {$question}
                                        </div>
                                        <div class="dcol summarycol3">
                                            <input type="checkbox" name="chk_{$field}" /><small>yes</small>
                                        </div>
                                        <div class="dcol txsearch_col5">
                                            <input type="text" name="txt_{$field}" />
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
                            <div class="drow">
                                <div class="dnormal">
                                    <div class="dcol colwidth350">
                                        Is the business approved overall?
                                    </div>
                                    <div class="dcol summarycol3">
                                        <input type="checkbox" name="chk_approved" /><small>yes</small>
                                    </div>
                                    <div class="dcol txsearch_col5">
                                        <input type="text" name="txt_approved" />
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" value="Save Approval" />
                        </div>
                    </div>
                </form>
            </div>
            <!-- 501c Approval end -->
        </div>
    </div>
</div>
{include file='footer.tpl'}
