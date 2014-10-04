<?php

class App_Event_Posws_DocumentController_getinvoice extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
               'AMOUNT' => array('int', 25, 1, App_Constants::getFormLabel('AMOUNT'))
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
	public function execute()
   {
		App_DataUtils::beginTransaction();
		$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      $amount1 = $this->_request->getParam("AMOUNT");
      $result = array();
		$c = new App_Cellphone($ns->mobileid);
    	//  $c->checkConstraint($amount,'2',true,true);
    	//  $c->checkConstraint($amount,'4',true,false);
		$uid = $c->getUserId();
		$user = new App_User($uid);
		$address1 = $user->getAddress1();
		$address2 = $user->getAddress2();
		$city = $user->getCity();
		$state = $user->getState();
		$firstname = $user->getFirstName();
		$lastname = $user->getLastName();
		$phoneno = $user->getBusinessPhone();
		$email = $user->getEmail();
		$businessname = $user->getBusinessName();
		$imagepath = $user->getImagePath();
		$panno = $user->getPanNo();
		$merchant_id = $user->getMerchantId();
		$kyc_to_user = $user->getKYC();
		$invoice_no = ''.rand(15 ,1000000000000).'';
					
      $c = new App_Cellphone($ns->mobileid);
		$wigidata = new App_Models_Db_Wigi_Useraddrpos();

    	$rowval = $wigidata->fetchRow(
      $wigidata->select()
        ->where('user_id = ?', $uid)
    	);
   
      $data = array();
		$uid = $ns->userid;
      $mid = $ns->mobileid;
		$p = new App_Prefs();
      $prefs = $p->getCellphonePrefs($uid,$mid);
      $ipAddr = $_SERVER['REMOTE_ADDR'];
		$url = "http://api.ipinfodb.com/v3/ip-city/?key=5cfaab6c5af420b7b0f88d289571b990763e37b66761b2f053246f9db07ca913&ip=$ipAddr&format=json";
    	$d = file_get_contents($url);
    	
    	
    	
    	 if($rowval->vattin  != "Not Applicable")
      {
      	$vtax =$rowval->vattin;
      }
      if($prefs["salestax_percent"] != "Not Applicable")
      {
      	$sales_tax = $prefs["salestax_percent"];
      }
      if($rowval->service_tax != "Not Applicable")
      {
      	$service_tax = $rowval->service_tax;
      }
      if($rowval->csttin !="Not Applicable")
      {
      	$cst_tax = $rowval->csttin;
      }
      if($prefs["tips_percent"] !="Not Applicable")
      {
      	$tips_tax = $prefs["tips_percent"];
      }
  		$all_tax = $vtax + $sales_tax + $service_tax + $cst_tax + $tips_tax;
  		$total = ($amount1 * $all_tax)/100;
  		$amount = $total+ $amount1;
    	
    	$w = new App_WigiEngine();
		$r = $w->createTransaction1( $ns->extinfo ,$ns->mobileid ,$amount,$ns->prefs["wigi"]['timeout'],$ns->prefs["system"]["timezone"]);

      
   	$location_info = json_decode($d , true);
   	$currentlocation = $location_info['cityName'].','.$location_info['regionName'].','.$location_info['countryName'];
      $result["Accepted_currancy"] = $prefs["invoice_currancy"];
      $result["time_due"]=$prefs["time_due"];
      $result["create_date"]= date('y-m-d H:i:s');
      $result["invoice_no"]= $invoice_no;
      $result["merchant_id"]= $merchant_id;
      $result["mobile_id"]= $mid ;
      $result["user_id"]= $uid ;
      $result["counter_manager"]= $firstname.' '.$lastname;
      $result["title"]= $firstname.' '.$lastname;
      $result["address1"]= $address1;
      $result["address2"]= $address2;
      $result["city"]   = $city;
     	$result["state"]  = $state;
      $result["transaction_location"]= $currentlocation;
      $result["phoneno"]= $phoneno;
      $result["email"]= $email;
      $result["business_name"]= $businessname;
      $result["pan_no"]= $panno;
      $result["Transaction_Type"]= 'Scan and Pay™';
      
     /* $result["refund_policy"]=$prefs["refund_policy"] ;
      $result["vate_salestax"]=$prefs["vate_salestax"];
      $result["vate_salestax_percent"] =  $prefs["vate_salestax_percent"];
      $result["salestax"] = $prefs["salestax"];
      $result["salestax_percent"] = $prefs["salestax_percent"];
      $result["servicetax"] = $prefs["servicetax"];
      $result["servicetax_percent"] =  $prefs["servicetax_percent"];
      $result["csttax"] =  $prefs["csttax"];
      $result["csttax_percentage"] =  $prefs["csttax_percent"];
      $result["tips"] =  $prefs["tips"];
      $result["tips_percent"] =  $prefs["tips_percent"];*/
      
      
      
      $result["refund_policy"]=$prefs["refund_policy"] ;
      $result["vate_salestax"]=$prefs["vate_salestax"];
      $result["vate_salestax_percent"] =  $rowval->vattin;
      $result["salestax"] = $prefs["salestax"];
      $result["salestax_percent"] = $prefs["salestax_percent"];
      $result["servicetax"] = $prefs["servicetax"];
      $result["servicetax_percent"] =  $rowval->service_tax;
      $result["csttax"] =  $prefs["csttax"];
      $result["csttax_percentage"] = $rowval->csttin;
      $result["tips"] =  $prefs["tips"];
      $result["tips_percent"] =  $prefs["tips_percent"];
     
      $result["longtitude"] = $prefs["longtitude"];
      $result["lattitude"] = $prefs["lattitude"];
      $result["image_path"] = 'http://incashme.com/u/profile/'.$imagepath;
		$data_val = array_merge($r,$result);
		$result1['result']['status'] = 'success';
      $result1['result']['value']  = '';
      $result1['result']['data']   = $data_val;
		App_DataUtils::commit(); 
      return $result1; 
   }
    
}
