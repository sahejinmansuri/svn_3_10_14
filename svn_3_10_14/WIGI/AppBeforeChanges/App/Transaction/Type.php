<?php

class App_Transaction_Type
{

    const SEND_MONEY                   = 100;
    const RECEIVE_MONEY                = 101;
    const SEND_DONATION                = 102;
    const RECEIVE_DONATION             = 103;
    const SEND_INTERNAL_MONEY          = 104;
    const RECEIVE_INTERNAL_MONEY       = 105;
    const SEND_PAYMENT                 = 106;
    const RECEIVE_PAYMENT              = 107;
    const CREATE_WIGI_CODE             = 200;
    const WIGI_CODE_EXPIRED            = 201;
    const REDEEMED_WIGI_CODE_MERCHANT  = 202;
    const REDEEMED_WIGI_CODE_CONSUMER  = 203;
    const WIGI_CODE_DELETED            = 204;
    const SCAN_AND_BUY                 = 205;
    const SCAN_AND_PAY                 = 206;
    const SEND_WGC                     = 207;
    const RECEIVE_WGC                  = 208;
    const ECOMMERCE_MERCHANT           = 209;
    const ECOMMERCE_CONSUMER           = 210;
    const WIGI_CODE_PENDING            = 211;
    const WIGI_CODE_REFUNDED           = 212;
    const SCAN_AND_PAY_MERCHANT        = 213;
    const SCAN_AND_PAY_CONSUMER        = 214;
    const SCAN_AND_BUY_MERCHANT        = 215;
    const SCAN_AND_BUY_CONSUMER        = 216;
    const FUND_FROM_CREDIT_CARD        = 300;
    const WITHDRAW_TO_CREDIT_CARD      = 301;
    const FUND_FROM_BANK_ACCOUNT       = 302;
    const WITHDRAW_TO_BANK_ACCOUNT     = 303;
    const FUND_FROM_CREDIT_CARD_PENDING    = 304;
    const FUND_FROM_BANK_ACCOUNT_PENDING   = 305;
    const CASH_SALE                    = 400;
    const CREDIT_SALE                  = 401;
    const CREDIT_SALE_PENDING          = 402;
    
    private function  __construct() {}
    
    public static function getConstName($c=0) {
        $stat = array();
        $stat[self::SEND_MONEY                   ] = 'Sent Money'; 
        $stat[self::RECEIVE_MONEY                ] = 'Received Money';
        $stat[self::SEND_DONATION                ] = 'Sent Donation';
        $stat[self::RECEIVE_DONATION             ] = 'Received Donation';
        $stat[self::SEND_INTERNAL_MONEY          ] = 'Send Money to Phone';
        $stat[self::RECEIVE_INTERNAL_MONEY       ] = 'Receive Money to Phone'; 
        $stat[self::SEND_PAYMENT                 ] = 'Send Payment';
        $stat[self::RECEIVE_PAYMENT              ] = 'Receive Payment';
        $stat[self::CREATE_WIGI_CODE             ] = 'WGC Created'; 
        $stat[self::WIGI_CODE_EXPIRED            ] = 'WGC Expired'; 
        $stat[self::REDEEMED_WIGI_CODE_MERCHANT  ] = 'WGC Redeemed';
        $stat[self::REDEEMED_WIGI_CODE_CONSUMER  ] = 'WGC Redeemed';
        $stat[self::WIGI_CODE_PENDING            ] = 'WGC Pending';
        $stat[self::WIGI_CODE_REFUNDED           ] = 'WGC Refunded';
        $stat[self::SCAN_AND_BUY                 ] = 'Scan & Buy';
        $stat[self::SCAN_AND_PAY                 ] = 'Scan & Pay';
        $stat[self::SCAN_AND_PAY_MERCHANT        ] = 'Scan & Pay';
        $stat[self::SCAN_AND_PAY_CONSUMER        ] = 'Scan & Pay';
        $stat[self::SEND_WGC                     ] = 'Send WGC';
        $stat[self::RECEIVE_WGC                  ] = 'Receive WGC';
        $stat[self::FUND_FROM_CREDIT_CARD        ] = 'Fund From Credit Card';
        $stat[self::WITHDRAW_TO_CREDIT_CARD      ] = 'Withdraw to Credit Card';
        $stat[self::WIGI_CODE_DELETED            ] = 'WGC Deleted';
        $stat[self::FUND_FROM_BANK_ACCOUNT       ] = 'Fund From Bank Account';
        $stat[self::WITHDRAW_TO_BANK_ACCOUNT     ] = 'Withdraw to Bank Account'; 
        $stat[self::FUND_FROM_CREDIT_CARD_PENDING      ] = 'Fund from credit card pending';
        $stat[self::FUND_FROM_BANK_ACCOUNT_PENDING     ] = 'Fund from bank account pending';
        $stat[self::CASH_SALE                    ] = 'Cash sale';
        $stat[self::CREDIT_SALE                  ] = 'Credit sale';
        $stat[self::CREDIT_SALE_PENDING          ] = 'Credit sale pending';
        $stat[self::ECOMMERCE_MERCHANT           ] = 'Ecommerce';
        $stat[self::ECOMMERCE_CONSUMER           ] = 'Ecommerce';
        return ($c)?$stat[$c]:$stat;
   }



}
