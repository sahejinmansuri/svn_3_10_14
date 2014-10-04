<?php

class App_Event_Cw_AdvancedController_mydocumentsdelete extends App_Event_WsEventAbstract  {

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
                        $cellid = $this->_request->getParam("C");
                        $docid = $this->_request->getParam("D");
                        $uid       = $session_data->userid;
                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$cellid);
                        App_Resource::cellphoneIsAuthorized("DOCUMENT",$cellid,$docid);


                        $pview->pageid = "advanced";
                        $pview->showcontent = "form";
                        $pview->cellid = $cellid;
                        $pview->docid = $docid;

                        $d = new App_DocumentEngine();
                        $documents = $d->deleteDocument($cellid, $docid);

                        $pview->showcontent = "success";
                        App_DataUtils::commit();

    }
}
