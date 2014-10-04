			</div>
			{if isset($balance)}
				{if $balance != $tbalance}
					<p class="footnote">* Your Total balance may be higher than your Available balance because you may have pending transactions, for example, when funds are added to your account from a Bank or Credit card account, they may take several hours to reflect on your Available balance. You may also have outstanding InCashMe&#8482; Money Payment Codes.</p>
				{/if}
			{/if}
		</div>
	</div>
	<div id="footer">
		<div class="center">
			<p class="copyright">InCashMe&#8482; Inc Copyright 2013-{date(Y)}. All Rights Reserved.</p>
			<p class="sitelinks"><a href="{$formroot}web/terms.html">Terms &amp; Conditions</a> | <a href="{$formroot}web/privacy.html">Privacy Policy</a></p>
			<!--p style="text-align:center;"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=KQZR8LvPa8iTnfMmfsBkD0EOFCrafaXKPy2vWB1Uex6kFQcTPGMeXE9"></script></p-->
			<p style="text-align:center;">The InCashMe Service is only valid where allowed by the Local Laws of your State or Jurisdiction</p>
		</div>
	</div>

</div>

</html>