<?php

class App_Event_Mobws_CellphoneController_getlogo extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MERCHANTID' => array('generic', 100, 1, App_Constants::getFormLabel('MERCHANTID')),
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

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Logo');


                $merchantid = $this->_request->getParam("MERCHANTID");
                $uid = "";
                if (preg_match('/-/',$merchantid)) {
                  $uid = intval(App_User::getUserIdFromMerchantId($merchantid));
                } else {
                  $uid = $merchantid;
                }
                if (is_file("/u/data/logos/$uid/logo")) {
                        $res = file_get_contents("/u/data/logos/$uid/logo");
                        header('Content-type: image/jpeg');
                        echo $res;
                }

                App_DataUtils::commit();
                exit();


                /*$result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $res;


                return $result;*/
    }
}
