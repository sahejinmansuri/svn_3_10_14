<?php

class App_SearchOptionsUtils {

public function getSearchClass($id)
{
	$options=array(
		'MERCHANTS'=>'App_Models_Db_Wigi_ViewMerchantInfo',
		'TRANSACTIONS'=>'App_Models_Db_Wigilog_Transaction',
		'CONSUMERS'=>'App_Models_Db_Wigi_ViewUserInfo',
	);

	return $options[$id];
}


public function prepareSearchInputForms($id)
{
	switch($id)
	{
		case 'TRANSACTIONS':
			return self::getTransactionsSearchData();
        case 'MERCHANTS':
			return self::getMerchantsSearchData();
        case 'CONSUMERS':
            return self::getConsumersSearchData();
	}

	return 0;
}


public function fieldOptions()
{
	$options=array(
		'A'=>array(
			'EQ'=>'Equal to (==)',
			'LT'=>'Less Than (<=)',
			'GT'=>'Greater Than (>=)',
	  	),
		'B'=>array(
			'EQ'=>'Equal to (==)',
			'LI'=>'Like (%xx%)',
		),
		'C'=>array(
			'EQ'=>'Equal to (==)',
		),
	);

	return $options;
}

public function fieldOptionValue()
{
	$options=array(
		'EQ'=>'=',
		'LT'=>'<=',
		'GT'=>'>=',
		'LI'=>'%',
	);

	return $options;
}




public static function getConsumersSearchData()
{
	$data=array(
		/*'1' => array(
			'index' => 'M1',
			'label'=> 'User Id',
			'field_var'=>'user_id',
			'option_id'=>'A',
		 ),*/
		/*'1' => array(
			'index' => 'M1',
			'label'=> 'Cell',
			'field_var'=>'business_phone',
			'option_id'=>'B',
		 ),*/
		'1' => array(
			'index' => 'C1',
			'label'=> 'Cell Phone',
			'field_var'=>'cellphone',
			'option_id'=>'C',
		 ),
        '10' => array(
			'index' => 'C1',
			'label'=> 'Email',
			'field_var'=>'email',
			'option_id'=>'C',
		 ),
		'2' => array(
			'index' => 'C2',
			'label'=> 'First Name',
			'field_var'=>'first_name',
			'option_id'=>'C',
		 ),
		'3' => array(
			'index' => 'C3',
			'label'=> 'Last Name',
			'field_var'=>'last_name',
			'option_id'=>'C',
		 ),
		'5' => array(
			'index' => 'C4',
			'label'=> 'Zip Code',
			'field_var'=>'zip',
			'option_id'=>'B',
		 ),
		'7' => array(
			'index' => 'C5',
			'label'=> 'City',
			'field_var'=>'city',
			'option_id'=>'C',
		 ),
		'8' => array(
			'index' => 'C6',
			'label'=> 'State',
			'field_var'=>'state',
			'option_id'=>'B',
		 ),
		'6' => array(
			'index' => 'C7',
			'label'=> 'Street Address',
			'field_var'=>'addr_line1',
			'option_id'=>'B',
		 ),
		'7' => array(
			'index' => 'C8',
			'label'=> 'Alternate Phone',
			'field_var'=>'alternate_phone',
			'option_id'=>'B',
		 ),
		'8' => array(
			'index' => 'C9',
			'label'=> 'Alternate Email',
			'field_var'=>'alternate_email',
			'option_id'=>'B',
		 ),
		/*'9' => array(
			'index' => 'M9',
			'label'=> 'Cell Phone',
			'field_var'=>'cellphone',
			'option_id'=>'B',
		 ),*/
	);

	return $data;

}


public static function getMerchantsSearchData()
{
	$data=array(
		/*'1' => array(
			'index' => 'M1',
			'label'=> 'User Id',
			'field_var'=>'user_id',
			'option_id'=>'A',
		 ),*/
		'1' => array(
			'index' => 'M1',
			'label'=> 'Email',
			'field_var'=>'email',
			'option_id'=>'C',
		 ),
		'2' => array(
			'index' => 'M2',
			'label'=> 'Business Name',
			'field_var'=>'name',
			'option_id'=>'C',
		 ),
		'3' => array(
			'index' => 'M3',
			'label'=> 'DBA',
			'field_var'=>'business_dba_name',
			'option_id'=>'C',
		 ),
		'4' => array(
			'index' => 'M4',
			'label'=> 'Zip Code',
			'field_var'=>'zip',
			'option_id'=>'B',
		 ),
		'5' => array(
			'index' => 'M5',
			'label'=> 'City',
			'field_var'=>'city',
			'option_id'=>'C',
		 ),
		'6' => array(
			'index' => 'M6',
			'label'=> 'State',
			'field_var'=>'state',
			'option_id'=>'B',
		 ),
		'7' => array(
			'index' => 'M7',
			'label'=> 'Business Phone',
			'field_var'=>'business_phone',
			'option_id'=>'B',
		 ),
		'8' => array(
			'index' => 'M8',
			'label'=> 'First Name of Contact',
			'field_var'=>'first_name',
			'option_id'=>'C',
		 ),
		'9' => array(
			'index' => 'M9',
			'label'=> 'Last Name of Contact',
			'field_var'=>'last_name',
			'option_id'=>'C',
		 ),
		'10' => array(
			'index' => 'M10',
			'label'=> 'Street Address',
			'field_var'=>'addr_line1',
			'option_id'=>'B',
		 ),
	);

	return $data;
}


public static function getTransactionsSearchData()
{
	$data=array(
		'1' => array(
			'index' => 'T1',
			'label'=> 'Transaction Amount',
			'field_var'=>'amount',
			'option_id'=>'A',
		 ),
		'2' => array(
			'index' => 'T2',
			'label'=> 'User From',
			'field_var'=>'`from`',
			'option_id'=>'C',
		 ),
		'3' => array(
			'index' => 'T3',
			'label'=> 'IP Address',
			'field_var'=>'ip_address',
			'option_id'=>'C',
		 ),
		'4' => array(
			'index' => 'T4',
			'label'=> 'From Description',
			'field_var'=>'from_description',
			'option_id'=>'B',
		 ),
		'5' => array(
			'index' => 'T5',
			'label'=> 'Viewed',
			'field_var'=>'viewed',
			'option_id'=>'B',
		 ),
		'6' => array(
			'index' => 'T6',
			'label'=> 'Transaction Id',
			'field_var'=>'transaction_id',
			'option_id'=>'B',
		 ),
		'7' => array(
			'index' => 'T7',
			'label'=> 'User To',
			'field_var'=>'`to`',
			'option_id'=>'C',
		 ),
		'8' => array(
			'index' => 'T8',
			'label'=> 'To Description',
			'field_var'=>'to_description',
			'option_id'=>'B',
		 ),

	);

	return $data;
}



public function getSearchData($id)
{
	$options=array(
		'CONSUMERS_CREDIT_CARD'=>array(
            'class_name'=>'App_Models_Db_Wigi_UserCreditCard',
            'field_name'=>'user_id',
            'has_status'=>1,
            'order_by'=>'date_added desc',
            'view_var_name'=>'consumers_credit_card_data'
        ),
		'CONSUMERS_BANK_ACCOUNTS'=>array(
            'class_name'=>'App_Models_Db_Wigi_UserBankAccount',
            'field_name'=>'user_id',
            'has_status'=>0,
            'order_by'=>'date_added desc',
            'view_var_name'=>'consumers_bank_account_data'
        ),
		'CONSUMERS_MOBILE_INFO'=>array(
            'class_name'=>'App_Models_Db_Wigi_UserMobile',
            'field_name'=>'user_id',
            'has_status'=>0,
            'order_by'=>'date_added desc',
            'view_var_name'=>'consumers_mobile_info_data'
        ),
		'CONSUMERS_TRANSACTIONS'=>array(
            'class_name'=>'App_Models_Db_Wigilog_Transaction',
            'field_name'=>'from_user_id',
            'has_status'=>0,
            'order_by'=>'stamp desc',
            'view_var_name'=>'consumers_transaction_data'
        ),
		'MERCHANT_TRANSACTIONS'=>array(
            'class_name'=>'App_Models_Db_Wigilog_Transaction',
            'field_name'=>'to_user_id',
            'has_status'=>0,
            'order_by'=>'stamp desc',
            'view_var_name'=>'merchants_transaction_data'
        ),
		'MERCHANTS_POS_DEVICE'=>array(
            'class_name'=>'App_Models_Db_Wigi_AuthorizedDevice',
            'field_name'=>'user_id',
            'has_status'=>0,
            'order_by'=>'user_id desc',
            'view_var_name'=>'merchants_pos_device_data'
        ),
		'LOGIN_HISTORY'=>array(
            'class_name'=>'App_Models_Db_Wigi_LoginHistory',
            'field_name'=>'email',
            'has_status'=>0,
            'order_by'=>'login_history_id desc',
            'view_var_name'=>'login_history_data'
        ),
	);

	return $options[$id];
}





}

?>
