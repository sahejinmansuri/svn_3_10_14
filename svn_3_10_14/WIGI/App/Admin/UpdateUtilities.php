<?php

/**
 * UpdateUtilities holds information about every update/edit feature available in Admin Wigi
 *
 * @author hitesh jain
 */

class App_Admin_UpdateUtilities {


    /* IMPORTANT DOCUMENTATION: DO NOT DELETE! 
        This function returns every bit of information needed for any insert/update in admin wigi. 
       1. Key in each of the array element is the feature that is available in admin wigi.
       2. 'section_label' => label displayed on the feature header -- Lock Account etc. 
       3. db_class => is the db object required to fetch and update the data. May be overwritten.
       4. call_back => This function would be checked for, when data would be updated/saved in the db table. IF a call back function is present, input data can be manipulated and updated/inserted as desired. If it is not available, then data would be prepared and updated using plain update stmt.
       5. preload_call_back => This would be checked when data would be preloaded. For example, while updating the preferences, we need to get the prefs json from db and manipulate it. This manipulation can be done in this preload_call_back function and data can be prepopulated when update screen shows up. 
       6. datefield and userfield are the fields of the db table which would be updated everytime a update occurs. Since different tables have different data modified and user modified fieldnames, hence this is needed.
       7. inputs => Array which would hold the fields that are allowed for updates. Each record will have the input field name (should match the db table field name, label that would be displayed against the field, field type -- currently text and radio button supported. In case of radio button - field value is mandatory as this value would be updated in the db table. For example, if one wants to update the status of a merchant, status can take locked/deleted/active etc values. On the lock Merchant screen, if one locks the user, value would be set as 'locked' --> and this value would come from field_value field in inputs record.
       8. preload_data -> This would guide if data needs to be preloaded when update screen is brought up. For example, when editing merchant information, this flag needs to be true to show the current info. For editing pwd or PINs etc, this should be false as we do not want to pre populate any field.
    */

    public static function getConsumerInputs($section)
    {
        $sections = array(
          'lock'=>array(
                'section_label'=>'Lock Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Lock Account',
                        'field_type' => 'radio',
                        'field_value' => 'locked',
                    ),
                ),
            ),
           'activate'=>array(
                'section_label'=>'Activate Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Activate Account',
                        'field_type' => 'radio',
                        'field_value' => 'active',
                    ),
                ),
            ),
           'delete'=>array(
                'section_label'=>'Delete Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'deleteConsumerAccount',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Delete Account',
                        'field_type' => 'radio',
                        'field_value' => 'deleted',
                    ),
                ),
            ),
           'password'=>array(
                'section_label'=>'Update Password',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'checkUpdatePasswd',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    /*1=>array(
                        'input_field'=>'old_password',
                        'input_label'=>'Old Password',
                        'field_type' => 'text',
                    ),*/
                    1=>array(
                        'input_field'=>'password',
                        'input_label'=>'New Password',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'password2',
                        'input_label'=>'Password Confirm',
                        'field_type' => 'text',
                    ),
                ),
            ),
            'profile'=>array(
                'section_label'=>'Update Consumer Information', // User for Save Button
                'db_class'=>'App_Models_Db_Wigi_User', // Used for DB Interaction
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'', // Call back function once task is over to alert user etc.
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'first_name',
                        'input_label'=>'Legal First Name',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'last_name',
                        'input_label'=>'Legal Last Name',
                        'field_type' => 'text',
                    ),
                    3=>array(
                        'input_field'=>'email',
                        'input_label'=>'Email',
                        'field_type' => 'text',
                    ),
                    4=>array(
                        'input_field'=>'alternate_phone',
                        'input_label'=>'Alternate Phone',
                        'field_type' => 'text',
                    ),
                    5=>array(
                        'input_field'=>'alternate_email',
                        'input_label'=>'Alternate Email',
                        'field_type' => 'text',
                    ),
                    6=>array(
                        'input_field'=>'kyc',
                        'input_label'=>'KYC',
                        'field_type' => 'radio',
                    ),
                ),
            ),
           'preferences'=>array(
                'section_label'=>'Edit Consumer Preferences',
                'db_class'=>'App_Prefs',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'checkUpdateConsumerPrefs',
                'preload_data'=>1, 
                'preload_call_back'=>'getConsumerPrefs',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    2=>array(
                        'input_field'=>'system_timeout',
                        'input_label'=>'Mobile App Timeout (seconds)',
                        'field_type' => 'text',
                    ),
                    3=>array(
                        'input_field'=>'wigi_international_trans',
                        'input_label'=>'International Transfers',
                        'field_type' => 'radio',
                    ),
                    4=>array(
                        'input_field'=>'notification_alert',
                        'input_label'=>'Alerts Via',
                        'field_type' => 'text',
                    ),
                    6=>array(
                        'input_field'=>'wigi_max_per_trans',
                        'input_label'=>'Max Amt/Transaction ($)',
                        'field_type' => 'text',
                    ),
                    7=>array(
                        'input_field'=>'wigi_max_per_day',
                        'input_label'=>'Max #of Transactions/Day',
                        'field_type' => 'text',
                    ),
                    8=>array(
                        'input_field'=>'wigi_timeout',
                        'input_label'=>'Payment Code Timeout (mins)',
                        'field_type' => 'text',
                    ),
                    9=>array(
                        'input_field'=>'gift_max_per_trans',
                        'input_label'=>'Gift Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    10=>array(
                        'input_field'=>'gift_max_per_day',
                        'input_label'=>'Gift Max Trans/Day (#)',
                        'field_type' => 'text',
                    ),
                    11=>array(
                        'input_field'=>'scan_max_per_trans',
                        'input_label'=>'Scan Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    12=>array(
                        'input_field'=>'scan_max_per_day',
                        'input_label'=>'Scan Max Amt/Day ($)',
                        'field_type' => 'text',
                    ),
                    13=>array(
                        'input_field'=>'funding_max_per_trans',
                        'input_label'=>'Funding Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    14=>array(
                        'input_field'=>'funding_max_per_day',
                        'input_label'=>'Funding Max Amt/Day ($)',
                        'field_type' => 'text',
                    ),
               
                ),
            ),
           'questions'=>array(
                'section_label'=>'Update Security Question',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'question',
                        'input_label'=>'Enter a Question',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'answer',
                        'input_label'=>'Enter a Answer',
                        'field_type' => 'text',
                    ),
                ),
            ),
        );

        
        return $sections[$section]?$sections[$section]:0;
    }




    public static function getMerchantInputs($section)
    {
        $sections = array(
           'bankac_delete'=>array(
                'section_label'=>'Delete Bank Account',
                'db_class'=>'App_Models_Db_Wigi_UserBankAccount',
                'db_field' => 'user_id',
                'db_child_field' => 'user_bank_account_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Delete Bank Account',
                        'field_type' => 'radio',
                        'field_value' => 'deleted',
                    ),
                ),
            ),
           'bankac_activate'=>array(
                'section_label'=>'Activate Bank Account',
                'db_class'=>'App_Models_Db_Wigi_UserBankAccount',
                'db_field' => 'user_id',
                'db_child_field' => 'user_bank_account_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Activate Bank Account',
                        'field_type' => 'radio',
                        'field_value' => 'active',
                    ),
                ),
            ),
           'activate'=>array(
                'section_label'=>'Activate Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Activate Account',
                        'field_type' => 'radio',
                        'field_value' => 'active',
                    ),
                ),
            ),
           'lock'=>array(
                'section_label'=>'Lock Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Lock Account',
                        'field_type' => 'radio',
                        'field_value' => 'locked',
                    ),
                ),
            ),
           'delete'=>array(
                'section_label'=>'Delete Account',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Delete Account',
                        'field_type' => 'radio',
                        'field_value' => 'deleted',
                    ),
                ),
            ),
           'password'=>array(
                'section_label'=>'Update Password',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'checkUpdatePasswd',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    /*1=>array(
                        'input_field'=>'old_password',
                        'input_label'=>'Old Password',
                        'field_type' => 'text',
                    ),*/
                    1=>array(
                        'input_field'=>'password',
                        'input_label'=>'New Password',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'password2',
                        'input_label'=>'Password Confirm',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'pin'=>array(
                'section_label'=>'Change PIN',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'checkUpdatePin',
                'preload_data'=>0, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'login_code',
                        'input_label'=>'Old Pin',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'login_code',
                        'input_label'=>'New PIN',
                        'field_type' => 'text',
                    ),
                    3=>array(
                        'input_field'=>'login_code',
                        'input_label'=>'Confirm PIN',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'preferences'=>array(
                'section_label'=>'Edit Merchant Preferences',
                'db_class'=>'App_Prefs',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'checkUpdatePrefs',
                'preload_data'=>1, 
                'preload_call_back'=>'getMerchantPrefs',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'cash',
                        'input_label'=>'POS Cash Payments',
                        'field_type' => 'radio',
                    ),
                    2=>array(
                        'input_field'=>'creditcard',
                        'input_label'=>'POS Credit Card Payments',
                        'field_type' => 'radio',
                    ),
                    3=>array(
                        'input_field'=>'scanandpay',
                        'input_label'=>'Scan & Pay payments',
                        'field_type' => 'radio',
                    ),
                    4=>array(
                        'input_field'=>'scanandbuy',
                        'input_label'=>'Scan & Buy payments',
                        'field_type' => 'radio',
                    ),
                    5=>array(
                        'input_field'=>'ecommerce',
                        'input_label'=>'eCommerce payments',
                        'field_type' => 'radio',
                    ),
                    6=>array(
                        'input_field'=>'possecret',
                        'input_label'=>'POS Secret',
                        'field_type' => 'text',
                    ),
                    7=>array(
                        'input_field'=>'salestax',
                        'input_label'=>'Sales Tax',
                        'field_type' => 'text',
                    ),
                    8=>array(
                        'input_field'=>'tips',
                        'input_label'=>'Tips ₹$',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'questions'=>array(
                'section_label'=>'Update Security Question',
                'db_class'=>'App_Models_Db_Wigi_User',
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'question',
                        'input_label'=>'Enter a Question',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'answer',
                        'input_label'=>'Enter a Answer',
                        'field_type' => 'text',
                    ),
                ),
            ),
            'profile'=>array(
                'section_label'=>'Update Merchant Information', // User for Save Button
                'db_class'=>'App_Models_Db_Wigi_User', // Used for DB Interaction
                'db_field' => 'user_id',
                'db_child_field' => '',
                'call_back'=>'', // Call back function once task is over to alert user etc.
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'business_name',
                        'input_label'=>'Official Business Name',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'business_dba_name',
                        'input_label'=>'Business DBA name',
                        'field_type' => 'text',
                    ),
                    3=>array(
                        'input_field'=>'first_name',
                        'input_label'=>'Contact First Name',
                        'field_type' => 'text',
                    ),
                    4=>array(
                        'input_field'=>'last_name',
                        'input_label'=>'Contact Last Name',
                        'field_type' => 'text',
                    ),
                    5=>array(
                        'input_field'=>'business_phone',
                        'input_label'=>'Business Phone',
                        'field_type' => 'text',
                    ),
                    6=>array(
                        'input_field'=>'business_type',
                        'input_label'=>'Business Type',
                        'field_type' => 'text',
                    ),
                    7=>array(
                        'input_field'=>'business_tax_id',
                        'input_label'=>'Tax ID or SSN',
                        'field_type' => 'text',
                    ),
                    8=>array(
                        'input_field'=>'501c',
                        'input_label'=>'501(c)(3) Registration',
                        'field_type' => 'text',
                    ),
                    9=>array(
                        'input_field'=>'business_url',
                        'input_label'=>'Business Url',
                        'field_type' => 'text',
                    ),
                    10=>array(
                        'input_field'=>'alternate_phone',
                        'input_label'=>'Alternate Phone',
                        'field_type' => 'text',
                    ),
                    11=>array(
                        'input_field'=>'alternate_email',
                        'input_label'=>'Alternate Email',
                        'field_type' => 'text',
                    ),
                ),
            ),
        );

        
        return $sections[$section]?$sections[$section]:0;

    }

    public static function getMobileInputs($section='notavailable')
    {
        $sections = array(
          'lock'=>array(
                'section_label'=>'Lock Mobile',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, 
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Lock Mobile',
                        'field_type' => 'radio',
                        'field_value' => 'locked',
                    ),
                ),
            ),
          'activate'=>array(
                'section_label'=>'Activate Mobile',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, 
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Activate Mobile',
                        'field_type' => 'radio',
                        'field_value' => 'active',
                    ),
                ),
            ),
          'unlock'=>array(
                'section_label'=>'Unlock Mobile',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, 
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Unlock Mobile',
                        'field_type' => 'radio',
                        'field_value' => 'active',
                    ),
                ),
            ),
          'delete'=>array(
                'section_label'=>'Delete Mobile',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, 
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Delete Mobile',
                        'field_type' => 'radio',
                        'field_value' => 'deleted',
                    ),
                ),
            ),
          'suspend'=>array(
                'section_label'=>'Suspend Mobile',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_call_back'=>'',
                'preload_data'=>0, 
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'status',
                        'input_label'=>'Suspend Mobile',
                        'field_type' => 'radio',
                        'field_value' => 'suspended',
                    ),
                ),
            ),
           'questions'=>array(
                'section_label'=>'Update Security Question',
                'db_class'=>'App_Models_Db_Wigi_Question',
                'db_field' => 'mobile_id',
                'db_child_field' => '',
                'call_back'=>'',
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
				'is_array_input' => 1,
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'question',
                        'input_label'=>'Enter a Question',
                        'field_type' => 'text',
                    ),
                    2=>array(
                        'input_field'=>'answer',
                        'input_label'=>'Enter a Answer',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'name'=>array(
                'section_label'=>'Update Phone Name',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'alias',
                        'input_label'=>'Update Phone Name',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'pin'=>array(
                'section_label'=>'Update Phone PIN',
                'db_class'=>'App_Models_Db_Wigi_UserMobile',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'',
                'preload_data'=>1, // Pre load the data true or false
                'preload_call_back'=>'',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    1=>array(
                        'input_field'=>'pin',
                        'input_label'=>'Update PIN',
                        'field_type' => 'text',
                    ),
                ),
            ),
           'preferences'=>array(
                'section_label'=>'Edit Mobile Preferences',
                'db_class'=>'App_Prefs',
                'db_field' => 'user_id',
                'db_child_field' => 'mobile_id',
                'call_back'=>'checkUpdateMobilePrefs',
                'preload_data'=>1, 
                'preload_call_back'=>'getMobilePrefs',
                'datefield'=>'date_changed',
                'userfield'=>'user_changed',
                'inputs'=>array(
                    2=>array(
                        'input_field'=>'system_timeout',
                        'input_label'=>'Mobile App Timeout (seconds)',
                        'field_type' => 'text',
                    ),
                    3=>array(
                        'input_field'=>'wigi_international_trans',
                        'input_label'=>'International Transfers',
                        'field_type' => 'radio',
                    ),
                    4=>array(
                        'input_field'=>'notification_alert',
                        'input_label'=>'Alerts Via',
                        'field_type' => 'text',
                    ),
                    6=>array(
                        'input_field'=>'wigi_max_per_trans',
                        'input_label'=>'Max Amt/Transaction ($)',
                        'field_type' => 'text',
                    ),
                    7=>array(
                        'input_field'=>'wigi_max_per_day',
                        'input_label'=>'Max #of Transactions/Day',
                        'field_type' => 'text',
                    ),
                    8=>array(
                        'input_field'=>'wigi_timeout',
                        'input_label'=>'Payment Code Timeout (mins)',
                        'field_type' => 'text',
                    ),
                    9=>array(
                        'input_field'=>'gift_max_per_trans',
                        'input_label'=>'Gift Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    10=>array(
                        'input_field'=>'gift_max_per_day',
                        'input_label'=>'Gift Max Trans/Day (#)',
                        'field_type' => 'text',
                    ),
                    11=>array(
                        'input_field'=>'scan_max_per_trans',
                        'input_label'=>'Scan Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    12=>array(
                        'input_field'=>'scan_max_per_day',
                        'input_label'=>'Scan Max Amt/Day (#)',
                        'field_type' => 'text',
                    ),
                    13=>array(
                        'input_field'=>'funding_max_per_trans',
                        'input_label'=>'Funding Max Amt/Trans ($)',
                        'field_type' => 'text',
                    ),
                    14=>array(
                        'input_field'=>'funding_max_per_day',
                        'input_label'=>'Funding Max Amt/Day (#)',
                        'field_type' => 'text',
                    ),
                ),
            ),
        );

        return (isset($sections[$section]))?$sections[$section]:$sections;
    }

}

?>
