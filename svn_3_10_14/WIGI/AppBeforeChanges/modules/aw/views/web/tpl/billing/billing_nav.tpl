                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
			    {if $BILLING_WIGI_SPECIAL_SETTINGS}
				<li><a href="{$formbase}billing/showdiscount">Special Billing</a></li>
			    {/if}
                            {if $BILLING_WIGI_SETTINGS}
				<li><a href="#fixed">Fixed Rate Billing</a></li>
				<li><a href="#percentage">Percentage Rate Billing</a></li>
				<li><a href="#billing">Default Billing</a></li>
			    {/if}
                        </ul>
                    </div>
                    {if $BILLING_WIGI_SPECIAL_SETTINGS}{include file='billing/discount_step1.tpl'}{/if}
		    {if $BILLING_WIGI_SETTINGS}
			    {include file='billing/fixed_billing.tpl'}
			    {include file='billing/percentage_billing.tpl'}
			    {include file='billing/default_billing.tpl'}
		    {/if}
                </div>
