<?php

class App_Event_Mw_AdvancedController_merchantidqrcode extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => 0 
		);
	}
	
	public function getEvtData() {
		$data = parent::getEvtData();
		unset($data['inputs']['KEY']);
		unset($data['inputs']['IDENTIFIER']);
		return $data;
	}
	
	public function execute(&$session_data,&$pview,&$cthis){

            $uid = $session_data->identity['userid'];
            $u = new App_User($uid);
            $merchantid = $u->getMerchantId(); 
            
         $code_params = array('text'            => "a$merchantid",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => '#000000',
          'padding' => 4,  //array(10,5,10,5),
          'moduleSize' => 8);

          $renderer_params = array('imageType' => 'png');
          Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
          exit();	
	}
	
}

?>
