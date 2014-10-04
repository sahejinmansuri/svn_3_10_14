<?php

class App_Event_Mobws_CellphoneController_updatedocument extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'DOCID' => array('int', 25, 1, App_Constants::getFormLabel('DOCID')),
                'DOCTYPE' => array('generic', 25, 1, App_Constants::getFormLabel('DOCTYPE')),
                'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
                'NUMBER' => array('generic', 50, 0, App_Constants::getFormLabel('NUMBER')),
                'EXPIRES' => array('generic', 12, 0, App_Constants::getFormLabel('EXPIRES')),
                'SAME' => array('generic', 50, 1, App_Constants::getFormLabel('TYPE')),
                'SAME2' => array('generic', 12, 1, App_Constants::getFormLabel('TYPE')),

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

                $doctype     = $this->_request->getParam("DOCTYPE");
                $description = $this->_request->getParam("DESCRIPTION");
                $number      = $this->_request->getParam("NUMBER");
                $expires     = App_DataUtils::fmttime_datetime($this->_request->getParam("EXPIRES"));
                $docid       = $this->_request->getParam("DOCID");
                $same        = $this->_request->getParam("SAME");
                $same2       = $this->_request->getParam("SAME2");


                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Update',$ns->mobileid,'user_mobile','Update Document');

                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->setDestination("/tmp");
                $upload->receive();
                $filename = $upload->getFileName('DOCIMG');
                $filename2 = $upload->getFileName('DOCIMG2');

                $data = ""; $data2 = "";

                if ($same === "FALSE" ) {
                  $data = file_get_contents($filename);
                }
                if ($same2 === "FALSE") {
                  $data2 = file_get_contents($filename2);
                }

                $de = new App_DocumentEngine();
                $de->updateDocument($docid,$ns->mobileid,$doctype,'1',$description,$data,$data2,$number,$expires);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
