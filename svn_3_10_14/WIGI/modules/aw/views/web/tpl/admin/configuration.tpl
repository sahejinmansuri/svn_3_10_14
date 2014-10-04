<h4>
	<span class="icons2">
		<span class="ui-state-default2 bgrey ui-corner-all">
			<span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
		</span>
	</span>&nbsp;Cofiguration
</h4>
<div class="dtable">
	<form action="{$formbase}admin/updateconfig" method="get">
		<ul class="filter">
			<li>
				<p style="width:120px;"><strong>Yearly Subscription Charge</strong> </p>
				<li><input type="text" name="sub_charge" value="{$sub_charge}" style="width:150px;"/></li>
			</li>
		</ul>
		<ul class="filter">
			<li>
				<p style="width:120px;"><strong>Amount to be load at first time</strong> </p>
				<li><input type="text" name="load_amount_first" value="{$load_amount_first}" style="width:150px;"/></li>
			</li>
		</ul>
		<ul class="filter">
			<li>
				<p style="width:120px;"><strong>Daily transaction limit</strong> </p>
				<li><input type="text" name="daily_transaction_limit" value="{$daily_transaction_limit}" style="width:150px;"/></li>
			</li>
		</ul>
		<ul class="actionlinks">
			<li>
				<input type="submit" name="submit" value="Update" />
			</li>
		</ul>
	</form>
</div>