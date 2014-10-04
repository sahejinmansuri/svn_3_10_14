<?php

class App_Event_Mobws_AuthController_settosandauth extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('phone', 15, 1, App_Constants::getFormLabel('CELLPHONE')),
                'CCODE' => array('countrycode', 3, 1, App_Constants::getFormLabel('CCODE')),
                'PIN' => array('pin', 10, 1, App_Constants::getFormLabel('PIN')),
                'OSID' => array('generic', 100, 1, App_Constants::getFormLabel('OSID')),
                //'TOSID' => array('int', 5, 1, App_Constants::getFormLabel('TOSID')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$cthis){

        App_DataUtils::beginTransaction();

        $cellphone = $this->_request->getParam('CELLPHONE');
        $ccode     = $this->_request->getParam('CCODE');
        $pin       = $this->_request->getParam('PIN');
        $osid      = $this->_request->getParam('OSID');
        //$tosid     = $this->_request->getParam('TOSID');

                //TODO: test to see if the username and password was good

                $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$ccode);
                $c = new App_Cellphone($mobileid);
                $u = new App_User($c->getUserId());
                $t = App_Tos::getCurrentTos();
                $u->setAcceptedTos($t['tos_id']);

                $params = $this->_request->getParams();

        App_DataUtils::commit();

        $cthis->getHelper('redirector')->goto('consolidatedauth','auth','mobws',$params);

    }
}
