{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
    {include file='sidebar.tpl'}
    <div id="page">
        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                <h4>Profile Settings: {$user->getLastName()}, {$user->getFirstName()} - {if $consumers_mobile_info_data}{$consumers_mobile_info_data[0].cellphone}{else} No Cell available {/if}</h4>

                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
                            <li><a href="#personalinfo">Personal info</a></li>
                            <li><a href="#moneysources">Money sources</a></li>
                            <li><a href="#preferences">Preferences</a></li>
                            <li><a href="#cellphones">Cell phones</a></li>
                            <li><a href="#transactions">Transactions</a></li>
                            <li><a href="#billing">Billing</a></li>
                            <div style="clear:both;"></div><br/>
                            <li style="border-bottom:5px solid #82B038;"><a href="#login_history">Login History</a></li>
                        </ul>
                    </div>

                <br/><div class="attention">
                    <div class="row">
                        <p><strong>Legal first name</strong>: {$user->getFirstName()}</p>
                    </div>
                    <div class="row">
                        <p><strong>Legal last name</strong>: {$user->getLastName()}</p>
                    </div>
                    <div class="row">
                        <p><strong>Email</strong>: {$user->getEmail()}</p>
                    </div>
                </div>

                    <div class="tab setup personalinfo">
                        {include file='customer/userdetail/personal_info.tpl'}
                    </div>

                    {include file='customer/userdetail/user_billing.tpl'}

                    <div class="tab setup moneysources table">
                        {include file='customer/userdetail/money_sources.tpl'}
                    </div>

                    <div class="tab setup preferences">
                        {include file='customer/userdetail/preferences.tpl'}
                    </div>

                    <div class="tab setup cellphones table">
                        {include file='customer/userdetail/cell_phones.tpl'}
                    </div>

                    <div class="tab setup transactions">
                        {include file='customer/userdetail/transactions.tpl'}
                    </div>

                    <div class="tab setup login_history">
                        {include file='customer/userdetail/login_history.tpl'}
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