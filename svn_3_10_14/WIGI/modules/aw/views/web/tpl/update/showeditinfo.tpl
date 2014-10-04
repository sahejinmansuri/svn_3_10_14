            <ul class="resultul">
                {foreach from=$sectionInputs item=data}
                    <li style="margin:5px;"><div class="width200 left">{$data.input_label}</div>: 
                        {if $data.field_type == 'text'}
                            <input type="text" name="{$data.input_field}" id="{$data.input_field}" value="{if $preload_data}{$data.input_value}{/if}" style="width:250px;"/>                    
                        {/if}
                        {if $data.field_type == 'radio'}
                            <input type="radio" id="{$data.input_field}_y" name="{$data.input_field}" value="1" {if $preload_data}{if $data.input_value} checked {/if} {/if}/><label for="{$data.input_field}_y">Yes</label>
                            <input type="radio" id="{$data.input_field}_n" name="{$data.input_field}" value="0" {if $preload_data}{if $data.input_value}{else} checked {/if}{/if}/><label for="{$data.input_field}_n">No</label>
                        {/if}
                    </li>
                {/foreach}
            </ul>

            <div class="recrow ctr">
                <input type="submit" value="{$section_label}" name="" class="adminBtn">
            </div>
