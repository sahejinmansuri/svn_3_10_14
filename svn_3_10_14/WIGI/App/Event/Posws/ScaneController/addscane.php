<?php

class App_Event_Posws_ScaneController_addscane extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
               // 'LOGINID' => array('generic', 25, 1, App_Constants::getFormLabel('LOGINID')),
               // 'MOBILEID' => array('generic', 25, 1, App_Constants::getFormLabel('MOBILEID')),
            
                 'MONEYVALUE' => array('generic', 25, 1, App_Constants::getFormLabel('MONEYVALUE')),
                'TIMEPERIOD' => array('generic', 255, 1, App_Constants::getFormLabel('TIMEPERIOD')),
                'ACCEPTEDCURRENCY' => array('generic', 255, 1, App_Constants::getFormLabel('ACCEPTEDCURRENCY')),
                'MAXNOSCANE' => array('generic', 255, 1, App_Constants::getFormLabel('MAXNOSCANE'))
               
               
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
		$moneyvalue     = $this->_request->getParam("MONEYVALUE");
      $timeperiod = $this->_request->getParam("TIMEPERIOD");
      $acceptedcurrency = $this->_request->getParam("ACCEPTEDCURRENCY");
      $maxnoscan = $this->_request->getParam("MAXNOSCANE");
      $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      
		$qr_code = $moneyvalue.'-'.$timeperiod.'-'.$acceptedcurrency.'-'.$maxnoscan;
       /*$code_params = array('text'            => "$qr_code",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => '#000000',
          'padding' => 4,  //array(10,5,10,5),
          'moduleSize' => 8);

          $renderer_params = array('imageType' => 'png');
          Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);*/
          
      $de = new App_ScaneEngine();
      $id = $de->addscane($ns->userid,$ns->mobileid, $moneyvalue, $timeperiod, $acceptedcurrency, $maxnoscan);
 		$result = array();
      $result['result']['status'] = 'success';
      $result['result']['value'] = '';
      $result['result']['data']   = $id;
		App_DataUtils::commit();
		$uinfo = new App_Models_Db_Wigi_scanedonate();
		$uinfof = $uinfo->update(
      									array(
                                 			'money_value' => $moneyvalue
                                     ),
      $uinfo->getAdapter()->quoteInto('scaneid = ?', $id)
                                );
      return $result;
    }
}
