<?php

class App_Document extends App_Models_Db_Wigi_DocInfo {


  public function __construct($id) {

    parent::__construct();
    $result = $this->find($id)->current();

    $this->doc_info_id          = $result->doc_info_id;
    $this->userid               = $result->user_id;
    $this->mobileid             = $result->mobile_id;

  }

  public function getUserId() {
    return $this->userid;
  }
  
  public function getMobileId() {
    return $this->mobileid;
  }

  public static function getMyDocuments($mobileid) {
    
    $t = new App_Models_Db_Wigi_ViewMyDocuments();

    $result = $t->fetchAll(
      $t->select()
        ->where('mobile_id = ?', $mobileid)
    );

    //if (count($result) == 0) {
    //  throw new WigiException('No documents available');
    //  return false;
    //}

    $res = array();

    foreach ($result as $row) {
      $q = array();
      $q['doc_info_id'] = $row['doc_info_id'];
      $q['doc_type']    = $row['doc_type'];
      $q['expiration']  = App_DataUtils::datetime_fmtdate($row['expiration']);
      $q['description'] = $row['description'];
      $q['number']      = $row['number'];
      array_push($res,$q);
    }

    return $res;
  }


}

?>
