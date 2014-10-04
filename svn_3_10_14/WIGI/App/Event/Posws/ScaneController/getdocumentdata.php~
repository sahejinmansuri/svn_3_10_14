<?php

class App_Event_Posws_DocumentController_getdocumentdata extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'DOCID' => array('int', 25, 1, App_Constants::getFormLabel('DOCID')),
                'TYPE'  => array('generic', 10, 1, App_Constants::getFormLabel('TYPE')),
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

                $docid     = $this->_request->getParam("DOCID");
                $type      = $this->_request->getParam("TYPE");

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                // App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Document Data');
					
					$de = new App_DocumentEngine();
               
                $res = $de->getDocumentData($ns->mobileid,$docid,$type);
            
                
                $image = imagecreatefromstring(base64_decode($res));
               
                header('Content-type: image/jpeg');
                imagejpeg($image);
                //echo $res;
                
               /* $data = base64_decode($res);
					
					$im = imagecreatefromstring($data);
					if ($im !== false) {
					    header('Content-Type: image/jpeg');
					    $image = imagejpeg($im);
					    imagedestroy($im);
					}*/
					
                App_DataUtils::commit();
//             return $image;

    }
}
