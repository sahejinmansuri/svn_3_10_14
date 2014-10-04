{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
					
					<div class="setup addquestions formlayout subformlayout">
						
						<form action="{$formbase}{$action}" method="post" autocomplete="off">
							
							<div class="stepbox">
								
								<div class="prompt question">
									<label for="parent">Product Category</label>
									<select name="parent" id="parent">
										<option value="0">Choose...</option>
										{foreach from=$parents item=parent}
										<option value="{$parent.id}">{$parent.name|@ucfirst}</option>
										{/foreach}
									</select>
									<p class="tip">Product Category</p>
								</div>
								<div class="prompt name">
									<label for="name">Product Name</label>
									<input type="text" name="name" id="name" maxlength="20" value="" />
									<p class="tip">Enter a product name</p>
								</div>
								<div class="prompt name">
									<label for="price">Product Price</label>
									<input type="text" name="price" id="price" maxlength="7" value="" />
									<p class="tip">Enter the price of the product</p>
								</div>
								<div class="prompt question">
									<label for="status">Status</label>
									<select name="status" id="status">
										<option value="ENABLED">Enabled</option>
										<option value="DISABLED">Disabled</option>
									</select>
									<p class="tip">Product to be display</p>
								</div>
							</div>
							
							<div class="submit">
								<input type="submit" value="Add" />
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}menu/home">Cancel</a></li>
						</ul>
						
					</div>
						
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
