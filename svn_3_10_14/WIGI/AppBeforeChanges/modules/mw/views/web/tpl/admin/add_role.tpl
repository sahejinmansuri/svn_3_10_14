<form action="{$formbase}admin/addrole" method="get">

	<strong>Add Security Permissions for the new Role</strong>

		<ul class="filter">
		<li>
			<p style="width:120px;"><strong>Add the Name of Role</strong> </p>
			<li><input type="rolename" name="rolename" value="" style="width:90px;"/></li>
		</li>
		</ul>
		
		<div class="dtable">
		    <div class="dbody">

			{foreach from=$categories item=data}
				<div style="width:85%;border-bottom:dotted #dfdfdf 1px;float:left;margin:5px;">
					<div style="width:300px;float:left;margin:5px;"><strong>{$data.label}</strong></div>
					<div style="width:200px;float:left;5px;">
						<input type="radio" value="1" name="{$data.vname}">Yes
						<input type="radio" checked value="0" name="{$data.vname}">No
					</div>
					<div style="clear:both;"></div>
				</div>
			{/foreach}

		       </div>
		   </div>
		
		<div style="clear:both;"></div>

        <div class="recrow ctr">
            <input class="adminBtn" type="submit" value="Add Role" />
        </div>



</form>