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
                    {include file='customer/merchant_top_nav.tpl'}
                </div>

                <br/><div class="attention">
                    <div class="row">
                        <p><strong>Official Business name</strong>:  {$cur_merc->getBusinessName()}</p>
                    </div>
                    <div class="row">
                        <p><strong>Business phone</strong>: {App_DataUtils::fmtPhone($cur_merc->getBusinessPhone())}</p>
                    </div>
                    <div class="row">
                        <p><strong>Business tax ID or SSN</strong>: {$cur_merc->getBusinessTaxId()}</p>
                    </div>
                </div>


                <div class="tab setup showdiscount">
                    {include file='customer/mercdetail/merchant_discount.tpl'}
                </div>

                <div class="tab setup merchantinfo">
                    {include file='customer/mercdetail/merchant_info.tpl'}
                </div>

                {if $CUSTOMER_BILLING_SETTINGS}
                    {include file='customer/mercdetail/merchant_billing.tpl'}
                {/if}

                <div class="tab setup moneysources table">
                    {include file='customer/mercdetail/money_sources.tpl'}
                </div>

                <div class="tab setup preferences">
                    {include file='customer/mercdetail/preferences.tpl'}
                </div>

                <div class="tab setup transactions">
                    {include file='customer/mercdetail/transactions.tpl'}
                </div>

                <!--<div class="tab setup posdevices table">
                    {include file='customer/mercdetail/cell_phones.tpl'}
                </div>-->

                <div class="tab setup login_history">
                    {include file='customer/mercdetail/login_history.tpl'}
                </div>
                
                <div class="tab setup pos_users">
                    {include file='customer/mercdetail/pos_users.tpl'}
                </div>

                </div>

            </div>

        </div>

    </div>

</div>


{literal}
<script>
$(document).ready(function() {
	$('.edit-info').each(function() {
		var $link = $(this);
		var $dialog = $('<div></div>')
			.load($link.attr('href') + ' #content')
			.dialog({
				autoOpen: false,
				title: $link.attr('title'),
				width: 600,
				autoResize:true,
                modal:true
			});

		$link.click(function() {
			$dialog.dialog('open');

			return false;
		});
	});
});

</script>
{/literal}

{include file='footer.tpl'}