{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home">Profile</a> <span class="separator"></span></li>
		<li><a href="{$formbase}profile/home#cellphones">Cellphone</a> <span class="separator"></span></li>
		<li>Edit question</li>
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
                <h1>Edit security question</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar box-info">
		
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editquestion formlayout subformlayout">
						<h4 class="widgettitle">Edit security question</h4>
						<div class="widgetcontent" >
						<!--<h4>Edit security question</h4>-->
						
						<p>The following security question have to be completed for your protection. Secret questions are specific to a cell phone.</p>
						
						<form action="{$formbase}profile/editquestion" method="post" autocomplete="off" class="stdform">
							<p>
								<label>Security question</label>
								<span class="field">
									<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}"{if $q == $selectedq} selected="selected"{/if}>{$q}</option>{/foreach}</select>
								</span>
								<small class="desc">Choose a security question</small>
							</p>
							<p>
								<label>Security answer</label>
								<span class="field">
									<input type="text" name="ANSWER" id="answer" maxlength="15" value="" />
								</span>
								<small class="desc">Enter a security answer</small>
							</p>
							
							<!--<div class="stepbox">
								
								<div class="prompt question">
									<label for="question">Security question</label>
									<select name="QUESTION" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}"{if $q == $selectedq} selected="selected"{/if}>{$q}</option>{/foreach}</select>
									<p class="tip">Choose a security question</p>
								</div>
								<div class="prompt answer">
									<label for="answer">Security answer</label>
									<input type="text" name="ANSWER" id="answer" maxlength="15" value="" />
									<p class="tip">Enter a security answer</p>
								</div>
								
							</div>-->
							
							<div class="submit">
								
								<input type="hidden" name="ITEM" value="{$ITEM}.{$QUESTION_ID}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update" class="btn btn-info" />
								<a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}" class="btn btn-info" >Cancel</a>
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editedquestion">
						
						<h4 class="widgettitle">Edit security question</h4>
						<div class="widgetcontent" >
						
						<p>Your cell phone security questions have been updated.</p>
						<a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}" class="btn btn-info">Back</a>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}profile/viewquestion/ITEM/{$ITEM}">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}