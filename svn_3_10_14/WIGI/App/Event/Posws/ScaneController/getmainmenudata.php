<?php

class App_Event_Posws_MainmenuController_getmainmenudata extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MENUID' => array('int', 25, 1, App_Constants::getFormLabel('MENUID')),
               // 'TYPE'  => array('generic', 10, 1, App_Constants::getFormLabel('TYPE')),
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

                $menuid     = $this->_request->getParam("MENUID");
               // $type      = $this->_request->getParam("TYPE");

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                // App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Document Data');
					
					$de = new App_MainmenuEngine();
               
                $res = $de->getmainmenudata($ns->mobileid,$menuid);
            
                
                $image = imagecreatefromstring(base64_decode($res));
             
                header('Content-type: image/jpeg');
                imagejpeg($image);
              
					
                App_DataUtils::commit();


    }
}
