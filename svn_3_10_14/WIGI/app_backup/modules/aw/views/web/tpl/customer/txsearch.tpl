{include file='header.tpl'}
{include file='error.tpl'}
<div class="box_wide box_withsidebar">
{include file='sidebar.tpl'}
    <div id="page">
        <div class="information">
            <div id="profile" class="setup txsearch">

                <div class="tab setup transactions">
                    {include file='customer/userdetail/transactions.tpl'}
                </div>

            </div>
            <ul class="actionlinks">
                <li><a href="{$formbase}customer/home#transactions_search">Back</a></li>
            </ul>
        </div>
    </div>
</div>

{literal}
<script>
function toggleS(div)
{
$('#'+div).toggle();
$('#c_'+div).toggleClass('ui-icon-minus');
}
</script>
{/literal}

{include file='footer.tpl'}
