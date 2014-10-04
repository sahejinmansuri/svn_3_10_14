<?php

class App_Report {

  public static function search($p,$timezone,$showfields,$count=false,$download=false,$headers=true) {
  
    $t = new App_Models_Db_Wigilog_ViewMerchantTransactions();
    $select = $t->select();

    if (array_key_exists("GROUP_BY",$p)) {
      if ($p["GROUP_BY"] === "USER") {
        $select = $t->select()->from($t, new Zend_Db_Expr("*,SUM(AMOUNT) AS tot_amount"));
        $select->group("cellphone")->group("country_code")->order("tot_amount DESC");
        $showfields["TOT_AMOUNT"] = true;
        unset($showfields["AMOUNT"]);
        unset($showfields["DATE"]);
        unset($showfields["DESCRIPTION"]);
      }
    }


    if (array_key_exists("USER_ID_MULTIPLE",$p)) {
      $s = "";
      foreach ($p["USER_ID_MULTIPLE"] as $uid) {
          $s .= " `from_user_id` = '$uid' or";
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

    if (array_key_exists("TRANSACTION_TYPE",$p)) {
          $select->where("`type` = ?",$p["TRANSACTION_TYPE"]);
    }

    if (array_key_exists("AMOUNT_FROM",$p)) {
      $select->where("amount >= ?",$p["AMOUNT_FROM"]);
    }
    if (array_key_exists("AMOUNT_TO",$p)) {
      $select->where("amount <= ?",$p["AMOUNT_TO"]);
    }


    if ($count) {
        $select->from($t->_name,'COUNT(*) AS num');
        $raw = $t->fetchRow($select)->num;
        return $raw;
    } else {
        $raw = $t->fetchAll($select);
    }


    $finalraw = "";

    if ($download) {
      $finalraw = "";
      $headrow = "";
      $i=0;
      foreach ($raw as $row) {
        if (array_key_exists('DATE',$showfields)) {
          $finalraw .= App_DataUtils::datetime_fmtdate($row['stamp'],$timezone) . ',' . App_DataUtils::datetime_fmttime($row['stamp'],$timezone) . ',';
          if ($i == 0) $headrow .= "DATE,TIME,";
        }
        if (array_key_exists('TYPE',$showfields)) {
          $finalraw .= App_Transaction_Type::getConstName($row['type']) . ',';
          if ($i == 0) $headrow .= "TYPE,";
        }
        if (array_key_exists('NAME',$showfields)) {
          $finalraw .= $row['first_name'] . ',';
          $finalraw .= $row['last_name'] . ',';
          $finalraw .= $row['first_name'] . ' ' . $row['last_name']  . ',';
          if ($i == 0) $headrow .= "FIRST NAME, LAST NAME, FULL NAME,";
        }
        if (array_key_exists('ADDRESS',$showfields)) {
          $finalraw .= $row['addr1'] . ' ' . $row['addr2']  . ' ' . $row['addr3']  . ' ' . $row['addr4'] . ',';
          $finalraw .= $row['city'] . ',';
          $finalraw .= $row['state'] . ',';
          $finalraw .= $row['zip'] . ',';
          $finalraw .= $row['addr1'] . ' ' . $row['addr2']  . ' ' . $row['addr3']  . ' ' . $row['addr4']  . ' ' . $row['city']  . ' ' . $row['state']  . ' ' . $row['zip']  . ',';
          if ($i == 0) $headrow .= "ADDRESS,CITY,STATE,ZIP,FULL ADDRESS,";
        }
        if (array_key_exists('PHONE',$showfields)) {
          $finalraw .= $row['country_code'] . ',';
          $finalraw .= $row['cellphone'] . ',';
          $finalraw .= $row['country_code'] . $row['cellphone'] . ',';
          if ($i == 0) $headrow .= "COUNTRY CODE,PHONE,FULL PHONE,";
        }
        if (array_key_exists('EMAIL',$showfields)) {
          $finalraw .= $row['email'] . ',';
          if ($i == 0) $headrow .= "EMAIL,";
        }
        if (array_key_exists('AMOUNT',$showfields)) {
          $finalraw .= $row['amount'] . ',';
          if ($i == 0) $headrow .= "AMOUNT,";
        }
        if (array_key_exists('DESCRIPTION',$showfields)) {
          $finalraw .= $row['user_description'] . ',';
          if ($i == 0) $headrow .= "REASON,";
        }

        if (array_key_exists('TOT_AMOUNT',$showfields)) {
          $finalraw .= $row['tot_amount'] . ',';
          if ($i == 0) $headrow .= "TOTAL AMOUNT,";
        }



        $finalraw = substr_replace($finalraw ,"",-1);
        $finalraw .= "\n";
        if ($i == 0) $headrow = substr_replace($headrow ,"",-1);
        $i++;
      }
      if ($headers) $finalraw = "$headrow\n" . $finalraw;

    } else { 

      $finalraw = array();

      foreach ($raw as $row) {
        $r = array();
        foreach ($row as $key => $val) {
          $r[$key] = $val;
        }
        array_push($finalraw,$r);
      }
    }
    return $finalraw;

    }
    
}

?>
