{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#moneysources">Money sources</a> <span class="separator"></span></li>
		<li>Link Cellphone</li>
		{if $logged_in == 1}
		<li class="right">
			Last login: {$lastlogin}<br />IP address: {$lastip}
		</li>
		
		{/if}
	</ul>
	<div class="maincontent">
        <div class="maincontentinner">
			<div class="row">
				<div id="dashboard-left" class="col-md-12">
		<div class="pageheader">
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Link Cellphone</h1>
            </div>
        </div>
	<div class="box_wide box_withsidebar box-info" >
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup linkcellphones formlayout subformlayout">
						<h4 class="widgettitle">Link cell phones to money sources</h4>
						<div class="widgetcontent" >
						<!--<h4>Link cell phones to money sources</h4>-->
						
						<p>Please click on the cell phones to select which ones you would like to link to each money source.</p>
						
						<form action="{$formbase}profile/linkcell" method="post">
					
							<div class="accordion accordion-info">
								
								{foreach from=$moneysources key=k item=u name=moneysources_loop}
									<h3><a href="#">Link "{$u.description}"</a></h3>
									<div><ul class="cellphone_link">
										{foreach from=$cellphones item=v name=cellphones_loop}
											<li class="{if array_key_exists($k, $existinglinks) and in_array($v.mobile_id, $existinglinks[$k])} selected {/if}" ><a href="#LINKEDCELLPHONES:{$k}:{$v.mobile_id}"><img src="{$csspath}/images/deviceunknown.png" alt="{$v.cellphone}" width="40" />{$v.cellphone}</a></li>
										{/foreach}
										</ul>
										<p class="tip">Link cellphones to this account</p>
									</div>
									
								{foreachelse}
									<p>You don't have any money sources to link.</p>
								{/foreach}
								
								<!--{foreach from=$moneysources key=k item=u name=moneysources_loop}
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
								{/foreach}-->
								
								<script type="text/javascript">
									$(document).ready(function() {
										$(".cellphone_link li.selected").each(function() {
											var selectClass = "selected";
											var data = $(this).children("a").attr("href").substring(1).split(":");
											var name = data[0];
											var value1 = data[1];
											var value2 = data[2];
											$(this).append('<input type="hidden" name="'+name+'['+value1+'][]" value="'+value2+'" />');
											$(this).find("input").hide();
										});
										$(".cellphone_link li a").click(function() {
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
							
							
							<div class="submit stdformbutton">
								
									<input type="hidden" name="ITEM" value="{$ITEM}" />
									<input type="hidden"  name="doaction" value="link" />
									<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Cancel</a>
									<input type="submit" class="btn btn-info" value="Link" />
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Cancel</a></li>
						</ul>-->
						</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup linkedcellphones">
						<h4 class="widgettitle">Link cell phones to your money source</h4>
						<div class="widgetcontent" >
						<!--<h4>Link cell phones to your money source</h4>-->
						
						<p>Your cell phones have been linked to your money sources.</p>
						
						<a href="{$formbase}profile/home#moneysources" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/home#moneysources">Back</a></li>
						</ul>-->
						</div>
						
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}