<?php

class App_Event_Cw_AdvancedController_mydocumentsdataview extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MOBILEID'  => array('int', 25, 1, App_Constants::getFormLabel('MOBILEID')),
                'TYPE'  => array('generic', 25, 1, App_Constants::getFormLabel('TYPE')),
                'DOCID'  => array('int', 25, 1, App_Constants::getFormLabel('DOCID')),
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
                        $docid     = $this->_request->getParam("DOCID");
                        $type      = $this->_request->getParam("TYPE");
                        $mobileid  = $this->_request->getParam("MOBILEID");
                        $uid       = $session_data->userid;
                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$mobileid);
                        App_Resource::cellphoneIsAuthorized("DOCUMENT",$mobileid,$docid);

                        $de = new App_DocumentEngine();
                        $res = $de->getDocumentData($mobileid,$docid,$type);
                        App_DataUtils::commit();
                        header('Content-type: image/jpeg');
                        echo $res;
                        exit;

    }
}
