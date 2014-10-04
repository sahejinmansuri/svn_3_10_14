<?php

class App_Event_Aw_MerchantProfileController_discountstep2 extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
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
    
    public function execute(&$mid,&$pview,&$cthis, &$identity){
			$list = App_Transaction_Type::getConstName();
			$cthis->view->typelist = $list;
			
			$month = $this->_request->getParam('month');
			$category = $month.' special billing';
			$us = new App_Models_Db_Wigi_WigiMerchantSettings();
			$a = $us->fetchAll($us->select()->from($us,array('category', 'value','datecreated'))->where('user_id = ?',$mid)->where('status = ?','A')->where('category = ?',$category));
			$res1 = $a->toArray(); 
			$str = 'N-|N---|0-0';
			if(isset($res1[0])){ $str = $res1[0]['value'];}
			$special_billing_data = App_Transaction_WigiSpecialBilling::prepareSpecialBillingData($str);

			foreach($special_billing_data as $id=>$data)
			{
				$cthis->view->$id= $data;
			}

			$cthis->view->special_tcodes = App_Transaction_WigiSpecialBilling::getSpecialTransactionCodeDetails();
			//$cthis->view->special_tcodes = App_Transaction_WigiSpecialBilling::SPECIAL_TRANS_CODES;
    }
}
