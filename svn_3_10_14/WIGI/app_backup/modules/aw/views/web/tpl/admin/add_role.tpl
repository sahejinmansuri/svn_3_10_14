{literal}
<script>
function toggleS(cname, id)
{
    if(id==1)
    {
	$('#'+cname).show();
    }else
    {
	$('#'+cname).hide();
    }

}
</script>
{/literal}

<form action="{$formbase}admin/addrole" method="post">

	<strong>Add Security Permissions for the new Role</strong>

		<ul class="filter">
		<li>
			<p style="width:120px;"><strong>Add the Name of Role</strong> </p>
			<li><input type="rolename" name="rolename" value="" style="width:90px;"/></li>
		</li>
		</ul>
		
		<div class="dtable">
		    <div class="dbody">
					{foreach from=$permissions item=data}
                      {include file='admin/permissions_lay.tpl'}
					{/foreach}
		       </div>
		   </div>
		
		<div style="clear:both;"></div>

        <div class="recrow ctr">
            <input class="adminBtn" type="submit" value="Add Role" />
       </div>

</form>