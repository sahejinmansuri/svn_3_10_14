<ul>
	{if true == false}
	<li>
		<a href="{$formbase}dashboard/home">My Account</a>
		<ul>
			<li><a href="{$formbase}dashboard/home">Dashboard</a></li>
			<li><a href="{$formbase}money/showadd">Add Funds</a></li>
			<li><a href="{$formbase}money/showwithdraw">Withdraw</a></li>
			<li><a href="{$formbase}history/home">History</a></li>
			<li><a href="{$formbase}statement/home">Statements</a></li>
			<li><a href="{$formbase}profile/home">Profile</a></li>
			<li><a href="{$formbase}advanced/home">Advanced Features</a></li>
		</ul>
	</li>
	{/if}
	<li>
		<a href="#">Support</a>
		<ul> 
			<li><a href="{$formroot}web/faqs">FAQ</a></li>
			<li><a href="{$formroot}web/support.html">Suggestions</a></li>
			<li><a href="{$formroot}web/support.html">Support requests</a></li>
			<li><a href="{$formroot}web/enquiry.html">Contact us</a></li>
		</ul>
	</li>
</ul>