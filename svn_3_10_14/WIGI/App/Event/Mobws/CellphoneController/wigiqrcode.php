<?php

class App_Event_Mobws_CellphoneController_wigiqrcode extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'WIGICODE' => array('wigicode', 15, 1, App_Constants::getFormLabel('WIGICODE')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();

         //error_log("being gen wigiqr");
         $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
         App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get QR Code');
         $wigicode   = $this->_request->getParam("WIGICODE");

         $u = new App_User($ns->userid);
         $c = new App_Cellphone($ns->mobileid);

         $s = "WIGICODE=$wigicode&COUNTRYCODE=" . $u->getCountryCode() . "&CELLPHONE=" . $c->getCellphone();
		 $encrypt = App_Encrypt::encrypt($s,'1');
		 
		 $transaction = new App_Models_Db_Wigilog_Transaction();
		 $select = $transaction->select()->where('`wigi_code_id` = ?', $wigicode);
		$code_array = $transaction->fetchAll($select);
		
		foreach($code_array as $key=>$val){
			$amount = $val['amount'];
		}
		 /*if($flag == 1){
			throw new App_Exception_WsException('There is a charge of '.$billing);
		  }*/
		 //decrypt code
		 //$passphrase = file_get_contents("/var/www/html/incash/etc/wigi-keys/v" . $this->keyver . "/passphrase");
		 //$decrypt = App_Decrypt::decrypt($encrypt, $passphrase, '1');
		 //error_log("wigiqr is ". $s);
		 //error_log("encrypt is ". $encrypt);
         //error_log("decrypt is ". $decrypt);
		 
        
	
	//check billing for redeem
	$mobileid = $ns->mobileid;
	$amount = $amount;
	$transaction_type = 207;
	
	$billing_amount = App_Billing::billing_check($mobileid, $amount, $transaction_type);
	
	
	$flag = 0;
	if($billing_amount != 0){
		$flag = 1;
	}
	if($flag == 1){
		$color_code = '#000000';
		 $code_params = array('text'            => "$encrypt",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => $color_code,
          'padding' => 2,  //array(10,5,10,5),
          'moduleSize' => 8,
			'newcolor' => '#0000ff');
			$chargable = 1;
	}else{
		$color_code = '#000000';
		 $code_params = array('text'            => "$encrypt",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => $color_code,
          'padding' => 2,  //array(10,5,10,5),
          'moduleSize' => 8);
			$chargable = 0;
	}
	

          App_DataUtils::commit();

          $renderer_params = array('imageType' => 'png');
	
	
		  
          try{
			Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
          }catch(Exception $e){
            //error_log("error rendering wigiqr ". $e->getMessage());
          }
          //error_log("finished rendering wigiqr");
		  
		  $result = array();
		  $result['result']['status'] = 'success';
          $result['result']['value']  = '';
          $result['result']['data']['chargable_wigi']   = $chargable;
		return $result;

    }
}
