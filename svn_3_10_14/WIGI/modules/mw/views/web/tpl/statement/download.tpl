"Device","Date","From","To","Description","Amount","Balance"
{foreach from=$statement key=k item=v}{foreach from=$v.transactions item=t}"{$k}","{App_DataUtils::date2human($t.stamp,$tzpref)}","{$allusers[$allcellphones[$t.from]["user_id"]]["first_name"]} {$allusers[$allcellphones[$t.from]["user_id"]]["last_name"]} {$allcellphones[$t.from]["cellphone"]}","{if $t.to == 0}Self{else}{$allusers[$allcellphones[$t.to]["user_id"]]["first_name"]} {$allusers[$allcellphones[$t.to]["user_id"]]["last_name"]} {$allcellphones[$t.to]["cellphone"]}{/if}","{$t.description}","₹{number_format({$t.amount}, 2, '.', ',')}","{if is_numeric($t.balance)}₹{number_format({$t.balance}, 2, '.', ',')}{else}N/A{/if}"
{foreachelse}{/foreach}{/foreach}