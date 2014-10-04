{include file='header.tpl'}
{include file='error.tpl'}
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

<div class="box_wide box_withsidebar">

    {include file='sidebar.tpl'}

    <div id="page">

        <div class="information">
            <div id="profile" class="setup profile columnlayout">
                <h4>Security</h4>
                <div class="tabfield">
                    <div class="tabnavigation">
                        <ul>
                            <li><a href="{$formbase}admin/home">Users</a></li>
                        </ul>
                    </div>

                    <div class="tab setup adminusers">
                        <strong>Security Permissions for {$login_id}</strong>
				<div class="dtable">
				    <div class="dbody">
				    	<form action="{$formbase}admin/savepermissions" method="post">

					{foreach from=$permissions item=data}

					<div style="width:85%;border:dotted black 1px;float:left;margin:5px;">
						<div style="width:300px;float:left;margin:5px;"><strong>{$data.label}</strong></div>
						<div style="width:200px;float:left;5px;">

							{if $data.is_enabled}
								<input onclick="toggleS('{$data.class}',1);" type="radio" checked value="1" name="{$data.vname}">Yes
								<input onclick="toggleS('{$data.class}',0);" type="radio" value="0" name="{$data.vname}">No
							{else}
								<input onclick="toggleS('{$data.class}',1);" type="radio" value="1" name="{$data.vname}">Yes
								<input onclick="toggleS('{$data.class}',0);" type="radio" checked value="0" name="{$data.vname}">No
							{/if}
						</div>
					    <div style="clear:both;"></div>
					    <br/>
					    <div id="{$data.class}" style="padding-left:20px;background:#dfdfdf;">

							{foreach from=$data.subcat item=data2}
								<div style="width:280px;float:left;margin:5px;">{$data2.label}</div>
								<div style="width:200px;float:left;5px;">

									{if $data2.is_enabled}
										<input type="radio" checked value="1" name="{$data2.vname}">Yes
										<input type="radio" value="0" name="{$data2.vname}">No
									{else}
										<input type="radio" value="1" name="{$data2.vname}">Yes
										<input type="radio" checked value="0" name="{$data2.vname}">No
									{/if}
								</div>
								<div style="clear:both;"></div>								<br/>

							{/foreach}
						</div>


					</div>

					{/foreach}
					<input type="hidden" name="login_id" value="{$login_id}"/>

					{if $is_admin}
						<div style="width:85%;text-align:center;">
							<input type="submit" value="Save Permissions">
						</div>
					{/if}


					</form>

                                        </div>
                                    </div>
                                </div>

                                <!--END admin users -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div> 
    </div>
</div>

{include file='footer.tpl'}
