{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			<div class="information">
              <div id="profile" class="setup profile columnlayout">
				<h4>InCashMe&trade; Billing</h4>
				
                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
                            <li class="selected"><a href="{$formbase}billing/showdiscount">Special Billing</a></li>
                            <li><a href="{$formbase}billing/home#fixed">Fixed Rate Billing</a></li>
                            <li><a href="{$formbase}billing/home#percentage">Percentage Rate Billing</a></li>
                            <li><a href="{$formbase}billing/home#billing">Default Billing</a></li>
                        </ul>
                    </div>
                    {include file='billing/discount_step1.tpl'}
                </div>
				
			   </div>
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
