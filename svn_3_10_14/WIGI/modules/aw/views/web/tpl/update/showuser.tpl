<!DOCTYPE HTML>
<html>
<body>
	<div id="content" style="height:auto;min-height:100px;">
       <table>
        <tr style="background:none;">
        <td width="95%">
            {if count($sectionInputs) > 0}
            <form action="{$formbase}update/saveuser?UID={$uid}&recid={$recid}&section={$section}" method="post">
                {include file='update/showeditinfo.tpl'}
            </form>
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

