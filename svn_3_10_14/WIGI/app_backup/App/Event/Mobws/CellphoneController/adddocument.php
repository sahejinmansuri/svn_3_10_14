<?php

class App_Event_Mobws_CellphoneController_adddocument extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'DOCTYPE' => array('generic', 25, 1, App_Constants::getFormLabel('DOCTYPE')),
                'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
                'NUMBER' => array('generic', 50, 0, App_Constants::getFormLabel('NUMBER')),
                'EXPIRES' => array('generic', 12, 0, App_Constants::getFormLabel('EXPIRES')),
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

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Add',$ns->mobileid,'user_mobile','Add Document');

                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->setDestination("/tmp");
                $upload->receive();
                $filename  = $upload->getFileName('DOCIMG');
                $filename2 = $upload->getFileName('DOCIMG2');

                //$data = "";
                $data  = file_get_contents($filename);
                $data2 = file_get_contents($filename2);

                $de = new App_DocumentEngine();

                $id = $de->addDocument($ns->mobileid,$doctype,'1',$description,$data,$data2,$number,$expires);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $id;

                App_DataUtils::commit();
                return $result;
    }
}
