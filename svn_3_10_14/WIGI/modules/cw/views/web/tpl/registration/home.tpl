{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}
{include file='content_header.tpl'}
	
	<div class="box_wide">
		
		<div id="page">
			
			{if true == false}
				{include file='registration/registration_fields.tpl'}
			{/if}
			
			<p style="font-size:14px;">To create a InCashMe Account you will have to download our Mobile application and do it from that Mobile Application.<br />We currently support Apple iPhone and iPad with Data Plan (Internet Access) and SMS/TXT capabilities.</p>
			<p style="font-size:14px;font-weight:bold;">Get the iPhone app from the iTunes App Store!</p>
			<p>We are soon also going to support Android devices, also with a Data Plan (Internet Access) and SMS/TXT capabilities.<br />You will be able to download the Android app from the Android Market.</p>
			
			<p>
				<a href="http://itunes.apple.com/app/wigime/id473512570?mt=8" target="_blank"><img src="{$csspath}/images/store_ios.png" alt="" /></a>
				<a href="https://market.android.com/" target="_blank"><img src="{$csspath}/images/store_android.png" alt="" /></a>
			</p>
			
			<p>The InCashMe Service is only valid where allowed by the Local Laws of your State or Jurisdiction</p>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}