<?php
    $db1 = mysql_connect('localhost', 'root', 'InCashMe@123?');
	$rv = mysql_select_db('incashme_dev', $db1);

	$sql2 = 'select message_id from message order by message_id desc';
	$rows2 = mysql_query($sql2);
	while($row2 = mysql_fetch_array($rows2)){
		$mes_id = $row2['message_id'];
		$sql1 = mysql_query("select * from user_mobile_message where message_id='".$mes_id."'");
		$count = mysql_num_rows($sql1);
		if($count == 0){
			echo "add message";
			$sql3 = 'select mobile_id from user_mobile';
			$rows3 = mysql_query($sql3);
			while($row3 = mysql_fetch_array($rows3)){
				$mob_id = $row3['mobile_id'];
				mysql_query("Insert into user_mobile_message(message_id, mobile_id, status) values('".$mes_id."','".$mob_id."','unread')");
			}
		}else{
			echo "nothing ";
			break;
		}
	}