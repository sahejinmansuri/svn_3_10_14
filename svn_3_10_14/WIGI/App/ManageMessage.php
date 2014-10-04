<?php

class App_ManageMessage extends App_Models_Db_Wigi_Message {

  public function __construct($message_id=0) {

    parent::__construct();


    if ($message_id > 0) {
      $result = $this->fetchRow(
        $this->select()
          ->where('message_id = ?', $message_id)
      );

      $this->support_id                 = $result->support_id;
      $this->user_id                    = $result->user_id;
      $this->message                    = $result->message;
      $this->status                     = $result->status;
    }

  }

  public function getSupportId() { return $this->support_id; }
  public function getUserId()    { return $this->user_id; }
  public function getMessage()   { return $this->message; }
  public function getStatus()    { return $this->status; }

  public function deleteMessage() {
      $this->delete(
        $this->getAdapter()->quoteInto('support_id = ?', $this->support_id)
      );
  }

  public static function deleteMessages($userid) {

    $t = new App_Models_Db_Wigi_UserMobileMessage();
    $t->delete(
        $t->getAdapter()->quoteInto('user_id = ?', $userid)
    );
  }


  public function setStatus($status) {
                                $this->update(
                                        array(
                                                'status' => $status,
                                        ),
                                        $this->getAdapter()->quoteInto('support_id = ?', $this->support_id)
                                );

  } 

  public static function createSupport($user_id,$message,$category) {
            $data = array(
               'user_id'  => $user_id,
               'message'  => $message,
               'category' => $category,
            );
            $s = new App_Support();
            return $s->insert($data);

  }

public static function getWigiMessages($params)
{
        $t = new App_Models_Db_Wigi_Message();
        $select = $t->select();
		
		$select->order('message_id desc');
        $raw = $t->fetchAll($select);
		return $raw->toArray();
}


  public static function getSupportTickets($p,$page,$rpp,$count = false) {
    $t = new App_Models_Db_Wigi_ViewSupportTickets();
    $select = $t->select();


    /*if (array_key_exists("DATE_FROM",$p)) {
      $select->where("stamp >= ?",$p["DATE_FROM"]);
    }
    if (array_key_exists("DATE_TO",$p)) {
      $select->where("stamp <= ?",$p["DATE_TO"]);
    }*/
    if (array_key_exists("STATUS",$p)) {
      $select->where("`status` = ?",$p["STATUS"]);
    }

    if ($count) {

      //$select//->from($t->_name,'COUNT(*) AS num')

      $raw = $t->fetchAll($select);
      return count($raw);

    } else {

      //$select->where('consumer_user_id = ?', $userid)->where('order_type = ?',$type)->order("stamp desc")->limit($rpp,$page*$rpp);

      $result = $t->fetchAll($select);

      for ($i=0; $i < count($result); $i++) {
          $phone = $result[0]->cellphone;
          $result[0]->cellphone = App_DataUtils::fmtphone($phone);
      }

      return $result;

    }

  }

}

?>
