
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
								<div style="clear:both;"></div><br/>

							{/foreach}
						</div>


					</div>

