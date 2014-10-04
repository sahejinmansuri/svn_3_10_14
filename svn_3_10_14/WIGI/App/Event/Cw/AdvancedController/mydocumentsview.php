<?php

class App_Event_Cw_AdvancedController_mydocumentsview extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'C'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE')),
                'D'  => array('int', 25, 1, App_Constants::getFormLabel('DOCUMENT')),
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
                        $uid = $session_data->userid;
                        $cellid = $this->_request->getParam("C");
                        $docid = $this->_request->getParam("D");
                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$cellid);
                        App_Resource::cellphoneIsAuthorized("DOCUMENT",$cellid,$docid);
						
						$de = new App_DocumentEngine();
                        $res_front = $de->getDocumentData($cellid,$docid,'FRONT');
                        $res_back = $de->getDocumentData($cellid,$docid,'BACK');
						
						$image_jpeg = 'data:image/jpeg;base64, ';
						
						$pview->image_front = $image_jpeg.$res_front;
						$pview->image_back = $image_jpeg.$res_back;

                        $pview->pageid = "advanced";

                        $pview->cellid = $cellid;
                        $pview->docid = $docid;
                        App_DataUtils::commit();

    }
}
