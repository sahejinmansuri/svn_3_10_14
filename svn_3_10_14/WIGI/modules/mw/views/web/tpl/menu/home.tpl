{include file='header.tpl'}
{include file='error.tpl'}
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				<div id="profile" class="setup profile columnlayout">
					
					<h4>Menu/Products Listing</h4>
						<ul class="actionlinks">
							<li><a href="{$formbase}menu/add">Add More Products</a></li>
						</ul>
					<div class="tabfield">
						
						<div class="tabnavigation">
							
							<ul>
							{foreach from=$parents item=parent}
								<li><a href="#{$parent.id}"{if $parent.status eq "DISABLED"} style="background: #ff5555 !important;"{/if}>{$parent.name|@ucfirst}</a></li>
							{/foreach}	
							</ul>
							
						</div>

						
						{foreach from=$parents item=parent name=parents_loop}
						<div class="tab setup {$parent.id} table" id="{$parent.id}">
							<h4>Items</h4>
							
							<div class="dtable">
								<div class="dhead">
									<div class="drow">
										<div class="dcol col1" style="width: 50%">Name</div>
										<div class="dcol col2" style="width: 10%">Price</div>
									</div>
								</div>
								
								<div class="dbody">
								{foreach from=$result item=child name=child_loop}
									{if $parent.id eq $child.parent}
									<div id="{$child.name}" class="drow{if $smarty.foreach.child_loop.index%2} drowalt{/if}">
										<div class="dnormal"{if $child.status eq "DISABLED"} style="background: #ff5555;"{/if}>
											<div class="dcol col1" style="width: 50%">
												<strong>{$child.name|@ucfirst}</strong>
											</div> 
											<div class="dcol col2" style="width: 10%">
												<strong>{$child.price}</strong>
											</div> 
											<div class="dcol col2" style="width: 30%">
												<a href="{$formbase}menu/delete/id/{$child.id}">Delete</a> | <a href="{$formbase}menu/edit/id/{$child.id}">Edit</a>
											</div>
										</div>
									</div>
									{/if}
								{foreachelse}
									<div class="drow">
										<div class="dcol"><em>There are no menu items in this category.</em></div>
									</div>
								{/foreach}
								{foreach from=$result item=child}
									<ul class="actionlinks">
										{if $parent.id eq $child.id}
										<li><a href="{$formbase}menu/edit/id/{$parent.id}">Edit this Category</a></li>
										<li><a href="{$formbase}menu/delete/id/{$parent.id}">Delete this Category</a></li>
										{/if}
									</ul>
								{/foreach}
								</div>
								
							</div>
							
						</div>
						{/foreach}
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	{if $message != ''}
	<script type="text/javascript">
		alert('{$message}');
	</script>
	{/if}
{include file='footer.tpl'}
