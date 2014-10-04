<?php

class App_Event_Posws_MainmenuController_updatesubmenu extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'SUBMENUID' => array('int', 25, 1, App_Constants::getFormLabel('SUBMENUID')),
                'MENUID' => array('int', 25, 1, App_Constants::getFormLabel('MENUID')),
                'TITLE' => array('generic', 25, 1, App_Constants::getFormLabel('TITLE')),
                'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
                'SAME' => array('generic', 50, 1, App_Constants::getFormLabel('TYPE')),
                'RATE' => array('generic', 50, 1, App_Constants::getFormLabel('RATE')),
                'QUANITTY' => array('generic', 50, 1, App_Constants::getFormLabel('QUANITTY')),

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
                $submenuid       = $this->_request->getParam("SUBMENUID");
                $menuid       = $this->_request->getParam("MENUID");
                $same        = $this->_request->getParam("SAME");
                $rate        = $this->_request->getParam("RATE");
                $quantity        = $this->_request->getParam("QUANITTY");
                


                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Update',$ns->mobileid,'user_mobile','Update Document');

                $upload = new Zend_File_Transfer_Adapter_Http();
                $upload->setDestination("/var/www/html/incash/public_html/u/data");
                $upload->receive();
                $filename = $upload->getFileName('MENUSUBIMG');
                
                
					$m = new App_Messenger();
					$message = $menuid;

					//$m->sendMessage("Message:".$message,"incashmeapp@gmail.com",'1');
                $data = ""; 

                /*if ($same === "FALSE" ) {
                  //$data = file_get_contents($filename);
                  echo "hi";
                  exit;
                   $data  = base64_encode(file_get_contents($filename));
              
                }
              */
              if ($_FILES['MENUSUBIMG']['name'] !="" ) {
                  //$data = file_get_contents($filename);
                 
                   $data  = base64_encode(file_get_contents($filename));
                   
            
              
                }
					  
                $de = new App_MainmenuEngine();
                $de->updatesubmenu($submenuid, $menuid,$ns->mobileid,$title,$description,$data,$same,$rate,$quantity);

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;
    }
}
