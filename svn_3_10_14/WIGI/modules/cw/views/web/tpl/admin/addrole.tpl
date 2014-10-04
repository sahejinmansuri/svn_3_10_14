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

{if $showcontent == "already"}
{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar"> 
{include file='sidebar.tpl'}
<div id="page">
<div class="information
	<div id="page">
        <div class="information">
            <div class="setup profile columnlayout" id="profile">
                <h4>Add Role</h4>
                <strong>The Rolename already exist. Please try with another name</strong>
				<ul class="actionlinks">
							<li><a href="{$formbase}admin/home">Back</a></li>
						</ul>
			</div>
		</div>
	</div>
</div>
</div>
{else}
<form action="{$formbase}admin/addrole" method="post" class="stdform">

	<p><strong>Add Security Permissions for the new Role</strong></p>

		<tr class="filter">
		<td>
			<td style="width:120px;"><strong>Add the Name of Role</strong> </td>
			<td><input type="rolename" name="rolename" value="" style="width:90px;"/></td>
		</td>
		</tr> 
		
		<div class="dtable">
		    <div class="dbody">
					{foreach from=$permissions_add item=data}
                      {include file='admin/permissions_lay.tpl'}
					{/foreach}
		       </div>
		   </div>
		
		<div style="clear:both;"></div>

        <div class="recrow ctr">
            <input  type="submit" class="btn btn-info" value="Add Role" />
       </div>

</form>
{/if}