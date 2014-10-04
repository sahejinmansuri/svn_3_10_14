<?php

class App_Event_Mobws_CellphoneController_updatedonation extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'END_DATE' => array('generic', 15, 1, App_Constants::getFormLabel('END_DATE')),
                'FREQUENCY' => array('generic', 15, 1, App_Constants::getFormLabel('FREQUENCY')),
                'AMOUNT' => array('generic', 15, 1, App_Constants::getFormLabel('AMOUNT')),
                'REASON' => array('generic', 15, 1, App_Constants::getFormLabel('REASON')),
                'ID' => array('int', 15, 1, App_Constants::getFormLabel('ID')),
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

                $date      = App_DataUtils::fmttime_datetime($this->_request->getParam("END_DATE"));
                $frequency = $this->_request->getParam("FREQUENCY");
                $id        = $this->_request->getParam("ID");
                $amount = $this->_request->getParam("AMOUNT");
                $reason        = $this->_request->getParam("REASON");
				
				error_log("=============================".$amount);
				
                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Delete WigiCode');

                $o = new App_Order($id);
                $o->updateDonate($date,$frequency,$reason,$amount);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
