<?php

class App_Message extends App_Models_Db_Wigi_UserMobileMessage {

  public function __construct($id=0) {

    parent::__construct();


    if ($id > 0) {
      $result = $this->fetchRow(
        $this->select()
          ->where('user_mobile_message_id = ?', $id)
      );

      $this->user_mobile_message_id   = $result->user_mobile_message_id;
      $this->message_id               = $result->message_id;
      $this->mobile_id                = $result->mobile_id;
    }

  }

  public function getUserMobileMessageId() {
    return $this->user_mobile_message_id;
  }

  public function getMessageId() {
    return $this->message_id;
  }

  public function getMobileId() {
    return $this->mobile_id;
  }

  public function deleteMessage() {
      $this->delete(
        $this->getAdapter()->quoteInto('user_mobile_message_id = ?', $this->user_mobile_message_id)
      );
  }

  public static function deleteMessages($mobileid) {

    $t = new App_Models_Db_Wigi_UserMobileMessage();
    $t->delete(
        $t->getAdapter()->quoteInto('mobile_id = ?', $mobileid)
    );
  }


  public static function getMessages($mobileid) {

    $t = new App_Models_Db_Wigi_ViewGetMessages();

    $result = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $mobileid)
    );

    return $result;
  }

  public static function getNewMessageCount($mobileid) {

    $t = new App_Models_Db_Wigi_ViewGetMessages();

    $result = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $mobileid)->where('status = ?', "unread")
    );

    return count($result);
  }


  public static function create($subject,$message,$status,$type) {
      $sp = new App_Db_Sp_CreateMessage();
      $result = $sp->getSimpleResponse(array('MESSAGE'=>$message,'SUBJECT'=>$subject,'STATUS'=>$status,'TYPE'=>$type,));
      return $result['@p_res'];

  }

  public static function send($mobileid,$messageid) {
      $sp = new App_Db_Sp_SendMessage();
      $result = $sp->getSimpleResponse(array('MESSAGE_ID'=>$messageid,'MOBILE_ID'=>$mobileid));
      return true;
  }
}
?> 
