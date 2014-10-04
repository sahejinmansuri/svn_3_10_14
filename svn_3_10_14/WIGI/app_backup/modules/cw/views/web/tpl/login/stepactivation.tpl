<form action="{$formbase}login/{$nextstep}" method="post">
	
	<div class="stepbox">
		
		<div class="notes">
			<h3>Web Access</h3>
			<p>Your Activation Code is being delivered<br />via a text message to your cell phone...</p>
		</div>
		
		<div class="prompt safepasscode">
			<label for="safepasscode">Activation Code</label>
			<input type="text" name="CODE" id="safepasscode" />
			<p class="tip">You should receive this shortly</p>
		</div>
		
	</div>
	
	<div class="confirm">
		
		<div class="notes">
			<input type="submit" value="Confirm" id="confirm" class="nosubmit" />
			<img src="{$csspath}/images/loading.gif" alt="" class="loading" />
		</div>
		
	</div>
	
	<div class="notes morelinks">
		
		<p>
			<a href="#" class="return">Send a new Activation Code</a>
		</p>
		
	</div>
	
</form>