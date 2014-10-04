{include file='header.tpl'}
{include file='error.tpl'}

<div class="box_wide box_withsidebar">
{include file='sidebar.tpl'}

    <div id="page">
        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                <h4>Customer Support</h4>
                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
                            <li><a href="#consumer_search">Search Consumers</a></li>
                            <li><a href="#merchants_search">Search Merchants</a></li>
                            <li><a href="#transactions_search">Search Transactions</a></li>
                            <li><a href="#messages">Messages</a></li>
                            <li><a href="#bank_account">Bank Account</a></li>
                            <div style="clear:both;"></div><br/>
                            <li style="border-bottom:5px solid #82B038;"><a href="#nonprofitapproval">Nonprofit Approval</a></li>

                        </ul>

                    </div>

                    <div class="tab setup consumer_search">
                        {$consumerSrchForm}
                    </div>

                    <div class="tab setup merchants_search">
                        {$merchantSrchForm}
                    </div>

                    <div class="tab setup transactions_search">
                        {$transactionSrchForm}
                    </div> 
       
                    <div class="tab setup messages">
                        {include file='customer/support_messages.tpl'}
                    </div>

                    <div class="tab setup bank_account">
                        {include file='customer/bank_account.tpl'}
                    </div> <!-- END Bank Account Approval -->


                    <!-- START 501c Approval -->
                    <div class="tab setup nonprofitapproval">
                        {include file='customer/nonprofit_approval.tpl'}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
	$(document).ready(function() {
		var dates = $(".messagedates").datepicker({
			dateFormat:'yy-mm-dd',
			onSelect: function(selectedDate) {
				var option = (this.className.indexOf("datefrom") != -1) ? "minDate" : "maxDate",
				instance = $(this).data("datepicker"),
				date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
</script>
{/literal}

{literal}    
<style>
.whiteb{background:white;}
</style>

<script>
function showNext(id, form_code)
{
    next_id=id+1;
    var ndiv = 'rec_'+form_code+next_id;

    $("#next_opt_"+form_code+id).hide();
    $("#"+ndiv).show();
}
</script>
{/literal}    

{include file='footer.tpl'}
