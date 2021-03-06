<?php

class App_Event_Posws_DocumentController_invoiceqrcode extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'IMPC' => array('wigicode', 15, 1, App_Constants::getFormLabel('IMPC')),
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
		error_log("being gen wigiqr");
      $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      $wigicode   = $this->_request->getParam("IMPC");
		$u = new App_User($ns->userid);
      $c = new App_Cellphone($ns->mobileid);
      
      $wigidata = new App_Models_Db_Wigilog_WigiCode();

    	$rowval = $wigidata->fetchRow(
      $wigidata->select()
        ->where('wigi_code_id = ?', $wigicode)
    	);
    
		$s = "WIGICODE=$wigicode&COUNTRYCODE=" . $u->getCountryCode() . "&CELLPHONE=" . $c->getCellphone() . "&MERCHANT_ID=" . $ns->userid . "&AMOUNT=". $rowval->amount."&TYPE=PAY";
		//$s = "AMOUNT=0&MERCHANTID=10&WIGICODE=562783866&TYPE=Donate";		
		 $encrypt =  App_DataUtils::obfuscate($s);
		//exit;
		//echo '----'.App_DataUtils::unobfuscate($encrypt);
		//exit;
		//$encrypt = App_Encrypt::encrypt($message,'1');
		
		//decrypt code
		$passphrase = file_get_contents("/var/www/html/incash/etc/wigi-keys/v" . $this->keyver . "/passphrase");
		$decrypt = App_Decrypt::decrypt($encrypt, $passphrase, '1');
		error_log("wigiqr is ". $s);
		//error_log("encrypt is ". $encrypt);
      //error_log("decrypt is ". $decrypt);
		$code_params = array('text'            => "$encrypt",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => '#000000',
          'padding' => 3,  //array(10,5,10,5),
          'moduleSize' => 8,
          'newcolor' => '#0000ff');

      App_DataUtils::commit();
		$renderer_params = array('imageType' => 'png');
      try
      {
			Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
      }
  		catch(Exception $e)
  		{
			error_log("error rendering wigiqr ". $e->getMessage());
      }
      error_log("finished rendering wigiqr");


    }
}
