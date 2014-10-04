<?php

class App_Order extends App_Models_Db_Wigi_Order {

  public function __construct($orderid=0) {

    parent::__construct();


    if ($orderid > 0) {
      $result = $this->fetchRow(
        $this->select()
          ->where('order_id = ?', $orderid)
      );

      $this->order_id                 = $result->order_id;
      $this->consumer_mobile_id       = $result->consumer_mobile_id;
      $this->merchant_mobile_id       = $result->merchant_mobile_id;
      $this->consumer_user_id         = $result->consumer_user_id;
      $this->merchant_user_id         = $result->merchant_user_id;
      $this->sku                      = $result->sku;
      $this->price                    = $result->price;
      $this->wigi_code                = $result->wigi_code;
      $this->description              = $result->description;      
      $this->merchant_order_id        = $result->merchant_order_id;
      $this->user_acct_no             = $result->user_acct_no;
    }

  }

  public function getOrderId() {
    return $this->order_id;
  }

  public function getConsumerMobileId() { return $this->consumer_mobile_id; }
  public function getMerchantMobileId() { return $this->merchant_mobile_id; }
  public function getConsumerUserId() { return $this->consumer_user_id; }
  public function getMerchantUserId() { return $this->merchant_user_id; }
  public function getSku() {}
  public function getPrice() {}
  public function getWigiCode() { return $this->wigi_code; }
  public function getDescription() {}
  public function getMerchantOrderId() {}

  public function setStatus($status) {
                                $this->update(
                                        array(
                                                'status' => $status,
                                        ),
                                        $this->getAdapter()->quoteInto('order_id = ?', $this->order_id)
                                );

  } 

  public static function getDistinctBusinessName($userid) {
      $t = new App_Models_Db_Wigi_ViewConsumerOrders();;
      $result = $t->fetchAll(
        $t->select()->distinct()->from(array('user_consumer' => 'view_consumer_orders'), 'business_name')
          ->where('consumer_user_id = ?', $userid)
      );

      $a = array();
      foreach ($result as $row) {
	if ($row->business_name === "") { continue; }
        array_push($a,$row->business_name);
      }

      return $a;
  }

  public static function getDistinctBusinessDBAName($userid) {
      $t = new App_Models_Db_Wigi_ViewConsumerOrders();;
      $result = $t->fetchAll(
        $t->select()->distinct()->from(array('user_consumer' => 'view_consumer_orders'), 'business_dba_name')
          ->where('consumer_user_id = ?', $userid)
      );

      $a = array();
      foreach ($result as $row) {
	if ($row->business_dba_name === "") { continue; }
        array_push($a,$row->business_dba_name);
      }

      return $a;


  }

  public static function scanAndBuy($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$sku,$price,$wigicode,$description,$merchant_order_id) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'sku'      => $sku,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'order_type' => 'buy'
            );
            $o = new App_Order();
            return $o->insert($data);
    
  }

  public static function scanAndPay($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$merchant_order_id,$user_acct_no,$status,$date) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'pay',
               'status' => $status,
               'payment_scheduled_date' => $date
            );
            $o = new App_Order();
            return $o->insert($data);

  }

/*  public static function bulkProcessScanAndPay() 
    $o = new App_Order();
    $select = $o->select();
    $select->where("consumer_mobile_id = ?",$p["CONSUMER_MOBILE_ID"]);
    $raw = $t->fetchAll($select);
  }
*/
  public static function updateScanAndPay($id,$date) {
      $o = new App_Order();
      $o->update(
                array(
                      'payment_scheduled_date' => $date
                     ),
                $o->getAdapter()->quoteInto('order_id = ?', $id)
      );
  }

  public static function cancelScanAndPay($id) {
      $o = new App_Order();
      $o->update(
                array(
                      'status' => 'cancelled'
                     ),
                $o->getAdapter()->quoteInto('order_id = ?', $id)
      );
  }

  public static function eCommerce($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$merchant_order_id,$user_acct_no) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'ecommerce',
               'status' => 'completed'
            );
            $o = new App_Order();
            return $o->insert($data);

  }

  public static function donate($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$merchant_order_id,$user_acct_no,$start_date="",$end_date="",$frequency="") {
error_log("CHRIS DATES $start_date $end_date $frequency");
            $status = 'recurring';
            if ($start_date === "") {
              $status = 'completed';
            }

            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'donate',
               'status' => $status,
               'donate_start_date' => $start_date,
               'donate_end_date' => $end_date,
               'donate_frequency' => $frequency
            );
            $o = new App_Order();
            return $o->insert($data);

  }

  public function updateDonate($date,$frequency,$reason,$price) {

      $this->update(
                array(
                      'donate_end_date' => $date,
                      'donate_frequency' => $frequency,
                      'description' => $reason,
                      'price' => $price
                     ),
                $this->getAdapter()->quoteInto('order_id = ?', $this->order_id)
      );
  }

  public function cancelDonate() {
      $this->update(
                array(
                      'status' => 'cancelled'
                     ),
                $this->getAdapter()->quoteInto('order_id = ?', $this->order_id)
      );
  }


  public static function sendPayment($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$message,$merchant_order_id,$user_acct_no,$payment_type_to) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'payment',
               'status' => 'completed',
               'message' => $message,
               'payment_type_to' => $payment_type_to
            );
            $o = new App_Order();
            return $o->insert($data);

  }


  public static function pos($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$merchant_order_id,$user_acct_no,$payment_method) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'pos',
               'status' => 'completed',
               'payment_method' => $payment_method                
            );
            $o = new App_Order();
            return $o->insert($data);

  }

  public static function receive($consumer_mobile_id,$merchant_mobile_id,$consumer_user_id,$merchant_user_id,$price,$wigicode,$description,$merchant_order_id,$user_acct_no) {
            $data = array(
               'consumer_mobile_id'  => $consumer_mobile_id,
               'merchant_mobile_id' => $merchant_mobile_id,
               'consumer_user_id'  => $consumer_user_id,
               'merchant_user_id' => $merchant_user_id,
               'price'    => $price,
               'wigi_code' => $wigicode,
               'description' => $description,
               'merchant_order_id' => $merchant_order_id,
               'stamp' => date('Y-m-d H:i:s'),
               'user_acct_no' =>  $user_acct_no,
               'order_type' => 'receive',
               'status' => 'completed'
            );
            $o = new App_Order();
            return $o->insert($data);

  }


  public static function getConsumerOrders($userid,$p,$type,$page,$rpp,$timezone,$count = false) {
    $u = new App_User($userid);
    $t = new App_Models_Db_Wigi_ViewConsumerOrders();
    $select = $t->select();
	

    if (array_key_exists("CONSUMER_MOBILE_ID",$p)) {
      $select->where("`consumer_mobile_id` = ?",$p["CONSUMER_MOBILE_ID"]);
    }
    if (array_key_exists("DATE_FROM",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_FROM"], $timezone);
      $select->where("`stamp` >= ?",$d);
    }
    if (array_key_exists("DATE_TO",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_TO"], $timezone,'1');
      $select->where("`stamp` < ?",$d);
    }
    if (array_key_exists("AMOUNT_FROM",$p)) {
      $select->where("`price` >= ?",$p["AMOUNT_FROM"]);
    }
    if (array_key_exists("AMOUNT_TO",$p)) {
     $select->where("`price` <= ?",$p["AMOUNT_TO"]);
    }
    if (array_key_exists("CELLPHONE",$p)) {
      $select->where("`cellphone` = ?",$p["CELLPHONE"]);
    }
    if (array_key_exists("STATUS",$p)) {
      $select->where("`status` = ?",$p["STATUS"]);
    }
    if (array_key_exists("BUSINESS_NAME",$p)) {
      $select->where("(`business_name` = ? or `business_dba_name` = ?)",$p["BUSINESS_NAME"]);
    }



    if ($count) {

      $select//->from($t->_name,'COUNT(*) AS num')
         ->where('`consumer_user_id` = ?', $userid)->where('`order_type` = ?',$type);

      $raw = $t->fetchAll($select);
      return count($raw);

    } else {

      $select->where('`consumer_user_id` = ?', $userid)->where('`order_type` = ?',$type)->order("stamp desc")->limit($rpp,$page*$rpp);

	// echo $select;
	 
      $result = $t->fetchAll($select);

      for ($i=0; $i < count($result); $i++) {
          $code = $result[0]->wigi_code;
          $phone = $result[0]->cellphone;
          $result[0]->wigi_code = App_DataUtils::fmtCode($code);
          $result[0]->cellphone = App_DataUtils::fmtphone($phone);
      }

      $clean_result = array();
      foreach ($result as $row) {
        $clean_row = array();

        if (is_file("/u/data/logos/$row->merchant_user_id/logo")) {
          $clean_row['has_logo'] = "true";
        } else {
          $clean_row['has_logo'] = "false";
        }


        foreach ($row as $var => $val) {
          $clean_row[$var] = $val; 
        }

        if (@$clean_row['donate_start_date'] !== "") @$clean_row['donate_start_date'] = App_DataUtils::datetime_fmtdate(@$clean_row['donate_start_date'],$timezone);
        if (@$clean_row['donate_end_date'] !== "") @$clean_row['donate_end_date'] = App_DataUtils::datetime_fmtdate(@$clean_row['donate_end_date'],$timezone);

        array_push($clean_result,$clean_row);
      }
//echo "<pre>";
//print_r($clean_result);
//exit();
      return $clean_result;

    }

  }

  public static function getConsumerOrdersRecurring($userid,$p,$type,$page,$rpp,$timezone,$count = false) {
    $u = new App_User($userid);
    $t = new App_Models_Db_Wigi_ViewConsumerOrders();
    $select = $t->select();
	

    if (array_key_exists("CONSUMER_MOBILE_ID",$p)) {
      $select->where("`consumer_mobile_id` = ?",$p["CONSUMER_MOBILE_ID"]);
    }
    if (array_key_exists("DATE_FROM",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_FROM"], $timezone);
      $select->where("`stamp` >= ?",$d);
    }
    if (array_key_exists("DATE_TO",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_TO"], $timezone,'1');
      $select->where("`stamp` < ?",$d);
    }
    if (array_key_exists("AMOUNT_FROM",$p)) {
      $select->where("`price` >= ?",$p["AMOUNT_FROM"]);
    }
    if (array_key_exists("AMOUNT_TO",$p)) {
     $select->where("`price` <= ?",$p["AMOUNT_TO"]);
    }
    if (array_key_exists("CELLPHONE",$p)) {
      $select->where("`cellphone` = ?",$p["CELLPHONE"]);
    }
    if (array_key_exists("STATUS",$p)) {
      $select->where("`status` = ?",$p["STATUS"]);
    }
    if (array_key_exists("BUSINESS_NAME",$p)) {
      $select->where("`business_name` = ? or `business_dba_name` = ?",$p["BUSINESS_NAME"]);
    }
	$select->where("`donate_frequency` != ?","");
	$select->where("`donate_frequency` != ?","none");
	$select->where("`donate_start_date` < ?","now()");
	//$select->where("`donate_end_date` >= ?","now()");
//echo $select;
//exit();


    if ($count) {

      $select//->from($t->_name,'COUNT(*) AS num')
         ->where('`consumer_user_id` = ?', $userid)->where('`order_type` = ?',$type);

      $raw = $t->fetchAll($select);
      return count($raw);

    } else {

      $select->where('`consumer_user_id` = ?', $userid)->where('`order_type` = ?',$type)->order("stamp desc")->limit($rpp,$page*$rpp);
	 
      $result = $t->fetchAll($select);

      for ($i=0; $i < count($result); $i++) {
          $code = $result[0]->wigi_code;
          $phone = $result[0]->cellphone;
          $result[0]->wigi_code = App_DataUtils::fmtCode($code);
          $result[0]->cellphone = App_DataUtils::fmtphone($phone);
      }

      $clean_result = array();
      foreach ($result as $row) {
        $clean_row = array();

        if (is_file("/u/data/logos/$row->merchant_user_id/logo")) {
          $clean_row['has_logo'] = "true";
        } else {
          $clean_row['has_logo'] = "false";
        }


        foreach ($row as $var => $val) {
          $clean_row[$var] = $val; 
        }
		$clean_row['time_end'] = strtotime($clean_row['donate_end_date']);
        if (@$clean_row['donate_start_date'] !== "") 
			$clean_row['donate_start_date'] = App_DataUtils::datetime_fmtdate(@$clean_row['donate_start_date'],$timezone);
        if ($clean_row['donate_end_date'] !== "") 
			$clean_row['donate_end_date'] = App_DataUtils::datetime_fmtdate($clean_row['donate_end_date'],$timezone);

        array_push($clean_result,$clean_row);
      }
      return $clean_result;

    }

  }
  
  public static function getMerchantOrders($userid,$p,$type,$page,$rpp,$timezone,$count = false) {
    $u = new App_User($userid);
    $mobileid = $u->getDefaultCellphone();
    $t = new App_Models_Db_Wigi_ViewOrders();
    $select = $t->select();


    $s = "";
    if (array_key_exists("USER_ID_MULTIPLE",$p)) {
	    foreach ($p["USER_ID_MULTIPLE"] as $uid) {
	        $s .= " `merchant_user_id` = '$uid' or";
	    }
	    preg_match('/^(.*) or$/', $s, $m);
	    $select->where($m[1] . "?","");
	}

    if (array_key_exists("DATE_FROM",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_FROM"], $timezone);
      $select->where("stamp >= ?",$d);
    }
    if (array_key_exists("DATE_TO",$p)) {
      $d = App_DataUtils::shift_datetime($p["DATE_TO"], $timezone,'1');
      $select->where("stamp < ?",$d);
    }

    if (array_key_exists("AMOUNT_FROM",$p)) {
      $select->where("price >= ?",$p["AMOUNT_FROM"]);
    }
    if (array_key_exists("AMOUNT_TO",$p)) {
      $select->where("price <= ?",$p["AMOUNT_TO"]);
    }
    if (array_key_exists("CELLPHONE",$p)) {
      $cellphone = preg_replace('/\D/', '', $p["CELLPHONE"]);
      $select->where("`cellphone` = ?",$cellphone);
    }
    if (array_key_exists("DEVICE",$p)) {
      $select->where("`device` = ?",$p["DEVICE"]);
    }
    if (array_key_exists("PAYMENT_TYPE_TO",$p)) {
      $select->where("`payment_type_to` = ?",$p["PAYMENT_TYPE_TO"]);
    }
    if (array_key_exists("BUSINESS_NAME",$p)) {
      $select->where("`business_name` LIKE ? or `business_dba_name` LIKE ?","%".$p["PAYMENT_TYPE_TO"]."%");
    }
    if (array_key_exists("STATUS",$p)) {
      $select->where("`status` = ?",$p["STATUS"]);
    }



    if ($count) {

      $select//->from($t->_name,'COUNT(*) AS num')
          ->where('order_type = ?',$type);

      $raw = $t->fetchAll($select);
      return count($raw);

    } else {

      $select->where('order_type = ?',$type)->order("stamp desc")->limit($rpp,$page*$rpp);

      $result = $t->fetchAll($select);

      for ($i=0; $i < count($result); $i++) {
          $code = $result[0]->wigi_code;
          $phone = $result[0]->cellphone;
          $result[0]->wigi_code = App_DataUtils::fmtCode($code);
          $result[0]->cellphone = App_DataUtils::fmtphone($phone);
      }

      if (array_key_exists("DOWNLOAD",$p)) {
        $result_string = ""; 
        foreach ($result as $row) {
          foreach ($row as $var => $val) {
            $result_string .= "$val,";
          }
          $result_string = substr_replace($result_string ,"",-1);
          $result_string .= "\n";
        }
        return $result_string; 
      }

      return $result;
  
    }
  }

  /*public function update($status) {
    //$uinfo = new App_Models_Db_Wigi_Order();
    $this->update(
                              array(
                                    'status' => $status,
                                   ),
                                        $this->getAdapter()->quoteInto('order_id = ?', $this->order_id)
                                );

  }*/

}

?>
