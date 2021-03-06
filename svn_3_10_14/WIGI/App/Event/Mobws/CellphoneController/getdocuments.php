<?php

class App_Event_Mobws_CellphoneController_getdocuments extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'PIN' => array('pin', 25, 1, App_Constants::getFormLabel('PIN')),
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

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
				
				//$checkpermission = $cthis->checkpermission($ns->mobileid,'',1);
				
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Documents');

                $pin     = $this->_request->getParam("PIN");

                $c = new App_Cellphone($ns->mobileid);
				
                if ($c->getPin() !== Atlasp_Utils::inst()->encryptPassword($pin)) {
                  throw new App_Exception_WsException("Incorrect PIN.");
                }

                $de = new App_DocumentEngine();
                $res = $de->getDocuments($ns->mobileid);
				
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $res;

                App_DataUtils::commit();
                return $result;
    }
}
