{include file='header.tpl'}
{include file='error.tpl'}
	<div class="box_wide box_withsidebar">
		{include file='sidebar.tpl'}
		<div id="page">
			<div class="information">
				<div id="profile" class="setup approved501c">
					<h4>Customer Support</h4>
					<p>The 501c status {$message} approved.</p>
					<ul class="actionlinks">
						<li><a href="{$formbase}customer/home#nonprofitapproval">Back</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
{include file='footer.tpl'}
