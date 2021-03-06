<?php

class App_Event_Posws_MainmenuController_deletemainmenu extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MENUID' => array('int', 25, 1, App_Constants::getFormLabel('MENUID')),
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

                $menuid       = $this->_request->getParam("MENUID");

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
             //   App_DataUtils::userlogp('Delete',$ns->mobileid,'user_mobile','Delete Document');

                $de = new App_MainmenuEngine();
                $de->deletemainmenu($ns->mobileid,$menuid);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
