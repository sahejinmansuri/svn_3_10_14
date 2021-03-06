<?php

class App_Event_Posws_MainmenuController_addmainmenu extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
               // 'LOGINID' => array('generic', 25, 1, App_Constants::getFormLabel('LOGINID')),
               // 'MOBILEID' => array('generic', 25, 1, App_Constants::getFormLabel('MOBILEID')),
                'TITLE' => array('generic', 25, 1, App_Constants::getFormLabel('TITLE')),
                'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
               
               
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
					
                 $title     = $this->_request->getParam("TITLE");
               
                $description = $this->_request->getParam("DESCRIPTION");
               $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
              // echo $ns->userid;exit;
               $upload = new Zend_File_Transfer_Adapter_Http();
                
                $upload->setDestination("/var/www/html/incash/public_html/u/data");
                $upload->receive();
               
                $filename  = $upload->getFileName('MENUIMG');
                //$img_filename = $_FILES['DOCIMG']['name'];
                //$img_filename2 =$_FILES['DOCIMG2']['name'];

                //$data = "";
               $data  = base64_encode(file_get_contents($filename));
               
                $de = new App_MainmenuEngine();
                
                $id = $de->addmainmenu($ns->userid,$ns->mobileid,$title,$description,$data);
 						

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $id;

                App_DataUtils::commit();
					 $uinfo = new App_Models_Db_Wigi_tblmainmenu();
					 $uinfof = $uinfo->update(
                                        array(
                                                'title' => $title
                                        ),
                                        $uinfo->getAdapter()->quoteInto('main_menu_id = ?', $id)
                                );
                return $result;
    }
}
