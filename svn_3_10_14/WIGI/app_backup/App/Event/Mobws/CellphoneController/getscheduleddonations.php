<?php

class App_Event_Mobws_CellphoneController_getscheduleddonations extends App_Event_WsEventAbstract {

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
    
    public function execute(){
                App_DataUtils::beginTransaction();

                //$code = $this->_request->getParam("CODE");
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Delete WigiCode');

                
                $p["CONSUMER_MOBILE_ID"] = $ns->mobileid;
                $p["STATUS"] = 'recurring';

                $results = App_Order::getConsumerOrders($ns->userid,$p,'donate','0','1000',$ns->timezone);
                if (count($results) == 0) {
                    throw new App_Exception_WsException("No recurring donations available.");
                }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $results;

                App_DataUtils::commit();
                return $result;
    }
}
