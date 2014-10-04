{if $is_existing_roles}

	<tr class="filter">
	<td>
		<p style="width:400px;"><h4>Available Roles are listed below:</h4> </p>
	</td>
	</tr>

   <div class="dtable">
     <div class="dbody">
	
	    {foreach from=$existing_roles item=data2}
            <div style="width:85%;border-bottom:dotted #dfdfdf 1px;float:left;margin:5px;">
                <div class="spacer" onClick="toggleS('{$data2.rec_id}');">
				<span class="icons2">
				<span class="ui-state-default2 bgreen ui-corner-all">
				<span id="c_{$data2.rec_id}" class="ui-icon-plus ui-icon ugreen"></span>
				</span>
				</span>
				</div>
                <div class="form-group">
                                            <label class="col-md-2 control-label">Role name:</label>
														  <div class="col-md-10">
														  <span class="profile_detail">{$data2.rolename}</span>
														  </div>
                                        </div>
				
				<!--<div style="width:300px;float:left;margin:5px;">Role name:<strong>{$data2.rolename}</strong></div>-->
                <!--<div style="width:200px;float:left;5px;">Delete </div>-->
                <div style="clear:both;"></div>
            </div>
            <div id="{$data2.rec_id}" style="display:none;">
                <form action="{$formbase}admin/editrole" method="post">
                    {foreach from=$data2.perms item=data}
                        {include file='admin/permissions_lay.tpl'}        
                    {/foreach}
                    <div style="clear:both;"></div>
                    <input type="hidden" name="rolename" value="{$data2.rolename}"/>

                    <div class="recrow ctr">
                        <input class="adminBtn" type="submit" value="Edit {$data2.rolename} Role" />
                   </div>
                </form>
				<form action="{$formbase}admin/deleterole" method="post">
                    <div style="clear:both;"></div>
                    <input type="hidden" name="rolename" value="{$data2.rolename}"/>

                    <div class="recrow ctr">
                        <input class="adminBtn" type="submit" value="Delete {$data2.rolename} Role" />
                   </div>
                </form>
				
            </div>
	    <div style="clear:both;"></div>

	<br/>
	<br/>

	{/foreach}

       </div>
   </div>



{else}
<b> No Roles exists in our systems..</b>
{/if}

{literal}
<script>
function toggleS(div)
{
$('#'+div).toggle();
$('#c_'+div).toggleClass('ui-icon-minus');
}
</script>
{/literal}