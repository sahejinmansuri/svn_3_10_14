{include file='header.tpl'}
{include file='error.tpl'}

	{if $showcontent == "form"}
		
		<h4>Confirm Donation</h4>
		
		<ul class="list">
			<li>
				<label>Donation Amount</label>
				<div>
					<p>US${number_format({$AMOUNT}, 2, '.', ',')}</p>
				</div>
			</li>
			<li>
				<label>Non-Profit Merchant</label>
				<div>
					<p>{$MERCHANT}</p>
					<p><span>{$MERCHANTID}</span></p>
				</div>
			</li>
			{if $REASON != null && $REASON != "null" && $REASON != "(null)"}
				<li>
					<label>Reason</label>
					<div>
						<p>{$REASON}</p>
					</div>
				</li>
			{/if}
			{if $ONETIME != true}
				<li>
					<label>Start Date</label>
					<div>
						<p>{date("M j, Y", strtotime($START_DATE))}</p>
					</div>
				</li>
				<li>
					<label>End Date</label>
					<div>
						<p>{date("M j, Y", strtotime($END_DATE))}</p>
					</div>
				</li>
				<li>
					<label>Frequency</label>
					<div>
						<p>{$FREQUENCY}</p>
					</div>
				</li>
			{/if}
		</ul>
		
		<a href="WiGimeApp://donate/status=cancel" class="button cancel">Cancel</a>
		<a href="{$formbase}donate/donatemoney/KEY/{$URLKEY}/AMOUNT/{$AMOUNT}/REASON/{$REASON}/IDENTIFIER/{$IDENTIFIER}/OSID/{$OSID}/MERCHANTID/{$MERCHANTID}/START_DATE/{$START_DATE}/END_DATE/{$END_DATE}/FREQUENCY/{$FREQUENCY}/doaction/donate/" class="button submit">Donate</a>
		
	{elseif $showcontent == "success"}
		
		<h4>Confirmation</h4>
		
		<div class="message">
			<p>Donation completed</p>
			
			<p>You have successfully sent an amount of <strong>US${$AMOUNT}</strong> to <strong>{$MERCHANT}</strong></p>
			
		</div>
		
		<a href="WiGimeApp://donate/status=success" class="button confirm">Return to InCashMe&#8482; App</a>
		
	{elseif $showcontent == "error"}
		
		<h4>Confirmation</h4>
		
		<div class="message">
			<p>An error has occured</p>
			
		</div>
		
		<a href="WiGimeApp://donate/status=error" class="button error">Return to InCashMe&#8482; App</a>
		
	{/if}
	
	<script type="text/javascript">
		$(document).ready(function() {
			var timeout = 30;
			var idate = new Date();
			var itime = idate.getTime();
			var setinterval = setInterval(function() {
				chktimeout();
			}, 3000);
			var chktimeout = function() {
				var cdate = new Date();
				var ctime = cdate.getTime();
				if (ctime > (itime + (timeout * 1000))) {
					if ($(".timeout").length == 0) {
						$(".list, .message, .button").remove();
						$("h4").after("<div class=\"message timeout\"><p>This page has timed out</p></div>");
						{if $showcontent != "success"}
							$(".message").after("<a href=\"WiGimeApp://donate/status=timeout\" class=\"button error\">Return to InCashMe&#8482; App</a>");
							document.location.replace("WiGimeApp://donate/status=timeout");
						{/if}
					}
				} else {
					clearInterVal(setinterval);
				}
			};
			$("a[href^='WiGimeApp']").click(function() {
				if ($(".timeout").length == 0) {
					$(".list, .message, .button").remove();
					$("h4").after("<div class='message timeout'><p>This page has timed out</p></div>");
					{if $showcontent != "success"}
						$(".message").after("<a href=\"WiGimeApp://donate/status=timeout\" class=\"button error\">Return to InCashMe&#8482; App</a>");
					{/if}
				}
				window.close();
			});
		});
	</script>

{include file='footer.tpl'}