<?php

class App_Constants extends Atlasp_App_Constants
{

    /**
     * @var array 
     */
    protected static $_formData = array(
        'labels' => array(
            'USERNAME' => 'Username',
            'LOGIN' => 'Username',
            'LOGINID' => 'Login ID',
            'PASSWORD' => 'Password',
            'PASSWD'   => 'Password',
            'COMPANY' => 'Company',
            'SMS_AUTH_CODE' => 'SMS Authentication Code',
            'CODE' => 'Code',
            'UID' => 'User Id',
            //
            'SESSION_ID' => 'Session ID',
            'DEVICE_ID' => 'Device ID',
            //
            'FIRST_NAME' => 'First Name',
            'MIDDLE_NAME' => 'Middle Name',
            'LAST_NAME' => 'Last Name',
            'OTHER_FIRST_NAME' => 'Other First Name',
            //
            'ADDRESS' => 'Address',
            'ADDR'    => 'Address',
            'ADDRESS2' => 'Address2',
            'STREET_ADDRESS' => 'Street Address',
            'CITY' => 'City',
            'OTHER_CITY' => 'Other City',
            'COUNTY' => 'County',
            'STATE' => 'State',
            'OTHER_STATE' => 'Other State',
            'ZIP' => 'Zip Code',
            'ZIP_CODE' => 'Zip Code',
            'COUNTY' => 'County',
            'RADIUS' => 'Radius',
            //
            'PHONE' => 'Phone',
            'EMAIL' => 'Email',
            'YEAR' => 'Year',
            'MONTH' => 'Month',
            'DAY' => 'Day',
            'PAGE' => 'Page',
            'DATE' => 'Date',

            'BANK'             => 'Bank',
            'CELLPHONE'        => 'Cellphone Number',
            'COUNTRY'          => 'Country Code',
            'COUNTRY_CODE'     => 'Country Code',
            'COUNTRYCODE'      => 'Country Code',
            'CODE'             => 'Verification Code',
            'ANSWER'           => 'Security Answer',
            'QUESTION'         => 'Security Question',
            'PIN'              => 'Pin',
            'TYPE'             => 'Type',
            'OSID'             => 'Osid',
            'BUSINESS_TYPE'    => 'Business Type',
            'BUSINESS_NAME'    => 'Business Name',
            'BUSINESS_TAX_ID'  => 'Business Tax ID',
            'BUSINESS_PHONE'   => 'Business Phone',
            'BUSINESS_DBA_NAME'=> 'Business DBA Name',
            'BUSINESS_URL'=> 'Business URL',
            'BIRTHDATE'        => 'Birth Date',
            'AMOUNT'           => 'Amount',
            'CREDITCARD'       => 'Credit Card',
            'CVV2'             => 'Cvv',
            'CCID'             => 'Credit Card Id',
            'DESCRIPTION'      => 'Description',
            'EXPIRATION'       => 'Expiration',
            'EXP'              => 'Expiration',
            'NAME_ON_CARD'     => 'Name on Card',
            'NAME'             => 'Name',
            'MESSAGE'          => 'Message',
            'MINBAL'           => 'Minimum Balance',
            'NEWPIN'           => 'New Pin',
            'OLDPIN'           => 'Old Pin',
            'RECEIPT_METHOD'   => 'Receipt Method',
            'STATEMENT_METHOD' => 'Statment Metho',
            'TO'               => 'To',
            'ID'               => 'Id',
            'WIGICODE_TIMEOUT' => 'Wigicode Timeout',
            'BIRTHDATE'        => 'Birth Date',
            'REASON'           => 'Reason',
            'WIGICODE'         => 'WiGi Code',
            'MERCHANTID'       => 'Merchant ID',
            'ALERT_METHOD'     => 'Alert Method',
            'WIGICODE_TIMEOUT' => 'WiGi Code Timeout',
            'INTERNATIONAL_TRANS' => 'International Transactions',
            'MAX_WIGI_AMT_TXN' => 'Max Amount Per WiGi Transaction',
            'MAX_WIGI_AMT_DAY' => 'Max Amount of WiGi Transactions Per Day',
            'MAX_GIFT_AMT_TXN' => 'Max Amount Per Gift',
            'MAX_GIFT_AMT_DAY' => 'Max Amount of Gifts Per Day',
            'MAX_FUND_AMT_TXN' => 'Max Amount Per Funding',
            'MAX_FUND_AMT_DAY' => 'Max Amount of Fundings Per Day',
            'SESSION_TIMEOUT'  => 'Session Timeout',
            'TIMEZONE'         => 'Timezone',
            'MESSAGEID'        => 'Message ID',
            'DOCTYPE'          => 'Document Type',
            'DOCID'            => 'Document ID',
            'NUMBER'           => 'Number',
            'EXPIRES'          => 'Expires',
            'TRANSACTIONID'    => 'Transaction ID',
            'ACCOUNT'          => 'Account',
            'ITEM'             => 'Item',
            'SEARCH'           => 'Search Term',
            '501C'             => '501 c',
            'STATE_OF_INC'     => 'State of Incorporation',
            'CATEGORY'         => 'Category',
            'CCODE'            => 'Country Code',
            'SENDTC'           => 'Send Terms & Conditions',
            'MERCHANT_NUMBER'  => 'Merchant number',
            'PAYMENT_TYPE'     => 'Payment type',
            'DOCUMENT_NUMBER'  => 'Document Number',
            'DEVICETOD'        => 'Device Time of Day',
            'APPVERSION'       => 'App Version',
            'DEVICEMODEL'      => 'Device Model',
            'SYSTEMNAME'       => 'System Name',
            'SYSTEMVERSION'    => 'System Version',
            'GPS'              => 'GPS',
            'APPNAME'          => 'App Name',
            'LANGUAGE'         => 'Language',
            'TOSID'            => 'Terms and Conditions',
            'PHONE_BRAND'      => 'Phone Brand',
            'STAX'             => 'Sales Tax',
            'TIPS'             => 'Tips',
            'DNAME'            => 'Device Name',
            'TIPVAL'           => 'Tip Value',
            'TRANS_ID'         => 'Transaction ID',
            'SALESTAX'         => 'Sales Tax',
            'TIP'              => 'Tip',
            'ORIG_CHARGE'      => 'Original Charge Amount',
            'LATLONG'          => 'GPS Coordinates',
            'QRCODE'           => 'Code',
            'SKU'              => 'Sku',
            'ACCT_NO'          => 'Account Number',
            'INVOICE_NO'       => 'Invoice Number',
            'MERCHANT_ID'      => 'Merchant ID',
            'QTY'              => 'Qty',
            'IDENTIFIER'       => 'Identifier',
            'SECRET'           => 'Secret',
            'DOCUMENT'         => 'Document',
            'DOCTYPE'          => 'Document Type',
            'DOCDESC'          => 'Document Description',
            'DOCNUM'           => 'Document Number',
            'DOCEXP_YEAR'      => 'Document Expiration Year',
            'DOCEXP_MONTH'     => 'Document Expiration Month',
            'DOCEXP_DAY'       => 'Document Expiration Day',
            'MOBILEID'         => 'Mobile Id',
            'MSGTYPE'      => 'Message Type',
            'DESC'         => 'Description',
            'END_DATE'     => 'End Date',
            'FREQUENCY'    => 'Frequency'
        )
    );

}