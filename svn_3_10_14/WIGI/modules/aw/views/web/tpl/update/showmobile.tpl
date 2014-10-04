<!DOCTYPE HTML>
<html>
<body>
	<div id="content" style="height:auto;min-height:100px;">
       <table width="95%">
        <tr style="background:none;">
        <td width="95%">
            {if $valid_request}
                {if count($sectionInputs) > 0}
                <form action="{$formbase}update/savemobile?UID={$uid}&recid={$mobileid}&section={$section}" method="post">
                    {if $is_array_data}
                        {include file='update/showeditinfo_array.tpl'}
                    {else}
                        {include file='update/showeditinfo.tpl'}
                    {/if}
                </form>
                {else}
                    <div class="attention">
                        <div class="row">
                            <p><strong>No inputs available.</strong></p>
                        </div>
                    </div>                
                {/if}
               {else}
                    <div class="attention">
                        <div class="row">
                            <p><strong>Invalid option. Please Exit.</strong></p>
                        </div>
                    </div>                
               {/if}
        </td>
        </tr>
        </table>
	</div>
</body>
</html>

