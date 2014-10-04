{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">
			
			{include file='dashboard/status.tpl'}
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup linkcellphones formlayout subformlayout">
						
						<h4>Link cell phones to money sources</h4>
						
						<p>Please click on the cell phones to select which ones you would like to link to each money source.</p>
						
						<form action="{$formbase}profile/linkcell" method="post">
							
							<div class="stepbox">
								
								{foreach from=$moneysources key=k item=u name=moneysources_loop}
									<div class="prompt linkedcellphones checkboxes">
										<label>Link "{$u.description}"</label>
										<ul>
											{foreach from=$cellphones item=v name=cellphones_loop}
											<li{if array_key_exists($k, $existinglinks) and in_array($v.mobile_id, $existinglinks[$k])} class="selected"{/if}><a href="#LINKEDCELLPHONES:{$k}:{$v.mobile_id}"><img src="{$csspath}/images/deviceunknown.png" alt="{$v.cellphone}" />{$v.cellphone}</a></li>
											{/foreach}
										</ul>
										<p class="tip">Link cellphones to this account</p>
									</div>
								{foreachelse}
									<p>You don't have any money sources to link.</p>
								{/foreach}
								
								<script type="text/javascript">
									$(document).ready(function() {
										$(".checkboxes li.selected").each(function() {
											var selectClass = "selected";
											var data = $(this).children("a").attr("href").substring(1).split(":");
											var name = data[0];
											var value1 = data[1];
											var value2 = data[2];
											$(this).append('<input type="hidden" name="'+name+'['+value1+'][]" value="'+value2+'" />');
											$(this).find("input").hide();
										});
										$(".checkboxes li a").click(function() {
											var selectClass = "selected";
											if ($(this).parent().hasClass(selectClass)) {
												$(this).parent().removeClass(selectClass);
												$(this).parent().find("input").remove();
											} else {
												var data = $(this).attr("href").substring(1).split(":");
												var name = data[0];
												var value1 = data[1];
												var value2 = data[2];
												$(this).parent().addClass(selectClass);
												$(this).parent().append('<input type="hidden" name="'+name+'['+value1+'][]" value="'+value2+'" />');
												$(this).parent().find("input").hide();
											}
											return false;
										});
									});
								</script>
								
							</div>
							
							<div class="submit">
								
								<div class="notes">
									<input type="hidden" name="ITEM" value="{$ITEM}" />
									<input type="hidden" name="doaction" value="link" />
									<input type="submit" value="Link" />
								</div>
								
							</div>
							
						</form>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>
						
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup linkedcellphones">
						
						<h4>Link cell phones to your money source</h4>
						
						<p>Your cell phones have been linked to your money sources.</p>
						
						<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}