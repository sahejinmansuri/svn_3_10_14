            <ul class="resultul">
                {foreach from=$sectionInputs item=data}
                    <li style="margin:5px;"><div class="left">{$data.rec_num}: {$data.rec_info}</div>: 
                        {if $data.field_type == 'text'}
                            <input type="text" name="{$data.rec_id}" id="{$data.rec_id}" value="{$data.rec_value}" style="width:100px;"/>                    
                        {/if}
                    </li>
                {/foreach}
            </ul>

            <div class="recrow ctr">
                <input type="submit" value="{$section_label}" name="" class="adminBtn">
            </div>
