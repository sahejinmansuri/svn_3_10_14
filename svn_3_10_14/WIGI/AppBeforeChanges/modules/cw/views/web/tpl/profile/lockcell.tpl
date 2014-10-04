{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup lockcellphone formlayout subformlayout">
						
						<h4>Lock cell phone: {$selectedcellphone}</h4>
						
						<p>A locked cell phone can not log in. The funds are still available and can be withdrawn online. To unlock a cell phone, login to wigime.com and unlock through profile settings.</p>
						
						<form action="{$formbase}profile/lockcell" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								{if count($cellphones) > 1 and $isdefaultcell == 1}
								<div class="prompt setdefaultcell">
									<label for="setdefaultcell">Set Default Cell</label>
									<select name="SETDEFAULT" id="setdefaultcell">
										<option value="">Leave this</option>
										{foreach from=$cellphones key=k item=v}
											{if $v.is_default == 0}
											<option value="{$v.mobile_id}">{$v.cellphone}</option>
											{/if}
										{/foreach}
									</select>
									<p class="tip">Would you like to set another cell phone to default?</p>
								</div>
								{/if}
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="lock" />
								<input type="submit" value="Lock" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup lockedcellphone">
						
						<h4>Lock cell phone</h4>
						
						<p>Your cell phone has been locked.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup lockedcellphone">
						
						<h4>Lock cell phone</h4>
						
						<p>Your cell phone cannot be unlocked.</p>
						<p>Make sure you entered your password and PIN number correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/lockcell/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
