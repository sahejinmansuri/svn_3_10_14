{if $is_existing_roles}

	<ul class="filter">
	<li>
		<p style="width:400px;"><strong>Your available Roles are listed below:</strong> </p>
	</li>
	</ul>

   <div class="dtable">
     <div class="dbody">
	
	{foreach from=$existing_roles item=data}

            <div style="width:85%;border-bottom:dotted #dfdfdf 1px;float:left;margin:5px;">
                <div class="spacer" onClick="toggleS('{$data.rec_id}');"><span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.rec_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span></div>
                <div style="width:200px;float:left;margin:5px;">Role name:<strong>{$data.rolename}</strong></div>
                <div style="width:200px;float:right;margin:5px;text-align:right;">
                        <form action="{$formbase}admin/deleterole" method="post">
                            <input type="hidden" name="rolename" value="{$data.rolename}"/>
                            <input class="adminBtn" type="submit" value="Delete {$data.rolename} Role" />
                        </form>
                </div>
                <div style="clear:both;"></div>
            </div>

            <div id="{$data.rec_id}" style="display:none;">
                <form action="{$formbase}admin/editrole" method="post">
                    {foreach from=$data.perms item=data2}
                        <div style="width:85%;border-bottom:dotted #dfdfdf 1px;float:left;margin:5px;">
                            <div style="margin-left:25px;width:150px;float:left;"><strong>{$data2.label}</strong></div>
                            <div style="width:100px;float:left;">{if $data2.is_enabled} Enabled {else} Disabled{/if}</div>
                            <div style="width:200px;float:left;">
                                <input type="radio" {if $data2.is_enabled} checked {/if} value="1" name="{$data2.vname}">Yes
                                <input type="radio" {if $data2.is_enabled} {else} checked {/if} value="0" name="{$data2.vname}">No
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    {/foreach}
                    <div style="clear:both;"></div>
                    <input type="hidden" name="rolename" value="{$data.rolename}"/>

                    <div class="recrow ctr">
                        <input class="adminBtn" type="submit" value="Edit {$data.rolename} Role" />
                   </div>
                </form>
            </div>
	    <div style="clear:both;"></div>

	<br/>
	<br/>
	<div style="clear:both;"></div>
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