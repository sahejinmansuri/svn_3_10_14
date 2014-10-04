<?php

class App_Event_Mobws_CellphoneController_movefunds extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'amount'  => array('amount', 25, 1, App_Constants::getFormLabel('AMOUNT')),
                'cellphone_from'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE_FROM')),
                'cellphone_to'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE_TO')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){

             App_DataUtils::beginTransaction();
             $amount = $this->_request->getParam("amount");
             $movefrom = $this->_request->getParam("cellphone_from");
             $moveto = $this->_request->getParam("cellphone_to");
             $uid = $session_data->identity['userid'];
             App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$movefrom); 

             $pview->pageid = "advanced";

             //$u = new App_User($uid);

             //$moveto = $u->getDefaultCellphone();
			if($movefrom == $moveto){
				throw new App_Exception_WsException('You can not Move Funds to same cellphone');
				return false;
			}
             $w = new App_WigiEngine();
             $w->sendMoney($session_data->extinfo,$movefrom,$moveto,$amount,'Move');
			 
					$result = array();
                    $result['result']['status'] = 'success';
                    $result['result']['value']  = '';
                    $result['result']['data']   = '';
			 
			App_DataUtils::commit();
			return $result;

    }
}
