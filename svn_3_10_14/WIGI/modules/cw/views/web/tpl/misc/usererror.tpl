{include file='header.tpl'}
{include file='error.tpl'}
	{include file='content_header.tpl'}
	<div class="box_wide">
		
		<div id="page">
			
			<p>An error has occured.</p>
			<p>{$message}</p>
			
			<ul class="actionlinks">
				<li><a href="javascript:history.go(-1);">Back</a></li>
			</ul>
			
		</div>
		
	</div>
	
{include file='footer.tpl'}
