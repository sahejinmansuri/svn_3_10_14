<?php

class App_MwPerm {

public static function getMerchantWigiFeatures($c=0)
{
	$r=array(
		'DASHBOARD_INDEX' => array(
			'index' => 1,
			'label' => 'Dashboard',
			'vname'  => 'DASHBOARD_INDEX',
			'class' => 's_dashboard',
		),
		'ADD_FUNDS_INDEX' => array(
			'index' => 2,
			'label' => 'Add Funds',
			'vname'  => 'ADD_FUNDS_INDEX',
			'class' => 's_dashboard',
		),
		'WITHDRAW_FUNDS_INDEX' => array(
			'index' => 3,
			'label' => 'Withdraw Funds',
			'vname'  => 'WITHDRAW_FUNDS_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_ORDERS_INDEX' => array(
			'index' => 4,
			'label' => 'Orders',
			'vname'  => 'VIEW_ORDERS_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_HISTORY_INDEX' => array(
			'index' => 5,
			'label' => 'History',
			'vname'  => 'VIEW_HISTORY_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_REPORTS_INDEX' => array(
			'index' => 6,
			'label' => 'Download Transactions',
			'vname'  => 'VIEW_REPORTS_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_STATEMENTS_INDEX' => array(
			'index' => 7,
			'label' => 'Statements',
			'vname'  => 'VIEW_STATEMENTS_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_ADVANCED_FEATURES_INDEX' => array(
			'index' => 8,
			'label' => 'Advanced Features',
			'vname'  => 'VIEW_ADVANCED_FEATURES_INDEX',
			'class' => 's_dashboard',
		),
		'VIEW_PROFILE_INDEX' => array(
			'index' => 9,
			'label' => 'Profile (Limited access would be available)',
			'vname'  => 'VIEW_PROFILE_INDEX',
			'class' => 's_dashboard',
		),
	);
	
	return ($c)?$r[$c]:$r;

}


public static function prepareRolesData($a)
{
	$res=array();
	$cnt=0;
	$features = self::getMerchantWigiFeatures();
	foreach($a as $id=>$data)
	{
		if(preg_match("/Merchant_Roles_/",$id))
		{
			$rolename = str_replace("Merchant_Roles_","",$id);
			$tmp['rolename']=$rolename;
			$tmp['value']=$data;
			$tmp['rec_id']=++$cnt;
			$permsArr=array();

			foreach($features as $id2=>$f)
			{
				$is_enabled = substr($data,$f['index']-1,1);
				$f['is_enabled'] = $is_enabled;
				$permsArr[]=$f;
			}

			$tmp['perms'] = $permsArr;
			$res[$rolename]=$tmp;
		}
		
	}

	return $res;
}


public static function checkRoleAvailable($a, $name)
{
	$name = str_replace(" ","_",trim($name));

	foreach($a as $id=>$data)
	{
		if(preg_match("/Merchant_Roles_/",$id))
		{
			$rolename = str_replace("Merchant_Roles_","",$id);
			if(strtolower($rolename) == strtolower($name))
			{
				return 0;
			}
		}
	}

	return 1;
}

}

?>
