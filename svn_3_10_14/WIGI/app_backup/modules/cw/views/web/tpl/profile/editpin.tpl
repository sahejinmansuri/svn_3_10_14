{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editpin formlayout subformlayout">
						
						<h4>Change PIN number</h4>
						
						<p>Each cell phone has its own PIN. The same PIN can be chosen for all phones.</p>
						
						<form action="{$formbase}profile/editpin" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt oldpin pin">
									<label for="oldpin">PIN</label>
									<input type="password" name="OLDPIN" id="oldpin" maxlength="7" />
									<p class="tip">Enter your current PIN number</p>
								</div>
								<div class="prompt newpin pin">
									<label for="newpin">PIN</label>
									<input type="password" name="NEWPIN" id="newpin" maxlength="7" />
									<p class="tip">Enter new PIN number (7 digits, unordered)</p>
								</div>
								<div class="prompt newpin_confirm pin">
									<label for="newpin_confirm">PIN (confirm)</label>
									<input type="password" name="NEWPIN_CONFIRM" id="newpin_confirm" maxlength="7" />
									<p class="tip">Repeat new PIN number</p>
								</div>
								
							</div>
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Change" />
								
							</div>
						
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedpin">
						
						<h4>Change PIN number</h4>
						
						<p>Your PIN number has been changed.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error"}
					
					<div class="setup editedpin">
						
						<h4>Change PIN number</h4>
						
						<p>Your PIN number cannot be changed.</p>
						<p>Make sure you entered your PIN numbers correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/editpin/ITEM/{$ITEM}">Try again</a></li>
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>

{include file='footer.tpl'}