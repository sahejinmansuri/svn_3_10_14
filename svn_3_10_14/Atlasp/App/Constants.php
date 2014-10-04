<?php
class Atlasp_App_Constants
{
    protected static $_formData = array(
        'labels' => array(
			'USER'			   => 'User',
			'NATIONALITY'		=> 'Nationality',
			'GENDER'			=> 'Gender',
			'MARITAL_STATUS'	=> 'Marital Status',
            'FIELD'            => 'Field',
            'USERNAME'         => 'Username',
            'PASSWORD'         => 'Password',
            'VCHAR'            => 'Verification Characters',
            'LAST_NAME'        => 'Last Name',
            'FIRST_NAME'       => 'First Name',
            'MIDDLE_NAME'      => 'Middle Name',
            'DOB'              => 'DOB',
            'STREET_ADDRESS'   => 'Street Address',
            'ADDRESS'          => 'Address',
            'ADDRESS2'         => 'Address2',
            'CITY'             => 'City',
            'COUNTY'           => 'County',
            'STATE'            => 'State',
            'ZIP'              => 'Zip Code',
            'ZIP_CODE'         => 'Zip Code',
            'COUNTY'           => 'County',
            'RADIUS'           => 'Radius',
            'TITLE'            => 'Title',
            'PHONE'            => 'Phone',
            'EMAIL'            => 'Email',
            'CONFIRM_EMAIL'    => 'Confirm Email',
            'LOGINID'          => 'Login ID',
            'CONFIRM_PASSWORD' => 'Confirm Password',
            'CURRENT_PASSWORD' => 'Current Password',
            'NEW_PASSWORD'     => 'New Password',
            'BUSINESS_TYPE'    => 'Business Type',
            'BUSINESS_NAME'    => 'Business Name',
            'BUSINESS_TAX_ID'  => 'Business Tax ID',
            'BUSINESS_PHONE'   => 'Business Phone',
            'BUSINESS_URL'     => 'Business Url',
            'BIRTHDATE'        => 'Birthdate',
            'AMOUNT'           => 'Amount',
            'TO'               => 'To',
            'MESSAGE'          => 'Message',
            'COUNTRYCODE'      => 'Country Code',
            'REASON'           => 'Reason',
            'WIGICODE'         => 'WiGi Code',
            'MERCHANTID'       => 'Merchant ID',
            'TRANSACTIONID'    => 'Transaction ID',
            'TYPE'             => 'Type',
            'ID'               => 'ID',
            'PIN'              => 'PIN',
            'OLDPIN'           => 'Old PIN',
            'NEWPIN'           => 'New PIN',
            'MESSAGEID'        => 'Message ID',
            'DOCTYPE'          => 'Document Type',
            'DESCRIPTION'      => 'Description',
            'NUMBER'           => 'Number',
            'EXPIRES'          => 'Expires',
            'DOCID'            => 'Document ID',
            'ACCOUNT'          => 'Account',
            'ITEM'             => 'Item',
            'SEARCH'           => 'Search Term',
            '501C'             => '501 c',
            'STATE_OF_INC'     => 'State of Incorporation',
            'CATEGORY'         => 'Category',
            'CCODE'            => 'Country Code',
            'SENDTC'           => 'Send Terms & Conditions',
            'DATE'             => 'Date',
            'ID'               => 'ID',
			'SUBMENUID'        => 'SUBMENUID',
            'MENUID'         => 'MENUID',
            'TITLE'         => 'TITLE',
            'RATE'           => 'RATE',
            'QUANITTY'         => 'QUANITTY',
            'CPIN'         => 'CPIN',
            'ROLE'         => 'ROLE',
            'VIEW_PROFILE_INDEX'         => 'VIEW_PROFILE_INDEX',
            'CHNAGE_PIN_INDEX'         => 'CHNAGE_PIN_INDEX',
            'ADD_MONEY_INDEX'         => 'ADD_MONEY_INDEX',
            'WITHDRAW_MONEY_INDEX'         => 'WITHDRAW_MONEY_INDEX',
            'CHANGE_QUESTION_INDEX'         => 'CHANGE_QUESTION_INDEX',
            'LOCK_CELL_INDEX'         => 'LOCK_CELL_INDEX',
            'MOBILE'         => 'MOBILE',
			
        ),

        'default_patterns' => array(
            'COMPANY_NAME'   => 'company',
            'LAST_NAME'      => 'name',
            'FIRST_NAME'     => 'name',
            'MI'             => 'name',
            'START_DATE'     => 'date_d',
            'END_DATE'       => 'date_d',
            'STREET_ADDRESS' => 'address',
            'ADDRESS2'       => 'address',
            'CITY'           => 'city',
            'STATE'          => 'state',
            'ZIP'            => 'zip',
            'SSN'            => 'ssn',
            'SESSION_ID'     => 'session',
            'CURRENT_EVENT'  => 'event',
            'EVENT'          => 'event',
            'FULL_NAME'      => 'name',
            'ACTION_MISC'    => 'event',
            'RECID'          => 'recid',
            'REFERENCE_CODE' => 'name',
            'ACTION_REPORT'  => 'event',
            '_SSV'           => 'cookie',
            'FIELD'          => 'generic',
            'BIRTHDATE'      => 'generic',
            'TO'             => 'phone',
            'MESSAGE'        => 'generic',
            'REASON'         => 'generic',
            'TYPE'           => 'int',
            'ID'             => 'int',
            'PIN'            => 'pin',
            'OLDPIN'         => 'pin',
            'NEWPIN'         => 'pin',
            'ITEM'           => 'generic',
            'SEARCH'         => 'generic',
        ),
    );

    public static function getDefaultPattern($postParam)
    {
        return static::$_formData['default_patterns'][$postParam];
    }

    public static function getFormLabel($postParam)
    {
        return static::$_formData['labels'][$postParam];
    }

    private function __construct() {}
    private function __clone() {}
}
