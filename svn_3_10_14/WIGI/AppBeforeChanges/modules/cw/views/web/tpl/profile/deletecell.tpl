{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup deletecellphone formlayout subformlayout">
						
						<h4>Delete cell phone</h4>
						
						<p>Are you sure you want to delete your cell phone? This will erase all references to this cell phone from the website, and you will not be able to log in with this number from your cell phone. To delete a cell phone, you have to withdraw all funds from it, and can't have any pending transactions.</p>
						
						<form action="{$formbase}profile/deletecell" method="post">
							
							<div class="stepbox">
								
								<div class="prompt pin">
									<label for="pin">PIN</label>
									<input type="password" name="PIN" id="pin" value="" maxlength="7" />
									<p class="tip">Please enter your PIN number for this cell phone</p>
								</div>
								<div class="prompt password">
									<label for="password">Password</label>
									<input type="password" name="PASSWORD" id="password" value="" maxlength="16" />
									<p class="tip">Please enter your password</p>
								</div>
								
							</div>
							
							<div class="submit">
								<input type="hidden" name="ITEM" value="{$ITEM}" />
								<input type="hidden" name="doaction" value="delete" />
								<input type="submit" value="Delete" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup deletedcellphone">
						
						<h4>Delete cell phone</h4>
						
						<p>Your cell phone has been deleted.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error1"}
					
					<div class="setup deletedcellphone">
						
						<h4>Delete cell phone</h4>
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Please make sure you entered your PIN and password correctly.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error2"}
					
					<div class="setup deletedcellphone">
						
						<h4>Delete cell phone</h4>
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure that it's not set as default.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error3"}
					
					<div class="setup deletedcellphone">
						
						<h4>Delete cell phone</h4>
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure you don't have any non-withdrawn funds on your cell phone.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "error4"}
					
					<div class="setup deletedcellphone">
						
						<h4>Delete cell phone</h4>
						
						<p>Your cell phone cannot be deleted.</p>
						<p>Make sure you don't have any pending transactions.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#cellphones">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}