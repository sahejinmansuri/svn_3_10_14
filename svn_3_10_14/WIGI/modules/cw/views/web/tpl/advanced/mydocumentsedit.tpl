{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>My Documents</li>
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
                <h1>My Documents</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar box-info">
		<div id="page">
			
			<!--{include file='dashboard/status.tpl'}-->
			
			<div class="information">
				
				{if $showcontent == "form"}
					
					<div class="setup editdocument formlayout subformlayout">
					
						<h4  class="widgettitle">Edit document</h4>
						<div class="widgetcontent" >
						
						
						<form action="{$formbase}advanced/mydocumentsedit" method="post" class="stdform">
							
							<p>
								<label>Display name</label>
								<span class="field">
									<input type="text" name="DOCDESC" id="documentdesc" maxlength="30" value="{$DOCDESC}" />
								</span>
								<small class="desc">This will be the name you see for this document</small>
							</p>
							<p>
								<label>Number</label>
								<span class="field">
									<input type="text" name="DOCNUM" id="documentnumber" maxlength="30" value="{$DOCNUM}" />
								</span>
								<small class="desc">Document number</small>
							</p>
							<p>
								<label>Type</label>
								<span class="field">
									<select name="DOCTYPE" id="doctype">{foreach from=$doctypes item=v}<option value="{$v}"{if $v == $DOCTYPE} selected="selected"{/if}>{$v}</option>{/foreach}</select>
								</span>
								<small class="desc">The type of this document</small>
							</p>
							<p>
								<label>Expiration date</label>
								<span class="field">
									<select name="DOCEXP_MONTH" id="docexpiration_month" class="datemonth">{section name=docexp_month_loop loop=$docexpdatemonths start=0}<option value="{($smarty.section.docexp_month_loop.index + 1)}"{if ($smarty.section.docexp_month_loop.index + 1) == $DOCEXP_MONTH} selected="selected"{/if}>{$docexpdatemonths[$smarty.section.docexp_month_loop.index + 1]}</option>{/section}</select>
									<select name="DOCEXP_DAY" id="docexpiration_day" class="dateday">{section name=docexp_day_loop loop=$docexpdatedays start=0}<option value="{($smarty.section.docexp_day_loop.index + 1)}"{if ($smarty.section.docexp_day_loop.index + 1) == $DOCEXP_DAY} selected="selected"{/if}>{($smarty.section.docexp_day_loop.index + 1)}</option>{/section}</select>
									<select name="DOCEXP_YEAR" id="docexpiration_year" class="dateyear">{section name=docexp_year_loop loop=$docexpdateyears start=($docexpdateyears-50)}<option value="{($smarty.section.docexp_year_loop.index + 1)}"{if ($smarty.section.docexp_year_loop.index + 1) == $DOCEXP_YEAR} selected="selected"{/if}>{($smarty.section.docexp_year_loop.index + 1)}</option>{/section}</select>
								</span>
								<small class="desc">The expiration date of this document</small>
							</p>
							
							<!--<div class="stepbox">
								
								<div class="prompt documentdesc">
									<label for="documentdesc">Display name</label>
									<input type="text" name="DOCDESC" id="documentdesc" maxlength="30" value="{$DOCDESC}" />
									<p class="tip">This will be the name you see for this document</p>
								</div>
								<div class="prompt documentnumber">
									<label for="documentnumber">Number</label>
									<input type="text" name="DOCNUM" id="documentnumber" maxlength="30" value="{$DOCNUM}" />
									<p class="tip">Document number</p>
								</div>
								<div class="prompt doctype">
									<label for="doctype">Type</label>
									<select name="DOCTYPE" id="doctype">{foreach from=$doctypes item=v}<option value="{$v}"{if $v == $DOCTYPE} selected="selected"{/if}>{$v}</option>{/foreach}</select>
									<p class="tip">The type of this document</p>
								</div>
								<div class="prompt docexpiration">
									<label for="docexpiration_month">Expiration date</label>
									<select name="DOCEXP_MONTH" id="docexpiration_month" class="datemonth">{section name=docexp_month_loop loop=$docexpdatemonths start=0}<option value="{($smarty.section.docexp_month_loop.index + 1)}"{if ($smarty.section.docexp_month_loop.index + 1) == $DOCEXP_MONTH} selected="selected"{/if}>{$docexpdatemonths[$smarty.section.docexp_month_loop.index + 1]}</option>{/section}</select>
									<select name="DOCEXP_DAY" id="docexpiration_day" class="dateday">{section name=docexp_day_loop loop=$docexpdatedays start=0}<option value="{($smarty.section.docexp_day_loop.index + 1)}"{if ($smarty.section.docexp_day_loop.index + 1) == $DOCEXP_DAY} selected="selected"{/if}>{($smarty.section.docexp_day_loop.index + 1)}</option>{/section}</select>
									<select name="DOCEXP_YEAR" id="docexpiration_year" class="dateyear">{section name=docexp_year_loop loop=$docexpdateyears start=($docexpdateyears-50)}<option value="{($smarty.section.docexp_year_loop.index + 1)}"{if ($smarty.section.docexp_year_loop.index + 1) == $DOCEXP_YEAR} selected="selected"{/if}>{($smarty.section.docexp_year_loop.index + 1)}</option>{/section}</select>
									<p class="tip">The expiration date of this document</p>
								</div>
								
							</div>-->
							
							<div class="submit">
								
								<input type="hidden" name="C" value="{$cellid}" />
								<input type="hidden" name="D" value="{$docid}" />
								<input type="hidden" name="doaction" value="edit" />
								<input type="submit" value="Update"  class="btn btn-info" />
								<a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments" class="btn btn-info">Cancel</a>
								
							</div>
							
						</form>
						
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments">Cancel</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{elseif $showcontent == "success"}
					
					<div class="setup editeddocument">
						
						<h4  class="widgettitle">Edit document</h4>
						<div class="widgetcontent" >
						
						<p>Your document has been updated.</p>
						<a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments"  class="btn btn-info">Back</a>
						<!--<ul class="actionlinks">
							<li><a href="{$formbase}advanced/mydocuments/ITEM/{$cellid}#mydocuments"  class="btn btn-info">Back</a></li>
						</ul>-->
						
					</div>
					</div>
					
				{/if}
				
			</div>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}