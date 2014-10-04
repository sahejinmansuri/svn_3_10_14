<?php

class App_Perm {

// Global positioning of the Categories
const BILLING_INDEX = 1;
const DASHBOARD_INDEX = 2;
const CUSTOMER_SUPPORT_INDEX = 3;
const SECURITY_INDEX = 4;
const SYSTEM_INDEX = 5;


const MAPSTR='111|110';

private function  __construct() {}


public static function getCategories($c=0) {
	$feature = array();
	$feature[self::BILLING_INDEX                   ] = 'Billing'; 
	$feature[self::DASHBOARD_INDEX                   ] = 'Dashboard'; 
	$feature[self::CUSTOMER_SUPPORT_INDEX                   ] = 'Customer Support'; 
	$feature[self::SECURITY_INDEX                   ] = 'Security'; 
	$feature[self::SYSTEM_INDEX                   ] = 'System'; 
	return ($c)?$feature[$c]:$feature;
}


/* Disable String shoudl looke like 1001|0111|
   First index in each group (explode by '|') is Parent Index
   Subsequent Indexes are for subcategories
*/
public static function getControllerSecurity()
{
	$controllerEvts=array(
		'billing' => array(
			'index' => 'BILLING',
			'subcat'=> array(
				'savefixed'=>'BILLING_WIGI_SETTINGS',
				'savepercentage'=>'BILLING_WIGI_SETTINGS',
				'savedefaults'=>'BILLING_WIGI_SETTINGS',
				'showdiscount'=>'BILLING_WIGI_SPECIAL_SETTINGS',
				'savediscount'=>'BILLING_WIGI_SPECIAL_SETTINGS',
				'discountstep2'=>'BILLING_WIGI_SPECIAL_SETTINGS',
			 ),
		 ),
		'customer' => array(
			'index' => 'CUSTOMER_SUPPORT',
			'subcat'=> array(
				'showdiscount'=>'CUSTOMER_SPECIAL_BILLING_SETTINGS',
				//'savediscount'=>'BILLING_MERCHANT_SPECIAL_SETTINGS',
			 ),
		 ),			 
	);

	return $controllerEvts;
}


public static function getAdminWigiFeatures()
{
	$r=array(
		'BILLING' => array(
			'index' => self::BILLING_INDEX,
			'label' => self::getCategories(self::BILLING_INDEX),
			'vname'  => 'BILLING_INDEX',
			'class' => 's_billing',
			'subcat'=> array(
				'BILLING_WIGI_SETTINGS'=>array(
					'index' => 1,
					'label' => 'InCashMe&trade; Billing Settings',
					'vname' => 'BILLING_WIGI_SETTINGS',
				 ),
				'BILLING_WIGI_SPECIAL_SETTINGS'=>array(
					'index' => 2,
					'label' => 'InCashMe&trade; Special Billing Settings',
					'vname' => 'BILLING_WIGI_SPECIAL_SETTINGS',
				 ),
			)
		),

		'DASHBOARD' => array(
			'index' => self::DASHBOARD_INDEX,
			'label' => self::getCategories(self::DASHBOARD_INDEX),
			'vname'  => 'DASHBOARD_INDEX',
			'class' => 's_dashboard',
			'subcat'=> array(
				'DASHBOARD_TRANSACTION_SUMMARY'=>array(
					'index' => 1,
					'label' => 'Dashboard Transaction Summary',
					'vname' => 'DASHBOARD_TRANSACTION_SUMMARY',
				 ),
				'DASHBOARD_SUBCAT2'=>array(
					'index' => 2,
					'label' => 'Dashboard Subcategory 2222',
					'vname' => 'DASHBOARD_SUBCAT2',
				 ),
			)
		),

		'CUSTOMER_SUPPORT' => array(
			'index' => self::CUSTOMER_SUPPORT_INDEX,
			'label' => self::getCategories(self::CUSTOMER_SUPPORT_INDEX),
			'vname'  => 'CUSTOMER_SUPPORT_INDEX',
			'class' => 's_customer',
			'subcat'=> array(
				'CUSTOMER_BILLING_SETTINGS'=>array(
					'index' => 1,
					'label' => 'Merchant Billing Settings',
					'vname' => 'CUSTOMER_BILLING_SETTINGS',
				 ),
				'CUSTOMER_SPECIAL_BILLING_SETTINGS'=>array(
					'index' => 2,
					'label' => 'Merchant Special Billing Settings',
					'vname' => 'CUSTOMER_SPECIAL_BILLING_SETTINGS',
				 ),
			)
		),

		'SECURITY' => array(
			'index' => self::SECURITY_INDEX,
			'label' => self::getCategories(self::SECURITY_INDEX),
			'vname'  => 'SECURITY_INDEX',
			'class' => 's_security',
			'subcat'=> array(
				'SECURITY_ADMIN_USERS'=>array(
					'index' => 1,
					'label' => 'Admin Users',
					'vname' => 'SECURITY_ADMIN_USERS',
				 ),
				'SECURITY_ADMIN_ROLES'=>array(
					'index' => 2,
					'label' => 'Admin Roles',
					'vname' => 'SECURITY_ADMIN_ROLES',
				 ),
				'SECURITY_ADMIN_VIEWS'=>array(
					'index' => 3,
					'label' => 'Admin Views',
					'vname' => 'SECURITY_ADMIN_VIEWS',
				 ),
				'SECURITY_ADMIN_PERMISSIONS'=>array(
					'index' => 4,
					'label' => 'Admin Permissions',
					'vname' => 'SECURITY_ADMIN_PERMISSIONS',
				 ),
				'SECURITY_NATE_PERMISSION'=>array(
					'index' => 5,
					'label' => 'Nate Permissions',
					'vname' => 'SECURITY_NATE_PERMISSION',
				 ),
			)
		),

	);
	
	
	return $r;

}


public static function is_enabled($var)
{
	// if($sess->$var) return 1 else return 0;
}

public static function getVarPosition($var, $str)
{
	$r = self::getAdminWigiFeatures();

	$f=explode("_",$var);
	
	$cat = $r[$f[0]];
	//print_r($cat);
	
	return $cat;
}


public static function updateUserSettings()
{
	$r=self::getAdminWigiFeatures();
	$str='';

	foreach($r as $id=>$data)
	{
		$str.=$_POST[$data['vname']];
		foreach($data['subcat'] as $id2=>$data2)
		{
			if($_POST[$data['vname']])
			{
				$str.=$_POST[$data2['vname']];
			}else
			{
				$str.=0;
			}
		}
		$str.='|';
	}
	
	return $str;
}


public static function setUserSettings($str,$is_admin)
{
	if($is_admin)
	{
		return self::prepareAdminSettings();
	}else
	{
		return self::prepareUserSettings($str);
	}
}


public static function prepareAdminSettings()
{
	$resArr;

	$r=self::getAdminWigiFeatures();

	foreach($r as $id=>$data)
	{
		$data['is_enabled']=1;

		foreach($data['subcat'] as $id2=>$data2)
		{
			$is_subcat_enabled=1;
			$data2['is_enabled']=$is_subcat_enabled;
			$data['subcat'][$id2]=$data2;
	
		}

		$resArr[$id]=$data;

	}

	return $resArr;
}


public static function prepareUserSettings($str)
{
	$resArr;
	$stra=explode("|",$str);
	//print_r($stra);

	$r=self::getAdminWigiFeatures();

	foreach($r as $id=>$data)
	{
		$is_cat_enabled=0;
		$data['is_enabled']=0;
		// Check if the Category itself is disabled
		$catIndex = $data['index']-1;
		if(isset($stra[$catIndex]))
		{
			$is_cat_enabled = substr($stra[$catIndex], 0, 1);
			$data['is_enabled']=substr($stra[$catIndex], 0, 1);

		}

		foreach($data['subcat'] as $id2=>$data2)
		{
			$is_subcat_enabled=0;
			if($is_cat_enabled)
			{
				$is_subcat_enabled = substr($stra[$catIndex],$data2['index'],1)?substr($stra[$catIndex],$data2['index'],1):0;
			}

			$data2['is_enabled']=$is_subcat_enabled;
			$data['subcat'][$id2]=$data2;
	
		}

		//echo "Category |	".$data['label']."	|	IS ENABLED	|	".$is_cat_enabled."<br/>";

		$resArr[$id]=$data;

	}
	

	return $resArr;
}


public static function prepareSecurityTPLParams($str)
{
	$r = self::prepareUserSettings($str);

	$tplArr=array();
	foreach($r as $id=>$data)
	{
		$tplArr[$data['vname']]=$data['is_enabled'];
		foreach($data['subcat'] as $id2=>$data2)
		{
			$tplArr[$data2['vname']]=$data2['is_enabled'];
		}
	}

	return $tplArr;
}


public static function checkRoleAvailable($a, $name)
{
	$name = str_replace(" ","_",trim($name));

	foreach($a as $id=>$data)
	{
		if(preg_match("/Admin_Roles_/",$id))
		{
			$rolename = str_replace("Admin_Roles_","",$id);
			if(strtolower($rolename) == strtolower($name))
			{
				return 0;
			}
		}
	}

	return 1;
}


public static function prepareRolesData($a)
{
	$res=array();
	$features = self::getAdminWigiFeatures();
	foreach($a as $id=>$data)
	{
		if(preg_match("/Admin_Roles_/",$id))
		{
			$rolename = str_replace("Admin_Roles_","",$id);
			$tmp['rec_id']=$rolename;
			$tmp['rolename']=str_replace("_"," ",$rolename);
			$tmp['value']=$data;
			$tmp['perms'] = self::prepareUserSettings($data);
			$res[$rolename]=$tmp;
		}
		
	}

	return $res;
}

}

?>
