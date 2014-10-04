<?php

class App_Resource  {


  public static function consumerIsAuthorized($type,$userid,$resourceid) {
    switch ($type) {
    case "BANK_ACCOUNT":
        $obj = new App_BankAccount($resourceid);

        if ($userid != $obj->getUserId()) 
          throw new App_Exception_WsException('You are not the owner of this bank account');
        break;
    case "CREDIT_CARD":
        $obj = new App_CreditCard($resourceid);
        if ($userid != $obj->getUserId())
          throw new App_Exception_WsException('You are not the owner of this credit card');
        break;
    case "USER":
        break;
    case "CELLPHONE":
        $obj = new App_Cellphone($resourceid);
        if ($userid != $obj->getUserId())
          throw new App_Exception_WsException('You are not the owner of this cellphone');
        break;
    case "WIGI_CODE":
        break;
    case "ORDER_CONSUMER":
        $obj = new App_Order($resourceid);
        if ($userid != $obj->getConsumerUserId())
          throw new App_Exception_WsException('You are not the owner of this order');
        break;
    case "TRANSACTION":
        break;

    }
  }

  public static function cellphoneIsAuthorized($type,$mobileid,$resourceid) {
    switch ($type) {
    case "MESSAGE":
        $obj = new App_Message($resourceid);
        if ($mobileid != $obj->getMobileId())
          throw new App_Exception_WsException('You are not the owner of this message');
        break;
    case "DOCUMENT":
        $obj = new App_Document($resourceid);
        if ($mobileid != $obj->getMobileId())
          throw new App_Exception_WsException('You are not the owner of this document');
        break;
    case "QUESTION":
        $obj = new App_Question($resourceid);
        if ($mobileid != $obj->getMobileId())
          throw new App_Exception_WsException('You are not the owner of this question');
        break;

    }
  }

}

?>
