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
				<!--page_count page_current-->
				{if {$transactions_count} > 0}
					{assign var="i" value="1"}
					{assign var="new_param" value=""}
					{foreach from=$inputsArr key=k item=v}
						
						{assign var="new_param" value="{$new_param}&field_name_{$i}={$v.field_name}&option_{$i}={$v.option}&value_{$i}={$v.value}"}
						{assign var="i" value="{$i+1}"}
					{/foreach}
					{assign var="new_url" value="{$formbase}customer/txsearch"}
					{assign var="new_url" value="{$new_url}?type={$type}&direction={$direction}"}
					{assign var="new_url" value="{$new_url}&orderby={$orderby}&orderby2={$orderby2}{$new_param}"}
					
					{assign var="ul_html" value=""}
					
						{assign var="start_pagination" value=""}
						{assign var="end_pagination" value=""}
						{assign var="first_li" value=""}
						{assign var="last_li" value=""}
						
					{for $foo=1 to $page_count}
						{assign var="current_page_id" value="{$foo}"}
						{assign var="current_page_start" value="{$current_page_id-5}"}
						{assign var="current_page_end" value="{$current_page_id+5}"}
						{assign var="first_pages" value="5"}
						{assign var="last_pages" value="{$page_count-5}"}
						{assign var="last_pages_count" value="{$page_count-9}"}
						{assign var="current_selected" value=""}
						{if $foo == $page_current}
							{assign var="current_selected" value=" class='selected'"}
						{/if}
						{assign var="li_html" value="<li {$current_selected} ><a href='{$new_url}&p={$foo}'>{$foo}</a></li>"}
						
						
						{if {$page_count} <= 10}
							{assign var="ul_html" value="{$ul_html}{$li_html}"}
							
						{elseif {$page_current} <= {$first_pages}}
								{if {$foo} <= 9}
									{assign var="ul_html" value="{$ul_html}{$li_html}"}
								{/if}
								{assign var="end_pagination" value="..."}
								{assign var="last_li" value="<li class='last_li_pagination'><a href='{$new_url}&p={$page_count}'>Last</a></li>"}
						{elseif {$page_current} > {$last_pages}}
								{if {$foo} > {$last_pages_count}}
									{assign var="ul_html" value="{$ul_html}{$li_html}"}
								{/if}
								{assign var="start_pagination" value="..."}
								{assign var="first_li" value="<li class='first_li_pagination'><a href='{$new_url}&p=1'>First</a></li>"}
						{else}
							{if {$page_current} > {$current_page_start}}
								{if {$page_current} < {$current_page_end}}
									{assign var="ul_html" value="{$ul_html}{$li_html}"}
								{/if}
								{assign var="start_pagination" value="..."}
								{assign var="end_pagination" value="..."}
								{assign var="first_li" value="<li class='first_li_pagination'><a href='{$new_url}&p=1'>First</a></li>"}
								{assign var="last_li" value="<li class='last_li_pagination'><a href='{$new_url}&p={$page_count}'>Last</a></li>"}
							{/if}
						{/if}
					{/for}
					<ul class='pagination'>{$first_li}{$ul_html}{$last_li}</ul>
				{/if}

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
<style>
#page .information ul.pagination li.first_li_pagination {
  margin-right: 20px;
}
#page .information ul.pagination li.last_li_pagination {
  margin-left: 10px;
}
</style>
{/literal}

{include file='footer.tpl'}
