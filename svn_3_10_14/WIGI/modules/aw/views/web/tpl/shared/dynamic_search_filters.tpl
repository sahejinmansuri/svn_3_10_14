    <div class="recrow">
            <div class="left2 b" style="width:150px;">Order By</div>
            <div class="left2" style="width:160px;">
                <select name="orderby" style="width:150px;">
                    {foreach from=$variableArr item=data}
                        <option value="{$data.field_var}" name="{$data.field_var}">{$data.label}</option>
                    {/foreach}
                </select>
            </div>
            <div class="left2">
                <select name="orderby2">
                    <option value="ASC">Asc</option>
                    <option value="DESC">Desc </option>
                </select>
            </div>
        <div style="clear:both;"></div>
    </div>
    
    <strong> &nbsp;Add Filters: </strong>
    {section name=foo loop=$num_filters}
    <div class="recrow whiteb" id="rec_{$form_code}{$smarty.section.foo.iteration}" {if $smarty.section.foo.iteration>1} style="display:none;"{/if}>

        <div class="left2" style="width:200px;">
                <select name="field_name_{$smarty.section.foo.iteration}">
                    {foreach from=$variableArr item=data}
                        <option value="{$data.field_var}" name="{$data.field_var}">{$data.label}</option>
                    {/foreach}
                </select>
        </div>

        <div class="right2">
                <select name="option_{$smarty.section.foo.iteration}">
                    <option value="EQ">Equal to ( == )</option>
                    <option value="LT">Less Than ( <= ) </option>
                    <option value="GT">Greater Than ( >= ) </option>
                    <option value="LI">Like ( %xx% ) </option>
                </select>
        </div>

        <div class="right2">
            <input type="text" name="value_{$smarty.section.foo.iteration}" />
        </div>

        {if $smarty.section.foo.iteration<$num_filters} 
        <div class="dcol" id="next_opt_{$form_code}{$smarty.section.foo.iteration}" onClick="javascript:showNext({$smarty.section.foo.iteration},'{$form_code}');">
            <span class="icons2">
                <span class="ui-state-default2 bgreen ui-corner-all">
                    <span id="c_{$data.adminuser_id}" class="ui-icon-plus ui-icon ugreen"></span>
                </span>
            </span>
        </div>
        {/if}

        <div style="clear:both;"></div>
    </div>
    {/section}
        <div style="clear:both;"></div>

